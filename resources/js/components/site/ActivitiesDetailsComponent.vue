<template>
  <v-main>

    <v-card
    class="mx-auto my-12" width="800">
      <v-card-title>{{ activitie.name }}</v-card-title>
      <v-card-text>
        <v-row
        align="center"
        class="mx-0">
          Tarefa de: {{ activitie.user.name }}
        </v-row>
        <v-row>
          <v-col cols="12" md="4">
            <v-text-field outlined dense readonly label="Progresso" v-model="activitie.status.name"></v-text-field>
          </v-col>
          <v-col cols="12" md="4">
            <v-text-field outlined dense readonly label="Responsavel" v-model="activitie.manager"></v-text-field>
          </v-col>
          <v-col cols="12" md="4">
            <v-text-field outlined dense readonly label="Solicitante" v-model="activitie.owner"></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="4">
            <v-text-field outlined repend-icon="mdi-calendar" dense readonly label="Data de inicio" v-model="activitie.start_date"></v-text-field>
          </v-col>
          <v-col cols="12" md="4">
            <v-text-field outlined repend-icon="mdi-calendar" dense readonly label="Data de Final" v-model="activitie.final_date"></v-text-field>
          </v-col>
          <v-col cols="12" md="4">
            <v-text-field outlined repend-icon="mdi-calendar" dense readonly label="Data de Previsata" v-model="activitie.due_date"></v-text-field>
          </v-col>
        </v-row>
        <v-row v-show="activitie.document">
          <v-col cols="12" md="">
            <span>Documento</span>
            <div><a :href="activitie.document" target="_blank">Ver documento</a> </div>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <!-- <v-textarea height="300px"  outlined dense readonly label="Ponto de Situação" v-model="activitie.status_situation">

            </v-textarea> -->
            <span>
              <h3>Ponto de situação</h3>
            </span>
            <div v-show="activitie.status_situation !== null">
              {{ activitie.status_situation }}
            </div>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <!-- <v-textarea height="300px"  outlined dense readonly label="Ponto de Situação" v-model="activitie.status_situation">

            </v-textarea> -->
            <span>
              <h3>Observações</h3>
            </span>
            <div v-show="activitie.observation !== null">
              {{ activitie.observation }}
            </div>
          </v-col>
        </v-row>
      </v-card-text>
      <v-card-actions>
        <v-btn
          :to="{ name: 'activities' }"
          exact
          outlined
          small
          elevation="4"
          color="secondary"
          dark
          class="mx-4"
          style="text-decoration: none;"
        >Voltar</v-btn>
      </v-card-actions>
    </v-card>
  </v-main>
</template>

<script>
export default {
  props: {
    id: {
      required: true
    }
  },
  data() {
    return {
      activitie: {
        id: null,
        name: "",
        manager: "",
        status_id: null,
        owner: "",
        start_date: null,
        due_date: null,
        final_date: null,
        status_situation: "",
        document: "",
        observation: "",
        status: {
          id: null,
          name: ""
        },
        user: {
          name: ''
        }
      }
    }
  },
  created() {
    this.getActivitie()
  },
  methods: {
    getActivitie() {
      this.$store.dispatch('showActivie', {id: this.id}).then(res => {
        this.activitie = res.data
      })
    }
  }

}
</script>

<style>

</style>