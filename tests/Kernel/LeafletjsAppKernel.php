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

    public function registerBundles(): iterable
    {
        return [new FrameworkBundle(), new LeafletjsBundle()];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) {
            $container->loadFromExtension('framework', [
                'secret' => '$ecret',
                'test' => true,
                'router' => [ 
                    'utf8' => true, 
                    'resource' => 'kernel::loadRoutes', 
                    'type' => 'service'
                ]
            ]);
            
            $container->loadFromExtension('leafletjs', ['paths' => [__DIR__.'/../fixtures']]);
        });
    }

    public function getCacheDir(): string
    {
        return $this->tmpDir('cache');
    }

    public function getLogDir(): string
    {
        return $this->tmpDir('logs');
    }

    private function tmpDir(string $type): string
    {
        $dir = sys_get_temp_dir() . '/leafletjs_bundle/' . uniqid($type . '_', true);

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        return $dir;
    }

}
