<template>
  <v-layout row
            ma-2>
    <v-flex xs2
            ma-2>
      <v-card class="clickable" @click.native="clients"  to="/clients">
        <v-layout row>
          <v-flex xs12
                  text-xs-center
                  pt-3>
            <v-badge>
              <template v-slot:badge>
                <span>{{clientCounter}}</span>
              </template>
              <v-icon large
                      color="grey">
                people
              </v-icon>
            </v-badge>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex xs12
                  text-xs-center>
            <h1 class="blue-grey--text lighten-1">Clients</h1>
          </v-flex>
        </v-layout>
      </v-card>
    </v-flex>
    <v-flex xs2
            ma-2>
      <v-card class="clickable" @click.native="timelogs"  to="/timelogs">
        <v-layout row>
          <v-flex xs12
                  text-xs-center
                  pt-3>
            <v-badge>
              <template v-slot:badge>
                <span>{{timelogCounter}}</span>
              </template>
              <v-icon large
                      color="grey">
                timer
              </v-icon>
            </v-badge>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex xs12
                  text-xs-center>
            <h1 class="blue-grey--text lighten-1 ">Time Logs</h1>
          </v-flex>
        </v-layout>
      </v-card>
    </v-flex>
    <v-flex xs2
            ma-2>
      <v-card class="clickable" @click.native="event"  to="/events">
        <v-layout row>
          <v-flex xs12
                  text-xs-center
                  pt-3>
            <v-badge>
              <template v-slot:badge>
                <span>{{eventCounter}}</span>
              </template>
              <v-icon large
                      color="grey">
                notes
              </v-icon>
            </v-badge>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex xs12
                  text-xs-center>
            <h1 class="blue-grey--text lighten-1 ">Events</h1>
          </v-flex>
        </v-layout>
      </v-card>
    </v-flex>
  </v-layout>
</template>
<script>
export default {
  name: 'Member',
  data () {
    return {
      clientCounter: 0,
      eventCounter: 0,
      timelogCounter: 0,
    }},
  created () {
    axios.get('/api/counters').then(response => {
      this.clientCounter = response.data.clientCounter
      this.eventCounter = response.data.eventCounter
      this.timelogCounter = response.data.timelogCounter
    }).catch(error => {
      console.log(error)
    })
  },
}
</script>
