
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

require('./fontawesome');

require('./firebase');

// Buefy
import Buefy from 'buefy'

Vue.use(Buefy)

// Vue.config.productionTip = false

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('admin-admins-index', require('./components/admin/admins/Index.vue'));
Vue.component('admin-admins-form', require('./components/admin/admins/Form.vue'));

Vue.component('admin-categories-index', require('./components/admin/categories/Index.vue'));
Vue.component('admin-categories-form', require('./components/admin/categories/Form.vue'));

Vue.component('admin-items-index', require('./components/admin/items/Index.vue'));
Vue.component('admin-items-form', require('./components/admin/items/Form.vue'));

Vue.component('admin-media', require('./components/media/Index.vue'));
Vue.component('admin-media-upload', require('./components/media/Upload.vue'));
Vue.component('admin-media-images', require('./components/media/Images.vue'));

const app = new Vue({
    el: '#app'
});


// Bulma NavBar Burger Script
document.addEventListener('DOMContentLoaded', function () {
    // Get all "navbar-burger" elements
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {

        // Add a click event on each of them
        $navbarBurgers.forEach(function ($el) {
            $el.addEventListener('click', function () {

                // Get the target from the "data-target" attribute
                let target = $el.dataset.target;
                let $target = document.getElementById(target);

                // Toggle the class on both the "navbar-burger" and the "navbar-menu"
                $el.classList.toggle('is-active');
                $target.classList.toggle('is-active');

            });
        });
    }

    require('./sidebar');
});



require('./bulma-extensions');
