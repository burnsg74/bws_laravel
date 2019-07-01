<template>
  <div>
    <v-layout row>
      <v-flex xs12>
        <router-link to="/member"
                     tag="v-btn"
                     class="info">
          <v-icon>arrow_left</v-icon>
          Back
        </router-link>
      </v-flex>
    </v-layout>
    <v-layout row>
      <v-flex xs12
              mr-4
              ml-2>
        @TODO - Add Notes here
      </v-flex>
    </v-layout>
  </div>
</template>
<script>
export default {
  name: 'Notes',
  data () {
    return {
    }
  },
  methods: {
  }
}
</script>
