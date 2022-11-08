<template>
  <div>
    <Head title="Create Apple"/>
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/apples">Apples</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <div class="flex flex-wrap -mb-8 -mr-6 p-8">
        <form @submit.prevent="store">
          <FormConstructor  :inputs="inputs"
                                       v-model:form="form"
          />
          <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
            <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Apple</loading-button>
          </div>
        </form>
      </div>

      <flash-messages />
    </div>
  </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
import FormConstructor from "@/Shared/Forms/FormConstructor";
// import Layout from "../../Shared/Layout";
import TextInput from '../../Shared/TextInput';
import SelectInput from '../../Shared/SelectInput';
import LoadingButton from '../../Shared/LoadingButton';
import validationRules from "@/FormArrays/Apples";
import FormHelper from "@/Helpers/FormHelper";
import PassModelTest from "@/Test/PassModelTest";
import FormElementDefaultTemplate from "@/Shared/Forms/FormElementDefaultTemplate";
import FlashMessages from '@/Shared/FlashMessages'
import DefaultLayout from "@/Shared/DefaultLayout";
let labels = {
  first_name: 'First name',
  last_name: 'Last name',
};

export default {
  components: {
    PassModelTest,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    FormConstructor,
    FormElementDefaultTemplate,
    FlashMessages
  },
  layout: DefaultLayout,
  remember: 'form',
  created() {
    this.setInputs();
  },
  data() {
    return {
      inputs: FormHelper.setNewLabels(validationRules, labels),
      form: this.$inertia.form(
        FormHelper.setDefaultValues(validationRules)
      //   {
      //   color: null,
      //   size: null,
      //   weight: null,
      //   is_eaten: null,
      //   quality_id: null
      // }
      ),
    }
  },
  methods: {
    store() {
      this.form.post('/api/apples')
    },
    setInputs() {
      this.inputs = FormHelper.setNewLabels(validationRules, labels);
    }
  },
}
</script>
