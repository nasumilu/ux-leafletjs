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

namespace Nasumilu\UX\Leafletjs\Factory\Builder;

use Nasumilu\UX\Leafletjs\Model\Control;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 */
abstract class AbstractControlBuilder implements ControlBuilderInterface
{

    /**
     * @var OptionsResolver
     */
    private $optionsResolver;

    /**
     * @var string
     */
    private $type;

    /**
     * 
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->type = $type;
        $this->optionsResolver = new OptionsResolver();
        $this->configureOptions($this->optionsResolver);
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
     * @param OptionsResolver $optionsResolver
     * @return void
     */
    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->define('position')
                ->allowedTypes('string')
                ->allowedValues('topleft', 'topright', 'bottomleft', 'bottomright')
                ->info('The position of the control (one of the map corners).');
    }

    /**
     * 
     * @param array $options
     * @return Control
     */
    public function build(array $options = []): Control
    {
        $controlOptions = $this->optionsResolver->resolve($options);
        return new Control($this->type, $controlOptions);
    }

}
