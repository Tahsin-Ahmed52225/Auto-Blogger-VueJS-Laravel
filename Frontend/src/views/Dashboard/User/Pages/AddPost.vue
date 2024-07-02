<template>
  <main id="main" class="main">
    <Breadcrumb title="Posts" role="user" />

    <section class="section dashboard" style="min-height: 67vh">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-9">
                  <input
                    v-model="post.title"
                    type="email"
                    class="form-control mb-3"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                  />
                  <QuillEditor :options="options" v-model:content="post.description" contentType="html"/>
                </div>
                <div class="col-3">
                  <div class="row mb-3">
                    <div class="col-6">
                      <button type="button" class="btn btn-primary w-100" @click="savePost('Publish')">Publish Post</button>
                    </div>
                    <div class="col-6">
                      <button type="button" class="btn btn-outline-dark w-100" @click="savePost('Draft')">Draft Post</button>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-body">
                     <div class="h6">
                         Select Category
                     </div>
                     <div>
                          <ul class="list-group category-card">
                            <li class="list-group-item" v-for="data in categories">
                              <input @click="selectCategories(data.id)"  class="form-check-input me-1" type="checkbox" aria-label="...">
                              {{ data.category_name }}
                            </li>
                          </ul>
                     </div> 
                    </div>
                  </div>
                  <div class="card">
                      <div class="card-body image-card">
                        <div class="h6">
                           Select Post Cover
                        </div>
                         <ImageUploader @imageData="imageUpload"></ImageUploader>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>
<script>
import Breadcrumb from '../../../../components/Dashboard/Breadcrumb.vue'
import ImageUploader from '../../../../components/Dashboard/ImageUploader.vue'
import { QuillEditor } from '@vueup/vue-quill'
import { toast } from 'vue3-toastify'
import '@vueup/vue-quill/dist/vue-quill.snow.css'

import { Loader } from '../../../../state/Loader'
import { navInfoStore } from '../../../../state/NavInfo'
export default {
  data() {
    const toolbarOptions = [
      ['bold', 'italic', 'underline', 'strike'], // toggled buttons
      ['blockquote', 'code-block'],
      ['link', 'image',],
      [{ list: 'ordered' }, { list: 'bullet' }],
      [{ script: 'sub' }, { script: 'super' }], // superscript/subscript
      [{ color: [] }, { background: [] }], // dropdown with defaults from theme
      [{ align: [] }],
      [{ header: [1, 2, 3, 4, 5, 6, false] }],
      [{ font: [] }],
    ]
    return {
      options: {
        debug: 'info',
        modules: {
          toolbar: toolbarOptions
        },
        placeholder: 'Write your post...',
        theme: 'snow'
      },
      categories: [],
      post: {
        title: '',
        description: '',
        cover_image: '',
        categories: [],
        status: '',
        user_id : '',
      }
    }
  },
  setup() {
    const loader = Loader();
    const navInfo = navInfoStore();
    return {loader, navInfo }
  },
  components: {
    Breadcrumb,
    QuillEditor,
    ImageUploader,
  },
  mounted(){
    this.getCategory()
  },
  methods: {
    getCategory() {
      this.loader.toggleLoader(true);
      const config = {
        headers: {
          Authorization: `Bearer ${this.navInfo.token}`,
          'ngrok-skip-browser-warning': true
        },
      };
      this.axios
        .get('categories',config)
        .then((res) => {
          switch (res.data.status_code) {
            case '200':
              this.loader.toggleLoader(false);
              this.categories = res.data.data;
              break
            case '400':
              this.loader.toggleLoader(false)
              console.log(res.data);
              break
            default:
              this.loader.toggleLoader(false)
              break
          }
        })
    },
    savePost(status) { 
      this.loader.toggleLoader(true);
      if (this.validatePostData()) {
        let payload = JSON.stringify({
          title: this.post.title,
          description: this.post.description,
          categories: this.post.categories,
          status: status,
          user_id: this.navInfo.userInfo.id,
        });
        const postData = new FormData();
        postData.append("payload", payload);
        postData.append("cover_image", this.post.cover_image);
        // Calling Add post API
        const config = {
          headers: {
            Authorization: `Bearer ${this.navInfo.token}`,
           'Content-Type': 'multipart/form-data'
          },
        };
        this.axios
          .post('posts',postData, config)
          .then((res) => {
            switch (res.data.status_code) {
              case '201':
                this.success(res.data);
                break
              case '400':
                this.error(res.data);
                break
              default:
                this.error(res.data);
                break
            }
          })
      }
    },
    selectCategories(id) {
      console.log(id);
      //in here you can check what ever condition  before append to array.
      if (this.post.categories.includes(id)) {
        this.post.categories = this.post.categories.filter(id => id % 2 !== 0)
      } else {
        this.post.categories.push(id);
      }
    },
    // Write validation logic
    validatePostData() {
      return true;
    },
    imageUpload(e) {
      this.post.cover_image = e;
    },
    success(data) {
      this.loader.toggleLoader(false);
      toast.success(data.message);
    },
    error(data) {
      this.loader.toggleLoader(false);
      toast.success(data.message);
    },
  }
}
</script>

<style>
 .ql-container {
  height: 77% !important;
}
.category-card{
  height: 300px !important;
  overflow-y: scroll;
  font-size: 12px !important;
}
</style>
