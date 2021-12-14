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
 */
class Attribution extends Control
{
    /** https://leafletjs.com/reference.html#control-attribution-prefix */
    public const OPTION_PREFIX = 'prefix';
    
    public function getType(): string
    {
        return Control::TYPE_ATTRIBUTION;
    }
    
    /**
     * @Ignore()
     * @return string|null
     */
    public function getPrefix(): string
    {
        return $this->options[self::OPTION_PREFIX] ?? 'Leaflet';
    }
    
    /**
     * 
     * @param string|null $prefix
     * @return Attribution
     */
    public function setPrefix(?string $prefix = null): Attribution 
    {
        $this->options[self::OPTION_PREFIX] = $prefix;
        return $this;
    }

}
