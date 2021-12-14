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

namespace Nasumilu\UX\Leaflet;

use ArrayAccess;
use Symfony\Component\Serializer\Annotation\Ignore;
use Nasumilu\UX\Leaflet\Layer\Layer;
use Nasumilu\UX\Leaflet\Control\Control;
/**
 * 
 */
class WebMap implements ArrayAccess
{
    
    public const OPTION_CLOSE_POPUP_ON_CLICK = 'closePopUpOnClick';
    public const OPTION_ZOOM_SNAP = 'zoomSnap';
    public const OPTION_ZOOM_DELTA = 'zoomDelta';
    public const OPTION_TRACK_RESIZE = 'trackResize';
    public const OPTION_BOX_ZOOM = 'boxZoom';
    public const OPTION_DOUBLE_CLICK_ZOOM = 'doubleClickZoom';
    public const OPTION_DRAGGING = 'dragging';
    
    public const OPTION_CRS = 'crs';
    public const OPTION_CENTER = 'center';
    public const OPTION_ZOOM = 'zoom';
    public const OPTION_MIN_ZOOM = 'minZoom';
    public const OPTION_MAX_ZOOM = 'maxZoom';
    public const OPTION_LAYERS = 'layers';
    public const OPTION_MAX_BOUNDS = 'maxBounds';
    public const OPTION_RENDERER = 'renderer';

    use OptionsTrait;
    
    private string $name;
    
    private array $layers = [];
    private array $controls = [];
    
    public function __construct(string $name, array $options = [])
    {
        $this->name = $name;
        $this->setOptions($options);
    }
    
    /**
     * 
     * @return string
     */
    public function getName(): string 
    {
        return $this->name;
    }
    
    /**
     * @Ignore()
     * @return array|null
     */
    public function getMaxBounds(): ?array
    {
        return $this->options[self::OPTION_MAX_BOUNDS] ?? null;
    }
    
    /**
     * 
     * @param array|null $maxBounds
     * @return WebMap
     */
    public function setMaxBounds(?array $maxBounds = null): WebMap
    {
        $this->options[self::OPTION_MAX_BOUNDS] = $maxBounds;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return int|null
     */
    public function getMaxZoom(): ?int 
    {
        return $this->options[self::OPTION_MAX_ZOOM] ?? null;
    }
    
    /**
     * 
     * @param int|null $maxZoom
     * @return WebMap
     */
    public function setMaxZoom(?int $maxZoom = null): WebMap
    {
        $this->options[self::OPTION_MAX_ZOOM] = $maxZoom;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return int|null
     */
    public function getMinZoom(): ?int
    {
        return $this->options[self::OPTION_MIN_ZOOM] ?? null;
    }
    
    /**
     * 
     * @param int|null $minZoom
     * @return WebMap
     */
    public function setMinZoom(?int $minZoom = null): WebMap
    {
        $this->options[self::OPTION_MIN_ZOOM] = $minZoom;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return bool
     */
    public function hasDoubleClickZoom(): bool
    {
        return (bool) ($this->options[self::OPTION_DOUBLE_CLICK_ZOOM] ?? true);
    }
    
    /**
     * 
     * @param bool|null $doubleClickZoom
     * @return WebMap
     */
    public function setDoubleClickZoom(?bool $doubleClickZoom = null): WebMap
    {
        $this->options[self::OPTION_DOUBLE_CLICK_ZOOM] = $doubleClickZoom;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return bool
     */
    public function hasDragging(): bool 
    {
        return $this->options[self::OPTION_DRAGGING] ?? true;
    }
    
    /**
     * 
     * @param bool|null $dragging
     * @return WebMap
     */
    public function setDragging(?bool $dragging = null): WebMap 
    {
        $this->options[self::OPTION_DRAGGING] = $dragging;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return bool
     */
    public function hasTrackResize(): bool 
    {
        return $this->options[self::OPTION_TRACK_RESIZE] ?? true;
    }
    
    /**
     * 
     * @param bool|null $trackResize
     * @return WebMap
     */
    public function setTrackResize(?bool $trackResize = null): WebMap 
    {
        $this->options[self::OPTION_TRACK_RESIZE] = $trackResize;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return int
     */
    public function getZoomSnap(): int
    {
        return $this->options[self::OPTION_ZOOM_SNAP] ?? 1;
    }
    
    /**
     * 
     * @param int|null $zoomSnap
     * @return WebMap
     */
    public function setZoomSnap(?int $zoomSnap = null): WebMap 
    {
        $this->options[self::OPTION_ZOOM_SNAP] = $zoomSnap;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return int
     */
    public function getZoomDelta(): int
    {
        return $this->options[self::OPTION_ZOOM_DELTA] ?? 1;
    }
    
    public function setZoomDelta(?int $zoomDelta = null): WebMap 
    {
        $this->options[self::OPTION_ZOOM_DELTA] = $zoomDelta;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return bool|null
     */
    public function hasBoxZoom(): bool 
    {
        return $this->options[self::OPTION_BOX_ZOOM] ?? true;
    }
    
    public function setBoxZoom(?bool $boxZoom = null): WebMap
    {
        $this->options[self::OPTION_BOX_ZOOM] = $boxZoom;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return array|null
     */
    public function getCenter(): ?array
    {
        return $this->options[self::OPTION_CENTER] ?? null;
    }
    
    /**
     * 
     * @param array|null $center
     * @return WebMap
     */
    public function setCenter(?array $center = null): WebMap 
    {
        $this->options[self::OPTION_CENTER] = $center;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return int|null
     */
    public function getZoom(): ?int 
    {
        return $this->options[self::OPTION_ZOOM] ?? null;
    }
    
    /**
     * 
     * @param int|null $zoom
     * @return WebMap
     */
    public function setZoom(?int $zoom = null): WebMap
    {
        $this->options[self::OPTION_ZOOM] = $zoom;
        return $this;
    }
    
    /**
     * @return array
     */
    public function getLayers(): array 
    {
        return $this->layers;
    }
    
    /**
     * 
     * @param array $layers
     * @return WebMap
     */
    public function setLayers(array $layers): WebMap 
    {
        $this->layers = [];
        return $this->addLayers(...$layers);
    }
    
    /**
     * 
     * @param Layer $layers
     * @return WebMap
     */
    public function addLayers(Layer ...$layers): WebMap 
    {
        $this->layers = array_merge($layers, $this->layers);
        return $this;
    }
    
    /**
     * 
     * @param Layer $layers
     * @return WebMap
     */
    public function removeLayer(Layer ...$layers): WebMap
    {
        foreach ($layers as $layer) {
            if(false !== $offset = array_search($layer, $this->layers, true)) {
                unset($this->layers[$offset]);
            }
        }
        return $this;
    }
    
    
    
    
    
    /**
     * @return array
     */
    public function getControls(): array 
    {
        return $this->controls;
    }
    
    /**
     * 
     * @param Control[] $controls
     * @return WebMap
     */
    public function setControls(array $controls): WebMap 
    {
        $this->controls = [];
        return $this->addControl(...$controls);
    }
    
    /**
     * 
     * @param Control ...$controls
     * @return WebMap
     */
    public function addControl(Control ...$controls): WebMap 
    {
        $this->controls = array_merge($controls, $this->controls);
        return $this;
    }
    
    /**
     * 
     * @param Control ...$controls
     * @return WebMap
     */
    public function removeControl(Control ...$controls): WebMap
    {
        foreach ($controls as $control) {
            if(false !== $offset = array_search($control, $this->controls, true)) {
                unset($this->controls[$offset]);
            }
        }
        return $this;
    }
    
    public function __toString(): string
    {
        return $this->name;
    }
}
