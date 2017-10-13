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
            createMarkers(places) {
                for (let i = 0; i < places.length; i++) {
                    let marker = new google.maps.Marker({
                        map: this.map,
                        position: {lat: parseFloat(places[i].lat), lng: parseFloat(places[i].lng)}
                    })
                    this.markers.push(marker)
                    google.maps.event.addListener(marker, 'click', function () {
                        this.infowindow.setContent(places[i].name);
                        this.infowindow.open(thismap, this);
                    })
                }
            },
            initMap(position) {
                console.log('Position acquiered')
                let pyrmont = {lat: position.coords.latitude, lng: position.coords.longitude};
                this.map = new google.maps.Map(document.getElementById('map'), {
                    center: pyrmont,
                    zoom: 15
                })
                this.infowindow = new google.maps.InfoWindow()
            },
            getPosition(){
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(this.initMap, this.positionError, {timeout: 10000});
                } else {
                    //Geolocation is not supported by this browser
                }
            },
            positionError(error) {
                var errorCode = error.code;
                var message = error.message;

                alert(message);
            }
        }

    }
</script>