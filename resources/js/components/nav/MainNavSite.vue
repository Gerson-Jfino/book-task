<template>
    <div>
		<v-app-bar app clipped-left color="#be0028">
			<!-- <v-app-bar-nav-icon class="grey--text" @click.prevent="drawer = !drawer"></v-app-bar-nav-icon> -->
			<v-toolbar-title>
				<!-- <img src="/images/logo_png/Absa_Logo_White.png" height="25" alt="" /> -->
				Livro de Atividades
			</v-toolbar-title>
			<v-spacer></v-spacer>
			<v-menu
				content-class="elevation-0"
				open-on-hover
				right
				min-width="200px"
				offset-y
			>
				<template v-slot:activator="{ on, attrs }">
					<v-avatar size="48" v-bind="attrs" v-on="on" color="secondary">
						<!-- <v-img v-if="user.logo" :src="user.logo"></v-img> -->
						<span class="white--text" headline>GM</span>
					</v-avatar>
				</template>
				<v-card class="mt-2" dark color="accent">
					<v-list-item-content class="justify-center">
						<div class="mx-auto text-center">
							<v-avatar color="secondary">
								<span class="white--text" headline>GM</span>
							</v-avatar>

							<h3>GM</h3>
							<!-- <p class="caption mt-1">{{ user.email }}</p> -->
							<v-divider class="my-1"></v-divider>
							<v-btn
								depressed
								rounded
								text
								small
							>
								Alterar Senha
							</v-btn>
							<v-divider class="my-1"></v-divider>
							<v-btn depressed rounded text small>
								Sair
							</v-btn>
						</div>
					</v-list-item-content>
				</v-card>
			</v-menu>

		</v-app-bar>
	</div>
</template>
<script>
export default {
    
}
</script>
<style scoped>
    
</style>