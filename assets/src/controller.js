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

'use strict';

import { Controller } from '@hotwired/stimulus';
import { layerFactory } from './layer-factory';
import { controlFactory } from './control-factory';

export default class extends Controller {

    static values = { url: String };

    async connect() {
        if(!this.hasUrlValue) {
            throw new Error('Url value not found!');
        }
        
        this._dispatchEvent('leafletjs:connecting', { layerFactory: layerFactory, controlFactory: controlFactory });
        const map = await this._initMap();
        this._dispatchEvent('leafletjs:connected', { map: map });
    }
    
    async _initMap() {
        return await fetch(this.urlValue)
            .then(response => response.json())
            .then(settings => {
                const webmap = L.map(this.element, settings.options);
              
                Object.values(settings.layers || {}).forEach(layer => {
                    layerFactory[layer.type](layer, webmap).options.name = layer.name;
                });
                
                settings.controls?.forEach(control => {
                    controlFactory[control.type](control.options, webmap);
                });
                
                return webmap;
            });
    }
    
    _dispatchEvent(name, payload) {
        this.element.dispatchEvent(new CustomEvent(name, { detail: payload }));
    }
}
