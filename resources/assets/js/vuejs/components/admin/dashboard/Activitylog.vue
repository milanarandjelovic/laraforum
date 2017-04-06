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
                    <a :href="'/@' + activity.causer.username">{{ activity.causer.username }}</a>
                  </td>
                </tr>
              </tbody>
            </table>

          </div> <!-- /.dataTables_wrapper-->
        </div> <!-- /.table-responsive -->
        <!-- /ACTIVITYLOG TABLE -->

      </div> <!-- /.ibox-content -->
    </div> <!-- /.ibox -->

  </div> <!-- /#activity-log -->
</template>

<script>
  import Spinner  from './../common/Spinner.vue'

  export default {
    name: 'activity-log',
    data () {
      return {
        height: '60px',
        width: '60px',
        activities: []
      }
    }, // data()

    components: {
      'spinner': Spinner,
    }, // components

    beforeMount () {
      this.loading = true
    }, // beforeMount()

    mounted () {
      this.loading = false
      this.getAllActivities()
    }, // mounted()

    methods: {
      getAllActivities () {
        axios.get('/api/admin/activities')
          .then((response) => {
            console.log(response)
            this.activities = response.data
          })
          .catch((error) => {

          })
      } // getAllActivities()
    } // methods
  }
</script>

<style lang="css">
</style>
