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

namespace Nasumilu\UX\Leafletjs\Factory;

use Nasumilu\UX\Leafletjs\Model\Layer;
use Nasumilu\UX\Leafletjs\Factory\Builder\LayerBuilderInterface;
use InvalidArgumentException;
/**
 */
class LayerFactory implements LayerFactoryInterface, LayerBuilderRegistry
{

    /**
     * @var array<LayerBuilderInterface>
     */
    private $layerBuilders;
    
    /**
     * @var array<string>
     */
    private $types;
    
    /**
     * 
     * @param LayerBuilderInterface $layerBuilders
     */
    public function __construct(LayerBuilderInterface ...$layerBuilders)
    {
        $this->setBuilders($layerBuilders);
    }
    
    /**
     * 
     * @param LayerBuilderInterface $layerBuilders
     * @return self
     */
    public function addBuilder(LayerBuilderInterface ...$layerBuilders): self
    {
        $this->layerBuilders = array_merge($this->layerBuilders, $layerBuilders);
        $this->types = null;
        return $this;
    }
    
    public function hasBuilder(LayerBuilderInterface $layerBuilder): bool
    {
        return false !== array_search($layerBuilder, $this->layerBuilders, true);
    }
    
    /**
     * 
     * @param array $layerBuilders
     * @return self
     */
    public final function setBuilders(array $layerBuilders): self
    {
        $this->layerBuilders = [];
        return $this->addBuilder(...$layerBuilders);
    }
    
    /**
     * 
     * @return array
     */
    public function getBuilders(): array 
    {
        return $this->layerBuilders;
    }
    
    /**
     * 
     * @return array
     */
    public function getLayerTypes(): array 
    {
        if(null === $this->types) {
            $this->types = array_map(static function(LayerBuilderInterface $builder) { return $builder->getType(); }, $this->layerBuilders);
        }
        return $this->types;
    }
    
    /**
     * 
     * @param string $type
     * @param string $name
     * @param string $url
     * @param array $options
     * @return Layer
     * @throws InvalidArgumentException
     */
    public function create(string $type, string $name, string $url, array $options = []): Layer
    {
        foreach($this->layerBuilders as $builder) {
            if($builder->getType() ===  $type) {
                return $builder->build($name, $url, $options);
            }
        }
        throw new InvalidArgumentException("Unable to build layer type $type!");
    }

}
