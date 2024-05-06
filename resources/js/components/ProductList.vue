
<script>

import axios from 'axios';

export default {
  data() {
    return {
      products: [],
      searchQuery: null,
      results: [],
    }
  },
  async created() {
    try {
      const response = await axios.get('/api/products');
      this.products = response.data;
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async deleteProduct(id) {
      try {
        await axios.delete(`/api/products/${id}`);
        this.products = this.products.filter(product => product.id !== id);
      } catch (error) {
        console.error(error);
      }
    },

    getResults(){
      axios.get('/products/' + this.searchQuery).then(res =>{
        this.results=res.data
      }).catch(error=>{
        this.results= this.products
      })
    }
  },
  watch:{
    searchQuery(after, before){
      this.getResults();
    }
  }
}

</script>
<template>
    <div class="card-body">
      <div class="row mb-3">
        <div class="col-4">
          <div class="input-group">
            <input v-model="searchQuery" type="text" class="form-control border-0 small" placeholder="Search for..."
            aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
              </div>
          </div>
        </div>
      </div>
      <div v-if="results.length > 0">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Category</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
                <tr v-for="result in results" :key="result.id">
                    <td>{{ result.name }}</td>
                    <td>{{ result.description }}</td>
                    <td>{{ result.category }}</td>
                    <td>
                      <div class="row gap-5 p-3">
                        <router-link :to="`/products/${result.id}`" class="p-2 col border btn btn-primary">View</router-link>
                        <router-link :to="`/products/${result.id}/edit`" class="p-2 col border btn btn-success">Edit</router-link>
                        <button @click="deleteProduct(result.id)" type="button" class="p-2 col border btn btn-danger">Delete</button>
                      </div>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>
      </div>
      <div class="table-responsive" v-else>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Category</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.name }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.category }}</td>
                    <td>
                      <div class="row gap-5 p-3">
                        <router-link :to="`/products/${product.id}`" class="p-2 col border btn btn-primary">View</router-link>
                        <router-link :to="`/products/${product.id}/edit`" class="p-2 col border btn btn-success">Edit</router-link>
                        <button @click="deleteProduct(product.id)" type="button" class="p-2 col border btn btn-danger">Delete</button>
                      </div>
                    </td>
                </tr>
            </tbody>
        </table>
      </div>
    </div>
</template>







