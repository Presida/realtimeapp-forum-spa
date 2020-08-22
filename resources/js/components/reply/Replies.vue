<template>
    <div>
        <v-card
            v-for="(reply, i) in content"
            :key="i"
            class="mb-2"
        >
            <v-card-title>
                {{reply.user}}
                <v-subheader>
                • {{reply.created_at}}
                </v-subheader>
                <v-spacer></v-spacer>
                <v-subheader>
                    <like :content="reply" />
                </v-subheader>
                <div v-if="own(reply.user_id) && !isEdit">
                    <v-btn color="warning" text fab small dark @click="edit">
                    <v-icon>mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn color="error" text fab small dark @click="destroy(reply.id, i)">
                    <v-icon>mdi-cancel</v-icon>
                    </v-btn>
                </div>
            </v-card-title>
            <v-card-text v-html="reply.reply" v-if="!isEdit">
            </v-card-text>
            <edit-reply v-if="isEdit" :body="[reply, replies[1]]" />
        </v-card>
    </div>
</template>

<script>
import EditReply from './editReply'
import Like from '../like/Like'

export default {
    props: ['replies'],
    data() {
        return {
            content: this.replies[0],
            isEdit: false
        }
    },
    methods: {
        own(id) {
            return User.own(id)
        },
        destroy(replyId, index) {
            axios.delete(`/api/question/${this.replies[1]}/reply/${replyId}`)
            .then(res => {
                this.content.splice(index, 1)
                console.log(this.content)
            })
            .catch(err => console.log(err))

        },
        edit() {
            this.isEdit = true
        }
    },
    created() {
        EventBus.$on('newReply', reply => {
            this.content.unshift(reply)
        })

        EventBus.$on('cancel', () => {
            this.isEdit = false
        })
    },
    components: {
        EditReply,
        Like
    }
}
</script>
