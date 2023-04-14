<{literal}>
    <script src="https://maps.googleapis.com/maps/api/js?key={$google_maps_api_key}"></script>
    <script>
        function initMap() {
            var myLatLng = {lat: {$google_maps_latitude}, lng: {$google_maps_longitude}};

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: {$google_maps_zoom},
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Hello World!'
            });
        }
    </script>
    <div id="map"></div>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={$google_maps_api_key}&callback=initMap"></script>
<{/literal}>
