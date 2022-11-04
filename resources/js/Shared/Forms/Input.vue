<template>
  <input :type="inputData.type" class="form-input border" v-bind="{ ...inputData.attributes}" :name="inputData.name" :id="inputData.id"
         :value="modelValue" @input="$emit('update:modelValue')"
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
