<template>
  <v-card class="mb-3">
    <v-card-title>
        <router-link :to="question.path">
            {{question.title}}
        </router-link>
    </v-card-title>
    <v-card-subtitle>
        {{question.user}} Posted
        {{question.create_at}}
    </v-card-subtitle>
    <v-card-text class="text--primary">
        {{question.body}}
    </v-card-text>
  </v-card>
</template>

<script>
export default {
    props: ['question']
}
</script>
