<template>
  <input type="file" :class="inputData.class ?? cssClass" v-bind="{ ...inputData.attributes ?? {}}" :name="inputData.name ?? null"
         :id="inputData.id ?? null"
         @input="$emit('update:modelValue', $event.target.files[0])"
         @change="previewImage"
  >

  <div class="mt-1" v-if="previewImageValue || modelValue">
    <img :src="previewImageValue" class="image-preview" v-if="previewImageValue">
    <img :src="modelValue" class="image-preview" v-if="!previewImageValue && modelValue">
  </div>
</template>

<script>
export default {
  name: "Input",
  props: {
    inputData: {
      type: Object
    },
    modelValue: {}
  },
  computed: {
    cssClass() {
      return 'form-control';
    }
  },
  data() {
    return {
      previewImageValue: null,
      defaultImage: null
    }
  },
  mounted() {
    if (this.modelValue) {
      this.defaultImage = this.modelValue;
    }
  },
  emits: ['update:modelValue'],
  methods: {
    previewImage(e) {
      if (e.target.files.length) {
        const file = e.target.files[0];
        this.previewImageValue = URL.createObjectURL(file);
      } else {
        this.previewImageValue = null;
        if (this.defaultImage) {
          this.$emit('update:modelValue', this.defaultImage)
        }
      }

    },
  }
}
</script>

<style scoped>
  .image-preview {
    width: 100px;
  }
</style>
