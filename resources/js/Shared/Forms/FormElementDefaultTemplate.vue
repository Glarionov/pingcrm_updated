<template>
  <FormElementDefaultWrapper :inputData="inputData">
    modelValue1={{modelValue}}
    <component :is="inputData.element" :inputData="inputData" v-model="modelValue"/>
  </FormElementDefaultWrapper>
</template>

<script>

import Input from "@/Shared/Forms/Input";
import Textarea from "@/Shared/Forms/Textarea";
import FormElementDefaultWrapper from "@/Shared/Forms/FormElementDefaultWrapper";

export default {
  name: "FormElementDefaultTemplate",
  components: {
    Input,
    Textarea,
    FormElementDefaultWrapper
  },
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
