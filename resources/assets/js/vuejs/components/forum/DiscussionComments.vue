<template>
  <div class="clearfix">
    <div class="social-footer">
      <div class="animated fadeIn">
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
              <div :style="$root.laraForum.id != comment.user_id ? '' : 'pointer-events: none;'">
                <comment-vote :discussion-id="comment.id"></comment-vote>
              </div>
            </div>
          </div> <!-- /.media-body -->
        </div> <!-- /.social-comment -->
        <div v-if="$root.laraForum.authenticated == 'true'">
          <div class="social-comment">
            <a :href="'/@' + $root.laraForum.username" class="pull-left">
              <img
                :src="$root.laraForum.avatar"
                alt="$root.laraForum.username + 'avatar'"
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
        <div v-if="$root.laraForum.authenticated != 'true'">
          <p class="text-center">
            <a href="/login">Sign in</a> or
            <a href="/register">create a forum account to participate in this
              discussion.</a>
          </p>
        </div>
      </div>
    </div> <!-- /.social-footer -->
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
        axios.get('/api/discussions/' + this.discussionId + '/comments')
          .then((response) => {
            this.comments = response.data.data
          })
      }, // getComments()

      createComment () {
        axios.post('/api/forum/discussions/' + this.discussionId + '/comments', {
          description: this.description
          }).then((response) => {
            this.comments.push(response.data.data)
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
