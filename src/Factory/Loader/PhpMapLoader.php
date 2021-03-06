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

/**
 * 
 */
class PhpMapLoader extends FileLoader
{
    
    public function load($resource, $type = null): array
    {
        $name = pathinfo($resource, PATHINFO_FILENAME);
        $file = $this->locator->locate($resource);
        $options = require $file;
        return $options[$name];
    }

    public function supports($resource, $type = null): bool
    {
        return 'php' === $type
                || (is_string($resource) && 'php' === pathinfo($resource, PATHINFO_EXTENSION));
    }

}
