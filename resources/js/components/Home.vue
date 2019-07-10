<template>
  <v-container fluid
               fill-height>
    <v-layout align-center
              justify-center>
      <v-flex xs12
              sm8
              md4>
        <v-card class="elevation-12">
          <v-toolbar dark
                     color="primary">
            <v-toolbar-title>Login form</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form>
              <v-text-field prepend-icon="person"
                            v-model="email"
                            name="email"
                            label="Email"
                            type="text"></v-text-field>
              <v-text-field prepend-icon="lock"
                            v-model="password"
                            name="password"
                            label="Password"
                            id="password"
                            type="password"></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="submit">Login</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
export default {
  data () {
    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      password: '',
      email: ''
    }
  },
  methods: {
    submit () {
      let vue = this
      axios.post('/api/login', {csrf: this.csrf, password: this.password, email: this.email}).then(function (response) {
        if (response.data.success === true) {
          vue.$store.commit('isLoggedin');
          vue.$router.push('/portal/member')
        }
      }).catch(function (error) {
        console.log(error)
      })
    }
  }
}
</script>
