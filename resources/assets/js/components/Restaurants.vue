<template>
    <div class="container">
        <div class="container">
            <br>
            <div id="meta" class="field is-grouped is-grouped-multiline">
                <div class="control" v-for="(tag, tagkey) in tagsList" v-if="tag.category === 'main'">
                    <div class="tags has-addons">
                        <span class="tag">{{ tag.name }}</span>
                    </div>
                </div>
            </div>
            <div class="field is-grouped is-grouped-multiline">
                <div class="control" v-for="(tag, tagkey) in tagsList" v-if="tag.category === 'second'">
                    <div class="tags has-addons">
                        <span class="tag">{{ tag.name }}</span>
                    </div>
                </div>
            </div>
        </div>
        <img class="is-centered has-text-center center" src="giphy-downsized.gif" v-if="loader" alt="loader">

        <br>
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
                                                <input type="radio" :id="restkey+[tag.id]+'_star5'" :name="'rating_'+(tagkey+1)" value="5">
                                                <label class="full" :for="restkey+[tag.id]+'_star5'" title="Awesome - 5 stars"></label>
                                                <input type="radio" :id="restkey+[tag.id]+'_star4half'" :name="'rating_'+(tagkey+1)" value="4.5">
                                                <label class="half" :for="restkey+[tag.id]+'_star4half'" title="Pretty good - 4.5 stars"></label>
                                                <input type="radio" :id="restkey+[tag.id]+'_star4'" :name="'rating_'+(tagkey+1)" value="4">
                                                <label class="full" :for="restkey+[tag.id]+'_star4'" title="Pretty good - 4 stars"></label>
                                                <input type="radio" :id="restkey+[tag.id]+'_star3half'" :name="'rating_'+(tagkey+1)" value="3.5">
                                                <label class="half" :for="restkey+[tag.id]+'_star3half'" title="Meh - 3.5 stars"></label>
                                                <input type="radio" :id="restkey+[tag.id]+'_star3'" :name="'rating_'+(tagkey+1)" value="3">
                                                <label class="full" :for="restkey+[tag.id]+'_star3'" title="Meh - 3 stars"></label>
                                                <input type="radio" :id="restkey+[tag.id]+'_star2half'" :name="'rating_'+(tagkey+1)" value="2.5">
                                                <label class="half" :for="restkey+[tag.id]+'_star2half'" title="Kinda bad - 2.5 stars"></label>
                                                <input type="radio" :id="restkey+[tag.id]+'_star2'" :name="'rating_'+(tagkey+1)" value="2">
                                                <label class="full" :for="restkey+[tag.id]+'_star2'" title="Kinda bad - 2 stars"></label>
                                                <input type="radio" :id="restkey+[tag.id]+'_star1half'" :name="'rating_'+(tagkey+1)" value="1.5">
                                                <label class="half" :for="restkey+[tag.id]+'_star1half'" title="Meh - 1.5 stars"></label>
                                                <input type="radio" :id="restkey+[tag.id]+'_star1'" :name="'rating_'+(tagkey+1)" value="1">
                                                <label class="full" :for="restkey+[tag.id]+'_star1'" title="Sucks big time - 1 star"></label>
                                                <input type="radio" :id="restkey+[tag.id]+'_starhalf'" :name="'rating_'+(tagkey+1)" value="0.5">
                                                <label class="half" :for="restkey+[tag.id]+'_starhalf'" title="Sucks big time - 0.5 stars"></label>

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
    -->
                                            </fieldset>
                                            <input hidden="" name="rest_id" :value="restkey+1">
                                            <p style="padding-top:8px">
                                                <span style="box-shadow: rgba(173, 173, 173, 0.37) 0px 3px 3px 0px;" class="has-text-weight-bold is-size-7 tag is-rounded">{{ rest.rate[tag.id] }}</span> {{ tag.name }}
                                            </p></div>
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
    </div>
</template>

<script>
    const axios = require('axios');

    export default {
        data: function () {
            return {
                loader: true,
                restaurants: {},
                places: {},
                csrf: "",
            }
        },
        props: ['tagsList'],
        mounted() {
            this.getLocation()
            this.csrf = window.Laravel.csrfToken
            setTimeout(function () {
                if (document.getElementById('notification')) {
                    document.getElementById('notification').style.display = 'none';
                }
            }, 3000)
        },
        created(){

        },
        methods: {
            getLocation() {
                let position = localStorage.getItem('position');
                if (position) {
                    console.log('Stored position', position)
                    this.getRestaurants(JSON.parse(position))
                } else {
                    navigator.geolocation.getCurrentPosition(this.getRestaurants, this.errorHandler, {timeout: 10000});
                }
               /* setInterval(function () {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(this.savePosition, this.errorHandler, {timeout: 10000});
                    } else {
                        //Geolocation is not supported by this browser
                    }
                }, 10000)*/
            },
            savePosition(position){
                localStorage.setItem('position', JSON.stringify(position));
            },
            errorHandler(err) {
                console.log(err.message)
            },
            getRestaurants(position) {
                let params = new URLSearchParams();
                params.append('lat', position.coords.latitude);
                params.append('lng', position.coords.longitude);
                axios.post('/', params)
                    .then(response => {
                        this.restaurants = response.data
                        eventHub.$emit('restReady', response.data)
                        console.log(this.restaurants); // output is "undefined"
                        this.loader = false
                    })
                    .catch(error => {
                        console.log(error.message)
                        this.loader = false
                    })
            },
            displayList(){

            },

        }
    }
</script>