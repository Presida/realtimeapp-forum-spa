<template>
    <div>
        <toolbar/>
        <router-view></router-view>
        <app-footer-comp/>
    </div>
</template>

<script>
import toolbar from './Toolbar'
import AppFooterComp from './AppFooter'
import Login from './login/Login'

export default {
    components: {
        toolbar,
        AppFooterComp,
        Login
    },
    props: {
        source: String,
    },
}
</script>
