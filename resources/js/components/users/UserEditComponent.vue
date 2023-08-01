<template>
    <v-main>
        
            <v-row justify="center">
                <v-col cols="12" sm="8" style="padding-top: 40px">
                    <v-form class="mt-4" @submit.prevent="updatePermission">
                        <v-card>
                            <v-card-title>
                                <h4 class="grey--text font-weight-regular">Alterar Permissões</h4>
                            </v-card-title>
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12" md="6">
                                        <v-text-field outlined dense readonly label="Nome" v-model="user.name"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="6">
                                        <v-text-field outlined dense readonly label="Email" v-model="user.email"></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="12" md="8">
                                        <v-select 
                                        :items="roles"
                                        item-text="name"
                                        item-value="id"
                                        outlined
                                        dense
                                        v-model="user.role_id"
                                        label="Estado"></v-select>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn type="submit" small elevation="4" color="secondary" dark>
                                    <v-icon small class="mr-2"> mdi-check </v-icon> Salvar
                                </v-btn>
                                <v-btn
                                    :to="{ name: 'users' }"
                                    exact
                                    outlined
                                    small
                                    elevation="4"
                                    color="secondary"
                                    dark
                                    class="mx-4"
                                    style="text-decoration: none;"
                                >
                                    <v-icon small class="mr-2"> mdi-cancel </v-icon>
                                    Cancelar
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-form>
                </v-col>
            </v-row>
        
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
            user: {
                name: '',
                email: '',
                role_id: ''
            },
            roles: [

            ]
        }
    },
    created() {
        this.getUser();
        this.getRoles();
    },
    methods: {
        getUser() {
            this.$store.dispatch('Auth/getUser', { id: this.id })
                .then(res => {
                    this.user = res.data
                })
        },
        getRoles(){
            this.$store.dispatch('Auth/getRoles')
                .then(res => {
                    this.roles = res.data
                })
        },
        updatePermission() {
            this.$store.dispatch('Auth/updateUser', this.user)
                .then(res => {
                    this.$router.push({name: 'users'})
                })
        }
    }
}
</script>

<style>

</style>