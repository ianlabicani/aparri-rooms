<div id="map" style="height: 400px;"></div>
@push('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        var map = L.map('map')
        var marker = L.marker([18.356834, 121.637310], {}).addTo(map);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        var latitude = {{ $room->latitude }};
        var longitude = {{ $room->longitude }};
        map.setView([latitude, longitude], 17);
        marker.setLatLng([latitude, longitude]);

        document.getElementById('latitude_display').value = latitude;
        document.getElementById('longitude_display').value = longitude;
    </script>
@endpush
