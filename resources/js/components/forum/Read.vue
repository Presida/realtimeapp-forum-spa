<template>
    <div>
        <div v-if="showEdit">
            <edit-comp :question="question"/>
        </div>
        <div v-if="!showEdit">
            <v-card class="my-3" v-if="question">
                <v-card-title>
                    {{question.title}}
                    <v-spacer></v-spacer>
                    <v-avatar>
                        <v-icon>mdi-message-text</v-icon>
                    </v-avatar>
                    <v-chip
                        class="ma-2"
                        color="teal"
                        text-color="white"
                        >
                        5 Reply
                    </v-chip>
                    <div v-if="own">
                        <v-btn color="warning" text fab small dark @click="edit">
                        <v-icon>mdi-pencil</v-icon>
                        </v-btn>
                        <v-btn color="error" text fab small dark @click="destroy">
                        <v-icon>mdi-cancel</v-icon>
                        </v-btn>
                    </div>
                </v-card-title>
                <v-card-subtitle>
                    {{question.user}} .
                    {{question.create_at}}
                </v-card-subtitle>
                <v-card-text class="text--primary" v-html="body">
                </v-card-text>
            </v-card>
        </div>
    </div>
</template>

<script>
import EditComp from './Edit'

export default {
    data () {
        return {
            question: null,
            // own: User.own(this.question)
            own: null,
            showEdit: false
        }
    },
    created () {
        axios.get(`/api/question/${this.$route.params.slug}`)
        .then(res => {
            this.question = res.data.data
            this.own = User.own(this.question.user_id)
        })
        .catch(error => console.log(error))

        EventBus.$on('cancelEditing', () => {
            this.showEdit = false
        })
    },
    // convert to html
    computed: {
        body() {
            return md.parse(this.question.body)
        }
    },
    methods: {
        destroy() {
            axios.delete(`/api/question/${this.question.slug}`)
            .then(res => this.$router.push('/forum'))
            .catch(error => console.log(error.response.data))
        },
        edit() {
            return this.showEdit = true
        }
    },
    components: {
        EditComp
    }
}
</script>
