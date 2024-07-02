<template>
    <div id="body">
        <div id="main-wrapper" class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="card border-1">
                        <div class="card-body p-0">
                            <div class="row no-gutters">
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="mb-5">
                                            <h3 class="h4 font-weight-bold text-theme">Register</h3>
                                        </div>

                                        <h6 class="h5 mt-2 mb-5">Didn't have an account ?</h6>

                                        <form @submit.prevent="submit">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Name</label>
                                                <input type="text" class="form-control" id="exampleInput1"
                                                    v-model="data.name" 
                                                    name="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    v-model="data.email" 
                                                    name="email">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1"
                                                    v-model="data.password"      
                                                    name="password">
                                            </div>
                                            <button type="submit" class="btn btn-primary" :disabled="processing">{{
                                                processing ? 'Loading..' : 'Register' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-lg-6 d-none d-lg-inline-block">
                                    <div class="account-block ">
                                        <div class="overlay"></div>
                                        <div class="account-testimonial">

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <p class="text-muted text-center mt-3 mb-3">Already have an account ?
                        <RouterLink class="text-primary ml-1" to="/login">Login</RouterLink>
                    </p>

                    <!-- end row -->

                </div>
                <!-- end col -->
            </div>
            <!-- Row -->
        </div>
    </div>
</template>

<script>
import { navInfoStore } from "../../../state/NavInfo";
import { Loader } from "../../../state/Loader";
export default {
      data() {
        return {
            data: {
                name: "",
                email: "",
                password: "",
            },
            validationErrors: {},
            processing: false
        }
    },
    setup() {
        const navInfo = navInfoStore();
        const loader = Loader();
        return { navInfo, loader };
    },
    methods: {
        submit() {
            this.validateFormSubmit();
            this.loader.toggleLoader(true);
            this.processing = true;
            this.axios.post("register", this.data).then((res) => {
                switch (res.data.status_code) {
                    case "201": this.signUp(res.data.data); break;
                    case "400": this.error(res.data.data); break;
                    default: this.error(); break;
                }
            }).finally(() => {
                this.loader.toggleLoader(false);
                this.processing = false
            });
        },
        signUp(data) {
            this.$router.push({ path: "/login" })
        },
        error(data = null) {
            console.log("I am having a problem");
        },
        validateFormSubmit() {
        },
    }
    

}
</script>

<style scoped>
#body {
    margin-top: 80px;
}

.account-block {
    padding: 0;
    background-image: url(https://bootdey.com/img/Content/bg1.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    height: 100%;
    position: relative;
}

.account-block .overlay {
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.4);
}

.account-block .account-testimonial {
    text-align: center;
    color: #fff;
    position: absolute;
    margin: 0 auto;
    padding: 0 1.75rem;
    bottom: 3rem;
    left: 0;
    right: 0;
}

.text-theme {
    color: #5369f8 !important;
}</style>