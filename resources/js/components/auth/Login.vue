<template>
    <v-container fill-height style="height: 100vh;" >
        <v-row wrap justify="center" align="center">
            <v-card min-width="500px" >
                <v-toolbar color="secondary" dark>
                    <!-- <v-row justify="center" align="center">
                        Gugla - Administração
                    </v-row> -->
                    
                </v-toolbar>
            
                <v-container>
                    <v-form @submit.prevent="login">
                        
                            <v-card-text>
                                <v-text-field
                                    v-model="formData.email"
                                    label="Email"
                                />
                                <v-text-field
                                    v-model="formData.password"
                                    label="Senha"
                                    :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                                    :type="show1 ? 'text' : 'password'"
                                    name="input-10-1"
                                    hint="Mínimo de 7 caracteres"
                                    counter
                                    @click:append="show1 = !show1"
                                >

                                </v-text-field>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn
                                @click="login"
                                small
                                elevation="4"
                                dark
                                color="secondary"
                                >
                                    Entrar
                                </v-btn>
                                <v-spacer></v-spacer>
                                <v-btn
                                depressed
								rounded
								text
								small
                                :to="{name: 'admin.forgotpassword'}">
                                    Esqueceu a senha?
                                </v-btn>
                            </v-card-actions>
                        
                    </v-form>
                </v-container>
            </v-card>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                email: '',
                password: ''
            },
            show1: false
        }
    },
    methods: {
        login() {
            this.$store.dispatch("auth/login", this.formData)
            .then((res) => {
                //console.log(response)
                const user = res.data.user
                if(user.first_login) {
                    this.$router.push({name: 'admin.dashboard'})
                }
                else {
                    this.$router.push({name: 'admin.change-password'})
                }
                
            })
            .catch((err) => {
                console.log(err)
            })
        }
    }
}
</script>

<style>

</style>