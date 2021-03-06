@extends('layouts.app')

@section('content')

    {{--<section class="hero has-text-centered is-medium is-success is-bold">--}}
        {{--<div class="hero-body">--}}
        {{--   <div class="hero-body" style=" z-index:0;">
               <div class="container">
                   <h1 class="title">Easily find where to eat !</h1>
               </div>
           </div>--}}
        {{--<div id="map" style="height:300px"></div>--}}
        {{--</div>--}}
    {{--</section>--}}
    <div>
        @include('layouts.message')
        <section class="hero has-text-centered is-medium is-success is-bold">
            <maps id="map" style="height:300px"></maps>
        </section>
        <br>
    <restaurants :tags-list="{{json_encode($tags)}}"></restaurants>

    </div>
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}

{{--
    <script>
        var map;
        var infowindow;
        var markers = []

        function initMap(latitude, longitude) {
            var pyrmont = {lat: latitude, lng: longitude};

            map = new google.maps.Map(document.getElementById('map'), {
                center: pyrmont,
                zoom: 15
            });
            infowindow = new google.maps.InfoWindow();
        }

        function createMarkers(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                for (var i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                }
            }
        }

        function createMarker(place) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
            var marker = new google.maps.Marker({
                map: map,
                position: {lat: parseFloat(place.lat), lng: parseFloat(place.lng)}
            });
            markers.push(marker);

            google.maps.event.addListener(marker, 'click', function () {
                infowindow.setContent(place.name);
                infowindow.open(map, this);
            });
        }
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

        function displayList(data) {
            var listRest = []
            var photoRef
            for (var key in data) {
                if (data[key].photo_reference) {
                    photoRef = data[key].photo_reference
                } else {
                    photoRef = 'CmRaAAAApfIhUaSptnWNIsypAN1eC80OE6TPd-Aytf7-EssAY7P2Egx6w59cvPfLrO7RSFy-gvLGR4OYCYeaPt4AkJu6MWFzFZbbgiXQZ6legyk4zX1LxuEa-ILdeAf7tpeh7ZW1EhAH2UdmVxJFYrAo0oP6yYSKGhQgP6MZx2EQ4CUzTyvYsKs6Kc_sEQ'
                }
                listRest[key] = '<div class="column is-6">' +
                    '<div class="box">' +
                    '<article class="media columns">' +
                    '<div class="media-left column is-2 is-one-quarter-mobile"> ' +
//                            '<figure class="image height-auto"><img src="https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=' + photoRef + '&key=AIzaSyAg4AuvoQ6ZF5uxqpjliVxYACAdAWvbvDk" alt="Image"></figure> ' +
                    '<figure class="image height-auto"><img src="' + data[key].icon + '" alt="Image"></figure> ' +
                    '</div> ' +
                    '<div class="media-content column is-10"> ' +
                    '<div class="content"> <p  style="margin:0px"> <strong>' + data[key].name + '</strong>  <br> ' + data[key].infos + '</p>' +
                    '<br><form action="{{route('rates.store')}}" method="post" class="columns is-multiline">' +
                    '{{csrf_field()}}' +
                        @foreach($tags as $tag)
                                @if($tag->category == 'main')
                            '<div class="comment column is-6" id="comment_' + data[key].g_id + '_{{$tag->id}}"> ' +
                    '<div class="comment-header-right"> ' +
                    '<fieldset class="rating"> ' +
                    '<input type="radio" id="' + data[key].g_id + '{{$tag->id}}_star5" name="rating_{{$tag->id}}" value="5"/><label ' + ((data[key].rate && data[key].rate[{{$tag->id}}] >= 5) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') + '  class="full" for="' + data[key].g_id + '{{$tag->id}}_star5" title="Awesome - 5 stars"></label> ' +
                    '<input type="radio" id="' + data[key].g_id + '{{$tag->id}}_star4half" name="rating_{{$tag->id}}" value="4.5"/><label ' + ((data[key].rate && data[key].rate[{{$tag->id}}] >= 4.5) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') + '  class="half" for="' + data[key].g_id + '{{$tag->id}}_star4half" title="Pretty good - 4.5 stars"></label> ' +
                    '<input type="radio" id="' + data[key].g_id + '{{$tag->id}}_star4" name="rating_{{$tag->id}}" value="4"/><label ' + ((data[key].rate && data[key].rate[{{$tag->id}}] >= 4) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') + '  class="full" for="' + data[key].g_id + '{{$tag->id}}_star4" title="Pretty good - 4 stars"></label> ' +
                    '<input type="radio" id="' + data[key].g_id + '{{$tag->id}}_star3half" name="rating_{{$tag->id}}" value="3.5"/><label ' + ((data[key].rate && data[key].rate[{{$tag->id}}] >= 3.5) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') + '  class="half" for="' + data[key].g_id + '{{$tag->id}}_star3half" title="Meh - 3.5 stars"></label> ' +
                    '<input type="radio" id="' + data[key].g_id + '{{$tag->id}}_star3" name="rating_{{$tag->id}}" value="3"><label ' + ((data[key].rate && data[key].rate[{{$tag->id}}] >= 3) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') + '  class="full" for="' + data[key].g_id + '{{$tag->id}}_star3" title="Meh - 3 stars"></label> ' +
                    '<input type="radio" id="' + data[key].g_id + '{{$tag->id}}_star2half" name="rating_{{$tag->id}}" value="2.5"/><label ' + ((data[key].rate && data[key].rate[{{$tag->id}}] >= 2.5) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') + '  class="half" for="' + data[key].g_id + '{{$tag->id}}_star2half" title="Kinda bad - 2.5 stars"></label> ' +
                    '<input type="radio" id="' + data[key].g_id + '{{$tag->id}}_star2" name="rating_{{$tag->id}}" value="2"><label ' + ((data[key].rate && data[key].rate[{{$tag->id}}] >= 2) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') + '  class="full" for="' + data[key].g_id + '{{$tag->id}}_star2" title="Kinda bad - 2 stars"></label> ' +
                    '<input type="radio" id="' + data[key].g_id + '{{$tag->id}}_star1half" name="rating_{{$tag->id}}" value="1.5"/><label ' + ((data[key].rate && data[key].rate[{{$tag->id}}] >= 1.5) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') + '  class="half" for="' + data[key].g_id + '{{$tag->id}}_star1half" title="Meh - 1.5 stars"></label> ' +
                    '<input type="radio" id="' + data[key].g_id + '{{$tag->id}}_star1" name="rating_{{$tag->id}}" value="1"/><label ' + ((data[key].rate && data[key].rate[{{$tag->id}}] >= 1) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '' ) + '  class="full" for="' + data[key].g_id + '{{$tag->id}}_star1" title="Sucks big time - 1 star"></label> ' +
                    '<input type="radio" id="' + data[key].g_id + '{{$tag->id}}_starhalf" name="rating_{{$tag->id}}" value="0.5"/><label ' + ((data[key].rate && data[key].rate[{{$tag->id}}] >= 0.5) ? 'style="background: rgba(43, 232, 105, 0.2);"' : '') + '  class="half" for="' + data[key].g_id + '{{$tag->id}}_starhalf" title="Sucks big time - 0.5 stars"></label> ' +
                    '</fieldset> ' +
                    '<input hidden name="rest_id" value="' + data[key].id + '"><p style="padding-top:8px">' + ((data[key].rate[{{$tag->id}}]) ? '<span class="tag is-rounded">' + data[key].rate[{{$tag->id}}] + '</span>' : '') + ' {{$tag->name}}</p>' +
                    '</div>' +
                    '</div>' +
                        @endif
                                @endforeach
                            '<div class="comment-footer-right"> ' +
                    '<div class="level"><button type="submit" title="Valider" class="button level-right is-small">Valider</button></div> ' +
                    '</form> ' +
                    '</div>' +
                    '</div> ' +
                    '</article> ' +
                    '</div><' +
                    '/div>'

            }

            $(".restaurantList").html('')
            for (rest in listRest) {
                $(".restaurantList").append(listRest[rest])
            }
        }

        var listRestaurants

        function savePosition(position) {
            initMap(position.coords.latitude, position.coords.longitude);
            /*$.ajax({
                type: "POST",
                cache: false,
                encoding: "UTF-8",
                url: "/",
                data: {lat: position.coords.latitude, lng: position.coords.longitude, _token: "{{csrf_token()}}"},
                success: function (data) {
                    listRestaurants = data
                    createMarkers(data, 'OK');
                    displayList(data);
                    console.log(data);
                    $('#loader').hide();
                }
            });*/
        }

        var listTags = [];

      /*  $('.tag').click(function () {
            $(this).toggleClass('animated pulse is-success');
            var tag_id = $(this).attr('tag');
            if ($.inArray(tag_id, listTags) == -1) {
                listTags.push(tag_id);
            } else {
                for (var i = 0; i < listTags.length; i++) {
                    if (tag_id == listTags[i]) {
                        var index = listTags.indexOf(tag_id);
                        listTags.splice(index, 1);
                    }
                }
            }
            sendTags(listTags, listRestaurants);
        });

        function sendTags(listTags, listRestaurants) {
            var flagFound = false
            /!*var newListRestaurants = listRestaurants.filter(function (restaurant) {
                return restaurant.state in
            })
                return key.listTags in key.rate
            })
            var matches = pillows.filter(function (pillow) {
                return pillow.fill === query.fill && pillow.price === query.price;
            });*!/
            /!*var newListRestaurants = $.grep(listRestaurants, function(obj) {
                if (listTags.length <= 1) {
                    for (var key in listTags) {
                        if(listTags[key] in obj.rate){
                            return true;
                        }
                    }
                } else {
                    if(listTags in obj.rate){
                        return true;
                    }
                }
            });*!/
            console.log(newListRestaurants)
            for (var key in listRestaurants) {
                for (var i in listTags) {
                    // Si le tag 1 est dans la liste des notes du restaurant
                    if (listTags[i] in listRestaurants[key].rate) {
                        newListRestaurants.push(listRestaurants[key])
                        flagFound = true
                    } else {
                        if (listRestaurants[key] in newListRestaurants) {
                        console.log('suppression de l id ', newListRestaurants.indexOf(listRestaurants[key]))
                            newListRestaurants.splice(newListRestaurants.indexOf(listRestaurants[key]), 1)
                        }
                    }
                }
                }

                // On retire les ducplicata
                var uniqueRestaurants = []
                $.each(newListRestaurants, function (i, el) {
                    if ($.inArray(el, uniqueRestaurants) === -1) uniqueRestaurants.push(el)
                })
                // Si pas de résultats on affiche tous les restaurants
                if (!flagFound) {
                    displayList(listRestaurants)
                } else {
                    displayList(uniqueRestaurants)
                }
            }
*/
    </script>


--}}


@endsection