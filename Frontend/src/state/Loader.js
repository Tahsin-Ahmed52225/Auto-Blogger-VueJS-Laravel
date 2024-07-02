import { defineStore } from "pinia";
export const Loader = defineStore({
    id: "loader",
    state: () => ({
        isLoading: false,
    }),
    getters: {
        //
    },
    actions: {
        toggleLoader(show)  {
            this.isLoading = show;
        }
    },  
})