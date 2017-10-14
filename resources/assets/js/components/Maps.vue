<template>
    <div class="google-map" :id="map"></div>
</template>

<script>
    export default {
        name: 'maps',
        props: ['restaurants'],
        data: function () {
            return {
                markerCoordinates: [],
                map: null,
                infowindow: null,
                bounds: null,
                markers: [],
            }
        },
        mounted: function () {
            this.getPosition()
            eventHub.$on('restReady', this.createMarkers)
        },
        methods: {
            getPosition() {
                let lng = localStorage.getItem('lng');
                let lat = localStorage.getItem('lat');
                if (lat && lng) {
                    this.initMap({coords : { latitude : lat, longitude : lng}});
                } else {
                    navigator.geolocation.getCurrentPosition(this.initMap, this.errorHandler, {timeout: 10000});
                }
              setInterval(function () {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (position){
                            localStorage.setItem('lng', position.coords.longitude);
                            localStorage.setItem('lat', position.coords.latitude);
                            console.log(localStorage.getItem('lat') + ' - ' + localStorage.getItem('lng'))
                        }, this.errorHandler, {timeout: 10000});
                    } else {
                        //Geolocation is not supported by this browser
                    }
                }, 10000)
            },
            savePosition(position){
                localStorage.setItem('lng', position.coords.longitude);
                localStorage.setItem('lat', position.coords.latitude);
            },
            createMarkers(places) {
                for (let i = 0; i < places.length; i++) {
                    let marker = new google.maps.Marker({
                        map: this.map,
                        position: {lat: parseFloat(places[i].lat), lng: parseFloat(places[i].lng)}
                    });
                    this.markers.push(marker);
                    google.maps.event.addListener(marker, 'click', function () {
                        this.infowindow.setContent(places[i].name);
                        this.infowindow.open(thismap, this);
                    })
                }
            },
            initMap(position) {
                let pyrmont = {lat: parseFloat(position.coords.latitude) , lng: parseFloat(position.coords.longitude)};
                console.log(pyrmont);
                this.map = new google.maps.Map(document.getElementById('map'), {
                    center: pyrmont,
                    zoom: 15
                });
                this.infowindow = new google.maps.InfoWindow()
            },
            positionError(error) {
                var errorCode = error.code;
                var message = error.message;
                console.log(message);
            }
        }

    }
</script>