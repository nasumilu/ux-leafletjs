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

namespace Nasumilu\UX\Leaflet\Twig;

use Symfony\Component\Routing\RouterInterface;
use Twig\{
    Environment,
    TwigFunction,
    Extension\AbstractExtension
};
use function trim;

/**
 */
class LeafletExtension extends AbstractExtension
{

    public const OPTION_ROUTE = 'route';
    public const OPTION_ROUTE_ARGS = 'route_args';
    
    private RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('render_webmap', [$this, 'renderWebMap'], ['needs_environment' => true, 'is_safe' => ['html']])
        ];
    }

    public function renderWebMap(Environment $environment, array $options = []): string
    {
        $url = $this->router->generate($options[self::OPTION_ROUTE], $options[self::OPTION_ROUTE_ARGS] ?? []);
        $html = '<div data-controller="nasumilu--ux-leafletjs--map" data-nasumilu--ux-leafletjs--map-url-value="' . $url . '">'
                . '<div data-nasumilu--ux-leafletjs--map-target="map"></div>'
                . '</div>';
        
        
        return trim($html);
    }

}
