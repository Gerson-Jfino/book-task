<template>
  <div>	
	<v-row justify="center">
		<v-col cols="12" sm="8" style="padding-top: 40px">
			<!-- <product-form /> -->
            <v-form class="mt-4" @submit.prevent="onSubmit">
                <v-card>
                    <v-card-title>
                        <v-row justify="center" align="center">
                            <h4 class="grey--text font-weight-regular">Cadastrar Actividade</h4>
                        </v-row>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="12" sm="6" md="6">
                                <v-text-field
                                outlined
                                dense
                                v-model="activities.name"
                                label="Titulo da atividade"
                                type="text"
                                >
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-text-field
                                outlined
                                dense
                                v-model="activities.manager"
                                label="Responsavél"
                                type="text">
                                </v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="6">
                                <v-select 
                                :items="status"
                                item-text="name"
                                item-value="id"
                                outlined
                                dense
                                v-model="activities.status_id"
                                label="Estado"></v-select>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-text-field
                                outlined
                                dense
                                v-model="activities.owner"
                                label="Solicitante"
                                type="text">
                                </v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="6">
                                <v-menu
                                    ref="menu"
                                    v-model="menu"
                                    :close-on-content-click="false"
                                    :return-value.sync="date"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="auto"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            outlined
                                            dense
                                            v-model="activities.start_date"
                                            label="Data de inicio"
                                            prepend-icon="mdi-calendar"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="activities.start_date"
                                        dense
                                        no-title
                                        scrollable
                                    >
                                        <v-spacer></v-spacer>
                                        <v-btn text color="primary" @click="menu = false">
                                            Cancel
                                        </v-btn>
                                        <v-btn text color="primary" @click="$refs.menu.save(date)">
                                            OK
                                        </v-btn>
                                    </v-date-picker>
                                </v-menu>
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-menu
                                    ref="menu"
                                    v-model="menu1"
                                    :close-on-content-click="false"
                                    :return-value.sync="date1"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="auto"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            outlined
                                            dense
                                            v-model="activities.due_date"
                                            label="Data prevista"
                                            prepend-icon="mdi-calendar"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="activities.due_date"
                                        dense
                                        no-title
                                        scrollable
                                    >
                                        <v-spacer></v-spacer>
                                        <v-btn text color="primary" @click="menu1 = false">
                                            Cancel
                                        </v-btn>
                                        <v-btn text color="primary" @click="$refs.menu.save(date1)">
                                            OK
                                        </v-btn>
                                    </v-date-picker>
                                </v-menu>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="6">
                                <v-menu
                                    ref="menu"
                                    v-model="menu2"
                                    :close-on-content-click="false"
                                    :return-value.sync="date2"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="auto"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            outlined
                                            dense
                                            v-model="activities.final_date"
                                            label="Data Final"
                                            prepend-icon="mdi-calendar"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="activities.final_date"
                                        dense
                                        no-title
                                        scrollable
                                    >
                                        <v-spacer></v-spacer>
                                        <v-btn text color="primary" @click="menu2 = false">
                                            Cancel
                                        </v-btn>
                                        <v-btn text color="primary" @click="$refs.menu.save(date2)">
                                            OK
                                        </v-btn>
                                    </v-date-picker>
                                </v-menu>
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-file-input
                                ref="anexo_conteudo"
                                outlined
								dense
								clearable
								show-size
								small-chips
								truncate-length="20"
								label="Anexo"
                                v-model="activities.document">

                                </v-file-input>
                            </v-col>
                        </v-row>
                        <v-row v-if="isUpdate">
                            <v-col cols="12">
                                <v-textarea outlined dense label="Ponto de situação" v-model="activities.status_situation" placeholder="Atualize o ponto de situação da atividade"></v-textarea>
                            </v-col>
                        </v-row>
                        <v-row v-if="isUpdate && user.role_id == 1">
                            <v-col cols="12">
                                <v-textarea outlined dense label="Observações" v-model="activities.observation" placeholder="Observações"></v-textarea>
                            </v-col>
                        </v-row>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn v-if="!isUpdate" type="submit" small elevation="4" color="secondary" dark>
                            <v-icon small class="mr-2"> mdi-check </v-icon> Salvar
                        </v-btn>
                        <v-btn v-else type="submit" small elevation="4" color="secondary" dark>
                            <v-icon small class="mr-2"> mdi-check </v-icon> Atualizar
                        </v-btn>
                        <v-btn v-if="isUpdate" @click="remove()" small elevation="4" color="error">
                            <v-icon small class="mr-2"> mdi-delete </v-icon> Eliminar
                        </v-btn>
                        <v-btn
                            :to="{ name: 'activities' }"
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
  </div>
</template>

<script>
export default {
    props: {
        activities: {
            type: Object,
            required: false,
            default() {
                return {
                    id: null,
                    name: '',
                    manager: '',
                    status_id: null,
                    owner: '',
                    user_id: null,
                    start_date: null,
                    due_date: null,
                    final_date: null,
                    status_situation: '',
                    document: null,
                    observation: ''
                }
            }
        },
        isUpdate: {
            type: Boolean,
            required: false
        }
    },
    data() {
        return {
            date: new Date().toISOString().substr(0, 10),
            date1: new Date().toISOString().substr(0, 10),
            date2: new Date().toISOString().substr(0, 10),
			menu: false,
			menu1: false,
			menu2: false,
            status: [
                {
                    id: null,
                    name: ''
                }
            ]
        }
    },
    computed: {
        user() {
            return this.$store.state.Auth.user;
        }
    },
    created() {
        this.getConfig()
    },
    methods: {
        onSubmit() {
            const action = this.isUpdate ? 'updateActivitie' : 'storeAtivities';
            const formData = new FormData();
            formData.append('id', this.activities.id);
            formData.append('name', this.activities.name);
            formData.append('manager', this.activities.manager);
            formData.append('status_id', this.activities.status_id);
            formData.append('owner', this.activities.owner);
            formData.append('user_id', this.activities.user_id);
            if (this.activities.start_date !== null) {
                formData.append('start_date', this.activities.start_date);
            }
            if (this.activities.due_date !== null) {
                formData.append('due_date', this.activities.due_date);
            }
            if (this.activities.final_date !== null) {
                formData.append('final_date', this.activities.final_date);
            }
            formData.append('status_situation', this.activities.status_situation);
            formData.append('observation', this.activities.observation);
            if (typeof(this.activities.document) !== "string" && this.activities.document !== null){
                formData.append('document', this.activities.document);
                // formData.delete("domunent");
            }
            // console.log(formData.get('id'));
            // return;
            this.$store.dispatch(action, formData).then(res => {
                this.$router.push({name: 'activities'})
            })
        },
        getConfig() {
            this.$store.dispatch('getStatus').then(res => {
                this.status = res.data
            })
        },
        remove() {
            this.$store.dispatch('removeActivitie', this.activities)
                .then(res => {
                    this.$router.push({name: 'activities'})
                })
        }
        
    }
}
</script>

<style>

</style>