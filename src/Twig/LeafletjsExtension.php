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

namespace Nasumilu\UX\Leafletjs\Twig;

use Symfony\Component\Routing\RouterInterface;
use Symfony\WebpackEncoreBundle\Twig\StimulusTwigExtension;
use Twig\{
    Environment,
    TwigFunction,
    Extension\AbstractExtension
};
use function trim;

/**
 */
class LeafletjsExtension extends AbstractExtension
{

    public const OPTION_ROUTE = 'route';
    public const OPTION_ROUTE_ARGS = 'route_args';
    public const OPTION_CONTROLLER = 'controller';
    public const OPTION_ATTRIBUTES = 'attributes';
    
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var StimulusTwigExtension
     */
    private $stimulus;

    public function __construct(StimulusTwigExtension $stimulus, RouterInterface $router)
    {
        $this->router = $router;
        $this->stimulus = $stimulus;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('webmap', [$this, 'renderWebMap'], ['needs_environment' => true, 'is_safe' => ['html']])
        ];
    }

    /**
     * @param Environment $environment
     * @param array $options
     * @return string
     */
    public function renderWebMap(Environment $environment, array $options = []): string
    {
        $url = $this->router->generate($options[self::OPTION_ROUTE], $options[self::OPTION_ROUTE_ARGS] ?? []);
        
        $controllers = array_merge($options[self::OPTION_CONTROLLER] ?? [], ['@nasumilu/ux-leafletjs/map' => ['url' => $url]]);
        $html = '<div '.$this->stimulus->renderStimulusController($environment, $controllers).' ';
        
        foreach($options[self::OPTION_ATTRIBUTES] ?? [] as $name => $value) {
            if(true === $value) {
                $html .= $name.'="'.$name.'" ';
            } elseif (false != $value) {
                $html .= $name.'="'.$value.'" ';
            }
        }
        return trim($html).'></div>';
    }

}
