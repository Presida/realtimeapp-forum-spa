<template>
    <div>
        <v-btn class="ma-2" text icon :color="color" @click="likeIt">
            <v-icon>mdi-thumb-up</v-icon>
        </v-btn>
        {{count}}
    </div>
</template>

<script>
export default {
    props: ['content'],
    data() {
        return {
            liked: this.content.liked,
            count: this.content.like_count
        }
    },
    methods: {
        likeIt() {
            if(User.loggedIn()) {
                this.liked ? this.decr() : this.incr()
                this.liked = !this.liked
            }
        },
        incr() {
            axios.post(`/api/like/${this.content.id}`)
            .then(res => this.count++)
            .catch(err => console.log(err))
        },
        decr() {
            axios.delete(`/api/like/${this.content.id}`)
            .then(res => this.count--)
            .catch(err => console.log(err))
        }
    },
    computed: {
        color() {
            return this.liked ? 'blue lighten-2' : 'grey'
        }
    }
}
</script>
