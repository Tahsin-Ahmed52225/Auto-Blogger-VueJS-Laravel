<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a href="/" class="logo d-flex align-items-center">
              <!-- <img src="../../assets/img/logo.png" alt=""> -->
              <img src="../../../public/assets/img/logo.png" alt="">
              <span class="d-none d-lg-block">Travel Diary</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
          <ul class="navbar-nav  mb-2 mb-lg-0 ">
            <li class="nav-item">
              <RouterLink class="nav-link" to="/">Home</RouterLink>
            </li>
            <li class="nav-item">
                <RouterLink class="nav-link" to="/">Our Blog</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" to="/about">About Us</RouterLink>
            </li>
            
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <RouterLink class="dropdown-item" to="/about">About</RouterLink>
                </li>
              </ul>
            </li> -->
            <li class="nav-item dropdown" v-if="navInfo.isAuth">   
                <a  class="nav-link border border-2 rounded-1 dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <font-awesome-icon icon="fa-solid fa-user" /> {{ navInfo.userInfo.name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li>
                    <RouterLink class="dropdown-item" to="/user/dashboard">Dashboard</RouterLink>
                    <RouterLink class="dropdown-item" to="/about">Profile</RouterLink>
                    <a class="dropdown-item" @click="navInfo.logout">Logout</a>
                  </li>
                </ul>
            </li>
            <li class="nav-item" v-else>
                  <RouterLink  class="nav-link border border-2 rounded-1" to="/login">
                     Login/Register
                  </RouterLink>
            </li>
          </ul>
        </div>
      </div>
    </nav>
</template>

<script >
import { RouterLink } from 'vue-router';
import { navInfoStore } from "../../state/NavInfo";
export default {
  data() {
    return {
     'user': {}
    }
  },
  setup() {
    const navInfo = navInfoStore();
    return { navInfo };
  },
  };
</script>