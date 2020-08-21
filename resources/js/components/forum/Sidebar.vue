<template>
    <v-card class="mx-auto">
    <v-list>
      <v-subheader>Categories</v-subheader>
      <v-list-item-group color="primary">
        <v-list-item
          v-for="(category, i) in categories"
          :key="i"
        >
          <v-list-item-content>
            <v-list-item-title v-text="category.name"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
  </v-card>
</template>

<script>
export default {
    data() {
        return {
            categories: null
        }
    },
    created() {
        axios.get('/api/category')
        .then(res => this.categories = res.data.data)
    }
}
</script>
