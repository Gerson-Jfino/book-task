<template>
    <!-- <div class="grey lighten-4"> -->
    <div class="grey lighten-5">
        <v-app>
            <main-nav-site></main-nav-site>
            <v-container class="mt-6">
                <router-view></router-view>
            </v-container>
            <loader></loader>
        </v-app>
    </div>
</template>
<script>
import MainNavSite from './nav/MainNavSite'
import loader from './loader/loader.vue';
export default {
    components: {
        MainNavSite,
        loader
    }
}
</script>