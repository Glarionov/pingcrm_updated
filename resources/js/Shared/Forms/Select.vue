<template>
  <select class="form-input border" v-bind="{ ...inputData.attributes ?? {}}" :name="inputData.name ?? null" :id="inputData.id ?? null"
         :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
  >
    <option disabled selected>
      Select value
    </option>
    <option v-for="(option, optionIndex) in inputData.options" :key="optionIndex" :value="option.value">
      {{ option.text }}
    </option>
  </select>
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
