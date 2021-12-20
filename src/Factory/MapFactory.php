<?php

/*
 * Copyright 2021 Michael Lucas.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Nasumilu\UX\Leafletjs\Factory;

use Symfony\Component\OptionsResolver\{
    OptionsResolver,
    Options
};
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\RouterInterface;
use Nasumilu\UX\Leafletjs\Model\Map;
use function array_filter;
use function is_null;
use function in_array;

/**
 * 
 */
class MapFactory implements MapFactoryInterface, MapLoaderInterface
{

    /**
     * @var LoaderInterface
     */
    private $loader;
    
    /**
     * @var OptionsResolver
     */
    private $optionsResolver;

    /**
     * @var LayerFactoryInterface
     */
    private $layerFactory;

    /**
     * @var ControlFactorInterface
     */
    private $controlFactory;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @param LayerFactoryInterface $layerFactory
     * @param ControlFactoryInterface $controlFactory
     * @param RouterInterface $router
     */
    public function __construct(LoaderResolverInterface $loaderResolver,
            LayerFactoryInterface $layerFactory, 
            ControlFactoryInterface $controlFactory, 
            RouterInterface $router)
    {
        $this->loader = new DelegatingLoader($loaderResolver);
        $this->layerFactory = $layerFactory;
        $this->controlFactory = $controlFactory;
        $this->router = $router;
        $this->optionsResolver = new OptionsResolver();
        $this->configureOptions($this->optionsResolver);
    }
    
    /**
     * 
     * @return LoaderInterface
     */
    public function getLoader(): LoaderInterface
    {
        return $this->loader;
    }
    
    /**
     * 
     * @return LayerFactoryInterface
     */
    public function getLayerFactory(): LayerFactoryInterface
    {
        return $this->layerFactory;
    }
    
    /**
     * 
     * @return ControlFactoryInterface
     */
    public function getControlFactory(): ControlFactoryInterface
    {
        return $this->controlFactory;
    }
    
    /**
     * 
     * @return RouterInterface
     */
    public function getRouter(): RouterInterface
    {
        return $this->router;
    }

    /**
     * 
     * @param OptionsResolver $optionsResolver
     * @return void
     */
    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        // Normalize closures
        $castToBool = OptionsNormalizer::closureFor('castToBool');
        $castToFloat = OptionsNormalizer::closureFor('castToFloat');
        $castToInt = OptionsNormalizer::closureFor('castToInt');
        $castWktCoordinateToArray = OptionsNormalizer::closureFor('castWktCoordinateToArray');
        $castBoolOrCenter = OptionsNormalizer::closureFor('castBoolOrCenter');

        // allowed values closures
        $greaterThanEqualToZero = OptionsValidator::closureFor('greaterThanEqualToZero');
        $greaterThanZero = OptionsValidator::closureFor('greaterThanZero');
        $centerOrBool = OptionsValidator::closureFor('centerOrBool');

        $optionsResolver->define('attributionControl')
                ->allowedTypes('bool', 'null')
                ->default(function (Options $options, $value) {
                    foreach ($options['controls'] ?? [] as $control) {
                        if ($control->getType() === 'attribution') {
                            return false;
                        }
                    }
                    return null;
                })
                ->info('Adds an attributionControl by default');

        $optionsResolver->define('zoomControl')
                ->allowedTypes('bool', 'null')
                ->default(function (Options $options, $value) {
                    foreach ($options['controls'] ?? [] as $control) {
                        if ($control->getType() === 'zoom') {
                            return false;
                        }
                    }
                    return null;
                })
                ->info('Adds a zoom control by default');

        // zoom option
        $optionsResolver->define('zoom')
                ->required()
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanZero)
                ->normalize($castToInt)
                ->info('Initial zoom level for the map');

        // center option
        $optionsResolver->define('center')
                ->required()
                ->allowedTypes('array', 'string')
                ->allowedValues(OptionsValidator::closureFor('wktCoordinate'))
                ->normalize($castWktCoordinateToArray)
                ->info('Initial location which to center the map');

        // layers option
        $optionsResolver->define('layers')
                ->default(function (OptionsResolver $layerOptionResolver) {
                    $layerOptionResolver->setPrototype(true);
                    $layerOptionResolver->define('type')
                    ->required()
                    ->allowedTypes('string')
                    ->allowedValues(function ($value) {
                        return in_array($value, $this->layerFactory->getLayerTypes(), true);
                    });

                    $layerOptionResolver->define('route')
                    ->allowedTypes('string')
                    ->info('The name of the route used to generate the layer\'s url.');

                    $layerOptionResolver->define('routeArgs')
                    ->allowedTypes('array')
                    ->info('The route arguments used to generate the layer\'s url.');

                    $layerOptionResolver->define('url')
                    ->required()
                    ->default(function (Options $options) {
                        if (isset($options['route'])) {
                            return $this->router->generate($options['route'], $options['routeArgs'] ?? []);
                        }
                    })
                    ->allowedTypes('string')
                    ->info('Either the full-qualified url or name of a route used '
                            . 'to obtain the layer\'s data');

                    $layerOptionResolver->define('options')
                    ->allowedTypes('array')
                    ->info('Any optional layer options.');
                })
                // normalize the lyaer options as Layer objects
                ->normalize(function (Options $options, $value) {
                    $layers = [];
                    foreach ($value as $key => $layer) {
                        $layers[] = $this->layerFactory->create($layer['type'], $key, $layer['url'], $layer['options'] ?? []);
                    }
                    return $layers;
                });

        // controls options
        $optionsResolver->define('controls')
                ->default(function (OptionsResolver $controlOptionResolver) {
                    $controlOptionResolver->setPrototype(true);
                    $controlOptionResolver->define('type')
                    ->required()
                    ->allowedTypes('string')
                    ->allowedValues(function ($value) {
                        return in_array($value, $this->controlFactory->getControlTypes(), true);
                    });

                    $controlOptionResolver->define('options')
                    ->allowedTypes('array')
                    ->info('Any optional control options.');
                })
                // normalize the control options as Control objects
                ->normalize(function (Options $options, $value) {
                    $controls = [];
                    foreach ($value as $key => $control) {
                        $controls[] = $this->controlFactory->create($control['type'], $control['options'] ?? []);
                    }
                    return $controls;
                });

        // closePopUpOnClick option
        $optionsResolver->define('closePopUpOnClick')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Indicates whether popups close when the user clicks the '
                        . 'map');

        // zoomSnap option
        $optionsResolver->define('zoomSnap')
                ->allowedTypes('numeric', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToFloat)
                ->info('Forces the map\'s zoom level to always be a multiple of '
                        . 'this value');

        // zoomDelta option
        $optionsResolver->define('zoomDelta')
                ->allowedTypes('numeric', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToFloat)
                ->info('Controls how much the map\'s zoom level will change '
                        . 'zooming. Smaller values allow for greater granularity.');

        // trackResize option
        $optionsResolver->define('trackResize')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Whether the map automatically handles browser window '
                        . 'resize to update itself.');

        // boxZoom option
        $optionsResolver->define('boxZoom')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Whether the map can be zoomed to a rectangular area '
                        . 'specified by dragging the mouse while pressing the shift key.');

        // doubleClickZoom option
        $optionsResolver->define('doubleClickZoom')
                ->allowedTypes('bool', 'string')
                ->allowedValues($centerOrBool)
                ->normalize($castBoolOrCenter)
                ->info('Whether the map can be zoomed in by double clicking on '
                        . 'it and zoomed out by double clicking while holding '
                        . 'shift.');

        // dragging option
        $optionsResolver->define('dragging')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Whether the map be draggable with mouse/touch or not.');

        // minZoom option
        $optionsResolver->define('minZoom')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToInt)
                ->info('Minimum zoom level of the map.');

        // maxZoom option
        $optionsResolver->define('maxZoom')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToInt)
                ->info('Maximum zoom level of the map.');

        // maxBounds option
        $optionsResolver->define('maxBounds')
                ->allowedTypes('array', 'string')
                ->allowedValues(OptionsValidator::closureFor('boundaryBox'))
                ->normalize(OptionsNormalizer::closureFor('castToBoundaryBox'))
                ->info('Restricts the view to the given geographical bounds, '
                        . 'bouncing the user back if the user tries to pan '
                        . 'outside the view. numeric[2][2]');

        // zoomAnimation option
        $optionsResolver->define('zoomAnimation')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Whether the map zoom animation is enabled');

        // zoomAnimationThreshold option
        $optionsResolver->define('zoomAnimationThreshold')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToInt)
                ->info('Won\'t animate zoom if the zoom difference exceeds this value.');

        // fadeAnimation option
        $optionsResolver->define('fadeAnimation')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Indicates whether the tile fade animation is enabled.');

        // markerZoomAnimation option
        $optionsResolver->define('markerZoomAnimation')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Indicates whether markers animate their zoom with the '
                        . 'zoom animation, if disabled they will disappear for '
                        . 'the length of the animation');

        // keyboard option
        $optionsResolver->define('keyboard')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Makes the map focusable and allows users to navigate the '
                        . 'map with keyboard arrows and +/- keys.');

        // keyboardPanDelta option 
        $optionsResolver->define('keyboardPanDelta')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToInt)
                ->info('Amount of pixels to pan when pressing an arrow key.');

        // scrollWheelZoom option
        $optionsResolver->define('scrollWheelZoom')
                ->allowedTypes('string', 'bool')
                ->allowedValues($centerOrBool)
                ->normalize($castBoolOrCenter)
                ->info('Indicates whether the map can be zoomed by using the mouse wheel.');

        // wheelDebounceTime option
        $optionsResolver->define('wheelDebounceTime')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToInt)
                ->info('Limits the rate at which a wheel can fire (in milliseconds)');

        // wheelPxPerZoomLevel option
        $optionsResolver->define('wheelPxPerZoomLevel')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToInt)
                ->info('How many scroll pixels mean a change of one full zoom '
                        . 'level.');

        // tap option
        $optionsResolver->define('tap')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Enables mobile hacks for supporting instant taps '
                        . '(fixing 200ms click delay on iOS/Android) and touch '
                        . 'holds (fired as contextmenu events).');

        // tapTolerance option
        $optionsResolver->define('tapTolerance')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToInt)
                ->info('The max number of pixels a user can shift his finger '
                        . 'during touch for it to be considered a valid tap.');

        // touchZoom option
        $optionsResolver->define('touchZoom')
                ->allowedTypes('string', 'bool')
                ->allowedValues($centerOrBool)
                ->normalize($castBoolOrCenter)
                ->info('Whether the map can be zoomed by touch-dragging with two'
                        . ' fingers.');

        // bounceAtZoomLimits option
        $optionsResolver->define('bounceAtZoomLimits')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Set it to false if you don\'t want the map to zoom '
                        . 'beyond min/max zoom and then bounce back when '
                        . 'pinch-zooming.');

        // inertia option
        $optionsResolver->define('inertia')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('If enabled, panning of the map will have an inertia '
                        . 'effect where the map builds momentum while dragging '
                        . 'and continues moving in the same direction for some '
                        . 'time.');

        // inertiaDeceleration option
        $optionsResolver->define('inertiaDeceleration')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToInt)
                ->info('The rate with which the inertial movement slows down, in pixels/second².');

        // inertiaMaxSpeed option
        $optionsResolver->define('inertiaMaxSpeed')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToInt)
                ->info('Max speed of the inertial movement, in pixels/second.');

        // easeLinearity
        $optionsResolver->define('easeLinearity')
                ->allowedTypes('numeric', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToFloat)
                ->info('The curvature factor of panning animation easing '
                        . '(third parameter of the Cubic Bezier curve).');

        // worldCopyJump option
        $optionsResolver->define('worldCopyJump')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('With this option enabled, the map tracks when you pan to'
                        . ' another "copy" of the world and seamlessly jumps to '
                        . 'the original one so that all overlays like markers '
                        . 'and vector layers are still visible.');

        $optionsResolver->define('maxBoundsViscosity')
                ->allowedTypes('numeric', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToFloat)
                ->info('If maxBounds is set, this option will control how solid '
                        . 'the bounds are when dragging the map around.');
    }

    /**
     * 
     * @param string $name
     * @param array $options
     * @return Map
     */
    public function create(string $name, array $options): Map
    {
        $mapOptions = $this->optionsResolver->resolve($options);

        return new Map($name, array_filter($mapOptions, static function ($value) {
                    return !is_null($value);
                }));
    }
    
    public function load(string $name, string $format = 'yaml'): Map
    {
        $config = $this->loader->load("$name.$format");
        return $this->create($name, $config);
    }

}
