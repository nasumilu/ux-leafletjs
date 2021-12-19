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

namespace Nasumilu\UX\Leafletjs\Factory;

use Nasumilu\UX\Leafletjs\Model\Control;
use Nasumilu\UX\Leafletjs\Factory\Builder\ControlBuilderInterface;
use InvalidArgumentException;

/**
 * 
 */
class ControlFactory implements ControlFactoryInterface
{
    
    /**
     * @var array<ControlBuilderInterface>
     */
    private $controlBuilders;
    
    /**
     * @var array<string>
     */
    private $types;
    
    /**
     * 
     * @param ControlBuilderInterface $controlBuilders
     */
    public function __construct(ControlBuilderInterface ...$controlBuilders)
    {
        $this->setBuilders($controlBuilders);
    }
    
    /**
     * 
     * @param array $controlBuilders
     * @return self
     */
    public function setBuilders(array $controlBuilders): self
    {
        $this->controlBuilders = [];
        return $this->addBuilder(...$controlBuilders);
    }
    
    /**
     * 
     * @param ControlBuilderInterface $controlBuilders
     * @return self
     */
    public function addBuilder(ControlBuilderInterface ...$controlBuilders): self
    {
        $this->controlBuilders = array_merge($this->controlBuilders, $controlBuilders);
        return $this;
    }
    
    /**
     * 
     * @return array
     */
    public function getBuilders(): array
    {
        return $this->controlBuilders;
    }
    
    public function getControlTypes(): array
    {
        if(null == $this->types) {
            $this->types = array_map(static function(ControlBuilderInterface $builder) { return $builder->getType(); }, $this->controlBuilders);
        }
        return $this->types;
    }
    
    /**
     * 
     * @param string $type
     * @param array $options
     * @return Control
     * @throws InvalidArgumentException
     */
    public function create(string $type, array $options = []): Control
    {
        foreach($this->controlBuilders as $builder) {
            if($builder->getType() === $type) {
                return $builder->build($options);
            }
        }
        throw new InvalidArgumentException("Unable to build controle type $type!");
    }

}
