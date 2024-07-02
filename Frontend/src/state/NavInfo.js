import { defineStore } from "pinia";
// import { Loader } from "../../../state/Loader";
import { Loader } from "../state/Loader";
export const  navInfoStore = defineStore({
    id: "navInfoStore",
    state: () => ({
      userInfo: JSON.parse(localStorage.getItem("userData")) || {},
      token :localStorage.getItem("token"),
      isAuth: localStorage.hasOwnProperty('token'),
      activePage: "/",
    }),
    getters: {
        //
    },
    actions: {
      logout() {
        const loader = Loader();
        loader.toggleLoader(true);
        this.$axios.post("logout").then((res) => {
          this.dataRemove();
          this.$router.push({ path: "/" })
          // if (res.data.status_code == 200 || res.data.status_code == 401) {
          //   this.dataRemove();
          //   this.$router.push({ path: "/" })
          // } else {
          //   alert('Invalid');
          // }
        }).finally(() => {
          loader.toggleLoader(false);
          this.processing = false
        });
    },
    error(err = '') {
      dataRemove();
    },
    dataRemove() {
      localStorage.removeItem('token');
      localStorage.removeItem('userData');
      this.isAuth = false;
      this.userInfo = {};
    }
    },  
})