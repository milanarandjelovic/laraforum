<template>
  <div id="forum-search">
    <form class="navbar-form navbar-left search-forum"
          autocomplete="off"
          @submit.prevent="search"
    >
      <div class="input-group">
        <span class="search-icon-holder pull-left">
          <i class="fa fa-search fa-lg" aria-hidden="true"></i>
        </span>
        <input type="text" placeholder="Search for something..."
               class="form-control" name="search-query"
               id="top-search-forum"
               v-model="search_query"
        >
      </div>
      <div class="query-results">
        <div class="query-results-holder">
          <ul class="results-list" v-if="discussionsCount > 0">
            <li class="suggestion-heading">Forum Suggestions</li>
            <li class="result-f" v-for="discussion in results.discussions">
              <a :href="'/discuss/channels/' + discussion.channel.channel_url + '/' + discussion.slug">
                {{ discussion.title }}
              </a>
            </li>
          </ul>
          <ul class="results-list" v-if="usersCount > 0">
            <li class="suggestion-heading">User Suggestions</li>
            <li class="result-f" v-for="user in results.users">
              <a :href="'/@' + user.username">
                {{ user.username }}
              </a>
            </li>
          </ul>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
  export default {
    name: 'forum-search',
    data () {
      return {
        search_query: '',
        usersCount: '',
        discussionsCount: '',
        results: {
          users: '',
          discussions: '',
        }
      }
    }, // data()

    methods: {
      search () {
        if (this.search_query != '') {
          this.$http.get('/api/search/' + this.search_query)
            .then(res => {
              this.results.users = res.data.users
              this.usersCount = res.data.users.length ? res.data.users.length : ''
              this.results.discussions = res.data.discussions
              this.discussionsCount = res.data.discussions.length ? res.data.discussions.length : ''
            }).catch(err => {
              console.log(err)
            })
        }
      } // search()
    } // methods
  }
</script>
