<template>
  <div class="pass-model">
    <input class="border" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
  </div>
</template>

<script>
export default {
  name: "PassModelTest",
  props: {
    modelValue: String
  },
  emits: ['update:modelValue'],
}
</script>

<style scoped>

</style>
