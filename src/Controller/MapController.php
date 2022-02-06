<?php

/*
 * Copyright 2021 Michael Lucas.
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

namespace Nasumilu\UX\Leafletjs\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Nasumilu\UX\Leafletjs\Factory\MapLoaderInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller used to serve the map configuration files.
 */
class MapController extends AbstractController
{

    private MapLoaderInterface $mapLoader;

    public function __construct(MapLoaderInterface $mapLoader)
    {
        $this->mapLoader = $mapLoader;
    }

    public function webmap(string $name): Response
    {
        $map = $this->mapLoader->load($name);
        return $this->json($map, 
                200, 
                [], 
                [AbstractObjectNormalizer::SKIP_NULL_VALUES => true]);
    }

}
