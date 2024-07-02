<template>
    
    <BaseModal v-if="modal.modalType === 'delete'">
      <template #title> {{ title }} </template>
      <template #body>
              Are you sure you want to delete ?  
      </template>
      <template #action>
         <button @click="modal.closeDelete()" type="button" class="btn btn btn-outline-secondary me-2">Close</button>
         <button @click="this.delete()" type="button" class="btn btn-primary">Yes,Sure</button>
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
    URL: String,
  },
  setup() {
    const loader = Loader();
    const modal = useModal();
    return { modal, loader}
  },
  components: {
      BaseModal
  },
  
  emits: ["success"],
  methods: {
    delete() {
      // Activing the loader
      this.modal.closeDelete();
      this.loader.toggleLoader(true);
      if (localStorage.getItem("token")) {
        const config = {
          headers: { Authorization: `Bearer ${localStorage.getItem("token")}` }
        };
        this.axios.delete(this.URL, config).then((res) => {
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
  }
}
</script>