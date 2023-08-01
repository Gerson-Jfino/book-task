<template>
  <!-- <div class="grey lighten-4"> -->
  <div class="grey lighten-5">
      <v-app>
          <v-container class="mt-6">
              <router-view></router-view>
          </v-container>
          <loader></loader>
      </v-app>
  </div>
</template>
<script>
import loader from './loader/loader.vue';
export default {
  components: {
      loader
  }
}
</script>