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

namespace Nasumilu\UX\Leafletjs\Tests\Factory;

use PHPUnit\Framework\TestCase;
use Nasumilu\UX\Leafletjs\Model\Map;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Config\FileLocator;
use Nasumilu\UX\Leafletjs\Factory\Loader\{
    XmlMapLoader,
    YamlMapLoader,
    PhpMapLoader
};
use Nasumilu\UX\Leafletjs\Factory\{
    LayerFactory,
    ControlFactory,
    MapFactory
};
use Nasumilu\UX\Leafletjs\Factory\Builder\{
    ZoomControlBuilder,
    LayersControlBuilder,
    ScaleControlBuilder,
    AttributionControlBuilder,
    TileLayerBuilder,
    WMSLayerBuilder
};

/**
 * 
 */
class MapFactoryTest extends TestCase
{

    /**
     * @test
     */
    public function kitchenSink()
    {
        $router = $this->createMock(RouterInterface::class);
        $router->expects($this->any())
                ->method('generate')
                ->willReturn('https://gernerated_route');
        $locator = new FileLocator(__DIR__.'/../fixtures');
        $loaderResolver = new LoaderResolver([new PhpMapLoader($locator), new YamlMapLoader($locator), new XmlMapLoader($locator)]);

        $layerFactory = new LayerFactory(new TileLayerBuilder($router));
        $layerFactory->addBuilder(new WMSLayerBuilder($router));

        $controlFactory = new ControlFactory(new ZoomControlBuilder());
        $controlFactory->addBuilder(...[
            new AttributionControlBuilder(),
            new ScaleControlBuilder(),
            new LayersControlBuilder()
        ]);
        $facotry = new MapFactory($loaderResolver, $layerFactory, $controlFactory, $router);
        $map = $facotry->load('test_map', 'php');
        $this->assertInstanceOf(Map::class, $map);
    }

}
