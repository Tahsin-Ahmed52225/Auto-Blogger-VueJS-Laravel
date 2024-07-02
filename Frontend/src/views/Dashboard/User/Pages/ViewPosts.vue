<template>
    <main id="main" class="main">
        <Breadcrumb title="Posts" role="user"/>

        <section class="section dashboard" style="min-height: 67vh;"> 
                <div class="row h-100">
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-title">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <RouterLink  to="/login">
                                       <button class="btn btn-primary me-md-2" type="button">Add New Post</button>
                                    </RouterLink>
                                    
                                </div>
                            </div>
                            <div class="card-body">
                                  <DataTable :data="values" class="display">
                                    <thead>
                                        <tr>
                                            <th>First</th>
                                            <th>Second</th>
                                        </tr>
                                    </thead>
                                </DataTable>
                            </div> 
                        </div>
                    </div>
                </div>
            </section>
    </main>
</template>
<script>
import { RouterLink } from 'vue-router';
import Breadcrumb from '../../../../components/Dashboard/Breadcrumb.vue';
import DataTable from 'datatables.net-vue3';
import Select from 'datatables.net-select';
DataTable.use(Select)
export default {
    data() {
        return {
            values: [
                [1, 2],
                [3, 4],
            ]
        }
    },
    setup() {
        //  DataTable.use(Select);
    },
    components: {
        Breadcrumb, DataTable
    },

}
</script>

<style lang="css">
@import "datatables.net-dt";
</style>