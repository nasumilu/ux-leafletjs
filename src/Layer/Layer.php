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

namespace Nasumilu\UX\Leaflet\Layer;

use Symfony\Component\Serializer\Annotation\Ignore;
use ArrayAccess;
use \Nasumilu\UX\Leaflet\OptionsTrait;

/**
 * 
 */
abstract class Layer implements ArrayAccess
{

    use OptionsTrait;

    public const TYPE_TILE = 'tile';
    public const TYPE_WMS = 'wms';
    public const OPTION_ATTRIBUTION = 'attribution';
    public const OPTION_BASE_LAYER = 'baseLayer';
    public const OPTION_TITLE = 'title';
    public const OPTION_LEGEND_ORDER = 'legendOrder';

    /**
     * @var string
     */
    private string $name;

    public function __construct(string $name, array $options = [])
    {
        $this->name = $name;
        $this->setOptions($options);
    }
    
    /**
     * 
     * @param int|null $legendOrder
     * @return Layer
     */
    public function setLegendOrder(?int $legendOrder = null): Layer
    {
        $this->options[self::OPTION_LEGEND_ORDER] = $legendOrder;
        return $this;
    }
    
    public function setTitle(?string $title = null): Layer 
    {
        $this->options[self::OPTION_TITLE] = $title;
        return $this;
    }
    
    public function setBaseLayer(?bool $baseLayer = null): Layer 
    {
        $this->options[self::OPTION_BASE_LAYER] = $baseLayer;
        return $this;
    }

    /**
     * @param string|null $attributioin
     * @return Layer
     */
    public function setAttribution(?string $attributioin = null): Layer
    {
        $this->options[self::OPTION_ATTRIBUTION] = $attributioin;
        return $this;
    }

    /**
     * @Ignore()
     * @return string|null
     */
    public function getAttribution(): ?string
    {
        return $this->options[self::OPTION_ATTRIBUTION] ?? null;
    }
    
    /**
     * @Ignore()
     * @return bool
     */
    public function isBaseLayer(): bool 
    {
        return $this->options[self::OPTION_BASE_LAYER] ?? false;
    }

    /**
     * Gets the layer's name
     * 
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * 
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->options[self::OPTION_TITLE] ?? null;
    }
    
    /**
     * @Ignore
     * @return int|null
     */
    public function getLegendOrder(): ?int 
    {
        return $this->options[self::OPTION_LEGEND_ORDER] ?? null;
    }
    
    /**
     * Gets the layer's type
     * 
     * @return string
     */
    public abstract function getType(): string;
    
    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return $this->name;
    }

}
