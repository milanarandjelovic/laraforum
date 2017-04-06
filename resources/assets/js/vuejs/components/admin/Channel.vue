<template>
  <div id="channel">

    <spinner
      class="admin-scale-loader"
      :loading="loading"
      :height="height"
      :width="width"
    >
    </spinner>

    <div class="ibox" v-show="!loading">

      <div class="ibox-title">
        <h5>All channel assigned for this forum</h5>
        <div class="ibox-tools">
          <a class="btn btn-primary btn-xs" @click.prevent="openChannelModal">
            Create new channel
          </a>
        </div> <!-- /.ibox-tools -->
      </div> <!-- /.ibox-title -->

      <div class="ibox-content">

        <!-- NEW CHANNEL MODAL -->
        <div class="modal fade" id="add-channel-modal">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                  </button>
                  <h4 class="modal-title">Create New Channel</h4>
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

                      <div class="form-group" :class="{ 'has-error' : form.errors.has('description') }">
                        <label class="col-sm-2 control-label" for="description">Description</label>
                        <div class="col-sm-10">
                          <textarea
                            type="text"
                            id="description"
                            name="description"
                            class="form-control description"
                            v-model="form.description"
                            rows="6"
                          >
                          </textarea>
                          <div v-if="form.errors.has('description')" class="form-error-message">
                            <p class="text-danger">{{ form.errors.get('description') }}</p>
                          </div>
                        </div>
                      </div> <!-- /.form-group -->

                      <div class="form-group" :class="{ 'has-error' : form.errors.has('channel_url') }">
                        <label class="col-sm-2 control-label" for="channel_url">Url</label>
                        <div class="col-sm-10">
                          <input
                            type="text"
                            id="channel_url"
                            name="channel_url"
                            class="form-control"
                            v-model="form.channel_url"
                          >
                          <div v-if="form.errors.has('channel_url')" class="form-error-message">
                            <p class="text-danger">{{ form.errors.get('channel_url') }}</p>
                          </div>
                        </div>
                      </div> <!-- /.form-group -->

                      <div class="form-group" :class="{ 'has-error' : form.errors.has('channel_icon') }">
                        <label class="col-sm-2 control-label" for="channel_icon">Icon</label>
                        <div class="col-sm-10">
                          <input
                            type="text"
                            id="channel_icon"
                            name="channel_icon"
                            class="form-control"
                            v-model="form.channel_icon"
                          >
                          <p>Choose channel
                            <a href="http://fontawesome.io/icons/" target="_blank">icon</a>.
                          </p>
                          <div v-if="form.errors.has('channel_icon')" class="form-error-message">
                            <p class="text-danger">{{ form.errors.get('channel_icon') }}</p>
                          </div>
                        </div>
                      </div> <!-- /.form-group -->

                    </form> <!-- /.form-horizontal -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button"
                    class="btn btn-primary"
                    @click.prevent="createChannel"
                  >
                    Save channel
                  </button>
                </div>
            </div> <!-- /.modal-content -->
          </div> <!-- /.modal-dialog -->
        </div> <!-- /.modal -->
        <!-- /NEW CHANNEL MODAL -->

        <!-- UPDATE CHANNEL MODAL -->
        <div class="modal fade" id="update-channel-modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                </button>
                <h4 class="modal-title">Update Channel</h4>
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

                  <div class="form-group" :class="{ 'has-error' : form.errors.has('description') }">
                    <label class="col-sm-2 control-label" for="description">Description</label>
                    <div class="col-sm-10">
                      <textarea
                        type="text"
                        id="description"
                        name="description"
                        class="form-control description"
                        v-model="form.description"
                        rows="6"
                      >
                      </textarea>
                        <div v-if="form.errors.has('description')" class="form-error-message">
                          <p class="text-danger">{{ form.errors.get('description') }}</p>
                        </div>
                    </div>
                  </div> <!-- /.form-group -->

                  <div class="form-group" :class="{ 'has-error' : form.errors.has('channel_url') }">
                    <label class="col-sm-2 control-label" for="channel_url">Url</label>
                    <div class="col-sm-10">
                      <input
                        type="text"
                        id="channel_url"
                        name="channel_url"
                        class="form-control"
                        v-model="form.channel_url"
                      >
                      <div v-if="form.errors.has('channel_url')" class="form-error-message">
                        <p class="text-danger">{{ form.errors.get('channel_url') }}</p>
                      </div>
                    </div>
                  </div> <!-- /.form-group -->

                  <div class="form-group" :class="{ 'has-error' : form.errors.has('channel_icon') }">
                      <label class="col-sm-2 control-label" for="channel_icon">Icon</label>
                      <div class="col-sm-10">
                        <input
                          type="text"
                          id="channel_icon"
                          name="channel_icon"
                          class="form-control"
                          v-model="form.channel_icon"
                        >
                        <p>Choose channel
                          <a href="http://fontawesome.io/icons/" target="_blank">icon</a>.
                        </p>
                        <div v-if="form.errors.has('channel_icon')" class="form-error-message">
                          <p class="text-danger">{{ form.errors.get('channel_icon') }}</p>
                        </div>
                      </div>
                  </div> <!-- /.form-group -->

                </form> <!-- /.form-horizontal -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                  Close
                </button>
                <button type="button"
                  class="btn btn-primary"
                  @click.prevent="updateChannel"
                >
                  Update channel
                </button>
              </div>
            </div> <!-- /.modal-content -->
          </div> <!-- /.modal-dialog -->
        </div> <!-- /.modal -->
        <!-- /UPDATE CHANNEL MODAL -->

        <!-- CHANNELS TABLE -->
        <div class="table-responsive" v-if="channels.length > 0">
          <div class="dataTables_wrapper form-inline dt-bootstrap">
            <table class="table table-striped table-bordered table-hover dataTable dtr-inline">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Channel url</th>
                    <th>Channel icon</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="channel in channels">
                    <td>{{ channel.id }}</td>
                    <td>{{ channel.name }}</td>
                    <td>{{ channel.description }}</td>
                    <td>{{ channel.channel_url }}</td>
                    <td>{{ channel.channel_icon }}</td>
                    <td>{{ channel.created_at }}</td>
                    <td>{{ channel.updated_at }}</td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-white btn-xs"
                          @click.prevent="openUpdateChannelModal(channel.id)"
                        >
                          <i class="fa fa-pencil"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-xs"
                          @click.prevent="deleteChannel(channel.id)"
                        >
                          <i class="fa fa-trash-o"></i> Deleted
                        </button>
                      </div>
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
                :callback="getAllChannels"
                navClass="pull-right"
              >
              </pagination>
            </div>

          </div> <!-- /.dataTables_wrapper-->
        </div> <!-- /.table-responsive -->
        <!-- /CHANNELS TABLE -->

        <div class="text-center" v-if="channels.length == 0">
          <h3>You have no channel, begin by creating a
            <a @click.prevent="openChannelModal">new channel</a>
          </h3>
        </div>

      </div> <!-- /.ibox-content -->
    </div> <!-- /.ibox -->
  </div> <!-- /#channel -->
</template>

<script>
  import Form from '../helpers/Form'
  import Spinner  from './../common/Spinner.vue'
  import Pagination from '../common/Pagination.vue'

  export default {
    name: 'channel',
    data () {
      return {
        height: '60px',
        width: '60px',
        form: new Form({
          name: '',
          description: '',
          channel_url: '',
          channel_icon: ''
        }),
        channel_id: '',
        channels: {},
        channel: {},
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
      this.getAllChannels()
    }, // mounted()

    methods: {
      openChannelModal () {
        this.form.clear()
        this.form.errors.clear()
        $('#add-channel-modal').modal('show')
      }, // openChannelModal()

      openUpdateChannelModal (id) {
        this.form.errors.clear()
        this.getChannel(id)
        $('#update-channel-modal').modal('show')
      }, // openUpdateChannelModal()

      createChannel () {
        this.form.post('/api/admin/channels/store')
          .then((response) => {
            this.$root.$refs.toastr.s(response.message, 'Success')
            this.getAllChannels()
            $('#add-channel-modal').modal('hide')
          })
          .catch((error) => {
            if (error) {
              this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
            }
          })
      }, // createChannel()

      getAllChannels (page) {
        let pg = page ? '/api/admin/channels?page=' + page : '/api/admin/channels'
        axios.get(pg)
          .then((response) => {
            this.pagination = response.data.pagination
            this.channels = response.data.channels.data
          }).catch((error) => {
          this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
        });
      }, // getAllChannel()

      getChannel (id) {
        axios.get('/api/admin/channels/' + id)
          .then((response) => {
            this.channel_id = response.data.id
            this.form.name = response.data.name
            this.form.description = response.data.description
            this.form.channel_icon = response.data.channel_icon
            this.form.channel_url = response.data.channel_url
          }).catch((error) => {
          this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
        });
      }, // getChannel()

      updateChannel () {
        this.form.put('/api/admin/channels/' + this.channel_id + '/update')
          .then((response) => {
            this.$root.$refs.toastr.s(response.message, 'Success')
            this.getAllChannels()
            $('#update-channel-modal').modal('hide')
          })
          .catch((error) => {
            this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
          })
      }, // updateChannel()

      deleteChannel (id) {
        let vm = this
        swal(
          {
            title: "Are you sure?",
            text: "You will not be able to recover this channel!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function (isConfirm) {
            if (isConfirm) {
              swal("Deleted!", "Your channel has been deleted.", "success");
              vm.form.delete('/api/admin/channels/' + id)
                .then((response) => {
                  vm.getAllChannels()
                  vm.$root.$refs.toastr.s(response.message, 'Success')
                })
                .catch((error) => {
                  vm.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
                })
            } else {
              swal("Cancelled", "Your channel is safe :)", "error");
            }
          }
        ); // swal()
      } // deleteChannel()
    } // methods
  }
</script>

<style lang="css">
  textarea.description {
    resize: none;
  }
</style>
