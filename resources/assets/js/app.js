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

/* Passport component */
import PassportClients from "./vuejs/components/passport/Clients.vue";
import PassportAuthorizedClients from "./vuejs/components/passport/AuthorizedClients.vue";
import PassportPersonalAccessTokens from "./vuejs/components/passport/PersonalAccessTokens.vue";

import VueToastr from 'vue-toastr';

/* Channels component */
import Channel from './vuejs/components/admin/Channel.vue';

/* Users component */
import User from './vuejs/components/admin/User.vue';
import EditUser from './vuejs/components/forum/EditUser.vue';

/* Role component */
import AdminRole from './vuejs/components/admin/Role.vue';

/* CommentVote component */
import CommentVote from './vuejs/components/common/CommentVote.vue';

/* Discussion Comments component */
import DiscussionComments from './vuejs/components/forum/DiscussionComments.vue';

/* Search component */
import ForumSearch from './vuejs/components/forum/ForumSearch.vue';

/* Dashboard component */
import ActivityLog from './vuejs/components/admin/dashboard/Activitylog.vue';


const app = new Vue({
  el: '#app',

  data: {
    laraForum: window.LaraForum
  },

  components: {
    PassportClients,
    PassportAuthorizedClients,
    PassportPersonalAccessTokens,

    VueToastr,

    Channel,
    User,
    EditUser,
    AdminRole,
    CommentVote,
    ForumSearch,
    DiscussionComments,
    ActivityLog
  }
});
