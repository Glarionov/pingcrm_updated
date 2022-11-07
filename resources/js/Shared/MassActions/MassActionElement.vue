<template>
  <div class="change-size col-2">

    <form @submit.prevent="setNewSize">
      <div class="d-flex">
        Set size:
        <input type="text" class="form-control form-control-sm mx-2 w-25" v-model="newSize">
        <button type="submit" class="btn btn-success btn-sm ml-1">Submit</button>
      </div>

    </form>
  </div>
</template>

<script>
export default {
  name: "MassActionElement"
}
</script>

<style scoped>

</style>
