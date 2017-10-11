@extends('layouts.app')

@section('content')

    <section class="hero has-text-centered is-small is-success is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Eat cheap, fast, healthy or all 3!
                </h1>
                {{--<h2 class="subtitle">
                    Find nearby places and eat what you want !
                </h2>--}}
            </div>
        </div>
    </section>
    <div class="container-fluid">

        <div class="columns is-vcentered">
            <div class="column">
                <div class="container">

                <h1 class="title is-2">
                    Superhero Scaffolding
                </h1>
                <h2 class="subtitle is-4">
                    Let this cover page describe a product or service.
                </h2>
                <br>
                <p class="has-text-centered">
                    <a class="button is-large">
                        Learn more
                    </a>
                </p>
                {{--
                <figure class="image is-4by3">
                    <img src="http://placehold.it/800x600" alt="Description">
                </figure>--}}
                </div>
            </div>
            <div class="column">
                <div id="map"></div>

            </div>
        </div>
    </div>

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

            google.maps.event.addListener(marker, 'click', function () {
                infowindow.setContent(place.name);
                infowindow.open(map, this);
            });
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(savePosition, positionError, {timeout: 10000});
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
            initMap(position.coords.latitude, position.coords.longitude)
            $.post("/geolocation", {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
                _token: "{{csrf_token()}}"
            });
        }
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAg4AuvoQ6ZF5uxqpjliVxYACAdAWvbvDk&libraries=places&callback=getLocation" async defer></script>

@endsection