<template>
  <div class="mt-2 grid grid-cols-12">
    <div class="col-span-4">
      <label v-if="inputData.label" class="form-label" :for="inputData.id">
        {{inputData.label}}<span v-if="inputData.required" class="text-red-600">*</span>
      </label>

    </div>
    <div class="col-span-6">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: "FormElementDefaultWrapper",
  props: {
    inputData: {
      type: Object
    }
  }
}
</script>

<style scoped>

</style>
