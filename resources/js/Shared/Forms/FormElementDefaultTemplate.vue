<template>
  <FormElementDefaultWrapper :inputData="inputData" :form="form">
    <component :is="inputData.element" :inputData="inputData" v-model="inputVal"/>
  </FormElementDefaultWrapper>
</template>

<script>

import Input from "@/Shared/Forms/Input";
import Textarea from "@/Shared/Forms/Textarea";
import FormElementDefaultWrapper from "@/Shared/Forms/FormElementDefaultWrapper";
import PassModelTest from "@/Test/PassModelTest";
import Select from "@/Shared/Forms/Select";

export default {
  name: "FormElementDefaultTemplate",
  components: {
    Input,
    Select,
    Textarea,
    FormElementDefaultWrapper,
    PassModelTest
  },
  props: {
    inputData: {
      type: Object
    },
    modelValue: String,
    form: Object,
  },
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
  emits: ['update:modelValue'],
}
</script>

<style scoped>

</style>
