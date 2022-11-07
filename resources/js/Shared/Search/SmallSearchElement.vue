<template>
  <div class="col-2 mr-2">
    <div class="mb-2">
      {{label}}
    </div>
<!--    <input type="text"-->
<!--           class="form-control form-control-sm w-50"-->
<!--           v-model="inputVal">-->

    <component :is="inputElement" :inputData="inputData" v-model="inputVal"/>
  </div>
</template>

<script>

import Input from "@/Shared/Forms/Input";
import Select from "@/Shared/Forms/Select";

export default {
  name: "SmallSearchElement",
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
