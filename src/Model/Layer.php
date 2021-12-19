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

namespace Nasumilu\UX\Leafletjs\Model;

/**
 *
 */
class Layer
{

    use NamedTrait;
    use OptionsTrait;

    /**
     * @var string
     */
    private $type;
    
    /**
     * @var string
     */
    private $url;

    /**
     * 
     * @param string $type
     * @param string $name
     * @param string $url
     * @param array $options
     */
    public function __construct(string $type, string $name, string $url, array $options = [])
    {
        $this->name = $name;
        $this->type = $type;
        $this->url = $url;
        $this->options = $options;
    }

    /**
     * 
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * 
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * 
     * @param type $url
     * @return Layer
     */
    public function setUrl($url): Layer
    {
        $this->url = $url;
        return $this;
    }

}
