<template>
    <!-- ======= Sidebar ======= -->
      <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
            <RouterLink  :to="'/' + this.role + '/dashboard'" class="nav-link">Dashboard</RouterLink>
          </li><!-- End Dashboard Nav -->

          <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#blog-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-menu-button-wide"></i><span>Blogs</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="blog-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                  <a class=" collapsed" data-bs-target="#blog-post" data-bs-toggle="collapse" href="#">
                    Posts
                  </a>
                  <ul id="blog-post" class="nav-content collapse ps-3" data-bs-parent="#blog-nav">
                    <li>
                      <RouterLink :to="'/' + this.role + '/posts/add'">Add Post</RouterLink>
                    </li>
                    <li>
                      <RouterLink :to="'/' + this.role + '/posts/view'">View Post</RouterLink>
                    </li>
                  </ul>
              </li>
              <li>
                <RouterLink :to="'/' + this.role + '/categoires'">Categoires</RouterLink>
              </li>
            </ul>
          </li><!-- End Components Nav -->
        </ul>

      </aside><!-- End Sidebar-->
</template>

<script>
import { RouterLink } from 'vue-router';
export default {
  props: {
    role: "string",
  },

}
</script>


