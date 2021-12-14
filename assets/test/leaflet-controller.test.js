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

import { Application, Controller } from 'stimulus';
import LeafletController from '../dist/leaflet-controller.esm';
import { clearDOM, mountDOM } from '@symfony/stimulus-testing';
import fetchMock from 'fetch-mock-jest';

class MapController extends Controller {
    connect() {
        this.element.addEventListener('leaflet:map_created', (evt) => console.log(evt.detail.map));
    }
}

const startStimulus = async () => {
    const application = Application.start();
    application.register('map', MapController);
    application.register('leaflet', LeafletController);
};


describe('LeafletController', () => {
    let container;

    afterEach(() => {
        clearDOM();
    });


    it('connect with options', async () => {

        container = mountDOM(`<div data-controller="leaflet map" 
            data-leaflet-url-value="http://localhost:8000/map.json">
                <div data-map-target="leaflet"></div>
            </div>`);
       
        startStimulus();

    });
    expect(true).toBe(true);
});



