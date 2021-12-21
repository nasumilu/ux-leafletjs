
# Map Definition (JSON Format)

## Example
```json
{
    "test_map": {
        "zoom": 4,
        "center": [29.54654, -85.654665],
        "maxBounds": [[71.386455, -64.565694], [17.681818, -179.147531]],
        "minZoom": 1,
        "maxZoom": 18,
        "layers": {
            "esri_world_topo": {
                "type": "tile",
                "url": "https:\/\/server.arcgisonline.com\/ArcGIS\/rest\/services\/World_Topo_Map\/MapServer\/tile\/{z}\/{y}\/{x}",
                "options": {
                    "baseLayer": true,
                    "title": "ArcGIS World Topo",
                    "attribution": "Tiles \u0026copy; \u003Ca href=\u0022https=\u003E\/\/services.arcgisonline.com\/ArcGIS\/rest\/services\/World_Topo_Map\/MapServer\u0022\u003EArcGIS\u003C\/a\u003E"
                }
            },
            "osm": {
                "type": "tile",
                "url": "https:\/\/{s}.tile.openstreetmap.org\/{z}\/{x}\/{y}.png",
                "options": {
                    "baseLayer": true,
                    "title": "OpenStreetMap",
                    "attribution": "\u0026copy; OpenStreetMap contributors"
                }
            },
            "noaa_base_reflectivity": {
                "type": "wms",
                "url": "https:\/\/idpgis.ncep.noaa.gov\/arcgis\/services\/NWS_Observations\/radar_base_reflectivity\/MapServer\/WMSServer",
                "options": {
                    "title": "NOAA Base Reflectivity",
                    "transparent": true,
                    "format": "image\/png",
                    "attribution": "NOAA National Weather Service",
                    "layers": [[1, "default"]]
                }
            },
            "usgs": {
                "type": "wms",
                "url": "https:\/\/carto.nationalmap.gov\/arcgis\/services\/contours\/MapServer\/WMSServer",
                "options": {
                    "title": "USGS Contours",
                    "transparent": true,
                    "format": "image\/png",
                    "attribution": "U.S. Geological Survey, National Geospatial Program",
                    "minZoom": 14,
                    "layers": [[1, "default"], [2], [3], [4], [5], [6], [7], [8], [9], [10]]
                }
            }
        },
        "controls": [{
                "type": "layers",
                "options": {
                    "position": "topright",
                    "collapsed": false
                }
            }, {
                "type": "scale",
                "options": {
                    "position": "bottomleft",
                    "maxWidth": 300,
                    "metric": false
                }
            }]
    }
}

```