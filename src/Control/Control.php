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

namespace Nasumilu\UX\Leaflet\Control;

use Nasumilu\UX\Leaflet\OptionsTrait;
use Symfony\Component\Serializer\Annotation\Ignore;
use ArrayAccess;

/**
 * 
 */
abstract class Control implements ArrayAccess
{

    public const TYPE_ZOOM = 'zoom';
    public const TYPE_ATTRIBUTION = 'attribution';
    public const TYPE_LEGEND = 'legend';
    public const TYPE_SCALE = 'scale';
    
    public const POSITION_TOP_RIGHT = 'topright';
    public const POSITION_TOP_LEFT = 'topleft';
    public const POSITION_BOTTOM_RIGHT = 'bottomright';
    public const POSITION_BOTTOM_LEFT = 'bottomleft';
    
    public const POSITIONS = [
        self::POSITION_BOTTOM_LEFT,
        self::POSITION_BOTTOM_RIGHT,
        self::POSITION_TOP_LEFT,
        self::POSITION_TOP_RIGHT
    ];
    
    /** https://leafletjs.com/reference.html#control-position */
    public const OPTION_POSITION = 'position';
    
    use OptionsTrait;
    
    /**
     * 
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }
    
    /**
     * @Ignore()
     * @return string|null
     */
    public function getPosition(): ?string
    {
        return $this->options[self::OPTION_POSITION] ?? null;
    }
    
    public function setPosition(?string $position = null): Control
    {
        $this->options[self::OPTION_POSITION] = $position;
        return $this;
    }
    
    public abstract function getType(): string;
    
}
