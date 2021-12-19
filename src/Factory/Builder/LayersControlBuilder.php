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

/**
 * 
 */
class LayersControlBuilder extends AbstractControlBuilder
{

    /**
     * 
     */
    public function __construct()
    {
        parent::__construct('layers');
    }

    /**
     * 
     * @param OptionsResolver $optionsResolver
     * @return void
     */
    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        $castToInt = OptionsNormalizer::closureFor('castToInt');
        $castToBool = OptionsNormalizer::closureFor('castToBool');
        parent::configureOptions($optionsResolver);

        $optionsResolver->define('collapsed')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Indicates that the control will be collapsed into an '
                        . 'icon and expanded on mouse hover or touch.');

        $optionsResolver->define('autoZIndex')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('The control will assign zIndexes in increasing order to '
                        . 'all of its layers so that the order is preserved '
                        . 'when switching them on/off.');

        $optionsResolver->define('hideSingleBase')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('The base layers in the control will be hidden when '
                        . 'there is only one.');

        $optionsResolver->define('sortLayers')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Whether to sort the layers.');

        $optionsResolver->define('sortFunction')
                ->allowedTypes('string')
                ->allowedValues('legendOrder', 'layerName')
                ->info('The sort function to use when sorting layers');
    }

}
