# Map Definition (XML Format)

## Example

```xml
<?xml version="1.0" encoding="UTF-8"?>
<webmap name="test_map">
    <option name="zoom" value="4" />
    <option name="center" value="29.54654 -85.654665" />
    <option name="maxBounds" value="71.386455 -64.565694, 17.681818 -179.147531" />
    <option name="minZoom" value="1" />
    <option name="maxZoom" value="18" />
    <layers>
        <layer name="esri_world_topo" type="tile" url="https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}">
            <option name="baseLayer" value="true" />
            <option name="title" value="ArcGIS World Topo" />
            <option name="attribution" value="Tiles &amp;copy; &lt;a href=&quot;https://services.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer&quot;&gt;ArcGIS&lt;/a&gt;" />
        </layer>
        <layer name="osm" type="tile" url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png">
            <option name="baseLayer" value="true" />
            <option name="title" value="OpenStreetMap" />
            <option name="attribution" value="&amp;copy; OpenStreetMap contributors" />
        </layer>
        <layer name="noaa_base_reflectivity" type="wms" url="https://idpgis.ncep.noaa.gov/arcgis/services/NWS_Observations/radar_base_reflectivity/MapServer/WMSServer">
            <option name="title" value="NOAA Base Reflectivity" />
            <option name="transparent" value="true" />
            <option name="format" value="image/png" />
            <option name="attribution" value="NOAA National Weather Service" />
            <wms_layers>
                <wms_layer name="1" style="default" />
            </wms_layers>
        </layer>
        <layer name="usgs" type="wms" url="https://carto.nationalmap.gov/arcgis/services/contours/MapServer/WMSServer">
            <option name="title" value="USGS Contours" />
            <option name="transparent" value="true" />
            <option name="format" value="image/png" />
            <option name="attribution" value="U.S. Geological Survey, National Geospatial Program" />
            <option name="minZoom" value="14" />
            <wms_layers>
                <wms_layer name="1" />
                <wms_layer name="2" />
                <wms_layer name="3" />
                <wms_layer name="4" />
                <wms_layer name="5" />
                <wms_layer name="6" />
                <wms_layer name="7" />
                <wms_layer name="8" />
                <wms_layer name="9" />
                <wms_layer name="10" />
            </wms_layers>
        </layer>
    </layers>
    <controls>
        <control type="layers">
            <option name="position" value="topright" />
            <option name="collapsed" value="false" />
        </control>
        <control type="scale">
            <option name="position" value="bottomleft" />
            <option name="maxWidth" value="300" />
            <option name="metric" value="false" />
        </control>
    </controls>
</webmap>
```