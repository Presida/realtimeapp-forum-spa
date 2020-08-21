<template>
    <v-container>
        <v-btn color="grey darken-2" text fab small dark @click="cancel">
            <v-icon>mdi-arrow-left</v-icon>
        </v-btn>
        Back
        <v-form
            ref="form"
            lazy-validation
            @submit.prevent="update"
        >
            <v-text-field
                v-model="form.title"
                label="Title"
                required
            >
            </v-text-field>

            <vue-simplemde v-model="form.body" ref="markdownEditor" />

            <v-btn
                class="blue darken-1"
                type="submit"
                dark
            >
                Update
            </v-btn>
        </v-form>
    </v-container>
</template>

<script>
export default {
    props: ['question'],
    data() {
        return {
            form: {
                title: null,
                body: null
            },
            categories: {}
        }
    },
    mounted() {
        this.form = this.question
    },
    methods: {
        update() {
            axios.put(`/api/question/${this.form.slug}`, this.form)
            .then(res => this.cancel())
        },
        cancel() {
            EventBus.$emit('cancelEditing')
        }
    }
}
</script>
