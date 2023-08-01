<template>
  <v-main>
    <form-c-omponent :isUpdate="true" :activities="activitie"></form-c-omponent>
  </v-main>
</template>

<script>
import FormCOmponent from './form/Form.vue';
export default {
    components: {
        FormCOmponent
    },
    props: {
        id: {
            required: true
        }
    },
    data() {
        return {
            activitie: {
                name: '',
                manager: '',
                status_id: null,
                owner: '',
                start_date: null,
                due_date: null,
                final_date: null,
                status_situation: ''
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
                // console.log(this.activitie);
            })
        }
    }
}
</script>

<style>

</style>