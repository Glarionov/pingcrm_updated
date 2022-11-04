<template>
  <textarea class="border" v-bind="{ ...inputData.attributes}" :name="inputData.name" :id="inputData.id"
            @model="inputData.value"
  >
  </textarea>
</template>

<script>
export default {
  name: "Input",
  props: {
    inputData: {
      type: Object
    }
  }
}
</script>

<style scoped>

</style>
