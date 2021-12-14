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

export default function (url, options) {
          
    const layerOptions = {};  
    
    for (const [key, value] of Object.entries(options)) {
        if(key === 'layers') {
            layerOptions.layers = value.map(layer => layer[0]).join(',');
            layerOptions.styles = value.map(layer => layer[1]|| '').join(',');
        } else {
            layerOptions[key] = value;
        }
    }
    
    return L.tileLayer.wms(url, layerOptions);
};
