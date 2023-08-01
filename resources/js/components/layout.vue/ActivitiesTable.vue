<template>
	<v-simple-table>
    <!-- <template v-slot:default > -->
    
        <thead>
            <tr>
                <th class="text-left">Nº Tarefa</th>
                <th class="text-left">Atividades</th>
                <th class="text-left" v-if="user.role_id == 1">Designado a</th>
                <th class="text-left">Responsavel</th>
                <th class="text-left">Status</th>
                <th class="text-left">Solicitante</th>
                <th class="text-left">Data de inicio</th>
                <th class="text-left">Data Prevista</th>
                <th class="text-left">Data Final</th>
                <th class="text-right">Acções</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="task in activities.data" :key="task.id">
                <td class="text-left">{{ task.id }}</td>
                <td>{{ task.name }}</td>
                <td v-if="user.role_id == 1">{{ task.user }}</td>
                <td>{{ task.manager }}</td>
                <td>{{ task.status }}</td>
                <td>{{ task.owner }}</td>
                <td>{{ task.start_date }}</td>
                <td>{{ task.due_date }}</td>
                <td>{{ task.final_date }}</td>
                <td class="text-right">
                    <v-btn depressed rounded small color="secondary" :to="{name: 'edit.activitie', params: { id: task.id }}">Editar</v-btn>
                    <v-btn depressed rounded small color="secondary"  :to="{ name: details_routes.name, params: { id: task.id } }">Detalhes</v-btn>
                </td>
            </tr>
        </tbody>
        <!-- </template> -->
    </v-simple-table>
</template>
<script>
export default {
    props:{
        activities: {
            required: true,
            type: Object | Array
        },

        details_routes: {
            required: true,
            type: Object,
            name: '',
        }
    },
    computed: {
        user() {
            return this.$store.state.Auth.user;
        }
    }
};
</script>