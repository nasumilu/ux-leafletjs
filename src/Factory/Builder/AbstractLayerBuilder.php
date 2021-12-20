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

use Symfony\Component\OptionsResolver\OptionsResolver;
use Nasumilu\UX\Leafletjs\Model\Layer;
use Symfony\Component\Routing\RouterInterface;
use Nasumilu\UX\Leafletjs\Factory\OptionsNormalizer;

/**
 * 
 */
abstract class AbstractLayerBuilder implements LayerBuilderInterface
{

    /**
     * @var OptionsResolver
     */
    private $optionsResolver;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * 
     * @param string $type
     * @param RouterInterface $router
     */
    public function __construct(string $type, RouterInterface $router)
    {
        $this->type = $type;
        $this->router = $router;
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
        $castToBool = OptionsNormalizer::closureFor('castToBool');
        $castToInt = OptionsNormalizer::closureFor('castToInt');

        $optionsResolver->define('attribution')
                ->allowedTypes('string')
                ->info('The layers attribution describing its data and any legal obligations');

        $optionsResolver->define('title')
                ->allowedTypes('string')
                ->info('A title to use un the Legend');

        $optionsResolver->define('baseLayer')
                ->allowedTypes('bool', 'string')
                ->normalize($castToBool)
                ->info('Indicates whether the layer is a base map or an overlay');

        $optionsResolver->define('legendOrder')
                ->allowedTypes('int', 'string')
                ->normalize($castToInt)
                ->info('Order which layer should appear in the Layers control.');
    }

    /**
     * 
     * @param string $name
     * @param string $url
     * @param array $options
     * @return Layer
     */
    public function build(string $name, string $url, array $options = []): Layer
    {
        $layerOptions = $this->optionsResolver->resolve($options);
        return new Layer($this->type,
                $name,
                $url,
                array_filter($layerOptions,
                        static function ($value) {
                            return !is_null($value);
                        }));
    }

    public function __toString()
    {
        return "LayerBuilderInterface[{$this->type}]";
    }

}
