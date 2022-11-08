<template>
  <input :type="inputData.type ?? 'text'" :class="inputData.class ?? cssClass" v-bind="{ ...inputData.attributes ?? {}}" :name="inputData.name ?? null"
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
    modelValue: {}
  },
  computed: {
    cssClass() {
      if (this.$props.inputData.type === 'checkbox') {
        return '';
      }
      return 'form-control';
    }
  },
  emits: ['update:modelValue'],
}
</script>

<style scoped>

</style>
