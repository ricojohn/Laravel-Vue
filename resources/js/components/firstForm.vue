<script>
</script>

<template >
    <div class="mb-3">
        <label for="name" class="form-label">Name: </label>
        <input class="form-control" type="text" id="name"   required />
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea class="form-control" id="description"   required></textarea>
    </div>
    <div class="mb-3">
        <select
        id="category"
        name="category"
        class="form-select"
        >
        <option>Category1</option>
        <option>Category2</option>
        <option>Category3</option>
    </select>
    </div>
</template>  

