<template>
    <div>
		<v-app-bar app clipped-left>
			<!-- <v-app-bar-nav-icon class="grey--text" @click.prevent="drawer = !drawer"></v-app-bar-nav-icon> -->
			<v-toolbar-title>
				<img src="/images/guezi.png" height="50" alt="" />
			</v-toolbar-title>
			<v-spacer></v-spacer>
			<v-btn text :to="{name: 'activities'}"> Atividades </v-btn>
			<v-btn v-if="user.role_id == 1" text :to="{name: 'users'}"> Utilizadores </v-btn>
			<v-menu
			offset-y
			>
				<template v-slot:activator="{ on, attrs }">
					<v-btn v-bind="attrs" v-on="on" depressed text small>
						<div>
							{{user.name}}
						</div>
					</v-btn>
				</template>
				<v-list>
					<v-list-item @click.prevent="logout">
						<v-list-item-icon><v-icon>mdi-logout</v-icon></v-list-item-icon>
						<v-list-item-title>Sair</v-list-item-title>
					</v-list-item>
				</v-list>
			</v-menu>

		</v-app-bar>
	</div>
</template>
<script>
export default {
	data() {
		return {
			userData: {
				name: ''
			}
		}
	},
    computed: {
		user() {
			this.userData = this.$store.state.Auth.user;
			return this.$store.state.Auth.user;
			// return this.$store.state.Auth.user
		},
		initialsNameUser() {
			const full_name = this.userData.name.split(" ");
			const initials = full_name.shift().charAt(0) + full_name.pop().charAt(0);
			return initials.toUpperCase();
		},
		
	},
	watch: {
		userData(user) {
			// this.useuser.name);
		}
	},
	created() {
		// console.log(this.$store.state.Auth.user.name);
	},
	methods: {
        logout(){
			this.$store.dispatch('Auth/logout')
				.then(res => {
					this.$router.push({name: 'login'})
				})
		}
	}
}
</script>
<style scoped>
    span {
		font-size: 14px;
	}
</style>