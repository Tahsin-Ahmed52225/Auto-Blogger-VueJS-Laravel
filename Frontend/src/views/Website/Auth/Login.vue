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
                                            <h3 class="h4 font-weight-bold text-theme">Login</h3>
                                        </div>

                                        <h6 class="h5 mt-2 mb-5">Welcome back!</h6>

                                        <form @submit.prevent="submit">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
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
                                            <button type="submit" class="btn btn-primary" :disabled="processing">{{ processing ? 'Loading..' : 'Login'  }}</button>
                                            <RouterLink class="forgot-link float-right text-primary mx-4" to="/forget-password">Forgot password?</RouterLink>
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

                    <p class="text-muted text-center mt-3 mb-3">Don't have an account? 
                        <RouterLink class="text-primary ml-1" to="/register">register</RouterLink>
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
// States
import { navInfoStore } from "../../../state/NavInfo";
import { Loader } from "../../../state/Loader";
export default {
    data() {
        return {
            data: {
                email: 'hi@hello.com',
                password: '1122334455',
            },
            validationErrors: {},
            processing: false
        }
    },
    setup() {
        const navInfo = navInfoStore();
        const loader = Loader();
        return { navInfo,loader};
    },
    methods: {
        submit() {
            this.loader.toggleLoader(true);
            this.processing = true
            this.axios.post("login", this.data).then((res) => {
                switch (res.data.status_code) {
                    case "200": this.signIn(res.data.data); break;
                    case "400": this.error(res.data.data); break;
                    default: this.error(); break;
                }
            }).finally(() => {
                this.loader.toggleLoader(false);
                this.processing = false
            });
        },
        signIn(data) {
            localStorage.setItem('token', data.token);
            localStorage.setItem('userData', JSON.stringify(data.user));
            this.navInfo.userInfo = data.user;
            this.navInfo.token = data.token;
            this.navInfo.isAuth = true;
            this.$router.push({ path: "/user/dashboard" })
        },
        error(data = null) {
            console.log("I am having a problem");
        }
    }
}

</script>
<style scoped>
#body{
    margin-top:80px;
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
}

</style>