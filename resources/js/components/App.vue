<script>
export default {
  name: 'App'
}
</script>
<template>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
      <div class="d-flex flex-row-reverse">
      <router-link to="/products/create" class="btn btn-success " style="text-decoration: none;">Add Product</router-link>
      </div>
    <router-view></router-view>
    </div>
  </div>
</template>

<style>

</style>
    
