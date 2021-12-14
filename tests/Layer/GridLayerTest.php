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

namespace Nasumilu\UX\Leaflet\Tests\Layer;

use PHPUnit\Framework\TestCase;
use Nasumilu\UX\Leaflet\Layer\GridLayer;
use InvalidArgumentException;

/**
 */
class GridLayerTest extends TestCase
{

    /**
     * @test
     * @return GridLayer
     */
    public function defaultConstructor(): GridLayer
    {
        $layer = $this->getMockForAbstractClass(GridLayer::class, ['grid_layer']);
        $this->assertInstanceOf(GridLayer::class, $layer);
        return $layer;
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param GridLayer $layer
     * @return void
     */
    public function getSetTileSize(GridLayer $layer): void
    {
        $this->assertNull($layer->getTileSize());
        $expected = 256;
        $this->assertEquals($expected, $layer->setTileSize($expected)->getTileSize());
        $this->assertEquals($expected, $layer['tileSize']);
        $layer['tileSize'] = null;
        $this->assertNull($layer['tileSize']);
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param GridLayer $layer
     * @return void
     */
    public function getSetOpacity(GridLayer $layer): void
    {
        $this->assertNull($layer->getOpacity());
        $expected = 1.0;
        $this->assertEquals($expected, $layer->setOpacity($expected)->getOpacity());
        $this->assertEquals($expected, $layer['opacity']);
        $layer['opacity'] = null;
        $this->assertNull($layer['opacity']);

        $this->expectException(InvalidArgumentException::class);
        $layer['opacity'] = 1.2;
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param GridLayer $layer
     * @return void
     */
    public function setIsUpdateWhenIdle(GridLayer $layer): void
    {
        $this->assertNull($layer->isUpdateWhenIdle());
        $this->assertTrue($layer->setUpdateWhenIdle(true)->isUpdateWhenIdle());
        $this->assertTrue($layer['updateWhenIdle']);
        $layer['updateWhenIdle'] = null;
        $this->assertNull($layer['updateWhenIdle']);
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param GridLayer $layer
     * @return void
     */
    public function setIsUpdateWhenZooming(GridLayer $layer): void
    {
        $this->assertNull($layer->isUpdateWhenZooming());
        $this->assertTrue($layer->setUpdateWhenZooming(true)->isUpdateWhenZooming());
        $this->assertTrue($layer['updateWhenZooming']);
        $layer['updateWhenZooming'] = null;
        $this->assertNull($layer['updateWhenZooming']);
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param GridLayer $layer
     * @return void
     */
    public function getSetUpdateInterval(GridLayer $layer): void
    {
        $this->assertNull($layer->getUpdateInterval());

        $expected = 200;
        $this->assertEquals($expected, $layer->setUpdateInterval($expected)->getUpdateInterval());
        $this->assertEquals($expected, $layer['updateInterval']);
        $layer['updateInterval'] = null;
        $this->assertNull($layer['updateInterval']);
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param GridLayer $layer
     * @return void
     */
    public function getSetZIndex(GridLayer $layer): void
    {
        $this->assertNull($layer->getZIndex());
        $expected = 1;
        $this->assertEquals($expected, $layer->setZIndex($expected)->getZIndex());
        $this->assertEquals($expected, $layer['zIndex']);
        $layer['zIndex'] = null;
        $this->assertNull($layer['zIndex']);
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param GridLayer $layer
     * @return void
     */
    public function getSetBounds(GridLayer $layer): void
    {
        $this->assertNull($layer->getBounds());

        $expected = [[180, 90], [-180, -90]];
        $this->assertEquals($expected, $layer->setBounds($expected)->getBounds());
        $this->assertEquals($expected, $layer['bounds']);
        $layer['bounds'] = null;
        $this->assertNull($layer['bounds']);

        $this->expectException(InvalidArgumentException::class);
        $layer['bounds'] = [[180, 90], ['abc', -90]];
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param GridLayer $layer
     * @return void
     */
    public function getSetMinZoom(GridLayer $layer): void
    {
        $this->assertNull($layer->getMinZoom());
        $expected = 1;
        $this->assertEquals($expected, $layer->setMinZoom($expected)->getMinZoom());
        $layer['minZoom'] = null;
        $this->assertNull($layer['minZoom']);
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param GridLayer $layer
     * @return void
     */
    public function getSetMaxZoom(GridLayer $layer): void
    {
        $this->assertNull($layer->getMaxZoom());
        $expected = 15;
        $this->assertEquals($expected, $layer->setMaxZoom($expected)->getMaxZoom());
        $layer['maxZoom'] = null;
        $this->assertNull($layer['maxZoom']);
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param GridLayer $layer
     * @return void
     */
    public function getSetMinNativeZoom(GridLayer $layer): void
    {
        $this->assertNull($layer->getMinNativeZoom());
        $expected = 1;
        $this->assertEquals($expected, $layer->setMinNativeZoom($expected)->getMinNativeZoom());
        $layer['minNativeZoom'] = null;
        $this->assertNull($layer['minNativeZoom']);
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param GridLayer $layer
     * @return void
     */
    public function getSetMaxNativeZoom(GridLayer $layer): void
    {
        $this->assertNull($layer->getMaxNativeZoom());
        $expected = 15;
        $this->assertEquals($expected, $layer->setMaxNativeZoom($expected)->getMaxNativeZoom());
        $layer['maxNativeZoom'] = null;
        $this->assertNull($layer['maxNativeZoom']);
    }

}
