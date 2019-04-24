
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and aother libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

let authorizations = require('./authorizations.js');

window.Vue.prototype.authorize = function(...params) {

    if (! window.App.user) return false;

    if(typeof params[0] === 'string') {
        return authorizations[params[0]](params[1]);
    }

    return params[0](window.App.user);
};

window.Vue.prototype.signedIn = window.App.signedIn;

window.events = new Vue();

window.flash = function(message, level='success') {
    window.events.$emit('flash', {message, level});
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('paginator', require('./components/Paginator.vue'));
Vue.component('user-notifications', require('./components/UserNotifications.vue'));
Vue.component('avatar-form', require('./components/AvatarForm.vue'));
Vue.component('wysiwyg', require('./components/Wysiwyg.vue'));

Vue.component('thread-view', require('./pages/Thread.vue'));

import InstantSearch from 'vue-instantsearch';
import algoliasearch from 'algoliasearch/lite';

Vue.use(InstantSearch);

const app = new Vue({
    el: '#app',

    data() {
        return {
            searchClient: algoliasearch(
                '0WYK5QXSQ8',
                '87a650f32e819dcb93bc9bab02a7e036'
            ),
        }
    }
});


