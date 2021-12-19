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
class Map
{
    use NamedTrait;
    use OptionsTrait;
    
    /**
     * @var array<Layer>
     */
    private $layers;
    
    /**
     * @var array<Control>
     */
    private $controls;
    
    /**
     * 
     * @param string $name
     * @param array $options
     */
    public function __construct(string $name, array $options)
    {
        $this->name = $name;
        
        $this->layers = [];
        if(array_key_exists('layers', $options)) {
            $this->setLayers($options['layers']);
            unset($options['layers']);
        }
        
        $this->controls = [];
        if(array_key_exists('controls', $options)) {
            $this->setControls($options['controls']);
            unset($options['controls']);
        }
        
        $this->options = $options;
    }
    
    /**
     * 
     * @return array
     */
    public function getLayers(): array
    {
        return $this->layers;
    }
    
    /**
     * 
     * @param array $layers
     * @return self
     */
    public final function setLayers(array $layers): self
    {
        $this->layers = [];
        $this->addLayer(...$layers);
        return $this;
    }
    
    /**
     * 
     * @param Layer $layers
     * @return self
     */
    public function addLayer(Layer ...$layers): self
    {
        $this->layers = array_merge($this->layers, $layers);
        return $this;
    }
    
    /**
     * 
     * @param Layer $layers
     * @return self
     */
    public function removeLayer(Layer ...$layers): self
    {
        foreach($layers as $layer) {
            if(false !== $offset = array_search($layer, $this->layers, true)) {
                unset($this->controls[$offset]);
            }
        }
        return $this;
    }
    
    /**
     * 
     * @return array
     */
    public function getControls(): array
    {
        return $this->controls;
    }
    
    /**
     * 
     * @param array $controls
     * @return self
     */
    public function setControls(array $controls): self
    {
        $this->controls = [];
        $this->addControl(...$controls);
        return $this;
    }
    
    /**
     * 
     * @param Control $controls
     * @return self
     */
    public function addControl(Control ...$controls): self
    {
        $this->controls = array_merge($this->controls, $controls);
        return $this;
    }
    
    /**
     * 
     * @param Control $controls
     * @return self
     */
    public function removeControl(Control ...$controls): self
    {
        foreach($controls as $control) {
            if(false !== $offset = array_search($control, $this->controls, true)) {
                unset($this->controls[$offset]);
            }
        }
        return $this;
    }
   
}
