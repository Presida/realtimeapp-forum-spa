<template>
    <v-container fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card>
              <v-card-title class="success white--text">
                Signup
              </v-card-title>
              <v-card-text>
                <v-form @submit.prevent="signup">
                  <v-text-field
                    label="Name"
                    prepend-icon="mdi-account"
                    type="text"
                    v-model="form.name"
                    color="success"
                    required
                  ></v-text-field>
                  <span class="red--text" v-if="errors.name">{{errors.name[0]}}</span>

                  <v-text-field
                    label="E-mail"
                    prepend-icon="mdi-email"
                    type="text"
                    v-model="form.email"
                    color="success"
                    required
                  ></v-text-field>
                  <span class="red--text" v-if="errors.email">{{errors.email[0]}}</span>

                  <v-text-field
                    label="Password"
                    v-model="form.password"
                    prepend-icon="mdi-lock"
                    type="password"
                    color="success"
                    required
                  ></v-text-field>
                  <span class="red--text" v-if="errors.password">{{errors.password[0]}}</span>

                  <v-text-field
                    label="Confirm Password"
                    v-model="form.password_confirmation"
                    prepend-icon="mdi-lock"
                    type="password"
                    color="success"
                    required
                  ></v-text-field>
                  <span class="red--text" v-if="errors.password">{{errors.password[0]}}</span>

                    <v-card-actions>
                        <v-btn outlined color="success" type="submit">Signup</v-btn>
                        <v-spacer></v-spacer>
                        <router-link class="success--text" to="/Login">
                            Login
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
            form : {
                name: null,
                email: null,
                password: null,
                password_confirmation: null
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
        signup() {
            axios.post('/api/auth/signup', this.form)
            .then(res => {
                User.responseAfterLogin(res),
                this.$router.push({name: 'forum'})
            })
            .catch(error => this.errors = error.response.data.errors)
        }
    }
}
</script>
