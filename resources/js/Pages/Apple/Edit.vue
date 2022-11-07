<template>
  <div class="main">
    <div class="not-found" v-if="!success && error_type === 'not_found'">
      Not found
    </div>
    <div class="found" v-else>
      <div class="flex flex-wrap -mb-8 -mr-6 p-8">
        <form @submit.prevent="store">
          <FormConstructor  :inputs="inputs"
                            v-model:form="form"
                            :values="mainObject"
          />
          <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
            <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Apple</loading-button>
          </div>
        </form>
      </div>

      Here is an apple. It's color = {{ mainObject.color }}
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
