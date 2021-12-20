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

namespace Nasumilu\UX\Leafletjs\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Reference;
use Nasumilu\UX\Leafletjs\Twig\LeafletjsExtension as LeafletTwigExtension;
use Twig\Environment;
use Symfony\Component\Routing\RouterInterface;
use Nasumilu\UX\Leafletjs\Factory\Builder\LayerBuilderInterface;
use Nasumilu\UX\Leafletjs\Factory\Builder\ControlBuilderInterface;

/**
 * 
 */
class LeafletjsExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {

        $loader = new YamlFileLoader(
                $container,
                new FileLocator(__DIR__ . '/../../config')
        );
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if (class_exists(Environment::class)) {
            $container
                    ->setDefinition('leafletjs.twig_extension',
                            new Definition(LeafletTwigExtension::class, [
                                new Reference('webpack_encore.twig_stimulus_extension'),
                                new Reference(RouterInterface::class)]))
                    ->addTag('twig.extension')
                    ->setPublic(false);
        }

        $paths = $config['paths'] ?? ['%kernel.project_dir%/config/maps'];

        $container->findDefinition('leafletjs.file_locator')
                ->setArgument('$paths', $paths);

        $container->registerForAutoconfiguration(ControlBuilderInterface::class)
                ->addTag('leaflet.control_builder');

        $container->registerForAutoconfiguration(LayerBuilderInterface::class)
                ->addTag('leaflet.layer_builder');
    }

    public function getAlias(): string
    {
        return 'leafletjs';
    }

}
