<template>
    <v-app>
    <v-container fill-height style="height: 100vh;" >
        <v-row wrap justify="center" align="center">
            <v-card min-width="500px" >
                <v-list>
							<v-list-item >
								<v-list-item-content >
									<!-- <div class="overline mb-4">OVERLINE</div> -->

									<v-list-item-title class="headline mb-1">
										Atividades DTI - Login
									</v-list-item-title>
								</v-list-item-content>

							<v-list-item-avatar
								tile
								size="80"
							>
						<img src="/images/guezi.png" height="25" alt="" />
						</v-list-item-avatar>
					</v-list-item>
				</v-list>
            
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
                                <span>Ainda não tem conta? <span class="register" @click="register"> Registe-se.</span></span>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn
                                type="submit"
                                small
                                elevation="4"
                                dark
                                color="secondary"
                                >
                                    Entrar
                                </v-btn>
                                <v-spacer></v-spacer>
                                <!-- <v-btn
                                depressed
								rounded
								text
								small
                                >
                                    Esqueceu a senha?
                                </v-btn> -->
                            </v-card-actions>
                        
                    </v-form>
                </v-container>
            </v-card>
        </v-row>
    </v-container>
</v-app>
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
            console.log(this.formData);
            this.$store.dispatch('Auth/login', this.formData)
                .then(res => {
                    this.$router.push({name: 'activities'})
                })
        },
        register() {
            this.$router.push({name: 'register'})
        }
    }
}
</script>

<style>

</style>