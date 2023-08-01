<template>
  <v-main>
    <v-container class="mt-6">
        test
    </v-container>
  </v-main>
</template>

<script>

export default {
    name: 'test-component',
    created() {
        this.$store.dispatch('a')
    }
}
</script>

<style>

</style>