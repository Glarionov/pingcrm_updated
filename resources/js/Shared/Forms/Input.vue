<template>
  <input :type="inputData.type ?? 'text'" class="form-input border" v-bind="{ ...inputData.attributes ?? {}}" :name="inputData.name ?? null"
         :id="inputData.id ?? null"
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
