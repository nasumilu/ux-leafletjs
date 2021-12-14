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

namespace Nasumilu\UX\Leaflet;

use Symfony\Component\Serializer\Annotation\Ignore;
use OutOfRangeException;
use function str_replace;
use function method_exists;
use function call_user_func;
/**
 * 
 */
trait OptionsTrait
{

    protected array $options = [];

    /**
     * @Ignore()
     * @param string $offset
     * @return string|null
     */
    protected function getterFromOffset(string $offset): ?string
    {
        foreach (['get', 'is', 'has'] as $prefix) {
            $method = $prefix . $offset;
            if (method_exists($this, $method)) {
                return $method;
            }
        }
        return null;
    }

    /**
     * @Ignore()
     * @param string $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return null !== $this->getterFromOffset($offset);
    }

    /**
     * @Ignore()
     * @param string $offset
     * @return mixed
     * @throws OutOfRangeException
     * @throws \ErrorException
     */
    public function offsetGet($offset)
    {
        if (null === $getter = $this->getterFromOffset($offset)) {
            throw new OutOfRangeException("Unable to find option getter method using get, is, or has for $offset!");
        }
        return call_user_func([$this, $getter]);
    }

    /**
     * @Ignore()
     * @param string $offset
     * @param mixed $value
     * @return void
     * @throws OutOfRangeException
     */
    public function offsetSet($offset, $value): void
    {
        if (!$this->offsetExists($offset)) {
            throw new OutOfRangeException("Offset `$offset` does not exist!");
        }
        $method = 'set' . str_replace('_', '', $offset);
        call_user_func([$this, $method], $value);
    }

    /**
     * @Ignore()
     * @param string $offset
     * @return void
     */
    public function offsetUnset($offset): void
    {
        $this->offsetSet($offset, null);
    }
    
    public function setOption(string $option, $value = null): self
    {
        $this[$option] = $value;
        return $this;
    }
    
    /**
     * @Ignore()
     * @param string $option
     * @return $this
     */
    public function getOption(string $option)
    {
        return $this[$option];
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options = []): self
    {
        $this->options = [];
        foreach ($options as $key => $value) {
            $this[$key] = $value;
        }
        return $this;
    }

}
