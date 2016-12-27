<template>
  <div class="modal fade" id="edit-user">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Update Profile</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">

            <div class="form-group" :class="{ 'has-error' : hasErrorChannelUrl }">
              <label class="control-label" for="first_name">First Name</label>
              <input
                      type="text"
                      id="first_name"
                      name="first_name"
                      class="form-control"
                      v-model="userForm.first_name"
              >
              <div v-if="errors.first_name.length > 0" class="form-error-message">
                <p class="text-danger">{{ errors.first_name }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : hasErrorChannelUrl }">
              <label class="control-label" for="last_name">Last Name</label>
              <input
                      type="text"
                      id="last_name"
                      name="last_name"
                      class="form-control"
                      v-model="userForm.last_name"
              >
              <div v-if="errors.last_name.length > 0" class="form-error-message">
                <p class="text-danger">{{ errors.last_name }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : hasErrorChannelUrl }">
              <label class="control-label" for="profile_description">Description</label>
              <textarea
                      rows="6"
                      type="text"
                      id="profile_description"
                      name="profile_description"
                      class="form-control description"
                      v-model="userForm.profile_description"
              >
              </textarea>
              <div v-if="errors.profile_description.length > 0" class="form-error-message">
                <p class="text-danger">{{ errors.profile_description }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : hasErrorChannelUrl }">
              <label class="control-label" for="personal_website">Personal Website</label>
              <input
                      type="text"
                      id="personal_website"
                      name="personal_website"
                      class="form-control"
                      placeholder="http://example.com"
                      v-model="userForm.personal_website"
              >
              <div v-if="errors.personal_website.length > 0" class="form-error-message">
                <p class="text-danger">{{ errors.personal_website }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : hasErrorChannelUrl }">
              <label class="control-label" for="twitter_username">Twitter Username</label>
              <input
                      type="text"
                      id="twitter_username"
                      name="twitter_username"
                      class="form-control"
                      v-model="userForm.twitter_username"
              >
              <div v-if="errors.twitter_username.length > 0" class="form-error-message">
                <p class="text-danger">{{ errors.twitter_username }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : hasErrorChannelUrl }">
              <label class="control-label" for="github_username">Github Username</label>
              <input
                      type="text"
                      id="github_username"
                      name="github_username"
                      class="form-control"
                      v-model="userForm.github_username"
              >
              <div v-if="errors.github_username.length > 0" class="form-error-message">
                <p class="text-danger">{{ errors.github_username }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : hasErrorChannelUrl }">
              <label class="control-label" for="place_of_employment">Place Of Employment</label>
              <input
                      type="text"
                      id="place_of_employment"
                      name="place_of_employment"
                      class="form-control"
                      v-model="userForm.place_of_employment"
              >
              <div v-if="errors.place_of_employment.length > 0" class="form-error-message">
                <p class="text-danger">{{ errors.place_of_employment }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : hasErrorChannelUrl }">
              <label class="control-label" for="job_title">Job Title</label>
              <input
                      type="text"
                      id="job_title"
                      name="job_title"
                      class="form-control"
                      v-model="userForm.job_title"
              >
              <div v-if="errors.job_title.length > 0" class="form-error-message">
                <p class="text-danger">{{ errors.job_title }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : hasErrorChannelUrl }">
              <label class="control-label" for="hometown">Hometown</label>
              <input
                      type="text"
                      id="hometown"
                      name="hometown"
                      class="form-control"
                      v-model="userForm.hometown"
              >
              <div v-if="errors.hometown.length > 0" class="form-error-message">
                <p class="text-danger">{{ errors.hometown }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : hasErrorChannelUrl }">
              <label class="control-label" for="country_flag">Country Flag</label>
              <select id="country_flag"
                      name="country_flag"
                      class="form-control"
                      v-model="userForm.country_flag"
              >
                <option v-for="country in countries" :value="country.id">{{ country.name }}</option>
              </select>
              <div v-if="errors.country_flag.length > 0" class="form-error-message">
                <p class="text-danger">{{ errors.country_flag }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : hasErrorChannelUrl }">
              <div class="checkbox i-checks pull-left">
                <input type="checkbox"
                       name="remember"
                       id="for_hire"
                       class="filled-in"
                       v-model="userForm.for_hire"
                >
                <label for="for_hire">Available For Hire?</label>
              </div>
              <div v-if="errors.for_hire.length > 0" class="form-error-message">
                <p class="text-danger">{{ errors.for_hire }}</p>
              </div>
            </div> <!-- /.form-group -->

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" @click.prevent="updateUserProfile">Update profile</button>
        </div>
      </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
  </div> <!-- /.modal -->
</template>

<script>
  export default {
    name: 'edit-user',
    data () {
      return {
        userForm: {
          first_name: '',
          last_name: '',
          profile_description: '',
          personal_website: '',
          twitter_username: '',
          github_username: '',
          place_of_employment: '',
          job_title: '',
          hometown: '',
          country_flag: '',
          for_hire: ''
        },
        errors: {
          first_name: '',
          last_name: '',
          profile_description: '',
          personal_website: '',
          twitter_username: '',
          github_username: '',
          place_of_employment: '',
          job_title: '',
          hometown: '',
          country_flag: '',
          for_hire: ''
        },
        countries: {}
      }
    }, // data()

    props: {
      username: {
        type: String,
        require: true
      }
    },

    mounted () {
      this.getUser()
    }, // mounted ()
    
    methods: {
      getUser () {
        this.$http.get('api/forum/' + this.username)
          .then(res => {
            console.log(res)
            this.userForm = res.data.user
            this.countries = res.data.countries
          }).catch(err => {
            this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
          });
      }, // getUser()

      updateUserProfile () {
        this.$http.put('api/forum/' + this.username + '/update', this.userForm)
          .then(res => {
            if(res.data.message) {
              this.$root.$refs.toastr.s(res.data.message, 'Success')
              $('#edit-user').modal('hide')
              setTimeout(location.reload(), 9000)
            }

            if(res.data.errors) {
              this.errors = res.data.errors
            }
          }).catch(err => {
            this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
          });
      } // updateUserProfile()
    } // methods
  }
</script>

<style lang="css">
  textarea.description {
    resize: none;
  }
</style>