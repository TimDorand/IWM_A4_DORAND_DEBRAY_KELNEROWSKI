<template>
    <div>

        <br>
    <img src="giphy-downsized.gif" v-if="loader" alt="loader">
    <div class="columns is-multiline">

        <div class="column is-6" v-for="(rest, restkey) in restaurants">
            <div class="box">
                <article class="media columns">
                    <div class="media-left column is-2 is-one-quarter-mobile">
                        <figure class="image height-auto">
                            <img :src="rest.icon" alt="Image">
                        </figure>
                    </div>
                    <div class="media-content column is-10">
                        <div class="content"><p style="margin:0px"><strong>{{ rest.name }}</strong>
                            <br>{{ rest.infos }}</p><br>
                            <form action="/rates" method="post" class="columns is-multiline">
                                <input type="hidden" name="_token" :value="csrf">

                                <div class="comment column is-6" v-for="(tag, tagkey) in tagsList" v-if="tag.category === 'main'">
                                    <div class="comment-header-right">
                                        <fieldset class="rating">
                                            <input type="radio" :id="tagkey+'_star5'" :name="'rating_'+tagkey" value="5"><label class="full" :for="tagkey+'_star5'" title="Awesome - 5 stars"></label>
                                            <input type="radio" :id="tagkey+'_star4half'" :name="'rating_'+tagkey" value="4.5"><label class="half" :for="tagkey+'_star4half'" title="Pretty good - 4.5 stars"></label>
                                            <input type="radio" :id="tagkey+'_star4'" :name="'rating_'+tagkey" value="4"><label class="full" :for="tagkey+'_star4'" title="Pretty good - 4 stars"></label>
                                            <input type="radio" :id="tagkey+'_star3half'" :name="'rating_'+tagkey" value="3.5"><label class="half" :for="tagkey+'_star3half'" title="Meh - 3.5 stars"></label>
                                            <input type="radio" :id="tagkey+'_star3'" :name="'rating_'+tagkey" value="3"><label class="full" :for="tagkey+'_star3'" title="Meh - 3 stars"></label>
                                            <input type="radio" :id="tagkey+'_star2half'" :name="'rating_'+tagkey" value="2.5"><label class="half" :for="tagkey+'_star2half'" title="Kinda bad - 2.5 stars"></label>
                                            <input type="radio" :id="tagkey+'_star2'" :name="'rating_'+tagkey" value="2"><label class="full" :for="tagkey+'_star2'" title="Kinda bad - 2 stars"></label>
                                            <input type="radio" :id="tagkey+'_star1half'" :name="'rating_'+tagkey" value="1.5"><label class="half" :for="tagkey+'_star1half'" title="Meh - 1.5 stars"></label>
                                            <input type="radio" :id="tagkey+'_star1'" :name="'rating_'+tagkey" value="1"><label class="full" :for="tagkey+'_star1'" title="Sucks big time - 1 star"></label>
                                            <input type="radio" :id="tagkey+'_starhalf'" :name="'rating_'+tagkey" value="0.5"><label class="half" :for="tagkey+'_starhalf'" title="Sucks big time - 0.5 stars"></label>

                                            <!--<input type="radio" :id="tagkey+'_star5'" :name="'rating_'+tagkey" value="5"><label class="full" ((rest.rate && rest.rate.tagkey] >= 5) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') :for="tagkey+'_star5'" title="Awesome - 5 stars"></label>
                                            <input type="radio" :id="tagkey+'_star4half'" :name="'rating_'+tagkey" value="4.5"><label class="half" ((rest.rate && rest.rate.tagkey] >= 4.5) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') :for="tagkey+'_star4half'" title="Pretty good - 4.5 stars"></label>
                                            <input type="radio" :id="tagkey+'_star4'" :name="'rating_'+tagkey" value="4"><label class="full" ((rest.rate && rest.rate.tagkey] >= 4) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') :for="tagkey+'_star4'" title="Pretty good - 4 stars"></label>
                                            <input type="radio" :id="tagkey+'_star3half'" :name="'rating_'+tagkey" value="3.5"><label class="half" ((rest.rate && rest.rate.tagkey] >= 3.5) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') :for="tagkey+'_star3half'" title="Meh - 3.5 stars"></label>
                                            <input type="radio" :id="tagkey+'_star3'" :name="'rating_'+tagkey" value="3"><label class="full" ((rest.rate && rest.rate.tagkey] >= 3) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') :for="tagkey+'_star3'" title="Meh - 3 stars"></label>
                                            <input type="radio" :id="tagkey+'_star2half'" :name="'rating_'+tagkey" value="2.5"><label class="half" ((rest.rate && rest.rate.tagkey] >= 2.5) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') :for="tagkey+'_star2half'" title="Kinda bad - 2.5 stars"></label>
                                            <input type="radio" :id="tagkey+'_star2'" :name="'rating_'+tagkey" value="2"><label class="full" ((rest.rate && rest.rate.tagkey] >= 2) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') :for="tagkey+'_star2'" title="Kinda bad - 2 stars"></label>
                                            <input type="radio" :id="tagkey+'_star1half'" :name="'rating_'+tagkey" value="1.5"><label class="half" ((rest.rate && rest.rate.tagkey] >= 1.5) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') :for="tagkey+'_star1half'" title="Meh - 1.5 stars"></label>
                                            <input type="radio" :id="tagkey+'_star1'" :name="'rating_'+tagkey" value="1"><label class="full" ((rest.rate && rest.rate.tagkey] >= 1) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') :for="tagkey+'_star1'" title="Sucks big time - 1 star"></label>
                                            <input type="radio" :id="tagkey+'_starhalf'" :name="'rating_'+tagkey" value="0.5"><label class="half" ((rest.rate && rest.rate.tagkey] >= 0.5) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') :for="tagkey+'_starhalf'" title="Sucks big time - 0.5 stars"></label>
-->                                        </fieldset>
                                        <input hidden="" name="rest_id" :value="restkey+1">
                                        <p style="padding-top:8px"><span class="tag is-rounded">{{ rest.rate.tagkey }}</span> {{ tag.name }}</p></div>
                                </div>
                                <div class="comment-footer-right">
                                    <div class="level">
                                        <button type="submit" title="Valider" class="button level-right is-small">Valider</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    const axios = require('axios');

    export default {
        data: function(){
            return{
                loader : true,
                restaurants: {},
                csrf: "",

            }
        },
        props:['tagsList'],
        mounted() {
            this.getLocation()
            this.csrf = window.Laravel.csrfToken
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