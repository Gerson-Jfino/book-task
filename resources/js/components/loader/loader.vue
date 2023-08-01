<template>
    <div class="text-center">
          <v-dialog v-model="loader" persistent width="300">
              <v-card color="red acent-3" dark>
                  <v-card-text class="text-center pt-3">
                      Por favor aguarde ...
                      <v-progress-linear
                          indeterminate
                          color="white"
                          class="mb-0 mt-2"
                      ></v-progress-linear>
                  </v-card-text>
              </v-card>
          </v-dialog>
    </div>
  </template>
  
  <script>
  export default {
      computed: {
          loader() {
              return this.$store.state.Loader.loading;
          }
      }
  }
  </script>
  
  <style>
  
  </style>