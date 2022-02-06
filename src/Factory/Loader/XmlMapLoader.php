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

use SimpleXMLElement;
use Symfony\Component\Config\Loader\FileLoader;

/**
 * 
 */
class XmlMapLoader extends FileLoader
{

    /**
     * 
     * @param type $resource
     * @param type $type
     * @return Map
     */
    public function load($resource, $type = null): array
    {
        $file = $this->getLocator()->locate($resource);
        $webmap = new SimpleXMLElement(file_get_contents($file));
        $configs = $this->parseOptions($webmap->option);
        
        $configs['layers'] = $this->parseLayers($webmap);
        $configs['controls'] = $this->parseControls($webmap);
        
        return $configs;
    }

    /**
     * 
     * @param type $resource
     * @param type $type
     * @return bool
     */
    public function supports($resource, $type = null): bool
    {
        return 'xml' === $type 
                || (is_string($resource) && 'xml' === pathinfo($resource, PATHINFO_EXTENSION));
    }
    
    private function parseControls(SimpleXMLElement $webmap): array
    {
        $controls = [];
        foreach($webmap->controls->control ?? [] as $control) {
            $type = (string) $control['type'];
            $controls[] = [
                'type' => $type,
                'options' => $this->parseOptions($control->option)
            ];
        }
        return array_filter($controls);
    }
    
    /**
     * 
     * @param SimpleXMLElement $webmap
     * @return array
     */
    private function parseLayers(SimpleXMLElement $webmap): array
    {
        $layers = [];
        foreach($webmap->layers->layer ?? [] as $layer) {
            $type = (string) $layer['type'];
            $url = (string) $layer['url'];
            $name = (string) $layer['name'];
            $layers[$name] = [
                'type' => $type,
                'url' => $url
            ];
            $method = "parse{$type}LayerOptions";
            $layers[$name]['options'] = $this->{$method}($layer);
        }
        return $layers;
    }
    
    /**
     * 
     * @param SimpleXMLElement $tileLayer
     * @return array
     */
    private function parseTileLayerOptions(SimpleXMLElement $tileLayer): array
    {
        return $this->parseOptions($tileLayer->option);
    }
    
    /**
     * 
     * @param SimpleXMLElement $wmsLayer
     * @return array
     */
    private function parseWmsLayerOptions(SimpleXMLElement $wmsLayer): array
    {
        $wmsLayers = [];
        foreach($wmsLayer->wms_layers->wms_layer ?? [] as $layer) {
            $wmsLayers[] = array_filter([(string) $layer['name'], (string)$layer['style'] ?? null]);
        }
        return array_merge($this->parseOptions($wmsLayer->option), ['layers' => $wmsLayers]);
    }
    
    /**
     * 
     * @param SimpleXMLElement $optionNodes
     * @return array
     */
    private function parseOptions(SimpleXMLElement $optionNodes): array 
    {
        $options = [];
        foreach($optionNodes as $option) {
            $options[(string)$option['name']] = (string) $option['value'];
        }
        return $options;
    }

}
