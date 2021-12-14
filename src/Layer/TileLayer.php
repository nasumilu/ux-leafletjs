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

/**
 * 
 */
class TileLayer extends GridLayer
{

    /** https://leafletjs.com/reference.html#tilelayer-subdomains */
    public const OPTION_SUBDOMAINS = 'subdomains';

    /** https://leafletjs.com/reference.html#tilelayer-errortileurl */
    public const OPTION_ERROR_TILE_URL = 'errorTileUrl';

    /** https://leafletjs.com/reference.html#tilelayer-zoomoffset */
    public const OPTION_ZOOM_OFFSET = 'zoomOffset';

    /** https://leafletjs.com/reference.html#tilelayer-tms */
    public const OPTION_TMS = 'tms';

    /** https://leafletjs.com/reference.html#tilelayer-zoomreverse */
    public const OPTION_ZOOM_REVERSE = 'zoomReverse';

    /** https://leafletjs.com/reference.html#tilelayer-detectretina */
    public const OPTION_DETECT_RETINA = 'detectRetina';

    /** https://leafletjs.com/reference.html#tilelayer-crossorigin */
    public const OPTION_CROSS_ORIGIN = 'crossOrigin';

    /**
     * @var string
     */
    private string $url;

    public function __construct(string $name, string $url, array $options = [])
    {
        parent::__construct($name, $options);
        $this->url = $url;
    }

    /**
     * {@inheritDoc}
     */
    public function getType(): string
    {
        return Layer::TYPE_TILE;
    }

    /**
     * The tile service url
     * 
     * @link https://leafletjs.com/reference.html#tilelayer Leaflet TileLayer
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
    
    /**
     * Gets the subdomains for the tile service
     * 
     * @Ignore()
     * @return string|null
     */
    public function getSubdomains(): ?string
    {
        return $this->options[self::OPTION_SUBDOMAINS] ?? null;
    }

    /**
     * Sets the subdomains for the tile service
     * 
     * @param string|null $subdomains
     * @return TileLayer
     */
    public function setSubdomains(?string $subdomains = null): TileLayer
    {
        $this->options[self::OPTION_SUBDOMAINS] = $subdomains;
        return $this;
    }

    /**
     * Gets the url to the tile image to show in place of the tile
     * that fails to load
     * 
     * @Ignore()
     * @return string|null
     */
    public function getErrorTileUrl(): ?string
    {
        return $this->options[self::OPTION_ERROR_TILE_URL] ?? null;
    }

    /**
     * Sets the url to the tile image to show in place of the tile that fails
     * to load
     * 
     * @param string|null $errorTileUrl
     * @return TileLayer
     */
    public function setErrorTileUrl(?string $errorTileUrl = null): TileLayer
    {
        $this->options[self::OPTION_ERROR_TILE_URL] = $errorTileUrl;
        return $this;
    }

    /**
     * Gets the zoom number used in tile URLs will be offset
     * 
     * @Ignore()
     * @return int|null
     */
    public function getZoomOffset(): ?int
    {
        return $this->options[self::OPTION_ZOOM_OFFSET] ?? null;
    }

    /**
     * Sets the zoom number used in tile URLs will be offset
     * @param int|null $zoomOffset
     * @return TileLayer
     */
    public function setZoomOffset(?int $zoomOffset = null): TileLayer
    {
        $this->options[self::OPTION_ZOOM_OFFSET] = $zoomOffset;
        return $this;
    }

    /**
     * Indicates that the zoom number used in the tile URLs is reversed
     * 
     * @Ignore()
     * @return bool|null
     */
    public function isZoomReversed(): ?bool
    {
        return $this->options[self::OPTION_ZOOM_REVERSE] ?? null;
    }

    /**
     * Sets the zoom number used in the tile URLs is reversed
     * 
     * @param bool|null $zoomReversed
     * @return TileLayer
     */
    public function setZoomReversed(?bool $zoomReversed = null): TileLayer
    {
        $this->options[self::OPTION_ZOOM_REVERSE] = $zoomReversed;
        return $this;
    }

    /**
     * Indicates if user is on a retina display it will request four tiles on
     * half the specific size and bigger zoom level in place of one to utilize
     * the high resolution
     * 
     * @Ignore()
     * @return bool|null
     */
    public function isDetectRetina(): ?bool
    {
        return $this->options[self::OPTION_DETECT_RETINA] ?? null;
    }

    /**
     * Sets when the user is on a retina display it will request four tiles on
     * half the specific size and bigger zoom level in place of one to utilize
     * the high resolution
     * 
     * @param bool|null $detectRetina
     * @return TileLayer
     */
    public function setDetectRetina(?bool $detectRetina = null): TileLayer
    {
        $this->options[self::OPTION_DETECT_RETINA] = $detectRetina;
        return $this;
    }

    /**
     * Gets the CORS attribute to add to the tiles. Needed to access pixel data
     * 
     * @Ignore()
     * @return string|null
     */
    public function getCrossOrigin(): ?string
    {
        return $this->options[self::OPTION_CROSS_ORIGIN] ?? null;
    }

    /**
     * Sets the CORS attribute to add to the tiles. Needed to access pixel data
     * 
     * @param string|null $crossOrigin
     * @return TileLayer
     */
    public function setCrossOrigin(?string $crossOrigin = null): TileLayer
    {
        $this->options[self::OPTION_CROSS_ORIGIN] = $crossOrigin;
        return $this;
    }

}
