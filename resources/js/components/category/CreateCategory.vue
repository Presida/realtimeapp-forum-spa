<template>
    <v-container>
        <v-form
            @submit.prevent="submit"
            class="mb-3"
        >
            <v-text-field
                v-model="form.name"
                label="Category Name"
                required
            >
            </v-text-field>
            <v-btn
                color="amber lighten-1"
                type="submit"
                dark
                outlined
                v-if="editSlug"
            >
                Update
            </v-btn>
            <v-btn
                color="blue lighten-1"
                type="submit"
                dark
                outlined
                v-else
            >
                Create
            </v-btn>
        </v-form>

        <v-subheader>Categories</v-subheader>
        <v-list
            v-for="(category, i) in categories"
            :key="i"
        >
            <v-list-item >
                <v-list-item-content>
                    <v-list-item-title>{{category.name}}</v-list-item-title>
                </v-list-item-content>
                <v-btn icon @click="edit(i)">
                    <v-icon color="yellow darken-1">mdi-pencil</v-icon>
                </v-btn>
                <v-btn icon @click="destroy(category.slug, i)">
                    <v-icon color="red lighten-1">mdi-delete</v-icon>
                </v-btn>
            </v-list-item>
            <v-divider></v-divider>
        </v-list>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            form: {
                name: null,
            },
            categories: {},
            editSlug: null,
        }
    },
    created() {
        if(!User.admin()) {
            this.$router.push('/forum')
        }
        axios.get('/api/category')
        .then(res => this.categories = res.data.data)
    },
    methods: {
        submit() {
            this.editSlug ? this.update() : this.create()
        },
        create() {
            axios.post('/api/category', this.form)
            .then(res => {
                this.categories.unshift(res.data)
                this.form.name = null
            })
            .catch(err => console.log(err))
        },
        destroy(slug, index) {
            axios.delete(`/api/category/${slug}`)
            .then(res => this.categories.splice(index, 1))
        },
        edit(index) {
            this.form.name = this.categories[index].name
            this.editSlug = this.categories[index].slug
            this.categories.splice(index, 1)
        },
        update() {
            axios.patch(`/api/category/${this.editSlug}`, this.form)
            .then(res => {
                this.categories.unshift(res.data)
                this.form.name = null
            })
            .catch(err => console.log(err))
        }
    }
}
</script>
