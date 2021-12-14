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
use Nasumilu\UX\Leaflet\Layer\TileLayer;

/**
 * 
 */
class TileLayerTest extends TestCase
{

    /**
     * @test
     * @return TileLayer
     */
    public function defaultConstructor(): TileLayer
    {
        $name = 'test';
        $url = 'https://somelayer.com';
        $layer = new TileLayer($name, $url);
        $this->assertInstanceOf(TileLayer::class, $layer);
        $this->assertEquals($name, $layer->getName());
        $this->assertEquals($url, $layer->getUrl());

        return $layer;
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param TileLayer $layer
     * @return void
     */
    public function getSetSubdomains(TileLayer $layer): void
    {
        $this->assertNull($layer->getSubDomains());
        $expected = 'abc';
        $this->assertEquals($expected, $layer->setSubDomains($expected)->getSubDomains());
        $layer['subdomains'] = null;
        $this->assertNull($layer['subdomains']);
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param TileLayer $layer
     * @return void
     */
    public function getSetErrorTileUrl(TileLayer $layer): void
    {
        $this->assertNull($layer->getErrorTileUrl());
        $expected = 'https://sometilelayer.com/error_tile.png';
        $this->assertEquals($expected, $layer->setErrorTileUrl($expected)->getErrorTileUrl());
        $layer['errorTileUrl'] = null;
        $this->assertNull($layer['errorTileUrl']);
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param TileLayer $layer
     * @return void
     */
    public function getSetZoomOffset(TileLayer $layer): void
    {
        $this->assertNull($layer->getZoomOffset());
        $expected = 2;
        $this->assertEquals($expected, $layer->setZoomOffset($expected)->getZoomOffset());
        $layer['zoomOffset'] = null;
        $this->assertNull($layer['zoomOffset']);
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param TileLayer $layer
     * @return void
     */
    public function setIsZoomReversed(TileLayer $layer): void
    {
        $this->assertNull($layer->isZoomReversed());
        $this->assertTrue($layer->setZoomReversed(true)->isZoomReversed());
        $layer['zoomReversed'] = null;
        $this->assertNull($layer['zoomReversed']);
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param TileLayer $layer
     * @return void
     */
    public function setIsDetectRetina(TileLayer $layer): void
    {
        $this->assertNull($layer->isDetectRetina());
        $this->assertTrue($layer->setDetectRetina(true)->isDetectRetina());
        $layer['detectRetina'] = null;
        $this->assertNull($layer['detectRetina']);
    }

    /**
     * @test
     * @depends defaultConstructor
     * @param TileLayer $layer
     * @return void
     */
    public function getSetCrossOrigin(TileLayer $layer): void
    {
        $this->assertNull($layer->getCrossOrigin());
        $expected = 'anonymous';
        $this->assertEquals($expected, $layer->setCrossOrigin($expected)->getCrossOrigin());
        $layer['crossOrigin'] = null;
        $this->assertNull($layer['crossOrigin']);
    }

}
