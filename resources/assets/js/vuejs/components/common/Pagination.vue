<template>
  <div id="pagination" v-if="pagination.per_page < pagination.total">

    <ul class="pagination" :class="navClass">
      <li class="footable-page-arrow" v-if="pagination.current_page > 1">
        <a data-page="first" @click.prevent="changePage(1)">«</a>
      </li>
      <li class="footable-page-arrow" v-if="pagination.current_page > 1">
        <a data-page="prev" @click.prevent="changePage(pagination.current_page - 1)">‹</a>
      </li>
      <li v-for="page in pagination.last_page"
        class="paginate_button"
        :class="page == pagination.current_page ? 'active': ''"
      >
        <a @click.prevent="changePage(page)">{{ page }}</a>
      </li>
      <li class="footable-page-arrow" v-if="pagination.current_page < pagination.last_page">
        <a data-page="next" @click.prevent="changePage(pagination.current_page + 1)">›</a>
      </li>
      <li class="footable-page-arrow" v-if="pagination.current_page < pagination.last_page">
        <a data-page="last" @click.prevent="changePage(pagination.last_page)">»</a>
      </li>
    </ul>

  </div> <!-- /#pagination -->
</template>

<script>
  export default{
    name: 'pagination',
    data(){
      return{
      }
    }, // data()

    props: {
      pagination: {
        type: Object,
        required: true
      },

      callback: {
        type: Function,
        required: true
      },

      size: {
        type: String,
        default: ""
      },

      navClass: {
        type: String,
        default: ""
      },

      offset: {
        type: Number,
        default: 4
      },

      visible: {
        type: Number,
        default: 1
      }
    }, // props

    computed: {
      data () {
        this.visible = 1

        var from = this.pagination.current_page - this.offset
        if(from < 1) {
          from = 1
        }

        var to = from + (this.offset * 2)
        if(to >= this.pagination.total_pages) {
          to = this.pagination.total_pages
        }
        this.from = from
        this.to = to

        var arr = []
        while (from <=to) {
          arr.push(from)
          from++
        }

        if(arr.length == 1) {
          this.visible = 0
        }

        return arr
      }
    }, // computed

    watch: {
      'pagination.per_page': () => {
      // this.callback()
      }
    }, // watch

    methods: {
      changePage (page) {
        this.pagination.current_page = page
        this.callback(page)
      }
    } // methods
  }
</script>
