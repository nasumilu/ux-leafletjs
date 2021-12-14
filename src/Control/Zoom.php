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

namespace Nasumilu\UX\Leaflet\Control;

use Symfony\Component\Serializer\Annotation\Ignore;

/**
 * 
 */
class Zoom extends Control
{

    /** https://leafletjs.com/reference.html#control-zoom-zoomintext */
    public const OPTION_ZOOM_IN_TEXT = 'zoomInText';

    /** https://leafletjs.com/reference.html#control-zoom-zoomintitle */
    public const OPTION_ZOOM_IN_TITLE = 'zoomInTitle';

    /** https://leafletjs.com/reference.html#control-zoom-zoomouttext */
    public const OPTION_ZOOM_OUT_TEXT = 'zoomOutText';

    /** https://leafletjs.com/reference.html#control-zoom-zoomouttitle */
    public const OPTION_ZOOM_OUT_TITLE = 'zoomOutTitle';

    public function getType(): string
    {
        return Control::TYPE_ZOOM;
    }
    
    /**
     * @Ignore()
     * @return string|null
     */
    public function getZoomInText(): ?string
    {
        return $this->options[self::OPTION_ZOOM_IN_TEXT];
    }

    /**
     * 
     * @param string|null $zoomInText
     * @return Zoom
     */
    public function setZoomInText(?string $zoomInText = null): Zoom
    {
        $this->options[self::OPTION_ZOOM_IN_TEXT] = $zoomInText;
        return $this;
    }

    /**
     * @Ignore()
     * @return string|null
     */
    public function getZoomInTitle(): ?string
    {
        return $this->options[self::OPTION_ZOOM_IN_TITLE];
    }

    /**
     * 
     * @param string|null $zoomInTitle
     * @return Zoom
     */
    public function setZoomInTitle(?string $zoomInTitle = null): Zoom
    {
        $this->options[self::OPTION_ZOOM_IN_TITLE] = $zoomInTitle;
        return $this;
    }

    /**
     * @Ignore()
     * @return string|null
     */
    public function getZoomOutText(): ?string
    {
        return $this->options[self::OPTION_ZOOM_OUT_TEXT];
    }

    /**
     * 
     * @param string|null $zoomOutText
     * @return Zoom
     */
    public function setZoomOutText(?string $zoomOutText = null): Zoom
    {
        $this->options[self::OPTION_ZOOM_OUT_TEXT] = $zoomOutText;
        return $this;
    }

    /**
     * @Ignore()
     * @return string|null
     */
    public function getZoomOutTitle(): ?string
    {
        return $this->options[self::OPTION_ZOOM_OUT_TITLE];
    }

    /**
     * 
     * @param string|null $zoomOutTitle
     * @return Zoom
     */
    public function setZoomOutTitle(?string $zoomOutTitle = null): Zoom
    {
        $this->options[self::OPTION_ZOOM_OUT_TITLE] = $zoomOutTitle;
        return $this;
    }

}
