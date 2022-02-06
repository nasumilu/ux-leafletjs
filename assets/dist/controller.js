import _asyncToGenerator from '@babel/runtime/helpers/asyncToGenerator';
import _classCallCheck from '@babel/runtime/helpers/classCallCheck';
import _createClass from '@babel/runtime/helpers/createClass';
import _inherits from '@babel/runtime/helpers/inherits';
import _possibleConstructorReturn from '@babel/runtime/helpers/possibleConstructorReturn';
import _getPrototypeOf from '@babel/runtime/helpers/getPrototypeOf';
import _defineProperty from '@babel/runtime/helpers/defineProperty';
import _regeneratorRuntime from '@babel/runtime/regenerator';
import { Controller } from '@hotwired/stimulus';
import L$1 from 'leaflet';
import _slicedToArray from '@babel/runtime/helpers/slicedToArray';

function geoJsonLayerFactory (_x, _x2) {
  return _ref.apply(this, arguments);
}

function _ref() {
  _ref = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee(url, options) {
    var layer;
    return _regeneratorRuntime.wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            _context.next = 2;
            return fetch(url).then(function (response) {
              return response.json();
            }).then(function (data) {
              return L$1.geoJson(data, {
                style: function style(feature) {
                  return options.style;
                }
              });
            });

          case 2:
            layer = _context.sent;
            return _context.abrupt("return", layer);

          case 4:
          case "end":
            return _context.stop();
        }
      }
    }, _callee);
  }));
  return _ref.apply(this, arguments);
}

function wmsLayerFactory (url, options) {
  var layerOptions = {};

  for (var _i = 0, _Object$entries = Object.entries(options); _i < _Object$entries.length; _i++) {
    var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
        key = _Object$entries$_i[0],
        value = _Object$entries$_i[1];

    if (key === 'layers') {
      layerOptions.layers = value.map(function (layer) {
        return layer[0];
      }).join(',');
      layerOptions.styles = value.map(function (layer) {
        return layer[1] || '';
      }).join(',');
    } else {
      layerOptions[key] = value;
    }
  }

  return L$1.tileLayer.wms(url, layerOptions);
}

var layerFactory = {
  tile: function () {
    var _tile = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee(args, webmap) {
      return _regeneratorRuntime.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return L$1.tileLayer(args.url, Object.assign({
                name: args.name
              }, args.options)).addTo(webmap);

            case 2:
              return _context.abrupt("return", _context.sent);

            case 3:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }));

    function tile(_x, _x2) {
      return _tile.apply(this, arguments);
    }

    return tile;
  }(),
  geojson: function () {
    var _geojson = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee2(args, webmap) {
      return _regeneratorRuntime.wrap(function _callee2$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              _context2.next = 2;
              return geoJsonLayerFactory(args.url, Object.assign({
                name: args.name
              }, args.options)).addTo(webmap);

            case 2:
              return _context2.abrupt("return", _context2.sent);

            case 3:
            case "end":
              return _context2.stop();
          }
        }
      }, _callee2);
    }));

    function geojson(_x3, _x4) {
      return _geojson.apply(this, arguments);
    }

    return geojson;
  }(),
  wms: function () {
    var _wms = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee3(args, webmap) {
      return _regeneratorRuntime.wrap(function _callee3$(_context3) {
        while (1) {
          switch (_context3.prev = _context3.next) {
            case 0:
              _context3.next = 2;
              return wmsLayerFactory(args.url, Object.assign({
                name: args.name
              }, args.options)).addTo(webmap);

            case 2:
              return _context3.abrupt("return", _context3.sent);

            case 3:
            case "end":
              return _context3.stop();
          }
        }
      }, _callee3);
    }));

    function wms(_x5, _x6) {
      return _wms.apply(this, arguments);
    }

    return wms;
  }()
};

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
var layerSort = {
  layerName: function layerName(layerOne, layerTwo, nameOne, nameTwo) {
    var upperNameOne = nameOne.toUpperCase();
    var upperNameTwo = nameTwo.toUpperCase();
    if (upperNameOne < upperNameTwo) return -1;
    if (upperNameOne > upperNameTwo) return 1;
    return 0;
  },
  legendOrder: function legendOrder(layerOne, layerTwo, nameOne, nameTwo) {
    var orderOne = layerOne.options.legendOrder || 0;
    var orderTwo = layerTwo.options.legendOrder || 0;
    if (orderOne < orderTwo) return -1;
    if (orderOne > orderTwo) return 1;
    return 0;
  }
};

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
var controlFactory = {
  scale: function scale(options, webmap) {
    return L$1.control.scale(options).addTo(webmap);
  },
  zoom: function zoom(options, webmap) {
    return L$1.control.zoom(options).addTo(webmap);
  },
  attribution: function attribution(options, webmap) {
    return L$1.control.attribution(options).addTo(webmap);
  },
  layers: function layers(options, webmap) {
    var baselayers = {};
    var overlays = {};
    var legendOptions = Object.assign({}, options);
    delete legendOptions.sort;

    if (options.sort) {
      legendOptions.sortLayers = true;
      legendOptions.sortFunction = layerSort[options.sort];
    }

    webmap.eachLayer(function (layer) {
      var title = layer.options.title;

      if (layer.options.baseLayer) {
        baselayers[title] = layer;
      } else {
        overlays[title] = layer;
      }
    });
    return L$1.control.layers(baselayers, overlays, legendOptions).addTo(webmap);
  }
};

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

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

var _default = /*#__PURE__*/function (_Controller) {
  _inherits(_default, _Controller);

  var _super = _createSuper(_default);

  function _default() {
    _classCallCheck(this, _default);

    return _super.apply(this, arguments);
  }

  _createClass(_default, [{
    key: "connect",
    value: function () {
      var _connect = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee() {
        var map;
        return _regeneratorRuntime.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                if (this.hasUrlValue) {
                  _context.next = 2;
                  break;
                }

                throw new Error('Url value not found!');

              case 2:
                this.dispatch('leafletjs:connecting', {
                  layerFactory: layerFactory,
                  controlFactory: controlFactory
                });
                _context.next = 5;
                return this._initMap();

              case 5:
                map = _context.sent;
                this.dispatch('leafletjs:connected', {
                  map: map
                });

              case 7:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, this);
      }));

      function connect() {
        return _connect.apply(this, arguments);
      }

      return connect;
    }()
  }, {
    key: "_initMap",
    value: function () {
      var _initMap2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee2() {
        var _settings$controls;

        var response, settings, webmap;
        return _regeneratorRuntime.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _context2.next = 2;
                return fetch(this.urlValue);

              case 2:
                response = _context2.sent;
                _context2.next = 5;
                return response.json();

              case 5:
                settings = _context2.sent;
                webmap = L.map(this.element, settings.options);
                Object.values(settings.layers || {}).forEach(function (layer) {
                  layerFactory[layer.type](layer, webmap);
                });
                (_settings$controls = settings.controls) === null || _settings$controls === void 0 ? void 0 : _settings$controls.forEach(function (control) {
                  controlFactory[control.type](control.options, webmap);
                });
                return _context2.abrupt("return", webmap);

              case 10:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2, this);
      }));

      function _initMap() {
        return _initMap2.apply(this, arguments);
      }

      return _initMap;
    }()
  }]);

  return _default;
}(Controller);

_defineProperty(_default, "values", {
  url: String
});

export { _default as default };
