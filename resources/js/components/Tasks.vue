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
        <router-link to="/task"
                     tag="v-btn"
                     class="success">
          <v-icon>person_add</v-icon> &nbsp;Add Task
        </router-link>
      </v-flex>
    </v-layout>
    <v-layout row>
      <v-flex xs12
              mr-4
              ml-2>
        <v-data-table :headers="headers"
                      :items="tasks"
                      class="elevation-1">
          <template v-slot:items="props">
            <tr  @click="showAlert(props.item)">
              <td>{{ props.item.summary }}</td>
              <td>{{ props.item.created_at }}</td>
              <td>{{ props.item.updated_at }}</td>
            </tr>
          </template>
        </v-data-table>
      </v-flex>
    </v-layout>
  </div>
</template>
<script>
export default {
  name: 'Tasks',
  data () {
    return {
      dialog: false,
      name: '',
      code: '',
      headers: [
        {text: 'Summary', value: 'summary'},
        {text: 'Created', value: 'created_at'},
        {text: 'Updated', value: 'updated_at'}
      ],
      tasks: []
    }
  },
  created () {
    axios.get('/api/tasks').then(response => {
      this.tasks = response.data
    }).catch(error => {
      console.log(error)
    })
  },
  methods: {
    showAlert(e) {
      this.$router.push({ path: `/task/${e.id}` })
    }
  }
}
</script>
