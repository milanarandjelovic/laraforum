<template>
  <div id="activity-log">

    <spinner
      class="admin-scale-loader"
      :loading="loading"
      :height="height"
      :width="width"
    >
    </spinner>

    <div class="ibox" v-show="!loading">

      <div class="ibox-title">
        <h5>Activities in forum</h5>
      </div> <!-- /.ibox-title -->

      <div class="ibox-content">

        <!-- ACTIVITYLOG TABLE -->
        <div class="table-responsive" v-show="!loading">
          <div class="dataTables_wrapper form-inline dt-bootstrap">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Time</th>
                  <th>Description</th>
                  <th>User</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="activity in activities">
                  <td>{{ activity.id }}</td>
                  <td>{{ activity.created_at | timeago }}</td>
                  <td>
                    <span v-if="activity.properties.type == 'user'">
                      {{ activity.description }}
                    </span>
                    <span v-else>
                      {{ activity.description }}
                      <a :href="activity.properties.link">"{{ activity.properties.title }}"</a>
                    </span>
                  </td>
                  <td>
                    <a :href="'/@' + activity.user_username">{{ activity.user_username }}</a>
                  </td>
                </tr>
              </tbody>
            </table>

             <div class="dataTables_paginate paging_simple_numbers">
              <div class="pull-left">
                  Showing {{ pagination.from }} to {{ pagination.to }} of {{ pagination.total }} entries
              </div>
              <pagination
                :pagination="pagination"
                :callback="getAllActivities"
                navClass="pull-right"
              >
              </pagination>
            </div>

          </div> <!-- /.dataTables_wrapper-->
        </div> <!-- /.table-responsive -->
        <!-- /ACTIVITYLOG TABLE -->

      </div> <!-- /.ibox-content -->
    </div> <!-- /.ibox -->

  </div> <!-- /#activity-log -->
</template>

<script>
  import Spinner  from './../../common/Spinner.vue'
  import Pagination from './../../common/Pagination.vue'

  export default {
    name: 'activity-log',
    data () {
      return {
        height: '60px',
        width: '60px',
        activities: [],
        pagination: {}
      }
    }, // data()

    components: {
      'spinner': Spinner,
      Pagination
    }, // components

    beforeMount () {
      this.loading = true
    }, // beforeMount()

    mounted () {
      this.loading = false
      this.getAllActivities()
    }, // mounted()

    methods: {
      getAllActivities (page) {
        let pg = page ? '/api/admin/activities?page=' + page : '/api/admin/activities'
        axios.get(pg)
          .then((response) => {
            this.pagination = response.data.pagination
            this.activities = response.data.activities.data
          })
          .catch((error) => {
            this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
          })
      } // getAllActivities()
    } // methods
  }
</script>

<style lang="css">
</style>
