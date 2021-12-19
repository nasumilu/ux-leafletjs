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

use Nasumilu\UX\Leafletjs\Model\Control;
use Nasumilu\UX\Leafletjs\Factory\OptionsNormalizer;
use Symfony\Component\OptionsResolver\{
    OptionsResolver,
    Options
};

/**
 * 
 */
class AttributionControlBuilder extends AbstractControlBuilder
{

    /**
     * 
     */
    public function __construct()
    {
        parent::__construct('attribution');
    }

    /**
     * 
     * @param OptionsResolver $optionsResolver
     * @return void
     */
    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        parent::configureOptions($optionsResolver);

        // prefix option
        $optionsResolver->define('prefix')
                ->allowedTypes('string', 'bool')
                ->normalize(static function(Options $option, $value) {
                    if(null !== $bool = OptionsNormalizer::castToBool($option, $value)) {
                        return $bool;
                    }
                    return $value;
                })
                ->info('The HTML text shown before the attributions. Use false to disable.');
    }

}
