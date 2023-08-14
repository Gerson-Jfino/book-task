<template>
	<form class="" @submit.prevent="searchContent">
		<v-form>
			<v-text-field
				ref="search"
				v-model="filter"
				label="Pesquisar"
				placeholder="pesquisar pelo nome"
				append-icon="mdi-briefcase-search"
				@click:append.prevent="searchContent"
				@keypress.enter.prevent="searchContent"
			></v-text-field>
		</v-form>
	</form>
</template>

<script>

export default {
	components: {
	},

	data() {
		return {
			filter: "",
		};
	},

	methods: {
		searchContent() {
			this.$emit("search", this.filter);
			this.filter = ''
		},
	},
};
</script>

<style scoped>
</style>