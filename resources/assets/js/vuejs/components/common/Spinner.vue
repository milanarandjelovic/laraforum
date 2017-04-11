<template>
    <div id="spinner" v-show="loading">
      <div class="center-block" :style="spinnerStyle">
        <i class="fa fa-cog fa-spin fa-5x fa-fw"></i>
      </div>
    </div>
</template>

<script>
  export default {
    name: 'spinner',

    props: {
      loading: {
        type: Boolean,
        default: true
      },

      color: {
        type: String,
        default: '#2F4050'
      },

      size: {
        type: String,
        default: '15px'
      }
    }, // props

    data () {
      return {
        spinnerStyle: {
          color: this.color,
          height: this.size,
          width: this.size,
        }
      }
    } // data()
  }
</script>

<style lang="css" scoped>
</style>
