<template>
    <BaseModal v-if="modal.modalType === 'edit'">
        <template #title> {{ title }} </template>
        <template #body>
             <form @submit.prevent="submit">
                <div class="mb-3">
                    <label for="categoryName" class="form-label">Category Name</label>
                    <input v-model="form.data.category_name"   type="text" class="form-control" id="categoryName" aria-describedby="emailHelp" >
                </div>
                <div class="mb-3">
                    <label for="categorySlug" class="form-label">Category Slug</label>
                    <input v-model="form.data.category_slug"  type="text" class="form-control" id="categorySlug" >
                </div>
            </form>
        </template>
        <template #action>
            <button @click="modal.closeEdit()" type="button" class="btn btn btn-outline-secondary me-2">Close</button>
            <button @click="this.edit()" type="button" class="btn btn-primary">Save</button>
        </template>
    </BaseModal>
</template>
<script>
import BaseModal from './BaseModal.vue';

import { useModal } from "../../../state/Modal";
import { Loader } from "../../../state/Loader";

export default {
    props: {
        title: String,
        form: Object,
    },
    setup() {
        const loader = Loader();
        const modal = useModal();
        return { modal, loader }
    },
    components: {
        BaseModal
    },
    
    emits: ["success"],
    // mounted() {
    //     console.log(this.form);
    //     this.editData.category_name = this.form;
    // },
    methods: {
        edit() {
            this.modal.closeDelete();
            this.loader.toggleLoader(true);
            if (localStorage.getItem("token")) {
                const config = {
                    headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
                    'ngrok-skip-browser-warning': true,
                };
                const data = {
                    category_name: this.form.data.category_name,
                    category_slug: this.form.data.category_slug,

                };
                this.axios.put(this.form.url, data ,config).then((res) => {
                    switch (res.data.status_code) {
                        case "200": this.success(res.data); break;
                        case "400": this.error(res.data.data); break;
                        default: this.error(); break;
                    }
                }).finally(() => {
                    this.loader.toggleLoader(false);
                });

            } else {
                alert("Why you aren't logged in?");
            }
            
        },
        success(data) {
            this.$emit("success",data);
        }
    },
    
}
</script>