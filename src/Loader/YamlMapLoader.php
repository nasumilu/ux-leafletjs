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

namespace Nasumilu\UX\Leafletjs\Loader;

use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Config\FileLocatorInterface;
use Nasumilu\UX\Leafletjs\Factory\MapFactoryInterface;
use Symfony\Component\Yaml\Yaml;
use Nasumilu\UX\Leafletjs\Model\Map;

/**
 * 
 */
class YamlMapLoader extends FileLoader implements MapLoaderInterface
{

    /**
     * @var MapFactoryInterface
     */
    private $factory;
    
    /**
     * 
     * @param MapFactoryInterface $factory
     * @param FileLocatorInterface $locator
     * @param string $env
     */
    public function __construct(MapFactoryInterface $factory, FileLocatorInterface $locator, string $env = null)
    {
        parent::__construct($locator, $env);
        $this->factory = $factory;
    }
    
    /**
     * {@inheritDoc}
     */
    public function load($resource, $type = null): Map
    {
        $name = pathinfo($resource, PATHINFO_FILENAME);
        $file = $this->getLocator()->locate($resource);
        $options = Yaml::parse(file_get_contents($file));
        return $this->factory->create($name, $options[$name]);
    }

    
    /**
     * {@inheritDoc}
     */
    public function supports($resource, $type = null): bool
    {
        return is_string($resource) && 'yaml' === pathinfo($resource, PATHINFO_EXTENSION);
    }

}
