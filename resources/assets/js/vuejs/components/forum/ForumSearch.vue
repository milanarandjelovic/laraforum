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
               @keyup.prevent="search"
        >
      </div>
      <div class="query-results" v-if="search_query != ''">
        <div class="query-results-holder">
          <ul class="results-list" v-if="discussionsCount > 0">
            <li class="suggestion-heading">Forum Suggestions</li>
            <li class="result-f" v-for="discussion in results.discussions">
              <a :href="'/discuss/channels/' + discussion.channel.channel_url + '/' + discussion.slug"
                v-html="discussion._highlightResult.title.value">
              </a>
            </li>
          </ul>
          <ul class="results-list" v-if="usersCount > 0">
            <li class="suggestion-heading">User Suggestions</li>
            <li class="result-f" v-for="user in results.users">
              <a :href="'/@' + user.username" v-html="user._highlightResult.username.value">
              </a>
            </li>
          </ul>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
  let algoliasearch = require('algoliasearch')
  let client = algoliasearch('4T9BZBHR3X', 'adc1093490db75bfaa263c99b104a245')

  let discussions = client.initIndex('discussions')
  let users = client.initIndex('users')

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
          discussions.search(this.search_query, (err, results) => {
            this.results.discussions = results.hits
            this.discussionsCount = this.results.discussions.length ? this.results.discussions.length : ''
          })

          users.search(this.search_query, (err, results) => {
            this.results.users = results.hits
            this.usersCount = this.results.users.length ? this.results.users.length : ''
          })
        }
      } // search()
    } // methods
  }
</script>
