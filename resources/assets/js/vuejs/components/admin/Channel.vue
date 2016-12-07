<template>
  <div id="channel">

    <scale-loader
            class="admin-scale-loader"
            :loading="loading"
            :color="color"
            :height="height"
            :width="width"
            :margin="margin"
    >
    </scale-loader>

    <div class="ibox" v-if="channels.length > 0">
      <div class="ibox-title">
        <h5>All channel assigned for this forum</h5>
        <div class="ibox-tools">
          <a class="btn btn-primary btn-xs" @click.prevent="openChannelModal">Create new channel</a>
        </div> <!-- /.ibox-tools -->
      </div> <!-- /.ibox-title -->
      <div class="ibox-content">

        <!-- NEW CHANNEL MODAL -->
        <div class="modal fade" id="add-channel-modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create New Channel</h4>
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
                              v-model="channelForm.name"
                              autofocus
                      >
                      <div v-if="errors.name.length > 0" class="form-error-message">
                        <p class="text-danger">{{ errors.name }}</p>
                      </div>
                    </div>
                  </div> <!-- /.form-group -->
                  <form class="form-horizontal">
                    <div class="form-group" :class="{ 'has-error' : hasErrorChannelUrl }">
                      <label class="col-sm-2 control-label" for="channel_url">Url</label>
                      <div class="col-sm-10">
                        <input
                                type="text"
                                id="channel_url"
                                name="channel_url"
                                class="form-control"
                                v-model="channelForm.channel_url"
                        >
                        <div v-if="errors.channel_url.length > 0" class="form-error-message">
                          <p class="text-danger">{{ errors.channel_url }}</p>
                        </div>
                      </div>
                    </div> <!-- /.form-group -->
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="channel_color">Color</label>
                      <div class="col-sm-10">
                        <input
                                type="color"
                                id="channel_color"
                                name="color"
                                v-model="channelForm.color"
                        >
                      </div>
                    </div> <!-- /.form-group -->
                  </form> <!-- /.form-horizontal -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click.prevent="createChannel">Save channel</button>
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update Channel</h4>
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
                              v-model="channelForm.name"
                              autofocus
                      >
                      <div v-if="errors.name.length > 0" class="form-error-message">
                        <p class="text-danger">{{ errors.name }}</p>
                      </div>
                    </div>
                  </div> <!-- /.form-group -->
                  <form class="form-horizontal">
                    <div class="form-group" :class="{ 'has-error' : hasErrorChannelUrl }">
                      <label class="col-sm-2 control-label" for="channel_url">Url</label>
                      <div class="col-sm-10">
                        <input
                                type="text"
                                id="channel_url"
                                name="channel_url"
                                class="form-control"
                                v-model="channelForm.channel_url"
                        >
                        <div v-if="errors.channel_url.length > 0" class="form-error-message">
                          <p class="text-danger">{{ errors.channel_url }}</p>
                        </div>
                      </div>
                    </div> <!-- /.form-group -->
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="channel_color">Color</label>
                      <div class="col-sm-10">
                        <input
                                type="color"
                                id="channel_color"
                                name="color"
                                v-model="channelForm.color"
                        >
                      </div>
                    </div> <!-- /.form-group -->
                  </form> <!-- /.form-horizontal -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click.prevent="updateChannel">Update channel</button>
              </div>
            </div> <!-- /.modal-content -->
          </div> <!-- /.modal-dialog -->
        </div> <!-- /.modal -->
        <!-- /UPDATE CHANNEL MODAL -->

        <table class="table table-hover">
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
          <tr v-for="channel in channels">
            <td>{{ channel.id }}</td>
            <td>{{ channel.name }}</td>
            <td>{{ channel.created_at }}</td>
            <td>{{ channel.updated_at }}</td>
            <td>
              <button class="btn btn-white btn-sm" @click.prevent="openUpdateChannelModal(channel.id)">
                <i class="fa fa-pencil"></i> Edit
              </button>
              <button class="btn btn-danger btn-sm" @click.prevent="deleteChannel(channel.id)">
                <i class="fa fa-trash-o"></i> Deleted
              </button>
            </td>
          </tr>
          </tbody>
        </table>

        <div class="text-center" v-if="channels.length == 0">
          <h3>You have no channel, begin by creating a
            <a @click.prevent="openChannelModal">new channel</a>
          </h3>
        </div>

      </div> <!-- /.ibox-content -->
    </div> <!-- /.ibox -->
  </div> <!-- /.channel -->
</template>

<script>
  import ScaleLoader from 'vue-spinner/src/ScaleLoader.vue';

  export default {
    name: 'channel',
    data () {
      return {
        height: '60px',
        channelForm: {
           name: '',
           channel_url: '',
           color: '#000000'
        },
        errors: {
          name: '',
          channel_url: ''
        },
        hasErrorName: false,
        hasErrorChannelUrl: false,
        channel_id: '',
        channels: {},
        channel: {}
      }
    },

    components: {
        'scale-loader': ScaleLoader
    },

    beforeMount () {
      this.loading = true
    },

    mounted () {
      this.loading = false
      this.getAllChannels()
    },

    methods: {
      openChannelModal () {
        this.channelForm.name = ''
        this.errors.channel_url = ''
        this.errors.name = ''
        this.hasErrorName = false
        this.hasErrorChannelUrl = false
        this.channelForm.channel_url = ''
        this.channelForm.color = '#000000'
        $('#add-channel-modal').modal('show')
      }, // openChannelModal()

      openUpdateChannelModal (id) {
        this.channelForm.name = ''
        this.errors.channel_url = ''
        this.errors.name = ''
        this.hasErrorName = false
        this.hasErrorChannelUrl = false
        this.getChannel(id)
        $('#update-channel-modal').modal('show')
      }, // openUpdateChannelModal()

      createChannel () {
        this.hasErrorName = false
        this.hasErrorChannelUrl = false
        this.$http.post('/api/channels/store', this.channelForm).then(res => {
          if(res.data.message) {
            this.channelForm.name = ''
            this.channelForm.channel_url = ''
            this.$root.$refs.toastr.s(res.data.message, 'Success')
            this.getAllChannels()
            $('#add-channel-modal').modal('hide')
          }
          if(res.data.errors) {
            this.errors = res.data.errors
            if(res.data.errors.name) {
              this.hasErrorName = true
            }
            if(res.data.errors.channel_url) {
              this.hasErrorChannelUrl = true
            }
          }
        }).catch(err => {
          this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
        });
      }, // createChannel()

      getAllChannels () {
        this.$http.get('/api/channels').then(res => {
          this.channels = res.data
        }).catch(err => {
          this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
        });
       }, // getAllChannel()

      getChannel (id) {
        this.$http.get('/api/channels/' + id).then(res => {
          this.channel_id = res.data.id
          this.channelForm.name = res.data.name
          this.channelForm.color = res.data.color
          this.channelForm.channel_url = res.data.channel_url
        }).catch(err => {
          this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
        });
      }, // getChannel()

      updateChannel () {
        this.hasErrorName = false
        this.hasErrorChannelUrl = false
        this.$http.put('/api/channels/' + this.channel_id + '/update', this.channelForm).then(res => {
          if(res.data.message) {
            this.channelForm.name = ''
            this.channelForm.channel_url = ''
            this.$root.$refs.toastr.s(res.data.message, 'Success')
            this.getAllChannels()
            $('#update-channel-modal').modal('hide')
          }
          if(res.data.errors) {
            this.errors = res.data.errors
            if(res.data.errors.name) {
              this.hasErrorName = true
            }
            if(res.data.errors.channel_url) {
              this.hasErrorChannelUrl = true
            }
          }
        }).catch(err => {
          this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
        });
      }, // updateChannel()

      deleteChannel (id) {
        let vm = this
        swal({
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
        function(isConfirm){
          if (isConfirm) {
            swal("Deleted!", "Your channel has been deleted.", "success");
            vm.$http.delete('/api/channels/' + id).then(res => {
              vm.getAllChannels()
              vm.$root.$refs.toastr.s(res.data.message, 'Success')
            }).catch(err => {
              vm.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
            });
          } else {
            swal("Cancelled", "Your channel is safe :)", "error");
          }
        });
      } // deleteChannel()
    } // methods
  }
</script>