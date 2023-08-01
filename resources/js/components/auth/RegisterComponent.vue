<template>
    <v-app>
    <v-container fill-height style="height: 100vh;" >
        <v-row wrap justify="center" align="center">
            <v-card width="500px" >
                <v-toolbar color="secondary" dark>
                    <v-row justify="center" align="center">
                        Criar Conta
                    </v-row>
                    
                </v-toolbar>
            
                <v-container>
                    <validation-observer
					ref="autoRegisterForm"
					v-slot="{  }">
                    <v-form @submit.prevent="autoRegister">
                        
                            <v-card-text>
                                <validation-provider
									v-slot="{ errors }"
									name="Nome"
									rules="required"
								>
                                    <v-text-field
                                        label="Nome"
                                        v-model="formData.name"
                                        :error-messages="errors"
                                    >

                                    </v-text-field>
                                </validation-provider>
                                <validation-provider
									v-slot="{ errors }"
									name="Email"
									rules="required"
								>
                                    <v-text-field
                                        v-model="formData.email"
                                        label="Email"
                                        :error-messages="errors"
                                    />
                                </validation-provider>
                                <validation-provider
									v-slot="{ errors }"
									name="Senha"
									rules="required|strong_password"
								>
                                    <v-text-field
                                        v-model="formData.password"
									    :append-icon="
									    show1 ? 'mdi-eye' : 'mdi-eye-off'
									    "
									    :rules="[rules.required, rules.min]"
									    :type="show1 ? 'text' : 'password'"
									    name="input-10-1"
									    label="Password"
									    hint="Mínimo de 7 caracteres"
									    counter
									    :error-messages="errors"
									    @click:append="show1 = !show1"
                                    >
                                    </v-text-field>
                                </validation-provider>
                                <validation-provider
                                    v-slot="{ errors }"
									name="Confirmar Senha"
                                    rules="required|confirmed:Senha|strong_password"
								>
                                    <v-text-field
                                        v-model="formData.confirm_password"
                                        :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                                        :rules="[rules.required, rules.min]"
                                        :type="show1 ? 'text' : 'password'"
                                        name="confirm-new-password"
                                        label="Confirmar Senha"
                                        hint="Mínimo de 7 characters"
                                        counter
                                        :error-messages="errors"
                                        @click:append="show1 = !show1"
                                    >
                                    </v-text-field>
                                </validation-provider>
                                <span>Já têm uma conta? <span class="register" @click="goToLogin"> Entrar.</span></span>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn
                                type="submit"
                                small
                                elevation="4"
                                dark
                                color="secondary"
                                >
                                    Criar conta
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
                    </validation-observer>
                </v-container>
            </v-card>
        </v-row>
    </v-container>
</v-app>
</template>

<script>
import Swal from "sweetalert2";
import {
	ValidationProvider,
	ValidationObserver,
	setInteractionMode,
	extend,
} from "vee-validate";
import { required, digits, email, confirmed,max, regex } from "vee-validate/dist/rules";

setInteractionMode("eager");

extend("required", {
	...required,
	message: "{_field_} não pode estar vazio!",
});

extend("digits", {
	...digits,
	message: "{_field_} deve conter {length} dígitos. ({_value_})!",
});

extend("email", {
	...email,
	message: "O email deve ser válido!",
});
extend("confirmed", {
	...confirmed,
	message: "O valor para o campo {_field_} não coincide!",
});


extend('strong_password', {
	message: field => 'A ' + field + ' deve conter pelo menos 1 caracter minúsculo, 1 caracter maiúsculo, 1 dígito e um cumprimento não inferior a 7!',
	validate: value => {
		// let pattern = new RegExp(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/); // Com caracteres especiais
		let pattern = new RegExp(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/);
		return pattern.test(value);
	}
});
export default {
    components: {
        // eslint-disable-next-line vue/no-unused-components
		ValidationProvider,
        // eslint-disable-next-line vue/no-unused-components
		ValidationObserver,
    },
    data() {
        return {
            formData: {
                name: '',
                email: '',
                password: '',
                confirm_password: ""
            },
            show1: false,
            rules: {
				required: (value) => !!value || "Obrigatório.",
				min: (v) => v.length  >= 7  || "Mínimo de 7 caracteres",
				emailMatch: () => `The email and password you entered don't match`,
			},
        }
    },
    methods: {
        async autoRegister() {
            const isValidAutoRegisterForm = await this.$refs.autoRegisterForm.validate();

			if (!isValidAutoRegisterForm) {
				Swal.fire({
					title: "Alerta de Validação!",
					html: `Verifque o preenchimento dos campos antes de enviar o formulário.`,
					icon: "warning",
					confirmButtonText: "Ok",
					confirmButtonColor: "#FF4500",
				});

				return;
			}
            this.$store.dispatch('Auth/autoRegisto', this.formData)
                .then(res => {
                    Swal.fire({
						title: "Sucesso!",
						html: `A sua conta foi registada!<br> Use as mesmas credenciais para fazer o login.`,
						icon: "success",
						confirmButtonText: "Ok",
						confirmButtonColor: "#FF1744",
					}).then(() => {
						this.$router.push({ name: "login" });
					});
                })
        },
        goToLogin() {
            this.$router.push({name: 'login'})
        }
    }
}
</script>

<style>
.register {
	color: cornflowerblue;
}
.register:hover {
	cursor: pointer;
}
</style>