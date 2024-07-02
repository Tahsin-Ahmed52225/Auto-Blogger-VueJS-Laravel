<template>
  <main id="main" class="main">
    <DeleteModal :URL="deleteURL" title="Delete Category" @success="success" />
    <EditCategoryModal :form="formEditData" title="Edit Category" @success="success" />
    <Breadcrumb title="Categories" role="user" />
    <section class="section dashboard" style="min-height: 67vh">
      <div class="row h-100">
        <div class="col-4">
          <div class="card h-100">
            <div class="card-body">
              <form @submit.prevent="submit">
                <div class="mb-3">
                  <label for="categoryName" class="form-label">Category Name</label>
                  <input
                    v-model="formData.category_name"
                    type="text"
                    class="form-control"
                    id="categoryName"
                    aria-describedby="emailHelp"
                  />
                </div>
                <div class="mb-3">
                  <label for="categorySlug" class="form-label">Category Slug</label>
                  <input
                    v-model="formData.category_slug"
                    type="text"
                    class="form-control"
                    id="categorySlug"
                  />
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-8">
          <div class="card h-100">
            <div class="card-body">
              <DataTable
                :columns="columns"
                :ajax="categoryDataCall"
                class="display"
                ref="table"
                :options="{ select: false }"
              >
                <thead>
                  <tr>
                    <th>Category Name</th>
                    <th>Category Slug</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </DataTable>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import Breadcrumb from '../../../../components/Dashboard/Breadcrumb.vue'
import DeleteModal from '../../../../components/Dashboard/Modal/DeleteModal.vue'
import EditCategoryModal from '../../../../components/Dashboard/Modal/EditCategoryModal.vue'

import { Loader } from '../../../../state/Loader'
import { navInfoStore } from '../../../../state/NavInfo'
import { useModal } from '../../../../state/Modal'

import DataTable from 'datatables.net-vue3'
import { toast } from 'vue3-toastify'
import DataTablesLib from 'datatables.net'
import Select from 'datatables.net-select'

DataTable.use(Select)
DataTable.use(DataTablesLib)

export default {
  data() {
    return {
      formData: {
        category_name: '',
        category_slug: ''
      },
      categoryDataCall: {
        type: 'GET',
        url: `${import.meta.env.VITE_API_URL}/categories`,
        headers: {
          Authorization: `Bearer ${this.navInfo.token}`,
          'ngrok-skip-browser-warning': true
        },
        error: function (response) {
          console.log(response)
          // If error reload
          this.dt.ajax.url(`${import.meta.env.VITE_API_URL}/categories`).load()
        }
      },
      columns: [
        { data: 'category_name' },
        { data: 'category_slug', orderable: false },
        {
          data: null,
          orderable: false,
          render: function (data) {
            return (
              '<button class="delete btn btn-danger btn-sm me-2" data-id=' +
              data.id +
              '>Delete </button><button class="edit btn btn-primary btn-sm" data-cat="' +
              data.category_name +
              '" data-slug=' +
              data.category_slug +
              ' data-id=' +
              data.id +
              '>Edit</button>'
            )
          }
        }
      ],
      dt: null,
      deleteURL: null,
      formEditData: {
        url: null,
        data: {
          category_name: null,
          category_slug: null
        }
      }
    }
  },
  setup() {
    const navInfo = navInfoStore()
    const loader = Loader()
    const modal = useModal()

    return { navInfo, loader, modal }
  },
  components: {
    Breadcrumb,
    DataTable,
    DeleteModal,
    EditCategoryModal
  },
  methods: {
    submit() {
      // Activing the loader
      this.loader.toggleLoader(true)
      const config = {
        headers: { Authorization: `Bearer ${this.navInfo.token}` }
      }
      this.axios
        .post('categories', this.formData, config)
        .then((res) => {
          switch (res.data.status_code) {
            case '201':
              this.success(res.data)
              break
            case '400':
              this.error(res.data.data)
              break
            default:
              this.error()
              break
          }
        })
        .finally(() => {
          this.processing = false
        })
    },
    success(data) {
      this.loader.toggleLoader(false)
      this.dt.ajax.url(`${import.meta.env.VITE_API_URL}/categories`).load()
      toast.success(data.message)
      // Reset form 
      this.clearCreateFrom();
    },
    updateCategory(data) {
      alert(data)
    },
    error(data) {
      console.log(data)
    },
    clearCreateFrom() {
      this.formData = {
        category_name: '',
        category_slug: ''
      }
    }
  },
  mounted() {
    this.dt = this.$refs.table.dt
    this.dt.on('click', 'button.delete', (e) => {
      this.deleteURL = `categories/` + e.target.getAttribute('data-id')
      this.modal.openDelete()
    })
    this.dt.on('click', 'button.edit', (e) => {
      this.formEditData = {
        url: `categories/` + e.target.getAttribute('data-id'),
        data: {
          category_name: e.target.getAttribute('data-cat'),
          category_slug: e.target.getAttribute('data-slug')
        }
      }

      this.modal.openEdit()
    })
  }
}
</script>

<style lang="css">
@import 'datatables.net-dt';
</style>
