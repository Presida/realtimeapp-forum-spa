<template>
    <v-menu
      :offset-y="true"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          v-bind="attrs"
          v-on="on"
          icon
        >
          <v-badge
            :content="unreadCount"
            :value="unreadCount"
            color="red"
            overlap
          >
            <v-icon >mdi-email</v-icon>
          </v-badge>
        </v-btn>
      </template>
      <v-list>
        <v-subheader v-if="isNotification">Notifications</v-subheader>
        <v-subheader v-else>You have no notification</v-subheader>
        <v-list-item-group>
            <v-list-item
            v-for="(item, i) in unread"
            :key="i"
            >
                <router-link :to="item.path" @click.native="readIt(item)">
                    {{item.replyBy}} <v-list-item-subtitle class="ml-1"> reply: {{item.question}}</v-list-item-subtitle>
                </router-link>
            </v-list-item>
            <v-list-item
            v-for="(item, i) in read"
            :key="i"
            >
                <router-link :to="item.path" class="grey--text">
                    {{item.replyBy}} <v-list-item-subtitle class="ml-1"> reply: {{item.question}}</v-list-item-subtitle>
                </router-link>
            </v-list-item>
        </v-list-item-group>
    </v-list>
    </v-menu>
</template>

<script>
export default {
    data() {
        return {
            read: {},
            unread: {},
            unreadCount: 0,
            isNotification: true
        }
    },
    created() {
        if(User.loggedIn()) {
            this.getNotification()
            if(this.unreadCount == 0)
                this.isNotification = false
        }
    },
    methods: {
        getNotification() {
            axios.post('/api/notifications')
            .then(res => {
                this.read = res.data.read
                this.unread = res.data.unread
                this.unreadCount = res.data.unread.length
            })
        },
        readIt(notification) {
            console.log(notification.id)
            axios.post('/api/markAsRead', {id:notification.id})
            .then(res => {
                this.unread.splice(notification, 1)
                this.read.push(notification)
                this.unreadCount--
            })
        }
    }
}
</script>
