<template>
  <div id="like-dislike">
    <a href="#" class="" @click.prevent="submitLdData()">
      <i :class="icon"></i>
      <clip-loader :loading="loading" :color="color" :size="size"></clip-loader>

      <span v-if="likes > 0">
        <span v-if="type === 'like'">
        {{ likes }}
        </span>
      </span>

      <span v-if="dislikes > 0">
        <span v-if="type === 'dislike'">
          {{ dislikes }}
        </span>
      </span>

    </a>
  </div>
</template>

<script>
  import ClipLoader from 'vue-spinner/src/ClipLoader.vue';

  export default {
    name: 'like-dislike',
    data () {
      return {
        loading: false,
        size: '18px',
        likes: '',
        dislikes: ''
      }
    },

    components: {
        'clip-loader': ClipLoader
    }, // components

    props: {
      id: {
        required: true,
        type: Number
      },
      type: {
        required: true,
        type: String
      },
      icon: {
        required: true,
        type: String
      },
      url: {
        required: true,
        type: String
      },
      getUrl: {
        required: true,
        type: String
      }
    }, // props

    mounted() {
      this.getAllLikeDislike()
    },

    methods: {
      getAllLikeDislike() {
        this.$http.get(this.getUrl + this.id).then(res => {
          this.likes = res.data.comment.like
          this.dislikes = res.data.comment.dislike
          this.loading = false
        }).catch(err => {
          // console.log(err)
        })
      }, // getAllLikeDislike()

      submitLdData() {
        this.loading = true
        this.$http.put(this.url + this.id).then(res => {
            this.getAllLikeDislike()
          }).catch(err => {
            // console.log(err)
        })
      } // submitLdData()
    } // methods
  }

</script>

<style lang="css" scoped>
  #like-dislike {
    position: absolute;
    margin-bottom: 10px;
  }

  #like-dislike:last-child {
    margin-left: 30px;
  }

  .v-spinner {
    position: absolute;
    top: 0;
  }
</style>