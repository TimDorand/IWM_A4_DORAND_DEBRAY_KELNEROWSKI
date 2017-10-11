@extends('layouts.app')

@section('content')

    <section class="hero has-text-centered is-medium is-success is-bold">
        {{--<div class="hero-body">--}}
        <div id="map" style="height:300px"></div>
        {{--</div>--}}
    </section>
    <div class="container">
        @include('layouts.message')
        <br>
        <div class="columns">
            <div class="column is-6">
                <div id="meta" class="field is-grouped is-grouped-multiline">
                    @foreach($tags as $tag)
                        <div class="control">
                            <div class="tags has-addons">
                                <span class="tag @if($tag->color == 'vert') is-success @endif ">{{$tag->name}}</span>
                                <a class="tag is-delete"></a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="box">
                    <article class="media">
                        <div class="media-left">
                            <figure class="image is-64x64">
                                <img src="http://bulma.io/images/placeholders/128x128.png" alt="Image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <strong>John Smith</strong>
                                    <small>@johnsmith</small>
                                    <small>31m</small>
                                    <br>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.
                                </p>
                            </div>
                            <nav class="level is-mobile">
                                <div class="level-left">
                                    <a class="level-item">
                                        <span class="icon is-small"><i class="fa fa-reply"></i></span>
                                    </a>
                                    <a class="level-item">
                                        <span class="icon is-small"><i class="fa fa-retweet"></i></span>
                                    </a>
                                    <a class="level-item">
                                        <span class="icon is-small"><i class="fa fa-heart"></i></span>
                                    </a>
                                </div>
                            </nav>
                        </div>
                    </article>
                </div>
            </div>
            <div class="column is-6">

                <form action="{{route('rates.store')}}" method="post">
                    @foreach($tags as $tag)
                        <div class="comment">
                            <div class="comment-header">
                                <div class="comment-header-left">
                                    {{--<div class="comment-header-left-profile"><img src="{{Auth::user()->picture}}"/>--}}
                                </div>
                                <div class="comment-header-left-title">Qu'avez-vous pensé de ce restaurant ?</div>
                                {{--<div class="comment-header-left-title comment-header-left-title--user displayNone">{{Auth::user()->name}}</div>--}}
                            </div>
                            <div class="comment-header-right">
                                <fieldset class="rating">
                                    <input type="radio" id="star5" name="rating" value="5"/><label
                                            class="full" for="star5"
                                            title="Awesome - 5 stars"></label>
                                    <input type="radio" id="star4half" name="rating"
                                            value="4.5"/><label class="half" for="star4half"
                                            title="Pretty good - 4.5 stars"></label>
                                    <input type="radio" id="star4" name="rating" value="4"/><label
                                            class="full" for="star4"
                                            title="Pretty good - 4 stars"></label>
                                    <input type="radio" id="star3half" name="rating"
                                            value="3.5"/><label class="half" for="star3half"
                                            title="Meh - 3.5 stars"></label>
                                    <input type="radio" id="star3" name="rating" value="3"/><label
                                            class="full" for="star3"
                                            title="Meh - 3 stars"></label>
                                    <input type="radio" id="star2half" name="rating"
                                            value="2.5"/><label class="half" for="star2half"
                                            title="Kinda bad - 2.5 stars"></label>
                                    <input type="radio" id="star2" name="rating" value="2"/><label
                                            class="full" for="star2"
                                            title="Kinda bad - 2 stars"></label>
                                    <input type="radio" id="star1half" name="rating"
                                            value="1.5"/><label class="half" for="star1half"
                                            title="Meh - 1.5 stars"></label>
                                    <input type="radio" id="star1" name="rating" value="1"/><label
                                            class="full" for="star1"
                                            title="Sucks big time - 1 star"></label>
                                    <input type="radio" id="starhalf" name="rating"
                                            value="half"/><label class="half" for="starhalf"
                                            title="Sucks big time - 0.5 stars"></label>
                                </fieldset>
                                {{--<div class="comment-header-right-imdb"><span class="logo">IMDB</span><span class="point">8.1/10</span></div>--}}
                            </div>
                            <div class="comment-body height-0">
                                <textarea name="comment" class="comment-body-text" required="required" style="width:100%;border:none;box-shadow:none;" minlength="10" contenteditable="true"></textarea>
                            </div>
                            <div class="comment-footer height-0">
                                {{--<div class="comment-footer-left">
                                    --}}{{--<div class="text-change text-change--bold" id="makeBold">B</div>--}}{{--
                                    --}}{{--<div class="text-change text-change--italic">i</div>--}}{{--
                                    --}}{{--<div class="text-change text-change--star"><i class="ion-android-star"></i></div>--}}{{--
                                </div>--}}
                            </div>

                            <script>
                                $(function () {

                                    var comment = $('.comment'),
                                        commentText = $('.comment-body-text'),
                                        commentTitle = $('.rating'),
                                        userName = $('.comment-header-left-title--user'),
                                        commentBody = $('.comment-body'),
                                        commentFooter = $('.comment-footer'),
                                        imdb = $('.comment-header-right-imdb'),
                                        send = $('.buton--main'),
                                        bold = $('.text-change--bold');

                                    $(commentTitle).on('click', function () {
//                                                $(commentTitle).addClass('displayNone');
//                                                $(userName).removeClass('displayNone');
                                        $(commentBody)
                                            .removeClass('height-0')
                                            .addClass('height-10')
                                            .addClass('m-t-16');
                                        $(commentText).text('');
                                        $(commentText).focus();
                                        $(imdb)
                                            .removeClass('displayNone')
                                            .removeClass('scale-0')
                                            .css('transform', 'scale(1)');
                                        $(commentFooter)
                                            .removeClass('height-0')
                                            .addClass('height-3')
                                            .addClass('m-t-16');
                                    });

                                    /*  $(send).on('click', function () {
                                     var commentValue = $(commentText).text();
                                     $(comment).after('<div class="public">Merci pour votre commentaire !</div>')
                                     setTimeout(function () {
                                     $('.public').css('transform', 'scale(1)');
                                     }, 50);
                                     // back action
                                     $(commentTitle).removeClass('displayNone');
                                     $(userName).addClass('displayNone');
                                     $(commentBody)
                                     .addClass('height-0')
                                     .removeClass('height-10')
                                     .removeClass('m-t-16');
                                     $(imdb)
                                     .addClass('displayNone')
                                     .css('transform', 'scale(0)');
                                     $(commentFooter)
                                     .addClass('height-0')
                                     .removeClass('height-3')
                                     .removeClass('m-t-16');
                                     });*/

                                    $('#makeBold').on('click', function () {
                                        text = window.getSelection;
                                        alert(text);
                                    });

                                });
                            </script>
                        </div>
                    @endforeach
                    <div class="comment-footer-right">
                        <input type="submit" title="Valider" class="button buton--main"></div>
                </form>
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
            initMap(position.coords.latitude, position.coords.longitude);
            $.ajax({
                type: "POST",
                cache: false,
                encoding: "UTF-8",
                url: "/restaurant",
                data: {lat: position.coords.latitude, lng: position.coords.longitude, _token: "{{csrf_token()}}"},
                success: function (data) {
                    console.log(data);
                }
            });
        }
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAg4AuvoQ6ZF5uxqpjliVxYACAdAWvbvDk&libraries=places&callback=getLocation" async defer></script>

    </div>
@endsection