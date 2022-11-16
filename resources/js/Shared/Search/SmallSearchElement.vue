<template>
  <div class="col-2 col-lg-1 mr-3">
    <div class="mb-2">
      {{ label }}
    </div>
    <component :is="inputElement" v-model="inputVal" :input-data="inputData" />
  </div>
</template>

<script>

import Input from "@/Shared/Forms/Input";
import Select from "@/Shared/Forms/Select";

export default {
  name: 'SmallSearchElement',
  components: {
    Input,
    Select,
  },
  props: {
    modelValue: String,
    label: String,
    inputElement: {
      type: String,
      default: 'Input'
    },
    inputData: {
      type: Object,
      default: () => {return {}}
    }
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
