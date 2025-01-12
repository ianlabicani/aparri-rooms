@extends('landlord.shell')

@section('content')
    <h1 class="my-4">Add a Room</h1>
    <form action="{{ route('landlord.rooms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Room Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="capacity" class="form-label">Capacity</label>
            <input type="number" class="form-control" id="capacity" name="capacity" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="amenities" class="form-label">Amenities</label>
            <input type="text" class="form-control" id="amenities" name="amenities" placeholder="Comma-separated">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
                <option value="1" selected>Available</option>
                <option value="0">Occupied</option>
            </select>
        </div>
        <!-- Map for Location -->
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <div id="map" style="height: 400px;"></div>
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">
                </div>
                <div class="d-flex justify-content-between gap-2">
                    <div class="mb-3 w-100">
                        <label for="latitude_display" class="form-label">Latitude</label>
                        <input type="text" class="form-control" id="latitude_display" disabled>
                    </div>
                    <div class="mb-3 w-100">
                        <label for="longitude_display" class="form-label">Longitude</label>
                        <input type="text" class="form-control" id="longitude_display" disabled>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3 h-75">
                    <label for="location_description" class="form-label">Location Description</label>
                    <textarea class="form-control h-100 no-resize" id="location_description" name="location_description" rows="5"></textarea>
                </div>
                @push('styles')
                    <style>
                        .no-resize {
                            resize: none;
                        }
                    </style>
                @endpush
                @push('scripts')
                    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                    <script>
                        // Initialize the map
                        var map = L.map('map').setView([18.356834, 121.637310], 13); // Default center

                        // Add OpenStreetMap tiles
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        // Add a marker with drag functionality
                        var marker = L.marker([18.356834, 121.637310], {
                            draggable: true
                        }).addTo(map);

                        const position = marker.getLatLng();

                        // Update hidden inputs when the marker is dragged
                        marker.on('dragend', function(e) {
                            var position = marker.getLatLng();
                            document.getElementById('latitude').value = position.lat;
                            document.getElementById('longitude').value = position.lng;
                            var position = marker.getLatLng();
                            document.getElementById('latitude_display').value = position.lat;
                            document.getElementById('longitude_display').value = position.lng;

                        });

                        // Update marker when the map is clicked
                        map.on('click', function(e) {
                            var position = e.latlng;
                            marker.setLatLng(position);
                            document.getElementById('latitude').value = position.lat;
                            document.getElementById('longitude').value = position.lng;
                        });

                        // Set default values for the hidden inputs
                        document.getElementById('latitude').value = position.lat;
                        document.getElementById('longitude').value = position.lng;
                        document.getElementById('latitude_display').value = position.lat;
                        document.getElementById('longitude_display').value = position.lng;
                        console.log(position.lat, position.lng);
                    </script>
                @endpush

            </div>
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label for="images" class="form-label">Room Images</label>
            <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Add Room</button>
    </form>
@endsection
