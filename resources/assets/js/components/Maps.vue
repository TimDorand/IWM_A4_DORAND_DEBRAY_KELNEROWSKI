<template>
    <div class="google-map" :id="mapName"></div>
</template>

<script>
    const axios = require('axios');

    export default {
        data: function(){
            return{
                loader : true,
                restaurants: {},
            }
        },
        props:['tagsList'],
        mounted() {
            this.getLocation()
        },
        created(){
            console.log(this.tagsList); // output is "undefined"

        },
        methods: {
            getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(this.getRestaurants, this.errorHandler, {timeout: 10000});
                } else {
                    //Geolocation is not supported by this browser
                }
            },
            errorHandler(err) { console.log(err.message) },
            getRestaurants(position) {
                let params = new URLSearchParams();
                params.append('lat', position.coords.latitude);
                params.append('lng', position.coords.longitude);
                axios.post('/', params)
                    .then(response => {
                        this.restaurants = response.data
                        this.loader = false
                    })
                    .catch(error => {
                        console.log(error.message)
                        this.loader = false
                    })
            },
            displayList(){

            }
        }

    }
</script>