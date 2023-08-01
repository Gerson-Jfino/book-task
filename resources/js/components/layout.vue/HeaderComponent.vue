<template>

	<v-row wrap>
		<v-col cols="12">
			<v-row wrap>
				<v-col cols="12">
					<h2 class="heading-2">Livro de actividades</h2>
				</v-col>
			</v-row>
			<v-row wrap>
				<v-col cols="6">
					<router-link style="text-decoration: none;" :to="{name: 'creatte.activite'}"><v-btn color="secondary"><v-icon class="mr-2"> mdi-plus </v-icon> Adicionar</v-btn></router-link>
						
				</v-col>
			</v-row>
		</v-col>
	</v-row>
</template>
<script>
export default {
	components: {
	}



};
</script>
<style scoped>
</style>