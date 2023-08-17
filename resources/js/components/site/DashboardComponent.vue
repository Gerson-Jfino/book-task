<template>
  <v-main>
    <v-row>
        <v-col cols="3">
            <v-card width="260px" height="100" elevation="10">
                <v-card-title>
                    <v-row align="center">
                        <v-col class="text-h4" style="color: #F4811F;" cols="6">
                            {{ userTotal }}
                        </v-col>
                        <v-col cols="6">
                            <v-btn icon style="margin-left: 10px;">
                                <v-icon x-large color="#F4811F">mdi-account</v-icon>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-card-title>
                <v-card-subtitle class="text-h6 font-weight-bold">
                    UTILIZADORES
                </v-card-subtitle>
            </v-card>
        </v-col>
        <!-- <v-spacer></v-spacer> -->
        <v-col cols="3">
            <v-card width="290px" height="100" elevation="10">
                <v-card-title>
                    <v-row align="center">
                        <v-col class="text-h5" style="color: #F4811F;" cols="6">
                            {{ actividadesTotal }}
                        </v-col>
                        <v-col cols="6">
                            <v-btn icon style="margin-left: 10px;">
                                <v-icon x-large color="#F4811F">mdi-gavel</v-icon>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-card-title>
                <v-card-subtitle class="text-h6 font-weight-bold">
                    ACTIVIDADES
                </v-card-subtitle>
            </v-card>
        </v-col>
    <!-- </v-row> -->
    <!-- <v-row> -->
        <v-col cols="3">
            <v-card elevation="10" width="400px" height="320px">
                <v-card-text>
                    <span>
                        UTILIZADORES
                    </span>
                </v-card-text>
                <v-card-text style="margin-top: -50px;">
                    <v-row justify="center" align="space-around">
                        <v-col cols="10">
                            <pie-chart v-if="mount" :object-data="dataUsers"></pie-chart>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-col>
        <v-col cols="3">
            <v-card width="600px" height="320px" elevation="10">
                <v-card-text>
                    <v-row justify="center" align="space-around">
                        <v-col cols="10">
                            <activities-charts v-if="mount" :object-data="activities"></activities-charts>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
    <v-row align="center" justify="space-around">
        <v-col cols="6">
            <v-card>
                <v-card-title>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
                </v-card-title>
                <v-data-table
                :headers="headers"
                :items="stats"
                :search="search"
                ></v-data-table>
            </v-card>
        </v-col>
        <v-col cols="6">
            <v-card>
                <v-card-title>
                    <span>Actividades pendentes</span>
                </v-card-title>
                <v-data-table
                :headers="headersPendentes"
                :items="pendentes"
                ></v-data-table>
            </v-card>
        </v-col>
    </v-row>
  </v-main>
</template>

<script>
import PieChart from "../layout.vue/PieChart.vue"
import ActivitiesCharts from "../layout.vue/ActivitiesCharts.vue"
export default {
    components: {
        PieChart,
        ActivitiesCharts
    },
    data() {
        return {
            userTotal: 0,
            actividadesTotal: 0,
            dataUsers: {
                admin: 0,
                normal: 0
            },
            activities: {
                curso: 0,
                continuo: 0,
                supervisor: 0,
                concluido: 0,
                pendente: 0
            },
            search: '',
            stats: [],
            pendentes: [],
            mount: false,
            headers: [
                {
                    text: 'Nome',
                    align: 'start',
                    value: 'name',
                },
                { text: 'actividades em curso', value: 'curso' },
                { text: 'Em curso pelo supervisor', value: 'supervisor' },
                { text: 'Actividades Continuo', value: 'continuo' },
                { text: 'Actividades  Pendente', value: 'pendente' },
                { text: 'Actividades Concluido', value: 'concluido' },
            ],
            headersPendentes: [
                {
                    text: 'Actividade',
                    align: 'start',
                    value: 'actividade',
                },
                { text: 'Designado a', value: 'user' },
                { text: 'Supervisor', value: 'manager' },
                { text: 'Estado', value: 'estado' },
            ]
        }
    },
    created() {
        this.getData()
    },
    methods: {
        getData() {
            this.$store.dispatch('getDashboardData')
                .then(res => {
                    this.userTotal = res.usersTotla
                    this.actividadesTotal = res.actividadestotal
                    this.dataUsers.admin = res.users.admin
                    this.dataUsers.normal = res.users.normal
                    // console.log(this.dataUsers);
                    this.activities = res.status
                    this.stats = res.stats
                    this.pendentes = res.pendentes
                    this.mount = true
                    console.log(res);
                })
        }
    }
}
</script>

<style>

</style> 