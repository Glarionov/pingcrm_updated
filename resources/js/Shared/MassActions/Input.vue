<template>
  <input type="text" class="form-control form-control-sm"
         :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
  >
</template>

<script>
export default {
  name: "Input",
  props: {
    inputData: {
      type: Object
    },
    modelValue: String
  },
  emits: ['update:modelValue'],
}
</script>

<style scoped>

</style>
