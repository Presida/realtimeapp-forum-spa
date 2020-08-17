<template>
    <v-container>
        <v-form
            ref="form"
            lazy-validation
            @submit.prevent="create"
        >
            <v-text-field
                v-model="form.title"
                label="Title"
                required
            >
            </v-text-field>

            <v-autocomplete
                v-model="form.category_id"
                :items="categories"
                item-text="name"
                item-value="id"
                dense
                filled
                label="Category"
            ></v-autocomplete>

            <vue-simplemde v-model="form.body" ref="markdownEditor" />

            <v-btn
                color="primary"
                type="submit"
            >
                Create
            </v-btn>
        </v-form>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            form: {
                title: null,
                category_id: null,
                body: null
            },
            categories: {}
        }
    },
    created() {
        axios.get('/api/category')
        .then(res => this.categories = res.data.data )
        .catch(error => console.log(error))
    },
    methods: {
        create() {
            axios.post('/api/question', this.form)
            .then(res => this.$router.push(res.data.path))
            .catch(error => console.log(error))
        }
    }
}
</script>
