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
class Scale extends Control
{

    /** https://leafletjs.com/reference.html#control-scale-maxwidth */
    public const OPTION_MAX_WIDTH = 'maxWidth';
    
    /** https://leafletjs.com/reference.html#control-scale-metric */
    public const OPTION_METRIC = 'metric';
    
    /** https://leafletjs.com/reference.html#control-scale-imperial */
    public const OPTION_IMPERIAL = 'imperial';
    
    /** https://leafletjs.com/reference.html#control-scale-updatewhenidle */
    public const OPTION_UPDATE_WHEN_IDLE = 'updateWhenIdle';
    
    
    /**
     * {@inheritDoc}
     */
    public function getType(): string
    {
        return Control::TYPE_SCALE;
    }
    
    /**
     * @Ignore()
     * @return int
     */
    public function getMaxWidth(): int
    {
        return $this->options[self::OPTION_MAX_WIDTH] ?? 100;
    }
    
    /**
     * 
     * @param int|null $maxWidth
     * @return Scale
     */
    public function setMaxWidth(?int $maxWidth = null): Scale 
    {
        $this->options[self::OPTION_MAX_WIDTH] = $maxWidth;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return bool
     */
    public function isMetric(): bool 
    {
        return $this->options[self::OPTION_METRIC] ?? true;
    }
    
    /**
     * 
     * @param bool|null $metric
     * @return Scale
     */
    public function setMetric(?bool $metric = null): Scale 
    {
        $this->options[self::OPTION_METRIC] = $metric;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return bool
     */
    public function isImperial(): bool
    {
        return $this->options[self::OPTION_IMPERIAL] ?? true;
    }
    
    
    /**
     * 
     * @param bool|null $imperial
     * @return Scale
     */
    public function setImperial(?bool $imperial = null): Scale 
    {
        $this->options[self::OPTION_IMPERIAL] = $imperial;
        return $this;
    }
}
