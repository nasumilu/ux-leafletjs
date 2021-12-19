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

import { Application, Controller } from '@hotwired/stimulus';
import LeafletjsController from '../src/controller';
import { clearDOM, mountDOM } from '@symfony/stimulus-testing';
import { getByTestId, waitFor } from '@testing-library/dom';
import fetchMock from 'jest-fetch-mock';

fetchMock.enableMocks();

class MapController extends Controller {
    connect() {
        this.element.addEventListener('leafletjs:connected', () => {
            this.element.classList.add('connected');
        });
    }
}

const startStimulus = async () => {
    const application = Application.start();
    application.register('map', MapController);
    application.register('leafletjs', LeafletjsController);
    return application;
};


describe('LeafletjsController', () => {
    let application;

    afterEach(() => {
        fetchMock.resetMocks();
        clearDOM();
        //application.stop();
    });


    it('connect with options', async () => {
        fetchMock.mockResponseOnce(JSON.stringify({
            zoom: 5,
            center: [29.54654, -85.654665],
            layers: {
                tile_layer: {
                    type: 'tile',
                    url: 'https://test.com/tilelayer/{x}/{y}/{z}'
                },
                north_woods: {
                    type: 'wms',
                    url: 'https://my_web_map_service',
                    options: {
                        layers: [
                            ['layer_one'],
                            ['layer_two', 'altnative_style']
                        ]
                    }
                }
            }
        }));

        const container = mountDOM(`<div data-testid="leaflet" data-controller="leafletjs map" 
            data-leafletjs-url-value="http://localhost:8000/map.json">
                <div data-map-target="leafletjs"></div>
            </div>`);

        expect(getByTestId(container, 'leaflet')).not.toHaveClass('connected');

        application = startStimulus();

        await waitFor(() => {
            expect(getByTestId(container, 'leaflet')).toHaveClass('connected');
        });
               
    });
});



