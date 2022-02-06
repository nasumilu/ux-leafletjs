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

namespace Nasumilu\UX\Leafletjs\Tests\Kernel;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Nasumilu\UX\Leafletjs\LeafletjsBundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Nasumilu\UX\Leafletjs\Controller\MapController;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

/**
 * 
 * The getCacheDirm, getLogDir, and tmpDir methods are nearly a Ctl+C, Ctl+V of
 * Titouan Galopin's AppKernelTrait;
 * 
 * @link https://github.com/symfony/ux-chartjs/blob/2.x/Tests/Kernel/AppKernelTrait.php AppKernelTrait.php
 * 
 */
class LeafletjsAppKernel extends Kernel
{

    use MicroKernelTrait;

    public function getProjectDir(): string
    {
        return __DIR__.'/../';
    }

}
