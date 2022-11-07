<template>
  <div class="mass-actions mt-3">
    <div class="mb-2">
      With selected:
    </div>

    <div class="flex flex-row">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: "MassActionsWrapper",

}
</script>

<style scoped>

</style>
