<template>
    <div>
        <toolbar/>
        <app-footer-comp/>
    </div>
</template>

<script>
import toolbar from './Toolbar'
import AppFooterComp from './AppFooter'

export default {
    components: {
        toolbar,
        AppFooterComp
    },
    props: {
        source: String,
    },
}
</script>
