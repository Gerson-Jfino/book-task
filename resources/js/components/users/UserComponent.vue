<template>
    <v-main>
        <v-container class="mt-6">
            <v-col cols="12">
                <v-simple-table>
                    <!-- <template v-slot:default > -->
                    
                        <thead>
                            <tr>
                                <th class="text-left">ID</th>
                                <th class="text-left">Nome</th>
                                <th class="text-left">Email</th>
                                <th class="text-left">Permissões</th>
                                <th class="text-right">Acção</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in users" :key="user.id">
                                <td class="text-left">{{ user.id }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.role.name }}</td>
                                <td class="text-right">
                                    <v-btn depressed rounded small color="secondary" :to="{name: 'users.edit', params: { id: user.id }}">Alterar permissões</v-btn>
                                </td>
                            </tr>
                        </tbody>
                        <!-- </template> -->
                    </v-simple-table>
            </v-col>
        </v-container>
    </v-main>
</template>

<script>
export default {
    data() {
        return {
            users: []
        }
    },
    created() {
        this.getUsers()
    },
    methods: {
        getUsers() {
            this.$store.dispatch('Auth/getUsers')
                .then(res => {
                    this.users = res.data;
                })
        }
    }
}
</script>

<style>

</style>