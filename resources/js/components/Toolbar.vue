<template>
    <nav>
        <v-toolbar :elevation="1">
            <v-toolbar-title class="text-uppercase">
                <span class="font-weight-light">RealTime</span>
                <span>Forum</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <li>
            <router-link
                v-for="item in items"
                :key="item.title"
                :to="item.to"
                text class="grey--text"
            >
                <v-btn text v-if="item.show">
                    <span>{{item.title}}</span>
                    <v-icon right>{{item.icon}}</v-icon>
                </v-btn>
            </router-link>
            </li>
        </v-toolbar>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            items: [
                {title: 'Forum', to: '/forum', show: true},
                {title: 'Ask Question', to: '/ask', show: User.loggedIn()},
                {title: 'Category', to: '/category', show: User.admin()},
                {title: 'Login', to: '/login', show: !User.loggedIn(), icon: 'mdi-import'},
                {title: 'Logout', to: '/logout', show: User.loggedIn(), icon: 'mdi-export'},
            ]
        }
    },
    created() {
        EventBus.$on('logout', () => {
            User.logout()
        })
    }
}
</script>

<style scoped>
    li { list-style-type: none; }
    li a {
        text-decoration: none;
    }
</style>
