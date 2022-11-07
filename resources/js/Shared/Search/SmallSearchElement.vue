<template>
  <div class="basis-1/6 mr-2">
    <div class="mb-2">
      {{label}}
    </div>
    <input type="text"
           class="form-control form-control-sm w-50"
           v-model="inputVal">
  </div>
</template>

<script>
export default {
  name: "SmallSearchElement",
  props: {
    modelValue: String,
    label: String
  },
  emits: ['update:modelValue'],
  computed: {
    inputVal: {
      get() {
        return this.modelValue;
      },
      set(val) {
        this.$emit('update:modelValue', val);
      }
    }
  },
}
</script>

<style scoped>

</style>
