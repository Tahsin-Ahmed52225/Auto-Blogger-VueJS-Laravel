<style >
/* Template files */
@import '../../../assets/dashboard/vendor/boxicons/css/boxicons.min.css';
@import '../../../assets/dashboard/vendor/quill/quill.snow.css';
@import '../../../assets/dashboard/vendor/quill/quill.bubble.css';
@import '../../../assets/dashboard/vendor/remixicon/remixicon.css';
@import '../../../assets/dashboard/vendor/simple-datatables/style.css';
@import '../../../assets/dashboard/css/style.css';

</style>

<template>
    <Loader/>
    <NavBar/>
    <SideBar role="user"/>
    <RouterView/>
    <FooterDashboard/>

</template>

<script >
// Template files
import '../../../assets/dashboard/vendor/apexcharts/apexcharts.min.js'
import '../../../assets/dashboard/vendor/chart.js/chart.umd.js'
import '../../../assets/dashboard/vendor/echarts/echarts.min.js'
import '../../../assets/dashboard/vendor/quill/quill.min.js'
import '../../../assets/dashboard/vendor/simple-datatables/simple-datatables.js'
import '../../../assets/dashboard/vendor/tinymce/tinymce.min.js'
import '../../../assets/dashboard/vendor/php-email-form/validate.js'
// Compoments 
import NavBar from '../../../components/Dashboard/NavBar.vue'
import SideBar from '../../../components/Dashboard/SideBar.vue'
import FooterDashboard from '../../../components/Dashboard/FooterDashboard.vue'
import Loader from '../../../components/Website/Loader.vue';
// Packages
import { RouterView } from 'vue-router'


export default {
    components: {
        NavBar, SideBar, FooterDashboard , Loader
    }

}
</script>