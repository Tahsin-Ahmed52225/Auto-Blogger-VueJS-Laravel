<template>
    <div class="pagetitle">
            <h1>{{ title }}</h1>
            <nav>
            <ol class="breadcrumb" >
                <li class="breadcrumb-item text-capitalize" v-for="breadCrumb in breadCrumbList">
                    <RouterLink :to="'/' + this.role + '/'+breadCrumb">{{ breadCrumb }}</RouterLink>
                </li>
                <!-- <li class="breadcrumb-item active">Dashboard</li> -->
            </ol>
            </nav>
    </div>
</template>

<script>
import { getBreadCrumbList } from '../../helper'
export default {
    props: {
        title: String,
        role: String,
    },
    data(){
        return {
            breadCrumbList: [],
        }
    },
    mounted() {
        this.breadCrumbList = getBreadCrumbList(this.role);
    }
    
}
</script>