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

use InvalidArgumentException;
use Symfony\Component\Serializer\Annotation\Ignore;

/**
 * 
 */
abstract class GridLayer extends Layer
{

    /** https://leafletjs.com/reference.html#tilelayer-tilesize */
    public const OPTION_TILE_SIZE = 'tileSize';

    /** https://leafletjs.com/reference.html#tilelayer-opacity */
    public const OPTION_OPACITY = 'opacity';

    /** https://leafletjs.com/reference.html#tilelayer-updatewhenidle */
    public const OPTION_UPDATE_WHEN_IDLE = 'updateWhenIdle';

    /** https://leafletjs.com/reference.html#tilelayer-updatewhenzooming */
    public const OPTION_UPDATE_WHEN_ZOOMING = 'updateWhenZooming';

    /** https://leafletjs.com/reference.html#tilelayer-updateinterval */
    public const OPTION_UPDATE_INTERVAL = 'updateInterval';

    /** https://leafletjs.com/reference.html#tilelayer-zindex */
    public const OPTION_ZINDEX = 'zIndex';

    /** https://leafletjs.com/reference.html#tilelayer-bounds */
    public const OPTION_BOUNDS = 'bounds';

    /** https://leafletjs.com/reference.html#gridlayer-minzoom */
    public const OPTION_MIN_ZOOM = 'minZoom';

    /** https://leafletjs.com/reference.html#gridlayer-maxzoom */
    public const OPTION_MAX_ZOOM = 'maxZoom';

    /** https://leafletjs.com/reference.html#gridlayer-maxnativezoom */
    public const OPTION_MAX_NATIVE_ZOOM = 'maxNativeZoom';
    
    /** https://leafletjs.com/reference.html#gridlayer-minnativezoom */
    public const OPTION_MIN_NATIVE_ZOOM = 'minNativeZoom';
    
    /** https://leafletjs.com/reference.html#gridlayer-nowrap */
    public const OPTION_NO_WRAP = 'noWrap';
    public const OPTION_PANE = 'pane';
    public const OPTION_CLASS_NAME = 'className';
    public const OPTION_KEEP_BUFFER = 'keepBuffer';

    
    public function __construct(string $name, array $options = [])
    {
        parent::__construct($name, $options);
    }
    
    /**
     * Gets the width and height of tiles in the grid
     * 
     * @Ignore()
     * @return int|null
     */
    public function getTileSize(): ?int
    {
        return $this->options[self::OPTION_TILE_SIZE] ?? null;
    }

    /**
     * Gets the opacity of the tiles
     * 
     * @Ignore()
     * @return float|null
     */
    public function getOpacity(): ?float
    {
        return $this->options[self::OPTION_OPACITY] ?? null;
    }

    /**
     * Indicates that new tiles load only when panning
     * 
     * @Ignore()
     * @return bool
     */
    public function isUpdateWhenIdle(): ?bool
    {
        return $this->options[self::OPTION_UPDATE_WHEN_IDLE] ?? null;
    }

    /**
     * Indicates that a smooth zoom animation will update grid layers every
     * integer zoom level.
     * 
     * @Ignore()
     * @return bool|null
     */
    public function isUpdateWhenZooming(): ?bool
    {
        return $this->options[self::OPTION_UPDATE_WHEN_ZOOMING] ?? null;
    }

    /**
     * Gets the update interval in milliseconds tiles will not update when 
     * panning
     * 
     * @Ignore()
     * @return int|null
     */
    public function getUpdateInterval(): ?int
    {
        return $this->options[self::OPTION_UPDATE_INTERVAL] ?? null;
    }

    /**
     * Gets the explicit z-index of the tile layer
     * 
     * @Ignore()
     * @return int|null
     */
    public function getZIndex(): ?int
    {
        return $this->options[self::OPTION_ZINDEX] ?? null;
    }

    /**
     * Gets the bounds (extent) which tile are loaded
     * 
     * @Ignore()
     * @return array|null
     */
    public function getBounds(): ?array
    {
        return $this->options[self::OPTION_BOUNDS] ?? null;
    }

    /**
     * Gets the minimum zoom level down to which the layer will
     * display (inclusive)
     * 
     * @Ignore()
     * @return int|null
     */
    public function getMinZoom(): ?int
    {
        return $this->options[self::OPTION_MIN_ZOOM] ?? null;
    }

    /**
     * Gets the maximum zoom level which the layer will display (inclusive)
     * 
     * @Ignore()
     * @return int|null
     */
    public function getMaxZoom(): ?int
    {
        return $this->options[self::OPTION_MAX_ZOOM] ?? null;
    }

    /**
     * Gets the minimum supported zoom provided by the tile source
     * 
     * @Ignore()
     * @return int|null
     */
    public function getMinNativeZoom(): ?int
    {
        return $this->options[self::OPTION_MIN_NATIVE_ZOOM] ?? null;
    }

    /**
     * Gets the maximum support zoom provided by the tile source
     * 
     * @Ignore()
     * @return int|null
     */
    public function getMaxNativeZoom(): ?int
    {
        return $this->options[self::OPTION_MAX_NATIVE_ZOOM] ?? null;
    }
    
    /**
     * Indicates whether the layer is wrapped around the antimeridian
     * 
     * @Ignore()
     * @return bool|null
     */
    public function isNoWrap(): ?bool
    {
        return $this->options[self::OPTION_NO_WRAP] ?? null;
    }
    
    /**
     * @Ignore()
     * @return string|null
     */
    public function getPane(): ?string
    {
        return $this->options[self::OPTION_PANE] ?? null;
    }
    
    /**
     * @Ignore()
     * @return string|null
     */
    public function getClassName(): ?string
    {
        return $this->options[self::OPTION_CLASS_NAME] ?? null;
    }
    
    /**
     * @Ignore()
     * @return int|null
     */
    public function getKeepBuffer(): ?int
    {
        return $this->options[self::OPTION_KEEP_BUFFER] ?? null;
    }

    /**
     * Sets the width and height of tiles in the grid
     * 
     * @param int|null $tileSize
     * @return GridLayer
     */
    public function setTileSize(?int $tileSize = null): GridLayer
    {
        $this->options[self::OPTION_TILE_SIZE] = $tileSize;
        return $this;
    }

    /**
     * Sets the opacity of the tiles
     * 
     * @param float|null $opacity
     * @return GridLayer
     * @throws InvalidArgumentException when non-null value is not between 0 - 1 (inclusive)
     */
    public function setOpacity(?float $opacity = null): GridLayer
    {
        if (null !== $opacity && ($opacity < 0 || $opacity > 1.0)) {
            throw new InvalidArgumentException("Opacity must be between 0 and 1.0, found $opacity!");
        }
        $this->options[self::OPTION_OPACITY] = $opacity;
        return $this;
    }

    /**
     * Set whether tiles load only when panning ends
     * 
     * @param bool|null $updateWhenIdle
     * @return GridLayer
     */
    public function setUpdateWhenIdle(?bool $updateWhenIdle = null): GridLayer
    {
        $this->options[self::OPTION_UPDATE_WHEN_IDLE] = $updateWhenIdle;
        return $this;
    }

    /**
     * Set whether a smooth zoom animation will update grid layers every integer
     * zoom level.
     * 
     * @param bool|null $updateWhenZooming
     * @return GridLayer
     */
    public function setUpdateWhenZooming(?bool $updateWhenZooming = null): GridLayer
    {
        $this->options[self::OPTION_UPDATE_WHEN_ZOOMING] = $updateWhenZooming;
        return $this;
    }

    /**
     * Sets the update interval in milliseconds tiles will not update when 
     * panning
     * 
     * @param int|null $updateInterval
     * @return GridLayer
     * @throws InvalidArgumentException
     */
    public function setUpdateInterval(?int $updateInterval = null): GridLayer
    {
        if (null !== $updateInterval && $updateInterval < 0) {
            throw new InvalidArgumentException("Update interval must be null or greater than zero, found $updateInterval!");
        }
        $this->options[self::OPTION_UPDATE_INTERVAL] = $updateInterval;
        return $this;
    }

    /**
     * Sets the explicit z-index of the tile layer
     * 
     * @param int|null $zIndex
     * @return GridLayer
     */
    public function setZIndex(?int $zIndex = null): GridLayer
    {
        $this->options[self::OPTION_ZINDEX] = $zIndex;
        return $this;
    }

    /**
     * Sets the bounds (extent) which tiles are loaded
     * 
     * @param array|null $bounds
     * @return GridLayer
     * @throws InvalidArgumentException
     */
    public function setBounds(?array $bounds = null): GridLayer
    {
        if (null === $bounds) {
            $this->options[self::OPTION_BOUNDS] = $bounds;
            return $this;
        }

        if (2 !== $count = count($bounds)) {
            throw new InvalidArgumentException("Bounds must have two numeric[] elements, found $count!");
        }

        foreach ($bounds as $key => $bound) {
            if (2 !== $count = count(array_filter($bound, static fn($value) => is_numeric($value)))) {
                throw new InvalidArgumentException("Bounds element at $key must contain two numeric values, found $count!");
            }
        }

        $this->options[self::OPTION_BOUNDS] = $bounds;
        return $this;
    }

    /**
     * Sets the minimum zoom level down to which the layer will display 
     * (inclusive).
     * 
     * @param int|null $minZoom
     * @return GridLayer
     * @throws InvalidArgumentException
     */
    public function setMinZoom(?int $minZoom = null): GridLayer
    {
        $this->options[self::OPTION_MIN_ZOOM] = $minZoom;
        return $this;
    }

    /**
     * Sets the maximum zoom level which the layer will display (inclusive)
     * 
     * @param int|null $maxZoom
     * @return GridLayer
     * @throws InvalidArgumentException
     */
    public function setMaxZoom(?int $maxZoom = null): GridLayer
    {
        $this->options[self::OPTION_MAX_ZOOM] = $maxZoom;
        return $this;
    }

    /**
     * Sets the minimum supported zoom provided by the tile source
     * 
     * @param int|null $minNativeZoom
     * @return GridLayer
     * @throws InvalidArgumentException
     */
    public function setMinNativeZoom(?int $minNativeZoom = null): GridLayer
    {
        $this->options[self::OPTION_MIN_NATIVE_ZOOM] = $minNativeZoom;
        return $this;
    }

    /**
     * Sets the maximum support zoom provided by the tile source
     * 
     * @param int|null $maxNativeZoom
     * @return GridLayer
     * @throws InvalidArgumentException
     */
    public function setMaxNativeZoom(?int $maxNativeZoom = null): GridLayer
    {
        $this->options[self::OPTION_MAX_NATIVE_ZOOM] = $maxNativeZoom;
        return $this;
    }
    
    public function setNoWrap(?bool $noWrap = null): GridLayer
    {
        $this->options[self::OPTION_NO_WRAP] = $noWrap;
        return $this;
    }
    
    public function setPane(?string $pane = null): GridLayer
    {
        $this->options[self::OPTION_PANE] = $pane;
        return $this;
    }
    
    public function setClassName(?string $className = null): GridLayer
    {
        $this->options[self::OPTION_CLASS_NAME] = $className;
        return $this;
    }

    public function setKeepBuffer(?int $keepBuffer = null): GridLayer
    {
        $this->options[self::OPTION_KEEP_BUFFER] = $keepBuffer;
        return $this;
    }
}
