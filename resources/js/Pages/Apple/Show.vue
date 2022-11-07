<template>
  <div class="main">
    <div class="not-found" v-if="!success && error_type === 'not_found'">
      Not found
    </div>
    <div class="found" v-else>
      Here is an apple.
      <div class="row">
        <div class="col-5">
          Color:
        </div>
        <div class="col-4">
          {{ mainObject.color }}
        </div>
      </div>
      <div class="row">
        <div class="col-5">
          Size:
        </div>
        <div class="col-4">
          {{ mainObject.size }}
        </div>
      </div>
      <div class="row">
        <div class="col-5">
          Weight:
        </div>
        <div class="col-4">
          {{ mainObject.weight }}
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import LoadingButton from '../../Shared/LoadingButton';
import FormConstructor from "@/Shared/Forms/FormConstructor";
import validationRules from "@/FormArrays/Apples";
import FormHelper from "@/Helpers/FormHelper";

let labels = {
  first_name: 'First name',
  last_name: 'Last name',
};

export default {
  name: 'Show',
  components: {
    FormConstructor,
    LoadingButton
  },
  // eslint-disable-next-line vue/require-prop-types,vue/prop-name-casing
  props: ['success', 'error_type', 'mainObject'],
  data() {
    return {
      inputs: FormHelper.setNewLabels(validationRules, labels),
      form: this.$inertia.form({
        color: this.$props.mainObject.color,
        size:  this.$props.mainObject.size,
        weight:  this.$props.mainObject.weight,
      }),
    }
  },
  methods: {
    setInputs() {
      this.inputs = FormHelper.setNewLabels(validationRules, labels);
    }
  }
}
</script>

<style scoped>

</style>
