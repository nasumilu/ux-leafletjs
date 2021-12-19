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

namespace Nasumilu\UX\Leafletjs\Factory\Builder;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Nasumilu\UX\Leafletjs\Factory\{
    OptionsNormalizer,
    OptionsValidator
};

/**
 * 
 */
class ScaleControlBuilder extends AbstractControlBuilder
{

    /**
     * 
     */
    public function __construct()
    {
        parent::__construct('scale');
    }

    /**
     * 
     * @param OptionsResolver $optionsResolver
     * @return void
     */
    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        // options normalize closure
        $castToInt = OptionsNormalizer::closureFor('castToInt');
        $castToBool = OptionsNormalizer::closureFor('castToBool');
        
        // allowed value closure
        $greaterThanZero = OptionsValidator::closureFor('greaterThanZero');
        
        parent::configureOptions($optionsResolver);

        $optionsResolver->define('maxWidth')
                ->allowedTypes('int', 'string')
                ->allowedValues($greaterThanZero)
                ->normalize($castToInt)
                ->info('Maximum width of the control in pixels. ');

        $optionsResolver->define('metric')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Whether to show the metric scale line (m/km).');

        $optionsResolver->define('imperial')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Whether to show the imperial scale line (mi/ft).');

        $optionsResolver->define('updateWhenIdle')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('The control is updated on moveend, otherwise it\'s '
                        . 'always up-to-date (updated on move).');
    }

}
