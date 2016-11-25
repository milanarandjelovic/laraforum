/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./vuejs/components/Example.vue'));

import PassportClients from "./vuejs/components/passport/Clients.vue";
import PassportAuthorizedClients from "./vuejs/components/passport/AuthorizedClients.vue";
import PassportPersonalAccessTokens from "./vuejs/components/passport/PersonalAccessTokens.vue";

const app = new Vue({
  el: '#app',
  components: {
    PassportClients,
    PassportAuthorizedClients,
    PassportPersonalAccessTokens
  }
});
