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

    <div class="ibox" v-show="!loading">

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
                <form class="form-horizontal" @keydown="form.errors.clear($event.target.name)">
                  <div class="form-group" :class="{ 'has-error' : form.errors.has('name') }">
                    <label class="col-sm-2 control-label" for="name">Name</label>
                    <div class="col-sm-10">
                      <input
                              type="text"
                              id="name"
                              name="name"
                              class="form-control"
                              v-model="form.name"
                              autofocus
                      >
                      <div v-if="form.errors.has('name')" class="form-error-message">
                        <p class="text-danger">{{ form.errors.get('name') }}</p>
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
                <form class="form-horizontal" @keydown="form.errors.clear($event.target.name)">
                  <div class="form-group" :class="{ 'has-error' : form.errors.has('name') }">
                    <label class="col-sm-2 control-label" for="name">Name</label>
                    <div class="col-sm-10">
                      <input
                              type="text"
                              id="name"
                              name="name"
                              class="form-control"
                              v-model="form.name"
                              autofocus
                      >
                      <div v-if="form.errors.has('name')" class="form-error-message">
                        <p class="text-danger">{{ form.errors.get('name') }}</p>
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
        <div class="table-responsive" v-if="roles.length > 0">
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
  import Form from '../helpers/Form';
  import ScaleLoader from 'vue-spinner/src/ScaleLoader.vue';
  import Pagination from '../common/Pagination.vue';

  export default {
    name: 'role',
    data () {
      return {
        height: '60px',
        form: new Form({
          name: ''
        }),
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
        this.form.clear()
        this.form.errors.clear()
        $('#add-role-modal').modal('show')
      }, // openRoleModal()

      openUpdateRoleModal (id) {
        this.form.errors.clear()
        this.getRole(id)
        $('#update-role-modal').modal('show')
      }, // openUpdateRoleModal()

      createRole () {
        this.form.post('/api/admin/roles/store')
          .then((response) => {
            this.$root.$refs.toastr.s(response.message, 'Success')
            this.roles.push(response.role)
            $('#add-role-modal').modal('hide')
          })
          .catch((error) => {
            if(error) {
              this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
            }
          })
      }, // createRole()

      getAllRoles (page) {
        let pg = page ? '/api/admin/roles?page=' + page : '/api/admin/roles'
        axios.get(pg)
          .then((response) => {
            this.pagination = response.data.pagination
            this.roles = response.data.roles.data
          }).catch((error) => {
            this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
          });
      }, // getAllRoles()

      getRole (id) {
        axios.get('/api/admin/roles/' + id)
          .then((response) => {
            this.role_id = response.data.id
            this.form.name = response.data.name
          }).catch((error) => {
            this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
          });
      }, // getRole()

      updateRole () {
        this.form.put('/api/admin/roles/' + this.role_id + '/update')
          .then((response) => {
            this.$root.$refs.toastr.s(response.message, 'Success')
            this.getAllRoles()
            $('#update-role-modal').modal('hide')
          })
          .catch((error) => {
            this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
          })
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
            vm.form.delete('/api/admin/roles/' + id)
              .then((response) => {
                vm.getAllRoles()
                vm.$root.$refs.toastr.s(response.message, 'Success')
              })
              .catch((error) => {
                vm.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
              })
          } else {
            swal("Cancelled", "Your role is safe :)", "error");
          }
        });
      } // deleteRole()
    } // methods
  }
</script>