<template>
  <div id="role">
    <scale-loader
            class="admin-scale-loader"
            :loading="loading"
            :color="color"
            :height="height"
            :width="width"
            :margin="margin"
    >
    </scale-loader>

    <div class="ibox" v-if="roles.length > 0">
      <div class="ibox-title">
        <h5>All roles in forum</h5>
        <div class="ibox-tools">
          <a class="btn btn-primary btn-xs" @click.prevent="openRoleModal">Create new role</a>
        </div> <!-- /.ibox-tools -->
      </div> <!-- /.ibox-title -->
      <div class="ibox-content">

        <!-- NEW ROLE MODAL -->
        <div class="modal fade" id="add-role-modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create New Role</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal">
                  <div class="form-group" :class="{ 'has-error' : hasErrorName }">
                    <label class="col-sm-2 control-label" for="name">Name</label>
                    <div class="col-sm-10">
                      <input
                              type="text"
                              id="name"
                              name="name"
                              class="form-control"
                              v-model="roleForm.name"
                              autofocus
                      >
                      <div v-if="errors.name.length > 0" class="form-error-message">
                        <p class="text-danger">{{ errors.name }}</p>
                      </div>
                    </div>
                  </div> <!-- /.form-group -->
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click.prevent="createRole">Save role</button>
              </div>
            </div> <!-- /.modal-content -->
          </div> <!-- /.modal-dialog -->
        </div> <!-- /.modal -->
        <!-- /NEW ROLE MODAL -->

        <!-- UPDATE ROLE MODAL -->
        <div class="modal fade" id="update-role-modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update Role</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal">
                  <div class="form-group" :class="{ 'has-error' : hasErrorName }">
                    <label class="col-sm-2 control-label" for="name">Name</label>
                    <div class="col-sm-10">
                      <input
                              type="text"
                              id="name"
                              name="name"
                              class="form-control"
                              v-model="roleForm.name"
                              autofocus
                      >
                      <div v-if="errors.name.length > 0" class="form-error-message">
                        <p class="text-danger">{{ errors.name }}</p>
                      </div>
                    </div>
                  </div> <!-- /.form-group -->
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click.prevent="updateRole">Update role</button>
              </div>
            </div> <!-- /.modal-content -->
          </div> <!-- /.modal-dialog -->
        </div> <!-- /.modal -->
        <!-- /UPDATE ROLE MODAL -->

        <!-- ROLES TABLE -->
        <div class="table-responsive">
          <div class="dataTables_wrapper form-inline dt-bootstrap">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline">
              <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="role in roles">
                <td>{{ role.id }}</td>
                <td>{{ role.name }}</td>
                <td>{{ role.created_at }}</td>
                <td>{{ role.updated_at }}</td>
                <td>
                  <button class="btn btn-white btn-xs" @click.prevent="openUpdateRoleModal(role.id)">
                    <i class="fa fa-pencil"></i> Edit
                  </button>
                  <button class="btn btn-danger btn-xs" @click.prevent="deleteRole(role.id)">
                    <i class="fa fa-trash-o"></i> Deleted
                  </button>
                </td>
              </tr>
              </tbody>
            </table>

            <div class="dataTables_paginate paging_simple_numbers">
              <div class="pull-left">
                Showing {{ pagination.from }} to {{ pagination.to }} of {{ pagination.total }} entries
              </div>
              <pagination :pagination="pagination" :callback="getAllRoles" navClass="pull-right"></pagination>
            </div>

          </div> <!-- /.dataTables_wrapper-->
        </div> <!-- /.teble-responsive -->
        <!-- /ROLES TABLE -->

        <div class="text-center" v-if="roles.length == 0">
          <h3>You have no role, begin by creating a
            <a @click.prevent="openRoleModal">new role</a>
          </h3>
        </div>

      </div> <!-- /.ibox-content -->
    </div> <!-- /.ibox -->
  </div>
</template>

<script>
  import ScaleLoader from 'vue-spinner/src/ScaleLoader.vue';
  import Pagination from '../common/Pagination.vue';

  export default {
    name: 'role',
    data () {
      return {
        height: '60px',
        roleForm: {
           name: ''
        },
        errors: {
          name: ''
        },
        hasErrorName: false,
        roles: {},
        pagination: {}
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
      this.getAllRoles()
    }, // mounted()

    methods: {
      openRoleModal () {
        this.roleForm.name = ''
        this.errors.name = ''
        this.hasErrorName = false
        $('#add-role-modal').modal('show')
      }, // openRoleModal()

      openUpdateRoleModal (id) {
        this.roleForm.name = ''
        this.errors.name = ''
        this.hasErrorName = false
        this.getRole(id)
        $('#update-role-modal').modal('show')
      }, // openUpdateRoleModal()

       createRole () {
        this.hasErrorName = false
        this.$http.post('/api/admin/roles/store', this.roleForm).then(res => {
          if(res.data.message) {
            this.roleForm.name = ''
            this.$root.$refs.toastr.s(res.data.message, 'Success')
            this.roles.push(res.data.role)
            $('#add-role-modal').modal('hide')
          }
          if(res.data.errors) {
            this.errors = res.data.errors
            if(res.data.errors.name) {
              this.hasErrorName = true
            }
          }
        }).catch(err => {
          this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
        });
      }, // createRole()

      getAllRoles (page) {
         let pg = page ? '/api/admin/roles?page=' + page : '/api/admin/roles'
        this.$http.get(pg).then(res => {
          this.pagination = res.data.pagination
          this.roles = res.data.roles.data
        }).catch(err => {
          this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
        });
      }, // getAllRoles()

      getRole (id) {
        this.$http.get('/api/admin/roles/' + id).then(res => {
          this.role_id = res.data.id
          this.roleForm.name = res.data.name
        }).catch(err => {
          this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
        });
      }, // getRole()

      updateRole () {
        this.hasErrorName = false
        this.$http.put('/api/admin/roles/' + this.role_id + '/update', this.roleForm).then(res => {
          if(res.data.message) {
            this.roleForm.name = ''
            this.$root.$refs.toastr.s(res.data.message, 'Success')
            this.getAllRoles()
            $('#update-role-modal').modal('hide')
          }
          if(res.data.errors) {
            this.errors = res.data.errors
            if(res.data.errors.name) {
              this.hasErrorName = true
            }
          }
        }).catch(err => {
          this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
        });
      }, // updateRole()

       deleteRole (id) {
        let vm = this
        swal({
          title: "Are you sure?",
          text: "You will not be able to recover this role!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) {
            swal("Deleted!", "Your role has been deleted.", "success");
            vm.$http.delete('/api/admin/roles/' + id).then(res => {
              vm.getAllRoles()
              vm.$root.$refs.toastr.s(res.data.message, 'Success')
            }).catch(err => {
              vm.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
            });
          } else {
            swal("Cancelled", "Your role is safe :)", "error");
          }
        });
      } // deleteRole()
    } // methods
  }
</script>