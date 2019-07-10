<template>
  <div>
    <v-layout row>
      <v-flex xs12>
        <router-link to="/portal/member"
                     tag="v-btn"
                     class="info">
          <v-icon>arrow_left</v-icon>
          Back
        </router-link>
        <v-btn color="success"
               @click="dialog = true">
          <v-icon>person_add</v-icon> &nbsp;Add Event
        </v-btn>
      </v-flex>
    </v-layout>
    <v-layout row>
      <v-flex xs12
              mr-4
              ml-2>
        <v-data-table :headers="headers"
                      :items="events"
                      class="elevation-1">
          <template v-slot:items="props">
            <td>{{ props.item.event }}</td>
            <td>{{ props.item.created_at }}</td>
            <td>{{ props.item.updated_at }}</td>
          </template>
        </v-data-table>
      </v-flex>
    </v-layout>
    <v-dialog v-model="dialog"
              persistent
              max-width="600px">
      <v-card>
        <v-card-title>
          <span class="headline">Add Event</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12
                      sm6
                      md4>
                <v-text-field label="Event*"
                              hint="Event"
                              v-model="event"
                              required></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1"
                 flat
                 @click="dialog = false">Close
          </v-btn>
          <v-btn color="blue darken-1"
                 flat
                 @click="save()">Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default {
  name: 'Events',
  data () {
    return {
      dialog: false,
      event: '',
      headers: [
        {text: 'Event', value: 'event'},
        {text: 'Created', value: 'created_at'},
        {text: 'Updated', value: 'updated_at'}
      ],
      events: []
    }
  },
  created () {
    axios.get('/api/events').then(response => {
      this.events = response.data
    }).catch(error => {
      console.log(error)
    })
  },
  methods: {
    save: function (e) {
      let vm = this
      let data = {}
      data['event'] = this.event

      $.ajax({
        url: '/api/saveEvent',
        data: data,
        type: 'POST',
        dataType: 'json',
        success: function (e) {
          vm.dialog = false
          vm.event = ''
        }
      })
      return false
    }
  }
}
</script>
