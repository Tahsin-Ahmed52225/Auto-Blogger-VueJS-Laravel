<template>
    <Loader/>
    <NavBar/>
    <RouterView />
    <FooterMain/>
</template>

<script >
// Components
import NavBar from '../../components/Website/NavBar.vue';
import FooterMain from '../../components/Website/FooterMain.vue';

import Loader from '../../components/Website/Loader.vue';
// Packages
import { RouterView } from 'vue-router'

export default {
    components: {
    NavBar, FooterMain,
    Loader
}
}
</script>