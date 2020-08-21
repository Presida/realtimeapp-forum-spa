<template>
      <v-container fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card>
              <v-card-title class="success white--text">
                Login
              </v-card-title>
              <v-card-text>
                <v-form @submit.prevent="login">
                  <v-text-field
                    label="E-mail"
                    prepend-icon="mdi-account"
                    type="text"
                    v-model="form.email"
                    color="success"
                    required
                  ></v-text-field>

                  <v-text-field
                    label="Password"
                    v-model="form.password"
                    prepend-icon="mdi-lock"
                    type="password"
                    color="success"
                    required
                  ></v-text-field>
                    <v-card-actions>
                        <v-btn outlined color="success" type="submit">Login</v-btn>
                        <v-spacer></v-spacer>
                        <router-link class="success--text" to="/signup">
                            Signup
                        </router-link>
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
            },
            errors: {}
        }
    },
    created() {
        if(User.loggedIn()) {
            this.$router.push({name: 'forum'})
        }
    },
    methods: {
        login() {
            User.login(this.form)
            // this.$router.push({name: 'forum'})
        }
    }
  }
</script>
