<template>
    <div id="user">

        <scale-loader
                class="admin-scale-loader"
                :loading="loading"
                :color="color"
                :height="height"
                :width="width"
                :margin="margin"
        >
        </scale-loader>

        <div class="ibox" v-show="!loading">

            <div class="ibox-title">
                <h5>All users in forum</h5>
            </div> <!-- /.ibox-title -->

            <div class="ibox-content">

                <!-- USERS TABLE -->
                <div class="table-responsive" v-if="users.length > 0">
                    <div class="dataTables_wrapper form-inline dt-bootstrap">

                        <table class="table table-striped table-bordered table-hover dataTable dtr-inline">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Role</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users">
                                <td>{{ user.id }}</td>
                                <td>{{ user.username }}</td>
                                <td>{{ user.first_name }}</td>
                                <td>{{ user.last_name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.created_at }}</td>
                                <td>{{ user.updated_at }}</td>
                                <td>
                                    <p class="label"
                                       :class="user.role_name == 'admin' ? 'label-primary' : 'label-success'"
                                    >
                                        {{ user.role_name }}
                                    </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="dataTables_paginate paging_simple_numbers">
                            <div class="pull-left">
                                Showing {{ pagination.from }} to {{ pagination.to }} of {{ pagination.total }} entries
                            </div>
                            <pagination :pagination="pagination" :callback="getAllUsers"
                                        navClass="pull-right"
                            >
                            </pagination>
                        </div>

                    </div>

                </div> <!-- /.table-responsive -->
                <!-- /USERS TABLE -->

                <div class="text-center" v-if="users.length == 0">
                    <h3>You have no user in forum.</h3>
                </div>

            </div> <!-- /.ibox-content -->
        </div> <!-- /.ibox -->
    </div>
</template>

<script>
  import ScaleLoader from 'vue-spinner/src/ScaleLoader.vue';
  import Pagination from '../common/Pagination.vue';

  export default {
    name: 'user',
    data () {
      return {
        height: '60px',
        pagination: {},
        users: {}
      }
    }, // data()

    components: {
      'scale-loader': ScaleLoader,
      Pagination
    }, // components

    beforeMount () {
      this.loading = true
    }, // beforeMount()

    mounted () {
      this.loading = false
      this.getAllUsers()
    }, // mounted()

    methods: {
      getAllUsers (page) {
        let pg = page ? '/api/admin/users?page=' + page : '/api/admin/users'
        axios.get(pg).then((response) => {
          this.pagination = response.data.pagination
          this.users = response.data.users.data
        }).catch((error) => {
          this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
        });
      } // getAllUsers()
    } // methods
  }
</script>
