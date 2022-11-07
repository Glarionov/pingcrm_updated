<template>
  <div class="basis-1/6 mr-2">
    <div class="mb-2">
      {{label}}
    </div>

    <!--                        <input type="text" class="form-control-sm mx-2 w-25" v-model="filter.filter.size[0]">-->
    <input type="text"
           class="form-control form-control-sm w-25"
           v-model="inputVal">

    <!--            <input class="relative px-6 py-3 w-full rounded-r focus:shadow-outline"-->
    <!--                   autocomplete="off" type="text" name="search" placeholder="Search…" -->
    <!--                   :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />-->

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
