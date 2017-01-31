<template>
  <div class="discussion__voting">
    <a href="#" class="discussion__voting-button"
       :class="{'discussion__voting-button--voted': userVote == 'up'}"
       @click.prevent="vote('up')"
    >
      <span class="fa fa-thumbs-up"></span>
    </a> {{ up }}
    <a href="#" class="discussion__voting-button"
       :class="{'discussion__voting-button--voted': userVote == 'down'}"
       @click.prevent="vote('down')"
    >
      <span class="fa fa-thumbs-down"></span>
    </a> {{ down }}
  </div>
</template>

<script>
export default {

  name: 'comment-vote',

  data () {
    return {
      up: null,
      down: null,
      userVote: null,
      canVote: false
    }
  }, // data()

  mounted () {
    this.getVotes()
  }, // mounted()

  props: {
    discussionId: {
      required: true,
    },
  }, // props

  methods: {
    getVotes () {
      axios.get('/api/forum/comments/' + this.discussionId + '/votes')
        .then((response) => {
          //console.log(response)
          this.up = response.data.data.up
          this.down = response.data.data.down
          this.userVote = response.data.data.user_vote
        })
    }, // getVotes()

    vote (type) {
      if (this.userVote == type) {
        this[type]--
        this.userVote = null
        this.deleteVote(type)
        return
      }

      if (this.userVote ) {
        // Remove opposite vote
        this[type == 'up' ? 'down' : 'up']--
      }

      this[type]++
      this.userVote = type

      this.createVote(type)
    }, // vote()

    deleteVote (type) {
      axios.delete('/api/forum/comments/' + this.discussionId + '/votes')
        .then((response) => {
          //console.log(response)
        })
    }, // deleteVote()

    createVote (type) {
      axios.post('/api/forum/comments/' + this.discussionId + '/votes', { type: type})
        .then((response) => {
          //console.log(response)
        })
    } // createVote()
  } // methods
}
</script>
