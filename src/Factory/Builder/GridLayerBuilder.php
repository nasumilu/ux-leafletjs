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

use Symfony\Component\OptionsResolver\OptionsResolver;
use Nasumilu\UX\Leafletjs\Factory\OptionsNormalizer;
use Nasumilu\UX\Leafletjs\Factory\OptionsValidator;

/**
 * 
 */
abstract class GridLayerBuilder extends AbstractLayerBuilder
{

    /**
     * 
     * @param OptionsResolver $optionsResolver
     * @return void
     */
    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        parent::configureOptions($optionsResolver);

        // option normalize closure
        $castToFloat = OptionsNormalizer::closureFor('castToFloat');
        $castToBool = OptionsNormalizer::closureFor('castToBool');
        $castToInt = OptionsNormalizer::closureFor('castToInt');
        $castToBoundaryBox = OptionsNormalizer::closureFor('castToBoundaryBox');
        
        // allowed values closure
        $greaterThanEqualToZero = OptionsValidator::closureFor('greaterThanEqualToZero');
        $boundaryBox = OptionsValidator::closureFor('boundaryBox');
        $greaterThanZero = OptionsValidator::closureFor('greaterThanZero');


        $optionsResolver->define('tileSize')
                ->allowedTypes('numeric', 'array')
                ->info('The width & height of tiles in the grid. Single numeric'
                        . ' value'
                        . ' indicates that the width & height are equal.');
        
        $optionsResolver->define('opacity')
                ->allowedTypes('numeric')
                ->allowedValues(static function ($value) {
                    return $value >= 0 && $value <= 1.0;
                })
                ->normalize($castToFloat)
                ->info('Opacity of the tiles');

        $optionsResolver->define('updateWhenIdle')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Indicates that new tiles load when panning ends');

        $optionsResolver->define('updateWhenZooming')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Indicates that tiles are update only when the smooth '
                        . 'animation ends');

        $optionsResolver->define('updateInterval')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToInt)
                ->info('The interval which tiles are updated when panning, in '
                        . 'milliseconds');

        $optionsResolver->define('zIndex')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToInt);
        
        $optionsResolver->define('bounds')
                ->allowedTypes('array', 'string')
                ->allowedValues($boundaryBox)
                ->normalize($castToBoundaryBox);

        $optionsResolver->define('minZoom')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToInt)
                ->info('The minimum zoom level which the layer will display '
                        . '(inclusive)');

        $optionsResolver->define('maxZoom')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToInt)
                ->info('The maximum zoom level which the layer will display '
                        . '(inclusive)');

        $optionsResolver->define('maxNativeZoom')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToInt)
                ->info('Maximum zoom number the tile source has available');

        $optionsResolver->define('minNativeZoom')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanEqualToZero)
                ->normalize($castToInt)
                ->info('Minimum zoom number the tile source has available');

        $optionsResolver->define('noWrap')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Whether the layer is wrapped around the antimeridian');
        
        $optionsResolver->define('className')
                ->allowedTypes('string')
                ->info('A custom class name to assign to the tile layer.');
        
        $optionsResolver->define('keepBuffer')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanZero)
                ->normalize($castToInt)
                ->info('When panning the map, keep this many rows and columns '
                        . 'of tiles before unloading them.');
    }

}
