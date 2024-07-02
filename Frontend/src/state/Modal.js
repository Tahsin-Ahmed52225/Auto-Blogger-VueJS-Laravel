import { defineStore } from "pinia";
export const useModal = defineStore({
    id: "useModal",
    state: () => ({
        isOpen: false,
        modalType: ""
    }),
    getters: {
        //
    },
    actions: {
        openDelete() {
            this.isOpen = true;
            this.modalType = "delete";
        },
        closeDelete() {
            this.isOpen = false;
            this.modalType = "";
        },
        openEdit() {
            this.isOpen = true;
            this.modalType = "edit";
        },
        closeEdit() {
            this.isOpen = false;
            this.modalType = "";
        },
    },  
})