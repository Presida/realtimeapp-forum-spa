<template>
      <v-container
        class=""
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <v-card class="elevation-12">
              <v-toolbar
                color="primary"
                dark
                flat
              >
                <v-toolbar-title>Login</v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                <v-form @submit.prevent="login">
                  <v-text-field
                    label="E-mail"
                    prepend-icon="mdi-account"
                    type="text"
                    v-model="form.email"
                    required
                  ></v-text-field>

                  <v-text-field
                    label="Password"
                    v-model="form.password"
                    prepend-icon="mdi-lock"
                    type="password"
                    required
                  ></v-text-field>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" type="submit">Login</v-btn>
                    </v-card-actions>
                </v-form>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
</template>

<script>
  export default {
    data() {
        return {
            form: {
                email: null,
                password: null
            }
        }
    },
    methods: {
        login() {
            this.$http.post('/api/auth/login', this.form)
            .then(res => console.log(res.data))
            .catch(error => console.log(error.response.data))
        }
    }
  }
</script>
