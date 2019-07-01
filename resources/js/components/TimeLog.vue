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
                      :pagination.sync="pagination"
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
          <span class="headline">Add Time Log</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12>
                <v-text-field label="Name*"
                              hint="Name for Time Log"
                              v-model="name"
                              required></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-text-field label="Start At*"
                              hint="Start At"
                              v-model="start_at"
                              v-on:click=""
                              required></v-text-field>
                <!--<v-datetime-picker :label="label"
                                   :datetime="datetime"
                                   @input="updateDatetime"></v-datetime-picker>-->
              </v-flex>
              <v-flex xs11>
                <v-text-field label="End At*"
                              hint="End At"
                              v-model="end_at"
                              required></v-text-field>
              </v-flex>
              <v-flex xs1>
                <v-icon @click="setStopwatchOn"
                        v-if="this.stopWatchOn === false">timer_off
                </v-icon>
                <v-icon @click="setStopwatchOff"
                        v-if="this.stopWatchOn">timer
                </v-icon>
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
import moment from 'moment'

export default {
  name: 'TimeLogs',
  data () {
    return {
      dialog: false,
      stopWatchOn: false,
      name: '',
      code: '',
      start_at_date: '',
      start_at_time: '',
      search: '',
      start_at: moment().format('YYYY-MM-DD HH:mm:ss'),
      end_at: moment().format('YYYY-MM-DD HH:mm:ss'),
      stopwatch: null,
      dateModel: '',
      timeModel: '',
      datetime: '2017-06-30 11:05:00',
      label: 'Custom Component',
      headers: [
        {text: 'Name', value: 'name'},
        {text: 'Start', value: 'start_at'},
        {text: 'End', value: 'end_at'},
        {text: 'Total', value: 'total'},
        {text: 'Created', value: 'created_at'},
        {text: 'Updated', value: 'updated_at'}
      ],
      timelogs: [],
      pagination: {
        sortBy: 'end_at',
        descending: true
      }
    }
  },
  created () {
    axios.get('/api/timeLogs').then(response => {
      this.timelogs = response.data
    }).catch(error => {
      console.log(error)
    })
  },
  computed: {
    startDateTime () {
      return this.dateModel + ' ' + this.timeModel + ':00'
    }
  },
  methods: {
    setStopwatchOn () {
      console.log('setStopwatchOn')
      this.stopWatchOn = true
      this.stopwatch = setInterval(this.UpdateEndAtTime, 1000)
    },
    setStopwatchOff () {
      console.log('setStopwatchOff')
      this.stopWatchOn = false
      clearInterval(this.stopwatch)
    },
    UpdateEndAtTime () {
      console.log('UpdateEndAtTime')
      this.end_at = moment().format('YYYY-MM-DD HH:mm:ss')
    },
    save: function (e) {
      console.log('save')
      this.setStopwatchOff()
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
          console.log('save - success')
          vm.dialog = false
          vm.name = ''
          vm.start_at = ''
          vm.end_at = ''
          axios.get('/api/timeLogs').then(response => {
            this.timelogs = response.data
          }).catch(error => {
            console.log(error)
          })
        }
      })
      return false
    }
  }
}
</script>
