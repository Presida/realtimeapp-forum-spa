<template>
    <v-container grid-list-md>
        <v-layout row wrap>
            <v-flex xs8>
                <question
                    v-for="question in questions"
                    :key=question.index
                    :question=question
                />
            </v-flex>
            <v-flex xs4>
                <sidebar/>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
import Question from './Question'
import Sidebar from './Sidebar'

export default {
    data() {
        return {
            questions: {}
        }
    },
    components: {
        Question,
        Sidebar
    },
    created() {
        axios.get('/api/question')
        .then(res => this.questions = res.data.data)
        .catch(err => console.log(error.response.data))
    }
}
</script>
