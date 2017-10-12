
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});



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