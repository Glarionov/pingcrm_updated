<template>
  <div class="main">
    <div class="not-found" v-if="!success && errorType === 'not_found'">
      Not found
    </div>
    <div class="found" v-else>
      <slot></slot>
    </div>
  </div>
</template>
<script>

export default {
  name: "SingleResourceWrapper"
}
</script>

<style scoped>

</style>
