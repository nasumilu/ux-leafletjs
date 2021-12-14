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
use Nasumilu\UX\Leaflet\Layer\Layer;
use OutOfRangeException;

/**
 * 
 */
class LayerTest extends TestCase {

    /**
     * @test
     * @return Layer
     */
    public function defualtConstructor(): Layer {
        $layer = $this->getMockForAbstractClass(Layer::class, ['test']);
        $this->assertInstanceOf(Layer::class, $layer);
        $this->assertEquals('test', $layer->getName());
        return $layer;
    }

    /**
     * @test
     * @depends defualtConstructor
     * @param Layer $layer
     * @return void
     */
    public function getSetAttribution(Layer $layer): void {
        $this->assertNull($layer->getAttribution());
        $expected = 'my attribution';
        $this->assertEquals($expected, $layer->setAttribution($expected)->getAttribution());
        $this->assertEquals($expected, $layer['attribution']);
        $layer['attribution'] = null;
        $this->assertNull($layer['attribution']);
    }

    /**
     * @test
     * @return void
     */
    public function optionalConstructor(): void {
        $options = ['test', ['attribution' => 'My Layer Attribution']];
        $layer = $this->getMockForAbstractClass(Layer::class, $options);
        $this->assertInstanceOf(Layer::class, $layer);
        $this->assertEquals($options[0], $layer->getName());
        $this->assertEquals($options[1]['attribution'], $layer->getAttribution());
        $this->assertEquals($options[1]['attribution'], $layer['attribution']);
    }

    /**
     * @test
     * @return void
     */
    public function offsetSetOutOfRangeException(): void {
        $layer = $this->getMockForAbstractClass(Layer::class, ['test']);
        $this->assertInstanceOf(Layer::class, $layer);
        $this->expectException(OutOfRangeException::class);
        $layer['not_valid'] = 'expect exception';
    }

    /**
     * @test
     * @return void
     */
    public function offgetSetOutOfRangeException(): void {
        $layer = $this->getMockForAbstractClass(Layer::class, ['test']);
        $this->assertInstanceOf(Layer::class, $layer);
        $this->expectException(OutOfRangeException::class);
        $layer['not_valid'];
    }

}
