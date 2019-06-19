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
        <v-btn color="success"
               @click="dialog = true">
          <v-icon>person_add</v-icon> &nbsp;Add Log
        </v-btn>
      </v-flex>
    </v-layout>
    <v-layout row>
      <v-flex xs12
              mr-4
              ml-2>
        <v-data-table :headers="headers"
                      :items="timelogs"
                      class="elevation-1">
          <template v-slot:items="props">
            <td>{{ props.item.name }}</td>
            <td>{{ props.item.start_at }}</td>
            <td>{{ props.item.end_at }}</td>
            <td>{{ props.item.total }}</td>
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
          <span class="headline">Add Client</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12
                      sm6
                      md4>
                <v-text-field label="Name*"
                              hint="Name for Time Log"
                              v-model="name"
                              required></v-text-field>
              </v-flex>
              <v-flex xs12
                      sm6
                      md4>
                <v-text-field label="Start At*"
                              hint="Start At"
                              v-model="start_at"
                              required></v-text-field>
              </v-flex>
              <v-flex xs12
                      sm6
                      md4>
                <v-text-field label="End At*"
                              hint="End At"
                              v-model="end_at"
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
  name: 'TimeLogs',
  data () {
    return {
      dialog: false,
      name: '',
      code: '',
      headers: [
        {text: 'Name', value: 'name'},
        {text: 'Start', value: 'start_at'},
        {text: 'End', value: 'end_at'},
        {text: 'Total', value: 'total'},
        {text: 'Created', value: 'created_at'},
        {text: 'Updated', value: 'updated_at'}
      ],
      timelogs: []
    }
  },
  created () {
    axios.get('/api/timeLogs').then(response => {
      this.timelogs = response.data
    }).catch(error => {
      console.log(error)
    })
  },
  methods: {
    save: function (e) {
      let vm = this
      let data = {}
      data['name'] = this.name
      data['start_at'] = this.start_at
      data['end_at'] = this.end_at
      $.ajax({
        url: '/api/saveTimeLog',
        data: data,
        type: 'POST',
        dataType: 'json',
        success: function (e) {
            vm.dialog = false
            vm.name = ''
            vm.start_at = ''
            vm.end_at = ''
        }
      })
      return false
    }
  }
}
</script>
