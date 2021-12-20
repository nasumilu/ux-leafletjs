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

namespace Nasumilu\UX\Leafletjs\DependencyInjection\Compiler;

use Nasumilu\UX\Leafletjs\Factory\LayerBuilderRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Description of LayerBuilderPass
 *
 * @author mlucas
 */
class LayerBuilderPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition(LayerBuilderRegistry::class)) {
            return;
        }

        $definition = $container->findDefinition(LayerBuilderRegistry::class);

        $taggedServices = $container->findTaggedServiceIds('leafletjs.layer_builder');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addBuilder', [new Reference($id)]);
        }
    }

}
