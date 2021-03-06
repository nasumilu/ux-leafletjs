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

namespace Nasumilu\UX\Leafletjs\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * Configuration for LeafletjsBundle
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $root = new TreeBuilder('leafletjs');

        $root->getRootNode()
                ->fixXmlConfig('path')
                ->children()
                    ->arrayNode('paths')
                        ->treatNullLike([])
                        ->scalarPrototype()->end()
                        ->defaultValue(['%kernel.project_dir%/config/maps'])
                    ->end()
                ->end()
            ->end();

        return $root;
    }

}
