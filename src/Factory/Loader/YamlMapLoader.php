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

namespace Nasumilu\UX\Leafletjs\Factory\Loader;

use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;

/**
 * 
 */
class YamlMapLoader extends FileLoader
{
    
    private const EXTENSIONS = ['yaml', 'yml'];
    
    /**
     * {@inheritDoc}
     */
    public function load($resource, $type = null): array
    {
        $name = pathinfo($resource, PATHINFO_FILENAME);
        $file = $this->getLocator()->locate($resource);
        $options = Yaml::parse(file_get_contents($file));
        return $options[$name];
    }

    
    /**
     * {@inheritDoc}
     */
    public function supports($resource, $type = null): bool
    {
        if(in_array($type, self::EXTENSIONS, true)) {
            return true;
        }
        
        if(!is_string($resource)) {
            return false;
        }
        $extension =  pathinfo($resource, PATHINFO_EXTENSION);
        
        return in_array($extension, self::EXTENSIONS, true);
    }

}
