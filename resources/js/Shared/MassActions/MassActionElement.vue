<template>
  <div class="col-12 col-sm-6 col-md-4 col-lg-3 mr-2">
    <form @submit.prevent="mainAction">
      <div class="d-flex">
        <div class="mb-2">
          {{label}}
        </div>
        <div class="mb-2 ml-2">
          <component :is="inputElement" :inputData="inputData" v-model="inputVal"/>
        </div>
        <div class="ml-2">
          <button type="submit" class="btn btn-success">Submit</button>
      </div>
      </div>


    </form>
  </div>
</template>

<script>

import Input from "@/Shared/MassActions/Input";

export default {
  name: "MassActionElement",
  components: {
    Input
  },
  props: {
    label: String,
    modelValue: String,
    inputElement: {
      type: String,
      default: 'Input'
    },
    inputData: {
      type: Object,
      default: () => {return {type: 'text'}}
    },
    mainAction: {
      type: Function
    }
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
  methods: {
    mainAction2() {

      // todo r
      this.$props.mainAction();
    }
  }
}
</script>

<style scoped>

</style>
