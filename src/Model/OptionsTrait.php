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

namespace Nasumilu\UX\Leafletjs\Model;

/**
 *
 */
trait OptionsTrait
{

    /**
     * @var array
     */
    protected $options = [];
    
    /**
     * 
     * @param array $options
     * @return self
     */
    public function setOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }
    
    /**
     * 
     * @return array
     */
    public function getOptions(): array 
    {
        return $this->options;
    }
    
    /**
     * 
     * @param string $option
     * @param type $value
     * @return self
     */
    public function setOption(string $option, $value): self
    {
        $this->options[$option] = $value;
    }
    
    /**
     * 
     * @param string $option
     * @return type
     */
    public function getOption(string $option)
    {
        return $this->options[$option];
    }
    
    /**
     * 
     * @param string $option
     * @return self
     */
    public function unsetOption(string $option): self
    {
        if(array_key_exists($option, $this->options)) {
            unset($this->options[$option]);
        }
        return $this;
    }
    
}
