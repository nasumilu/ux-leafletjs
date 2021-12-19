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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\WebpackEncoreBundle\Twig\StimulusTwigExtension;
use Nasumilu\UX\Leafletjs\Twig\LeafletjsExtension as LeafletTwigExtension;
use Twig\Environment;
use Symfony\Component\Routing\RouterInterface;
/**
 * 
 */
class LeafletjsExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {

        if (class_exists(Environment::class)) {
            $container
                    ->setDefinition('leaflet.twig_extension', 
                            new Definition(LeafletTwigExtension::class, [
                                new Reference(StimulusTwigExtension::class),
                                new Reference(RouterInterface::class)]))
                    ->addTag('twig.extension')
                    ->setPublic(false);
        }
    }

}
