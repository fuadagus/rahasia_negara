@extends('layouts.template')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">
<style>
    html,
    body {
        height: 100%;
        width: 100%;
    }

    #map {
        height: calc(100vh - 56px);
        width: 100%;
        margin: 0;
    }
</style>
@endsection

@section('content')
<div id="map" style="width: 100vw; height: 100vh; margin: 0"></div>

<!-- Modal Create Point -->
<div class="modal fade" id="PointModal" tabindex="-1" aria-labelledby="PointModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="PointModalLabel">Create Point</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store-point') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Fill point name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="geom" class="form-label">Geometry</label>
                        <textarea class="form-control" id="geom_point" name="geom" rows="1" readonly></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image_point" name="image"
                            onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="mb-3">
                        <img src="" alt="Preview" id="preview-image-point" class="img-thumbnail" width="400">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create Polyline -->
<div class="modal fade" id="PolylineModal" tabindex="-1" aria-labelledby="PolylineModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="PolylineModalLabel">Create Polyline</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store-polyline') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Fill polyline name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="geom" class="form-label">Geometry</label>
                        <textarea class="form-control" id="geom_polyline" name="geom" rows="1" readonly></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image_polyline" name="image"
                            onchange="document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="mb-3">
                        <img src="" alt="Preview" id="preview-image-polyline" class="img-thumbnail" width="400">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create Polygon -->
<div class="modal fade" id="PolygonModal" tabindex="-1" aria-labelledby="PolygonModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="PolygonModalLabel">Create Polygon</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store-polygon') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Fill polygon name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="geom" class="form-label">Geometry</label>
                        <textarea class="form-control" id="geom_polygon" name="geom" rows="1" readonly></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image_polygon" name="image"
                            onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="mb-3">
                        <img src="" alt="Preview" id="preview-image-polygon" class="img-thumbnail" width="400">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
<script src="https://unpkg.com/terraformer@1.0.7/terraformer.js"></script>
<script src="https://unpkg.com/terraformer-wkt-parser@1.1.2/terraformer-wkt-parser.js"></script>
<script>
    // Map Initialization
    var map = L.map('map').setView([-6.888, 109.6753], 13);

    // Base Map Layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Feature Group for Drawn Items
    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    // Draw Control
    var drawControl = new L.Control.Draw({
        draw: {
            position: 'topleft',
            polyline: true,
            polygon: true,
            rectangle: true,
            circle: false,
            marker: true,
            circlemarker: false
        },
        edit: false
    });
    map.addControl(drawControl);

    // Event Handler for Draw Created
    map.on('draw:created', function (e) {
        var type = e.layerType,
            layer = e.layer;

        var drawnJSONObject = layer.toGeoJSON();
        var objectGeometry = Terraformer.WKT.convert(drawnJSONObject.geometry);

        if (type === 'polyline') {
            $("#geom_polyline").val(objectGeometry);
            $("#PolylineModal").modal('show');
        } else if (type === 'polygon' || type === 'rectangle') {
            $("#geom_polygon").val(objectGeometry);
            $("#PolygonModal").modal('show');
        } else if (type === 'marker') {
            $("#geom_point").val(objectGeometry);
            $("#PointModal").modal('show');
        }

        drawnItems.addLayer(layer);
    });

    // Function to Add GeoJSON Layer
    function addGeoJsonLayer(url, featureLayer) {
        $.getJSON(url, function(data) {
            featureLayer.addData(data);
            map.addLayer(featureLayer);
        });
    }

    // GeoJSON Point Layer
    var point = L.geoJson(null, {
        onEachFeature: function (feature, layer) {
            var popupContent = "Name: " + feature.properties.name + "<br>" +
                "Description: " + feature.properties.description + "<br>" +
                "Photo: <img src='{{ asset('storage/images/') }}/" + feature.properties.image + "' class='img-thumbnail' alt='...'>" + "<br>" +
                "<div class='d-flex flex-row mt-3'>" +
                "<a href='{{ url('edit-point') }}/" + feature.properties.id + "' class='btn btn-sm btn-warning me-2'><i class='fa-solid fa-edit'></i></a>" +
                "<form action='{{ url('delete-point') }}/" + feature.properties.id + "' method='POST'>" +
                '{{ csrf_field() }}' +
                '{{ method_field('DELETE') }}' +
                "<button type='submit' class='btn btn-danger' onclick='return confirm(`Are you sure you want to delete this point?`)'><i class='fa-solid fa-trash-can'></i></button>" +
                "</form>" +
                "</div>";

            layer.on({
                click: function (e) {
                    point.bindPopup(popupContent);
                },
                mouseover: function (e) {
                    point.bindTooltip(feature.properties.name);
                },
            });
        },
    });
    addGeoJsonLayer("{{ route('api.points') }}", point);

    // GeoJSON Polyline Layer
    var polyline = L.geoJson(null, {
        onEachFeature: function (feature, layer) {
            var popupContent = "Name: " + feature.properties.name + "<br>" +
                "Description: " + feature.properties.description + "<br>" +
                "Photo: <img src='{{ asset('storage/images/') }}/" + feature.properties.image + "' class='img-thumbnail' alt='...'>" + "<br>" +
                "<div class='d-flex flex-row mt-3'>" +
                "<a href='{{ url('edit-polyline') }}/" + feature.properties.id + "' class='btn btn-sm btn-warning me-2'><i class='fa-solid fa-edit'></i></a>" +
                "<form action='{{ url('delete-polyline') }}/" + feature.properties.id + "' method='POST'>" +
                '{{ csrf_field() }}' +
                '{{ method_field('DELETE') }}' +
                "<button type='submit' class='btn btn-danger' onclick='return confirm(`Are you sure you want to delete this polyline?`)'><i class='fa-solid fa-trash-can'></i></button>" +
                "</form>" +
                "</div>";

            layer.on({
                click: function (e) {
                    polyline.bindPopup(popupContent);
                },
                mouseover: function (e) {
                    polyline.bindTooltip(feature.properties.name);
                },
            });
        },
    });
    addGeoJsonLayer("{{ route('api.polylines') }}", polyline);

    // GeoJSON Administrative Layer
    var admin = L.geoJson(null, {
        onEachFeature: function(feature, layer) {
            var popupContent = "Name: " + feature.properties.name + "<br>" +
                "Description: " + feature.properties.description + "<br>" +
                "Photo: <img src='{{ asset('storage/images/') }}/" + feature.properties.image + "' class='img-thumbnail' alt='...'>" + "<br>";

            layer.on({
                click: function(e) {
                    admin.bindPopup(popupContent);
                },
                mouseover: function(e) {
                    admin.bindTooltip(feature.properties.name);
                },
            });
        },
    });
    addGeoJsonLayer("{{ route('api.admin') }}", admin);
    // Define category styles
   // Define category styles
   var categoryStyles = {
        "Gedung/Bangunan": {
            color: "#ff0000", // Red
            weight: 2,
            opacity: 1
        },
        "Perkebunan/Kebun": {
            color: "#00ff00", // Green
            weight: 2,
            opacity: 1
        },
        "Permukiman dan Tempat Kegiatan": {
            color: "#0000ff", // Blue
            weight: 2,
            opacity: 1
        },
        "Sawah": {
            color: "#ffff00", // Yellow
            weight: 2,
            opacity: 1
        },
        "Tegalan/Ladang": {
            color: "#ff00ff", // Magenta
            weight: 2,
            opacity: 1
        },
        // Add more categories if needed
    };

    // Function to get style based on feature category
    function getCategoryStyle(feature) {
        return categoryStyles[feature.properties.remark] || {
            color: "#000000", // Default color if category not found
            weight: 2,
            opacity: 1
        };
    }
    // Add GeoJSON layer with categorical styling
    var PL = L.geoJson(null, {
        style: getCategoryStyle,
        onEachFeature: function (feature, layer) {
            var popupContent = "Name: " + feature.properties.name + "<br>" +
                "Description: " + feature.properties.description + "<br>" +
                "Photo: <img src='{{ asset('storage/images/') }}/" + feature.properties.image + "' class='img-thumbnail' alt='...'>" + "<br>";

            layer.on({
                click: function (e) {
                    layer.bindPopup(popupContent).openPopup();
                },
                mouseover: function (e) {
                    layer.bindTooltip(feature.properties.name).openTooltip();
                },
            });
        },
    });
    addGeoJsonLayer("{{ route('api.pl') }}", PL);
   
    // Layer Control
    var overlayMaps = {
        "Points": point,
        "Polylines": polyline,
        "Batas admin": admin,
        "Penggunaan Lahan": PL
    };
    var layerControl = L.control.layers(null, overlayMaps, {
        collapsed: false
    }).addTo(map);
</script>
@endsection
