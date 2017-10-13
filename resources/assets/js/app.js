'use strict'
window.Vue = require('vue');
Vue.component('restaurants', require('./components/Restaurants.vue'))

const app = new Vue({
    el: '#app',
});


/* BULMA JS (dropdown) */
document.addEventListener('DOMContentLoaded', function () {

    // Dropdowns

    var $dropdowns = getAll('.dropdown:not(.is-hoverable)');

    if ($dropdowns.length > 0) {
        $dropdowns.forEach(function ($el) {
            $el.addEventListener('click', function (event) {
                event.stopPropagation();
                $el.classList.toggle('is-active');
            });
        });

        document.addEventListener('click', function (event) {
            closeDropdowns();
        });
    }

    function closeDropdowns() {
        $dropdowns.forEach(function ($el) {
            $el.classList.remove('is-active');
        });
    }
    // Functions

    function getAll(selector) {
        return Array.prototype.slice.call(document.querySelectorAll(selector), 0);
    }

    var latestKnownScrollY = 0;
    var ticking = false;

    function scrollUpdate() {
        ticking = false;
        // do stuff
    }

    function onScroll() {
        latestKnownScrollY = window.scrollY;
        scrollRequestTick();
    }

    function scrollRequestTick() {
        if (!ticking) {
            requestAnimationFrame(scrollUpdate);
        }
        ticking = true;
    }

    window.addEventListener('scroll', onScroll, false);
})