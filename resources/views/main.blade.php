@extends('layouts.app')

@section('content')
    <div class="container">
        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 1000px !important;
                width: 1000px !important;
            }
            /* Optional: Makes the sample page fill the window. */
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>


        <script>

            var map;
            var infowindow;

            function initMap(latitude, longitude) {
                var pyrmont = {lat: latitude, lng: longitude};

                map = new google.maps.Map(document.getElementById('map'), {
                    center: pyrmont,
                    zoom: 15
                });

                infowindow = new google.maps.InfoWindow();
                var service = new google.maps.places.PlacesService(map);
                service.nearbySearch({
                    location: pyrmont,
                    radius: 500,
                    type: ['store']
                }, callback);
            }

            function callback(results, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    for (var i = 0; i < results.length; i++) {
                        createMarker(results[i]);
                    }
                }
            }

            function createMarker(place) {
                var placeLoc = place.geometry.location;
                var marker = new google.maps.Marker({
                    map: map,
                    position: place.geometry.location
                });

                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.setContent(place.name);
                    infowindow.open(map, this);
                });
            }
        </script>

        <div id="map"></div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script>
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(savePosition, positionError, {timeout:10000});
                } else {
                    //Geolocation is not supported by this browser
                }
            }

            // handle the error here
            function positionError(error) {
                var errorCode = error.code;
                var message = error.message;

                alert(message);
            }

            function savePosition(position) {
                initMap(position.coords.latitude, position.coords.longitude);
                $.ajax({
                    type: "POST",
                    cache: false,
                    encoding: "UTF-8",
                    url: "/restaurant",
                    data: {lat: position.coords.latitude, lng: position.coords.longitude, _token: "{{csrf_token()}}" },
                    success: function (data) {
                        console.log(data);
                    }
                });
            }
        </script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAg4AuvoQ6ZF5uxqpjliVxYACAdAWvbvDk&libraries=places&callback=getLocation" async defer></script>

    </div>
@endsection