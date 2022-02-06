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
return [
    'my_map' => [
        'zoom' => 5,
        'center' => [29.54654, -85.654665],
        'closePopUpOnClick' => true,
        'zoomSnap' => 0.1,
        'zoomDelta' => 0.5,
        'trackResize' => true,
        'boxZoom' => false,
        'doubleClickZoom' => 'center',
        'dragging' => false,
        'minZoom' => 3,
        'maxZoom' => 18,
        'zoomAnimation' => true,
        'zoomAnimationThreshold' => 4,
        'fadeAnimation' => false,
        'markerZoomAnimation' => false,
        'keyboard' => true,
        'keyboardPanDelta' => 80,
        'scrollWheelZoom' => 'center',
        'wheelDebounceTime' => 40,
        'wheelPxPerZoomLevel' => 60,
        'tap' => true,
        'tapTolerance' => 15,
        'touchZoom' => true,
        'bounceAtZoomLimits' => false,
        'maxBounds' => [[-14.54654, -60.654665], [-29.54654, 85.654665]],
        'inertia' => true,
        'inertiaDeceleration' => 3000,
        'inertiaMaxSpeed' => 10,
        'easeLinearity' => 0.2,
        'worldCopyJump' => false,
        'maxBoundsViscosity' => 0.1,
        'controls' => [
            [
                'type' => 'zoom',
                'options' => [
                    'position' => 'topright',
                    'zoomInText' => '+',
                    'zoomInTitle' => 'Zoom In',
                    'zoomOutText' => '-',
                    'zoomOutTitle' => 'Zoom Out'
                ]
            ],
            [
                'type' => 'layers',
                'options' => [
                    'position' => 'topleft',
                    'collapsed' => false,
                    'autoZIndex' => true,
                    'hideSingleBase' => true,
                    'sortLayers' => true,
                    'sortFunction' => 'legendOrder'
                ]
            ],
            [
                'type' => 'scale',
                'options' => [
                    'position' => 'bottomleft',
                    'maxWidth' => 300,
                    'metric' => true,
                    'imperial' => true,
                    'updateWhenIdle' => false
                ]
            ],
            [
                'type' => 'attribution',
                'options' => [
                    'position' => 'bottomright',
                    'prefix' => 'nasumilu.com'
                ]
            ]
        ],
        'layers' => [
            'tile-layer' => [
                'type' => 'tile',
                'url' => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                'options' => [
                    'legendOrder' => 1,
                    'baseLayer' => true,
                    'title' => 'OpenStreetMap',
                    'attribution' => '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    'tileSize' => [256, 256],
                    'opacity' => 0.5,
                    'updateWhenIdle' => true,
                    'updateWhenZooming' => true,
                    'updateInterval' => 200,
                    'zIndex' => 1,
                    'bounds' => [[-14.54654, -60.654665], [-29.54654, 85.654665]],
                    'maxNativeZoom' => 10,
                    'minNativeZoom' => 0,
                    'minZoom' => 3,
                    'maxZoom' => 5,
                    'noWrap' => true,
                    'className' => 'map-tile',
                    'keepBuffer' => 2,
                    'subdomains' => ['a', 'b', 'c', 'u'],
                    'zoomOffset' => 0,
                    'tms' => true,
                    'zoomReverse' => false,
                    'detectRetina' => true,
                    'crossOrigin' => '*'
                ]
            ],
            'north_woods' => [
                'type' => 'wms',
                'url' => 'https://map.nasumilu.com/northwood/wms',
                'options' => [
                    'legendOrder' => 1,
                    'baseLayer' => false,
                    'title' => 'SF College North Woods',
                    'tileSize' => [256, 256],
                    'opacity' => 0.5,
                    'updateWhenIdle' => true,
                    'updateWhenZooming' => true,
                    'updateInterval' => 200,
                    'zIndex' => 1,
                    'bounds' => [[-14.54654, -60.654665], [-29.54654, 85.654665]],
                    'maxNativeZoom' => 10,
                    'minNativeZoom' => 0,
                    'minZoom' => 3,
                    'maxZoom' => 5,
                    'noWrap' => true,
                    'className' => 'map-tile',
                    'keepBuffer' => 2,
                    'subdomains' => ['a', 'b', 'c', 'u'],
                    'errorTileUrl' => 'https://error_image.png',
                    'zoomOffset' => 0,
                    'tms' => true,
                    'zoomReverse' => false,
                    'detectRetina' => true,
                    'crossOrigin' => '*',
                    'format' => 'image/png',
                    'transparent' => true,
                    'version' => '1.3.0',
                    'uppercase' => false,
                    'layers' => [
                        ['northwood:boundary_perimeter', 'northwood:PerimeterStyle'],
                        ['northwood:boundary'],
                        ['northwood:tree', 'northwood:TreeStyle'],
                        ['northwood:trail', 'northwood:TrailStyle'],
                        ['northwood:natural_community', 'northwood:NaturalCommunityStyle']
                    ]
                ]
            ]
        ]
    ]
];
