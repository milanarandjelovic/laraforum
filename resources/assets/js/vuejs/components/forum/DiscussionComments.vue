<template>
  <div class="clearfix">
    <div class="social-comment" v-for="comment in comments">
      <a :href="'/@' + comment.user.data.username" class="pull-left">
        <img :src="comment.user.data.avatar" class="img-responsive">
      </a>
      <div class="media-body">
        <a :href="'/@' + comment.user.data.username" class="discussion-comment-creator">
          {{ comment.user.data.username }}
        </a>
        <span class="discussion-created-at">{{ comment.created_at }}</span>
        <div>{{ comment.description }}</div>
        <div v-if="$root.laraForum.authenticated == 'true'">
          <div v-if="$root.laraForum.id != comment.user_id">
            <comment-vote :discussion-id="comment.id"></comment-vote>
          </div>
        </div>
      </div> <!-- /.media-body -->
    </div> <!-- /.social-comment -->
    <div v-if="$root.laraForum.authenticated == 'true'">
      <div class="social-comment">
        <a :href="'/@' + $root.laraForum.username" class="pull-left">
          <img :src="$root.laraForum.avatar" alt="$root.laraForum.username + 'avatar'"
               class="img-responsive"
          >
        </a>
        <div class="media-body">
          <div class="form-group">
            <textarea class="form-control comment"
                      rows="8"
                      placeholder="Write comment..."
                      name="description"
                      v-model="description"
            ></textarea>
          </div> <!-- /.form-group -->
          <div class="form-group">
            <a class="btn btn-primary pull-right"
               @click.prevent="createComment"
            >
              Post Your Reply
            </a>
          </div> <!-- /.form-group -->
        </div> <!-- /.media-body -->
      </div> <!-- /.social-comment -->
    </div>
  </div>
</template>

<script>
  import CommentVote from '../common/CommentVote.vue'

  export default {
    name: 'discussion-comments',
    data () {
      return {
        comments: [],
        description: ''
      }
    }, // data()

    components: {
      CommentVote
    }, // components

    mounted () {
      this.getComments()
    }, // mounted

    props: {
      discussionId: {
        required: true
      }
    }, // props

    methods: {
      getComments () {
        this.$http.get('/api/discussions/' + this.discussionId + '/comments')
          .then(res => {
            this.comments = res.data.data
          })
      }, // getComments()

      createComment () {
        console.log('Create Comment')
        this.$http.post('/api/forum/discussions/' + this.discussionId + '/comments', {
          description: this.description
          }).then(res => {
            console.log(res)
            this.comments.push(res.data.data)
            this.description = ''
          })
      }
    } // methods
  }
</script>

<style lang="css">
  textarea.comment {
    resize: none;
  }
</style>