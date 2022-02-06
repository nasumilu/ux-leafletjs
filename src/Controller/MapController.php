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

use Nasumilu\UX\Leafletjs\Factory\MapLoaderInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Nasumilu\UX\Leafletjs\Model\Map;

/**
 * Controller used to serve the map configuration files.
 */
class MapController
{

    private MapLoaderInterface $mapLoader;
    private SerializerInterface $serializer;

    public function __construct(MapLoaderInterface $mapLoader,
            SerializerInterface $serializer)
    {
        $this->mapLoader = $mapLoader;
        $this->serializer = $serializer;
    }

    public function webmap(string $name): JsonResponse
    {
        return $this->json($this->mapLoader->load($name));
    }
    
    private function json(Map $map): JsonResponse 
    {
        $json = $this->serializer->serialize($map, 'json', [AbstractObjectNormalizer::SKIP_NULL_VALUES]);
        return new JsonResponse($json, 200, [], true);
    }

}
