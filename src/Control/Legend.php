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

use Symfony\Component\Serializer\Annotation\Ignore;

/**
 * 
 */
class Legend extends Control
{

    /** https://leafletjs.com/reference.html#control-layers-collapsed */
    public const OPTION_COLLAPSED = 'collapsed';

    /** https://leafletjs.com/reference.html#control-layers-autozindex */
    public const OPTION_AUTO_INDEX = 'autoIndex';

    /** https://leafletjs.com/reference.html#control-layers-hidesinglebase */
    public const OPTION_HIDE_SINGLE_BASE = 'hideSingleBase';
    
    public const OPTION_SORT = 'sort';

    /**
     * {@inheritDoc}
     */
    public function getType(): string
    {
        return Control::TYPE_LEGEND;
    }
    
    /**
     * @Ignore()
     * @return string|null
     */
    public function getSort(): ?string
    {
        return $this->options[self::OPTION_SORT] ?? null;
    }

    /**
     * @Ignore()
     * @return bool
     */
    public function isCollapsed(): bool
    {
        return $this->options[self::OPTION_COLLAPSED] ?? true;
    }

    /**
     * 
     * @param bool|null $collapsed
     * @return Legend
     */
    public function setCollapsed(?bool $collapsed = null): Legend
    {
        $this->options[self::OPTION_COLLAPSED] = $collapsed;
        return $this;
    }

    /**
     * 
     * @param string|null $sort
     * @return Legend
     */
    public function setSort(?string $sort = null): Legend 
    {
        $this->options[self::OPTION_SORT] = $sort;
        return $this;
    }
    
    /**
     * @Ignore()
     * @return bool
     */
    public function isAutoIndex(): bool
    {
        return $this->options[self::OPTION_AUTO_INDEX] ?? true;
    }

    /**
     * 
     * @param bool|null $autoIndex
     * @return Legend
     */
    public function setAutoIndex(?bool $autoIndex = null): Legend
    {
        $this->options[self::OPTION_AUTO_INDEX] = $autoIndex;
        return $this;
    }

    /**
     * @Ignore()
     * @return bool
     */
    public function isHideSingleBase(): bool
    {
        return $this->options[self::OPTION_HIDE_SINGLE_BASE] ?? false;
    }

    /**
     * 
     * @param bool|null $hideSingleBase
     * @return Legend
     */
    public function setHideSingleBase(?bool $hideSingleBase = null): Legend
    {
        $this->options[self::OPTION_HIDE_SINGLE_BASE] = $hideSingleBase;
        return $this;
    }

}
