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
use Symfony\Component\Routing\RouterInterface;
use Nasumilu\UX\Leafletjs\Factory\OptionsNormalizer;

/**
 * 
 */
class WMSLayerBuilder extends TileLayerBuilder
{

    /**
     * 
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        GridLayerBuilder::__construct('wms', $router);
    }
    
    /**
     * 
     * @param OptionsResolver $optionsResolver
     * @return void
     */
    public function configureOptions(OptionsResolver $optionsResolver): void
    {
        parent::configureOptions($optionsResolver);
        
        $castToBool = OptionsNormalizer::closureFor('castToBool');
        
        $optionsResolver->define('layers')
                ->required()
                ->allowedTypes('array')
                ->info('An array of layers and styles');
        
        $optionsResolver->define('format')
                ->allowedTypes('string')
                ->allowedValues('image/jpeg', 
                        'image/png', 
                        'image/gif', 
                        'image/tiff', 
                        'image/tiff8',
                        'image/geotiff',
                        'image/geotiff8',
                        'image/svg+xml')
                ->info('The georeferenced image mime-type');
        
        $optionsResolver->define('transparent')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('If true, the WMS service will return images with '
                        . 'transparency.');
       
        $optionsResolver->define('version')
                ->allowedTypes('string')
                ->allowedValues('1.1.1', '1.3.0')
                ->info('Version of the WMS service to use');
        
        $optionsResolver->define('uppercase')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('If true, WMS request parameter keys will be uppercase');
       
    }
    
}
