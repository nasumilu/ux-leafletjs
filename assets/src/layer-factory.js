/* 
 * Copyright 2021 Michael Lucas
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
import geoJsonLayerFactory from './geojson-layer-factory';
import wmsLayerFactory from './wms-layer-factory';

export const layerFactory = {
    tile: async (args, webmap) => await L.tileLayer(args.url, args.options).addTo(webmap),
    geojson: async (args, webmap) => await geoJsonLayerFactory(args.url, args.options).addTo(webmap),
    wms: async (args, webmap) => await wmsLayerFactory(args.url, args.options).addTo(webmap)
};
