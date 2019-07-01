<template>
  <v-dialog v-model="dialog"
            persistent
            max-width="700px">
    <v-card>
      <v-card-text>
        <v-container grid-list-md>
          <v-layout wrap>
            <v-flex xs6 >
        <v-date-picker v-model="dateModel"
                       no-title
                       scrollable
                       actions
                       @input="checkHours"></v-date-picker>
            </v-flex>
            <v-flex xs6 >
        <v-time-picker ref="timer"
                       v-model="timeModel"
                       no-title
                       scrollable
                       format="24hr"
                       actions
                       @input="checkMinutes"></v-time-picker>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>
<script>
export default {
  name: 'v-datetime-picker',
  props: {
    datetime: {
      type: String,
      required: true
    },
    label: {
      type: String,
      default: ''
    }
  },
  data () {
    return {
      dialog: false,
      dateModel: '',
      timeModel: '',
      menu: false,
      selectedTab: 'calendar'
    }
  },
  watch: {
    menu (val) {
      if (val) {
        this.selectedTab = 'calendar'
        if (this.$refs.timer)
          this.$refs.timer.selectingHour = true
      }
    }
  },
  computed: {
    actualDatetime () {
      return this.dateModel + ' ' + this.timeModel + ':00'
    }
  },
  methods: {
    checkMinutes (val) {
      if (this.$refs.timer.selectingHour === false) {
        this.timeModel = val
        this.$refs.timer.selectingHour = true
        this.selectedTab = 'calendar'
        this.menu = false
        this.$emit('input', this.actualDatetime)
      }
    },
    checkHours (val) {
      this.dateModel = val
      this.selectedTab = 'timer'
    }
  },
  created () {
    this.dateModel = this.datetime.split(' ')[0]
    this.timeModel = this.datetime.split(' ')[1]
  }
}
</script>
