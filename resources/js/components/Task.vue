<template>
  <div>
    <v-layout row>
      <v-flex xs2>
        <router-link to="/portal/tasks"
                     tag="v-btn"
                     class="info">
          <v-icon>arrow_left</v-icon>
          Back
        </router-link>
      </v-flex>
      <v-flex xs8 text-xs-center>
        <h1 style="color:gray">{{title}} Task</h1>
      </v-flex>
      <v-flex xs2>
      </v-flex>
    </v-layout>
    <v-layout row>
      <v-flex xs12
              mr-4
              ml-2>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation
        >
          <v-text-field
              v-model="summary"
              :counter="254"
              :rules="summaryRules"
              label="Summary"
              required
          ></v-text-field>

          <v-textarea
              v-model="description"
              name="description"
              label="Description"
              auto-grow
          ></v-textarea>

          <v-btn
              :disabled="!valid"
              color="success"
              @click="save"
          >
            Save
          </v-btn>
        </v-form>
      </v-flex>
    </v-layout>
  </div>
</template>
<script>
export default {
  name: 'Task',
  props: ['id'],
  data () {
    return {
      title: 'Edit',
      valid: true,
      summary: '',
      summaryRules: [
        v => !!v || 'Summary is required',
        v => (v && v.length <= 254) || 'Name must be less than 254 characters'
      ],
      description: '',
    }
  },
  created () {
    if (this.$props.id === undefined) {
      this.title = 'Add'
      return
    }

    axios.get('/api/task/'+this.$props.id).then(response => {
      console.log(response)
      this.summary = response.data.summary
      this.description = response.data.description
    }).catch(error => {
      console.log(error)
    })
  },
  methods: {
    save () {
      if (this.$refs.form.validate()) {
        this.snackbar = true
        console.log('Save 2')
        let data = {}
        data['summary'] = this.summary
        data['description'] = this.description
        let vue = this
        $.ajax({
          url: '/api/saveTask',
          data: data,
          type: 'POST',
          dataType: 'json',
          success: function (e) {
            console.log('success')
            vue.$router.push({ path: `/tasks` })
          }
        })
      }
    },
  }
}
</script>
