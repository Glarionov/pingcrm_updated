<template>
  <div class="filters">
    <form @submit.prevent="search">
      <div class="flex flex-row d-flex">
        <slot></slot>
        <div class="position-relative ml-4">
          <button type="submit" class="btn btn-success position-absolute bottom-0">Submit</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "SearchFormsWrapper",
  methods: {
    search() {
      this.$parent.search();
    }
  }
}
</script>

<style scoped>

</style>
