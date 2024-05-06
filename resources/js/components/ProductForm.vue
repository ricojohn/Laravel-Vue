<script >
import axios from 'axios';
  export default {
    data() {
      return {
        activePhase: 1,
        product: {
          name: '',
          description: '',
          category: '',
          img: [],
          date_time: '',
        }
      }
    },
    computed: {
      isNewProduct() {
        return !this.$route.path.includes('edit');
        this.activePhase = 1;
      }
    },
    async created() {
      if (!this.isNewProduct) {
        const response = await axios.get(`/api/products/${this.$route.params.id}`);
        this.product = response.data;
      }
    },
    methods: {
      async submitForm() {
        try {
          if (this.isNewProduct) {
            await axios.post('/api/products', this.product);
          } else {
            await axios.put(`/api/products/${this.$route.params.id}`, this.product);
          }
          this.$router.push('/dashboard');
        } catch (error) {
          console.error(error);
        }
      },
      goToStep: function(step) {
        this.activePhase = step;
      }
    }
  }

</script>

<template>
    <div>
      <h2 v-if="isNewProduct">Add Product</h2>
      <h2 v-else>Edit Product</h2>
      
      <form @submit.prevent="submitForm">
        <template v-if='activePhase == 1'>
          <div class="mb-3">
              <label for="name" class="form-label">Name: </label>
              <input class="form-control" type="text" id="name" v-model="product.name"  required />
          </div>
          <div class="mb-3">
              <label for="description" class="form-label">Description:</label>
              <textarea class="form-control" id="description" v-model="product.description"  required></textarea>
          </div>
          <div class="mb-3">
              <select
              id="category"
              name="category"
              v-model="product.category"
              class="form-select"
              >
              <option>{{product.category}}</option>
              <option>Category1</option>
              <option>Category2</option>
              <option>Category3</option>
            </select>
          </div>
          <button type="button" @click.prevent="goToStep(2)" class="btn btn-primary">Continue</button>
        </template>
            
        <template v-if='activePhase == 2'>
          <div class="form-group col">
              <label>IMG </label><input type="file" v-on:change="product.img" class="form-control">
          </div>
          <button type="button" @click.prevent="goToStep(1)" class="btn btn-warning">Back</button>
          <button type="button" @click.prevent="goToStep(3)" class=" ml-2 btn btn-primary">Continue</button>
        </template>

        <template v-if='activePhase == 3'>
          <div class="form-group col">
              <label>Date and Time </label><input type="datetime-local" v-model="product.date_time" class="form-control">
          </div>
          <button type="button" @click.prevent="goToStep(2)" class="mr-2 btn btn-warning">Back</button>
          <button type="submit" v-if="isNewProduct" class="btn btn-primary">Add Product</button>
          <button type="submit" v-else class="btn btn-primary">Update Product</button>
        </template>
        <!-- <firstForm v-if='activePhase == 1'/> -->
        <!-- <secondForm v-if='activePhase == 2'/> -->
        <!-- <thirdForm v-if='activePhase == 3'/> -->
        <!-- <button type="button" @click.prevent="" class="btn btn-primary">Continue</button> -->
        </form>
    </div>
  </template>
  
  