<template>
  <div class="mt-3 row">
    <div class="col-12 col-md-3">
      <label v-if="inputData.label" class="form-label" :for="inputData.id">
        {{inputData.label}}<span v-if="inputData.required" class="text-red-600">*</span>
      </label>

    </div>
    <div class="col-12 col-md-9">
      <slot></slot>
    </div>
    <div v-if="form.errors[inputData.id]" class="form-error col-span-12">{{ form.errors[inputData.id] }}</div>
  </div>
</template>

<script>
export default {
  name: "FormElementDefaultWrapper",
  props: {
    inputData: {
      type: Object
    },
    form: Object
  }
}
</script>

<style scoped>

</style>
