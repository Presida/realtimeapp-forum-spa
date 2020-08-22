<template>
    <div>
        <vue-simplemde v-model="reply.reply" ref="markdownEditor" />
        <v-btn @click="update(reply.id)">Update</v-btn>
        <v-btn @click="cancel">Cancel</v-btn>
    </div>
</template>

<script>
export default {
    props: ['body'],
    data() {
        return {
            reply: this.body[0],
            questionSlug: this.body[1]
        }
    },
    methods: {
        cancel() {
            EventBus.$emit('cancel')
        },
        update(replyId) {
            axios.patch(`/api/question/${this.questionSlug}/reply/${replyId}`, {body: this.reply.reply})
            .then(res => this.cancel())
            .catch(err => console.log(err))
        }
    }
}
</script>
