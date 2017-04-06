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

            <div class="form-group" :class="{ 'has-error' : form.errors.has('first_name') }">
              <label class="control-label" for="first_name">First Name</label>
              <input
                type="text"
                id="first_name"
                name="first_name"
                class="form-control"
                v-model="form.first_name"
              >
              <div v-if="form.errors.has('first_name')" class="form-error-message">
                <p class="text-danger">{{ form.errors.get('first_name') }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : form.errors.has('last_name') }">
              <label class="control-label" for="last_name">Last Name</label>
              <input
                type="text"
                id="last_name"
                name="last_name"
                class="form-control"
                v-model="form.last_name"
              >
              <div v-if="form.errors.has('last_name')" class="form-error-message">
                <p class="text-danger">{{ form.errors.get('last_name') }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : form.errors.has('profile_description') }">
              <label class="control-label" for="profile_description">Description</label>
              <textarea
                rows="6"
                type="text"
                id="profile_description"
                name="profile_description"
                class="form-control description"
                v-model="form.profile_description"
              >
              </textarea>
              <div v-if="form.errors.has('profile_description')" class="form-error-message">
                <p class="text-danger">{{ form.errors.get('profile_description') }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : form.errors.has('personal_website') }">
              <label class="control-label" for="personal_website">Personal Website</label>
              <input
                type="text"
                id="personal_website"
                name="personal_website"
                class="form-control"
                placeholder="http://example.com"
                v-model="form.personal_website"
              >
              <div v-if="form.errors.has('personal_website')" class="form-error-message">
                <p class="text-danger">{{ form.errors.get('personal_website') }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : form.errors.has('twitter_username') }">
              <label class="control-label" for="twitter_username">Twitter Username</label>
              <input
                type="text"
                id="twitter_username"
                name="twitter_username"
                class="form-control"
                v-model="form.twitter_username"
              >
              <div v-if="form.errors.has('twitter_username')" class="form-error-message">
                <p class="text-danger">{{ form.errors.get('twitter_username') }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : form.errors.has('github_username') }">
              <label class="control-label" for="github_username">Github Username</label>
              <input
                type="text"
                id="github_username"
                name="github_username"
                class="form-control"
                v-model="form.github_username"
              >
              <div v-if="form.errors.has('github_username')" class="form-error-message">
                <p class="text-danger">{{ form.errors.get('github_username') }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : form.errors.has('place_of_employment') }">
              <label class="control-label" for="place_of_employment">Place Of Employment</label>
              <input
                type="text"
                id="place_of_employment"
                name="place_of_employment"
                class="form-control"
                v-model="form.place_of_employment"
              >
              <div v-if="form.errors.has('place_of_employment')" class="form-error-message">
                <p class="text-danger">{{ form.errors.get('place_of_employment') }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : form.errors.has('job_title') }">
              <label class="control-label" for="job_title">Job Title</label>
              <input
                type="text"
                id="job_title"
                name="job_title"
                class="form-control"
                v-model="form.job_title"
              >
              <div v-if="form.errors.has('job_title')" class="form-error-message">
                <p class="text-danger">{{ form.errors.get('job_title') }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : form.errors.has('hometown') }">
              <label class="control-label" for="hometown">Hometown</label>
              <input
                type="text"
                id="hometown"
                name="hometown"
                class="form-control"
                v-model="form.hometown"
              >
              <div v-if="form.errors.has('hometown')" class="form-error-message">
                <p class="text-danger">{{ form.errors.get('hometown') }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : form.errors.has('country_flag') }">
              <label class="control-label" for="country_flag">Country Flag</label>
              <select id="country_flag"
                name="country_flag"
                class="form-control"
                v-model="form.country_flag"
              >
                <option v-for="country in countries" :value="country.id">{{ country.name }}</option>
              </select>
              <div v-if="form.errors.has('country_flag')" class="form-error-message">
                <p class="text-danger">{{ form.errors.get('country_flag') }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group" :class="{ 'has-error' : form.errors.has('for_hire') }">
              <div class="checkbox i-checks pull-left">
                <input type="checkbox"
                  name="remember"
                  id="for_hire"
                  class="filled-in"
                  v-model="form.for_hire"
                >
                <label for="for_hire">Available For Hire?</label>
              </div>
              <div v-if="form.errors.has('for_hire')" class="form-error-message">
                <p class="text-danger">{{ form.errors.get('for_hire') }}</p>
              </div>
            </div> <!-- /.form-group -->

            <div class="form-group">
              <p>Want to change your profile photo? We pull from
                <a href="https://gravatar.com">gravatar.com</a>.</p>
            </div> <!-- /.form-group -->

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary"
            @click.prevent="updateUserProfile"
          >
            Update profile
          </button>
        </div>
      </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
  </div> <!-- /.modal -->
</template>

<script>
  import Form from '../helpers/Form';

  export default {
    name: 'edit-user',

    data () {
      return {
        form: new Form({
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
        }),
        countries: {}
      }
    }, // data()

    props: {
      username: {
        type: String,
        require: true
      }
    }, // props

    mounted () {
      this.getUser()
    }, // mounted ()

    methods: {
      getUser () {
        axios.get('api/forum/' + this.username)
          .then((response) => {
            this.form.first_name = response.data.user.first_name
            this.form.last_name = response.data.user.last_name
            this.form.profile_description = response.data.user.profile_description
            this.form.personal_website = response.data.user.personal_website
            this.form.twitter_username = response.data.user.twitter_username
            this.form.github_username = response.data.user.github_username
            this.form.place_of_employment = response.data.user.place_of_employment
            this.form.job_title = response.data.user.job_title
            this.form.hometown = response.data.user.hometown
            this.form.country_flag = response.data.user.country_flag
            this.form.for_hire = response.data.user.for_hire
            this.countries = response.data.countries
          })
          .catch((error) => {
            this.$root.$refs.toastr.e('An error unfortunately occurred.', 'Error')
          });
      }, // getUser()

      updateUserProfile () {
        this.form.put('api/forum/' + this.username + '/update')
          .then((response) => {
            this.$root.$refs.toastr.s(response.message, 'Success')
            $('#edit-user').modal('hide')
            setTimeout(location.reload(), 9000)
          })
          .catch((error) => {
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
