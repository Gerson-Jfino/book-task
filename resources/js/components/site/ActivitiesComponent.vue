<template>
    <v-main>
      <v-container class="mt-6">
        <header-component-vue></header-component-vue>
            <hr>
          <v-row wrap>
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
  export default {
      name: 'test-component',
      components: {
        ActivitiesTable,
        HeaderComponentVue
      },
      created() {
          this.getActivities()
      },
      data() {
        return {
            activities: {
                data: []
            }
        }
      },
      methods: {
        getActivities() {
            this.$store.dispatch('getActivities').then(res => {
                this.activities.data = res;
                // console.log(res);
            })
        }
      }
  }
  </script>
  
  <style>
  
  </style>