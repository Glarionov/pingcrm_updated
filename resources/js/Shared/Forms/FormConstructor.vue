<template>
  <div>
    <div v-for="(input, inputIndex) in inputs" :key="inputIndex" class="form-group">
      <FormElementDefaultTemplate v-model="this.$props.form[input.id]" :input-data="input" :form="form"/>
    </div>
  </div>
</template>

<script>

import FormElementDefaultTemplate from "@/Shared/Forms/FormElementDefaultTemplate";

export default {
  name: 'FormConstructor',
  components: {
    FormElementDefaultTemplate
  },
  // eslint-disable-next-line vue/require-prop-types
  props: ['inputs', 'form'],
  mounted() {
  },
  methods: {
    change() {
      this.$emit('update:modelValue', {color: 'zzz'});
    }
  },
  emits: ['update:form'],
}
</script>

<style scoped>

</style>
