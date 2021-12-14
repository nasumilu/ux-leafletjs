# nasumilu/ux-leafletjs

This is a Symfony UX -> lealfet.js integration component.


## Install

During development install using composer is only possible if you add the git
repository. Upon the first release a packagis and flex recipe will easy the pain
of installing this component. Until then this is the process required:

composer.json
```json
{
    "repositories" [
        {
            "type": "vcs",
            "url": "https://github.com/nasumilu/ux-leafletjs"
        }
    ]
}
```


```sh
$ composer require nasuilu/ux-leafletjs:dev-main
```

## Setup

If not using Symfony Flex then add the bundle to the applications **config/bundles.php**
```php
return [
    ...
    Nasumilu\UX\Leaflet\LeafletBundle::class => ['all' => true],
    ...
];
```

Next install the javascript packages by first updating your applications 
**assets/controllers.json** as follows:
```json
{
    "controllers": {
        ...
        "@nasumilu/ux-leafletjs": {
            "map": {
                "fetch": "eager",
                "enabled": true
            }
        }, ...

   }
}

```

Next install the @nasumilu/ux-leafletjs javascript dependency and build

With yarn
```sh
$ yarn install --force
$ yarn build
``

or with npm
```sh
$ npm install --force
$ npm run build
```

## Usage

Each map is created using a url which provides a JSON object. The JSON object
is used to configure a web map.

```php

// Controller/MapController.php

class MapController extends AbstractController {


    /**
     * @Route("/", name="app.index")
     * @return ResponseInterface
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/webmap", name="app.webmap")
     */
    public function map(): Response 
    {
        $options = [
            'center' => [29.54654, -85.654665],
            'zoom' => 5,
            'layers' => [
                new TileLayer('osm',
                    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', [
                    'attribution' => '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    'title' => 'Open Streets Map',
                    'baseLayer' => true
                ]);
            ],
            'controls' => [
                new Scale([
                    'position': Scale::POSITION_BOTTOM_RIGHT,
                    'maxWidth': 300
                ]),
                new Legend([
                    'position' => Legend::POSITION_TOP_RIGHT,
                ])
            ]
        ];
        
        $map = new WebMap('dev_map', $options);
        return $this->json($map, 200, [], [AbstractObjectNormalizer::SKIP_NULL_VALUES => true]); 
    }

}

```

In the template use the `webmap` function:
```twig
{# templates/map/index.twig.html
{% extends "base.html.twig" %}
{% block body %}
    {{ webmap({ 'route': 'app.webmap' } ) }}
{% endblock %}
```

![Sample Webmap](./docs/images/ux-leafletjs_screenshot.png)