<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Map with Address Search</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        #map { width: 100%; height: 500px; border-radius: 10px; }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-400 to-purple-500 min-h-screen flex flex-col items-center justify-center p-4">

    <div class="w-full max-w-3xl bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">📍 Interactive Map with Address Search</h2>

        <!-- Search Box -->
        <div class="flex gap-2 mb-4">
            <input type="text" id="search-box" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Enter city, country, or location..." />
            <button onclick="searchLocation()" class="bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 transition">🔍 Search</button>
        </div>

        <div id="map" class="mb-4"></div>
        
        <div class="bg-gray-100 p-4 rounded-lg text-gray-700">
            <p id="coordinates" class="font-semibold">📌 Lat: -, Lng: -</p>
            <p id="location-name" class="mt-2"><strong>📍 Address:</strong> Loading...</p>
        </div>

        <button onclick="sendData()" class="mt-4 w-full bg-green-600 text-white px-4 py-3 rounded-lg hover:bg-green-700 transition">
            🚀 Send Address
        </button>
    </div>

    <script>
        var map = L.map('map').setView([20, 0], 2);
        var marker;
        var locationData = { lat: null, lng: null, address: "" };

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        function detectUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError, { enableHighAccuracy: true });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            updateMap(lat, lng);
        }

        function showError(error) {
            alert("Geolocation error: " + error.message);
        }

        function updateMap(lat, lng) {
            map.setView([lat, lng], 12);

            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([lat, lng], { draggable: true }).addTo(map)
                .bindPopup("📍 You are here! Drag me anywhere").openPopup();

            getAddress(lat, lng);

            marker.on('dragend', function(event) {
                var position = event.target.getLatLng();
                updateCoordinates(position.lat, position.lng);
                getAddress(position.lat, position.lng);
            });

            updateCoordinates(lat, lng);
        }

        function getAddress(lat, lng) {
            var url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`;

            $.getJSON(url, function(data) {
                if (data.display_name) {
                    locationData.address = data.display_name;
                    document.getElementById('location-name').innerHTML = `<strong>📍 Address:</strong> ${locationData.address}`;
                } else {
                    locationData.address = "Not found";
                    document.getElementById('location-name').innerHTML = "<strong>📍 Address:</strong> Not found";
                }
            }).fail(function() {
                console.error("Failed to fetch address");
            });
        }

        function updateCoordinates(lat, lng) {
            locationData.lat = lat;
            locationData.lng = lng;
            document.getElementById('coordinates').innerHTML = `📌 Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`;
        }

        function sendData() {
            if (!locationData.lat || !locationData.lng || locationData.address === "") {
                alert("Please wait for the address to load or select a location.");
                return;
            }

            localStorage.setItem("locationData", JSON.stringify(locationData));
            window.location.href = "http://192.168.1.170/api/ui5";
        }

        function searchLocation() {
            var query = document.getElementById("search-box").value;
            if (query === "") {
                alert("Please enter a location.");
                return;
            }

            var url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`;

            $.getJSON(url, function(data) {
                if (data.length > 0) {
                    var lat = parseFloat(data[0].lat);
                    var lon = parseFloat(data[0].lon);
                    updateMap(lat, lon);
                } else {
                    alert("Location not found. Try again.");
                }
            }).fail(function() {
                alert("Error fetching location data.");
            });
        }

        detectUserLocation();
    </script>

</body>
</html>
