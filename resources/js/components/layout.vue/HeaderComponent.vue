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
				<v-spacer></v-spacer>
				<v-col cols="2" class="text-right">
					<v-select
					:items="status"
					v-model="selected"
					@change="byStatus(selected)"
					item-text="name"
					item-value="id"
					label="Filtrar por status"
					></v-select>
				</v-col>
				<v-col cols="3" class="text-right">
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
				</v-col>
			</v-row>
		</v-col>
	</v-row>
</template>
<script>
export default {
	components: {
	},
	data() {
		return {
			filter: "",
			status: [],
			selected: null
		}
	},
	created() {
		this.getStatus()
	},
	methods: {
		searchContent() {
			this.$emit("search", this.filter);
			this.filter = ''
		},
		getStatus() {
			this.$store.dispatch('getStatus').then(res => {
                this.status = res.data
            })
		},
		byStatus(selected) {
			const filterStatud = this.status.find(st => st.id == selected)
			this.$emit("searchByStatus", filterStatud);
			this.selected = ''
		}
	}



};
</script>
<style scoped>
</style>