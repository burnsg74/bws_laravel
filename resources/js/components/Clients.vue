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
          <v-icon>person_add</v-icon> &nbsp;Add Client
        </v-btn>
      </v-flex>
    </v-layout>
    <v-layout row>
      <v-flex xs12
              mr-4
              ml-2>
        <v-data-table :headers="headers"
                      :items="clients"
                      class="elevation-1">
          <template v-slot:items="props">
            <td>{{ props.item.name }}</td>
            <td>{{ props.item.code }}</td>
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
                              hint="Name for Client"
                              v-model="name"
                              required></v-text-field>
              </v-flex>
              <v-flex xs12
                      sm6
                      md4>
                <v-text-field label="Code*"
                              hint="Code for Client"
                              v-model="code"
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
  name: 'Clients',
  data () {
    return {
      dialog: false,
      name: '',
      code: '',
      headers: [
        {text: 'Name', value: 'name'},
        {text: 'Code', value: 'code'},
        {text: 'Created', value: 'created_at'},
        {text: 'Updated', value: 'updated_at'}
      ],
      clients: []
    }
  },
  created () {
    axios.get('/api/clients').then(response => {
      this.clients = response.data
    }).catch(error => {
      console.log(error)
    })
  },
  methods: {
    save: function (e) {
      let vm = this
      let data = {}
      data['name'] = this.name
      data['code'] = this.code

      $.ajax({
        url: '/api/saveClient',
        data: data,
        type: 'POST',
        dataType: 'json',
        success: function (e) {
            vm.dialog = false
            vm.name = ''
            vm.code = ''
        }
      })
      return false
    }
  }
}
</script>
