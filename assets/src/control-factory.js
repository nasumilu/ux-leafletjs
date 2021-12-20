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

import L from 'leaflet';
import { layerSort } from './layer-sort';

export const controlFactory = {
    scale: (options, webmap) => L.control.scale(options).addTo(webmap),
    zoom: (options, webmap) => L.control.zoom(options).addTo(webmap),
    attribution: (options, webmap) => L.control.attribution(options).addTo(webmap),
    layers: (options, webmap) => {
        
        let baselayers = {};
        let overlays = {};
        const legendOptions = Object.assign({}, options);
        
        delete legendOptions.sort;
        if(options.sort) {
            legendOptions.sortLayers = true;
            legendOptions.sortFunction = layerSort[options.sort];
        }
        
        webmap.eachLayer(layer => {
            let title = layer.options.title;
            if(layer.options.baseLayer) {
                baselayers[title] = layer;
            } else {
                overlays[title] = layer;
            }
        });
        
        return L.control.layers(baselayers, overlays, legendOptions).addTo(webmap);
    }
};