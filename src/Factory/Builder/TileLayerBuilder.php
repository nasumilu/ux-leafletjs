<?php

/*
 * Copyright 2021 mlucas.
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

namespace Nasumilu\UX\Leafletjs\Factory\Builder;

use Symfony\Component\Routing\RouterInterface;
use Nasumilu\UX\Leafletjs\Factory\{
    OptionsNormalizer,
    OptionsValidator
};
use Symfony\Component\OptionsResolver\{
    OptionsResolver,
    Options
};

/**
 * 
 */
class TileLayerBuilder extends GridLayerBuilder
{

    /**
     * 
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        parent::__construct('tile', $router);
    }

    /**
     * 
     * @param OptionsResolver $optionsResolver
     * @return void
     */
    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        $castToInt = OptionsNormalizer::closureFor('castToInt');
        $castToFloat = OptionsNormalizer::closureFor('castToFloat');
        $castToBool = OptionsNormalizer::closureFor('castToBool');
        
        parent::configureOptions($optionsResolver);

        $optionsResolver->define('baseLayer')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Indicates whether the layer is a base layer or an '
                        . 'overlay');

        $optionsResolver->define('subdomains')
                ->allowedTypes('string', 'array')
                ->info('Subdomains of the tile service.');

        $optionsResolver->define('errorTileRoute')
                ->allowedTypes('string')
                ->info('The route name for the route to the tile image to show '
                        . 'in place of the tile that failed to load');

        $optionsResolver->define('errorTileRouteArgs')
                ->allowedTypes('array')
                ->info('The route arguments used with the route to the tile '
                        . 'image to show in place of the tile that faild to '
                        . 'load');

        $optionsResolver->define('errorTileUrl')
                ->default(function (Options $options) {
                    if (isset($options['url'])) {
                        return $options['url'];
                    }
                    if (isset($options['errorTileRoute'])) {
                        return $this->router->generate($options['errorTileRoute'], $options['errorTileRouteArgs'] ?? []);
                    }
                })
                ->allowedTypes('string', 'null')
                ->info('URL to the tile image to show in place of the tile that '
                        . 'failed to load.');

        $optionsResolver->define('zoomOffset')
                ->allowedTypes('int', 'string')
                ->normalize($castToInt)
                ->info('The zoom number used in tile URLs will be offset with '
                        . 'this value.');

        $optionsResolver->define('tms')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('If true, inverses Y axis numbering for tiles (turn this'
                        . ' on for TMS services)');

        $optionsResolver->define('zoomReverse')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('If set to true, the zoom number used in tile URLs will '
                        . 'be reversed (maxZoom - zoom instead of zoom)');

        $optionsResolver->define('detectRetina')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('If true and user is on a retina display, it will '
                        . 'request four tiles of half the specified size and a '
                        . 'bigger zoom level in place of one to utilize the '
                        . 'high resolution.');

        $optionsResolver->define('crossOrigin')
                ->allowedTypes('bool', 'string')
                ->normalize(function(Options $options, $value) {
                    if(null !== $bool = OptionsNormalizer::castToBool($options, $options)) {
                        return $bool; 
                    }
                    return $value;
                })
                ->info('Whether the crossOrigin attribute will be added to the '
                        . 'tiles. If a String is provided, all tiles will have '
                        . 'their crossOrigin attribute set to the String '
                        . 'provided');
    }

    /**
     * 
     * @param string $name
     * @param string $url
     * @param array $options
     * @return \Nasumilu\UX\Leafletjs\Model\Layer
     */
    public function build(string $name, string $url, array $options = []): \Nasumilu\UX\Leafletjs\Model\Layer
    {
        return parent::build($name, $url, $options)
                        ->unsetOption('errorTileRoute')
                        ->unsetOption('errorTileRouteArgs');
    }

}
