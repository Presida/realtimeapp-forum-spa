<template>
    <div>
        <vue-simplemde v-model="body" ref="markdownEditor" />
        <v-btn @click="submit">Reply</v-btn>
    </div>
</template>

<script>
export default {
    props: ['questionSlug'],
    data() {
        return {
            body: '',
        }
    },
    methods: {
        submit() {
            axios.post(`/api/question/${this.questionSlug}/reply`, {body:this.body})
            .then(res => {
                EventBus.$emit('newReply', res.data.reply)
                window.scrollTo(0, 0)
                this.body = null
            })
        }
    }
}
</script>
