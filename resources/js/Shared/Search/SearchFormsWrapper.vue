<template>
  <div class="filters">
    <form @submit.prevent="search">
      <div class="flex flex-row d-flex">
        <slot></slot>
        <div class="basis-1/4 mt-2">
          <button type="submit" class="btn-indigo">Submit</button>
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
