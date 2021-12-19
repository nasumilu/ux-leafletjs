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

namespace Nasumilu\UX\Leafletjs\Tests\Loader;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Config\FileLocator;
use Nasumilu\UX\Leafletjs\Loader\YamlMapLoader;
use Nasumilu\UX\Leafletjs\Model\Map;
use Nasumilu\UX\Leafletjs\Factory\{
    LayerFactory,
    MapFactory,
    ControlFactory
};
use Nasumilu\UX\Leafletjs\Factory\Builder\{
    AttributionControlBuilder,
    ZoomControlBuilder,
    ScaleControlBuilder,
    LayersControlBuilder,
    WMSLayerBuilder,
    TileLayerBuilder
};

/**
 * 
 */
class YamlMapLoaderTest extends TestCase
{

    /**
     * @test
     * @return void
     */
    public function load(): void 
    {
        $router = $this->createMock(RouterInterface::class);

        $layerFactory = new LayerFactory(new TileLayerBuilder($router));
        $layerFactory->addBuilder(new WMSLayerBuilder($router));

        $controlFactory = new ControlFactory(new ZoomControlBuilder());
        $controlFactory->addBuilder(...[
            new AttributionControlBuilder(),
            new ScaleControlBuilder(),
            new LayersControlBuilder()
        ]);
        $factory = new MapFactory($layerFactory, $controlFactory, $router);
        
        $locator = new FileLocator(__DIR__.'/../');
        $loader = new YamlMapLoader($factory, $locator);
        $map = $loader->load('test_map.yaml');

        $this->assertInstanceOf(Map::class, $map);
    }
    
}
