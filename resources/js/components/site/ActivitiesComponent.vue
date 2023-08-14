<template>
    <v-main>
      <v-container class="mt-6">
        <header-component-vue @searchByStatus="searchByStatus" @search="searchFunc"></header-component-vue>
            <hr>
            <v-row v-if="search_alert">
            <v-col cols="12">
              <v-alert
                v-if="activities.data.length > 0"
                dense
                text
                color="secondary"
                border="bottom"
                colored-border
                elevation="2"
              >
                <v-row justify="space-between">
                  <v-col>
                    <span class="caption"
                      >{{ activities.data.length }} atividades de {{ s_filter }}.
                    </span>
                  </v-col>
                  <v-col class="text-right">
                    <v-btn
                      @click="resetSearchResults"
                      color="secondary"
                      small
                      text
                      rounded
                      >Limpar <v-icon small>mdi-close</v-icon></v-btn
                    >
                  </v-col>
                </v-row>
              </v-alert>
            </v-col>
          </v-row>
          <v-row wrap>
            <json-excel
              style="margin-top: 10px;"
              :data="activities.data"
              :name="'livro_de_atividades' + '.xls'"
            >
              <v-btn small color="red accent-3" dark>
                <v-icon> mdi-download </v-icon>
                Exportar Actividades
              </v-btn>
            </json-excel>
            <v-col cols="12">
                <activities-table :activities="activities" :details_routes="{ name: 'details.activitie'}"></activities-table>
            </v-col>
          </v-row>
          
      </v-container>
    </v-main>
  </template>
  
  <script>
//   import ActivitiesTable from '../layout/ActivitiesTable.vue'
import ActivitiesTable from '../layout.vue/ActivitiesTable.vue';
import HeaderComponentVue from '../layout.vue/HeaderComponent.vue';
import JsonExcel from "vue-json-excel";
import Swal from "sweetalert2";
  export default {
      name: 'test-component',
      components: {
        ActivitiesTable,
        HeaderComponentVue,
        JsonExcel
      },
      created() {
          this.getActivities()
      },
      data() {
        return {
            activities: {
                data: []
            },
            search_alert: false,
            s_filter: ""
        }
      },
      computed: {
        user() {
            return this.$store.state.Auth.user;
        }
      },
      methods: {
        getActivities(filter = "", status = "") {
          this.$store.dispatch('Auth/checkAuthenticated')
            .then(res => {

            }).catch(() => {
                router.push({name: 'login'})
            })
            this.$store.dispatch('getActivities', {filter, status}).then(res => {
              this.activities.data = res;
              if (filter) {
                this.s_filter = filter
                this.search_alert = true
              }
                // console.log(res);
            })
        },
        searchFunc(filter) {
          this.getActivities(filter = filter);
        },
        searchByStatus(status) {
          const id = status.id
          this.s_filter = status.name
          this.search_alert = true
          this.getActivities("" ,id);
        },
        resetSearchResults() {
          this.search_alert = false;
          this.s_filter = ""
          this.getActivities()
        },
        startDownload() {
            Swal.fire({
              title: "Exportando as actividades",
              text: "O ficheiro será descarregado dentro de instantes",
              confirmButtonText: "OK",
              confirmButtonColor: "#f15726",
              icon: "info",
            });
          },

          finishDownload() {
            // console.log('fim');
          },
      }
  }
  </script>
  
  <style>
  
  </style>