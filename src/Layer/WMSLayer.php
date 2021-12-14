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

namespace Nasumilu\UX\Leaflet\Layer;

use Symfony\Component\Serializer\Annotation\Ignore;

use function array_merge;

/**
 * 
 */
class WMSLayer extends TileLayer
{
    
    /** https://leafletjs.com/reference.html#tilelayer-wms-layers */
    public const OPTION_LAYERS = 'layers';
    
    /** https://leafletjs.com/reference.html#tilelayer-wms-format */
    public const OPTION_FORMAT = 'format';
    
    /** https://leafletjs.com/reference.html#tilelayer-wms-transparent */
    public const OPTION_TRANSPARENT = 'transparent';
    
    /** https://leafletjs.com/reference.html#tilelayer-wms-version */
    public const OPTION_VERSION = 'version';
    
    /** https://leafletjs.com/reference.html#tilelayer-wms-crs */
    public const OPTION_CRS = 'crs';
    
    /** https://leafletjs.com/reference.html#tilelayer-wms-uppercase */
    public const OPTION_UPPERCASE = 'uppercase';
    
    public function __construct(string $name, string $url, array $layers, array $options = [])
    {
        parent::__construct($name, $url, array_merge(['layers' => $layers], $options));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getType(): string
    {
        return Layer::TYPE_WMS;
    }
    
    /**
     * Gets the web map service (WMS) layers
     * 
     * The return value is an array of string[1|2] where the required first element
     * is the layer name and the optional second element is the layer's style. If
     * omitted the layer's default style is typically used.
     * 
     * @Ignore()
     * @return array<string[]> 
     */
    public function getLayers(): array 
    {
        return $this->options[self::OPTION_LAYERS];
    }
    
    /**
     * Sets the web map service (WMS) layers
     * 
     * The value must be an array of string[1|2] values where the required first
     * element is the layer name and the optional second element is the layer's 
     * style. If omitted the layer's default style is typically used.
     * 
     * @param array<string[]> $layers
     * @return WMSLayer
     */
    public function setLayers(array $layers): WMSLayer
    {
        $this->options[self::OPTION_LAYERS] = $layers;
        return $this;
    }
    
    /**
     * Add layer(s) to the web map service (WMS) layers. 
     * 
     * The layers are appended to the end of the set. The the first element 
     * must be the name of the element and the optional second element is the 
     * layer's style. If omitted then the WMS typically will use the layers 
     * default style.
     *  
     * @param string[] ...$layers
     * @return WMSLayer
     */
    public function addLayers(array ...$layers): WMSLayer
    {
        $this->options[self::OPTION_LAYERS] = array_merge($this->options[self::OPTION_LAYERS] ?? [], $layers);
        return $this;
    }
    
    /**
     * Removes layer(s) from the map service (WMS) layers.
     * 
     * The layers 
     * @param array $layers
     * @return WMSLayer
     */
    public function removeLayers(array ...$layers): WMSLayer
    {
        foreach($layers as $layer) {
            if(false === $offset = array_search($layer, $this->options[self::OPTION_LAYERS] ?? [], true)) {
                unset($this->options[self::OPTION_LAYERS][$offset]);
            }
        }
        return $this;
    }
    
    /**
     * @Ignore()
     * @return string|null
     */
    public function getFormat(): ?string
    {
        return $this->options[self::OPTION_FORMAT] ?? null;
    }
    
    /**
     * 
     * @param string|null $format
     * @return WMSLayer
     */
    public function setFormat(?string $format = null): WMSLayer
    {
        $this->options[self::OPTION_FORMAT] = $format;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return bool|null
     */
    public function isTransparent(): ?bool
    {
        return $this->options[self::OPTION_TRANSPARENT] ?? null;
    }
    
    /**
     * 
     * @param bool|null $transparent
     * @return WMSLayer
     */
    public function setTransparent(?bool $transparent = null): WMSLayer
    {
        $this->options[self::OPTION_TRANSPARENT] = $transparent;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return string|null
     */
    public function getVersion(): ?string
    {
        return $this->options[self::OPTION_VERSION] ?? null;
    }
    
    /**
     * 
     * @param string|null $verion
     * @return WMSLayer
     */
    public function setVersion(?string $verion = null): WMSLayer
    {
        $this->options[self::OPTION_VERSION] = $verion;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return string|null
     */
    public function getCrs(): ?string
    {
        return $this->options[self::OPTION_CRS] ?? null;
    }
    
    /**
     * 
     * @param string|null $crs
     * @return WMSLayer
     */
    public function setCrs(?string $crs = null): WMSLayer 
    {
        $this->options[self::OPTION_CRS] = $crs;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return bool|null
     */
    public function isUppercase(): ?bool
    {
        return $this->options[self::OPTION_UPPERCASE] ?? null;
    }
    
    /**
     * 
     * @param bool|null $uppercase
     * @return WMSLayer
     */
    public function setUppercase(?bool $uppercase = null): WMSLayer
    {
        $this->options[self::OPTION_UPPERCASE] = $uppercase;
        return $this;
    }
 
}
