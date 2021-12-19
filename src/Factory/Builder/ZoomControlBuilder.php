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

/**
 *
 */
class ZoomControlBuilder extends AbstractControlBuilder 
{
    /**
     * 
     */
    public function __construct()
    {
        parent::__construct('zoom');
    }
    
    /**
     * 
     * @param OptionsResolver $optionsResolver
     * @return void
     */
    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        parent::configureOptions($optionsResolver);
        
        // zoomInText option
        $optionsResolver->define('zoomInText')
                ->allowedTypes('string')
                ->info('The text set on the `zoom in` button.');
        
        // zoomInTitle option
        $optionsResolver->define('zoomInTitle')
                ->allowedTypes('string')
                ->info('The title set on the `zoom in` button.');
        
        // zoomOutText option
        $optionsResolver->define('zoomOutText')
                ->allowedTypes('string')
                ->info('The text set on the `zoom out` button.');
        
        // zoomOutTitle option
        $optionsResolver->define('zoomOutTitle')
                ->allowedTypes('string')
                ->info('The title set on the `zoom out` button.');
    }
}
