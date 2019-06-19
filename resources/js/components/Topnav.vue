<template>
  <v-layout row>
    <v-flex shrink
            pa-1>
      <h1>
        <router-link to="/"
                     style="text-decoration: none; color: darkslategrey;">Burns Web Services
        </router-link>
      </h1>
    </v-flex>
    <v-flex grow
            pa-1></v-flex>
    <span v-if="isLoggedin">
    <v-flex shrink
            pa-1>
      <v-icon>lock</v-icon>
      <a href="#"
         @click.prevent="logout()"> Logout</a>
    </v-flex>
    </span>
  </v-layout>
</template>
<script>
import { mapState } from 'vuex'

export default {
  name: 'TopNav',
  computed: mapState(['isLoggedin']),
  methods: {
    logout () {
      this.$store.commit('isLoggedout')
      axios.get('/api/logout')
      this.$router.push('/')
    }
  }
}
</script>
