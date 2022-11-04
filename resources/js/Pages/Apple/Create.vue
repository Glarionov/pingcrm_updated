<template>
  <div>
    <Head title="Create Organization"/>
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/apples">Apples</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <div class="flex flex-wrap -mb-8 -mr-6 p-8">
        <input type="text" v-model="form.color">
        <form @submit.prevent="store">
          <FormConstructor :inputs="inputs" :form="form"/>
          <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
            <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Apple</loading-button>
          </div>
        </form>
      </div>
<!--      <form @submit.prevent="store">-->
<!--        <div class="flex flex-wrap -mb-8 -mr-6 p-8">-->
<!--          <text-input v-model="form.color" :error="form.errors.color" class="pb-8 pr-6 w-full lg:w-1/2" label="color"/>-->
<!--          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name"/>-->
<!--          &lt;!&ndash;                    <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />&ndash;&gt;-->
<!--          <text-input v-model="form.phone" :error="form.errors.phone" class="pb-8 pr-6 w-full lg:w-1/2" label="Phone"/>-->
<!--          <text-input v-model="form.address" :error="form.errors.address" class="pb-8 pr-6 w-full lg:w-1/2"-->
<!--                      label="Address"/>-->
<!--          <text-input v-model="form.city" :error="form.errors.city" class="pb-8 pr-6 w-full lg:w-1/2" label="City"/>-->
<!--          <text-input v-model="form.region" :error="form.errors.region" class="pb-8 pr-6 w-full lg:w-1/2"-->
<!--                      label="Province/State"/>-->
<!--          <select-input v-model="form.country" :error="form.errors.country" class="pb-8 pr-6 w-full lg:w-1/2"-->
<!--                        label="Country">-->
<!--            <option :value="null"/>-->
<!--            <option value="CA">Canada</option>-->
<!--            <option value="US">United States</option>-->
<!--          </select-input>-->
<!--          <text-input v-model="form.postal_code" :error="form.errors.postal_code" class="pb-8 pr-6 w-full lg:w-1/2"-->
<!--                      label="Postal code"/>-->
<!--        </div>-->
<!--        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">-->
<!--          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Organization-->
<!--          </loading-button>-->
<!--        </div>-->
<!--      </form>-->
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
    FormConstructor
  },
  // layout: Layout,
  remember: 'form',
  created() {
    this.setInputs();
  },
  data() {
    return {
      inputs: FormHelper.setNewLabels(validationRules, labels),
      form: this.$inertia.form({
        color: null,
        name: null,
        // email: null,
        phone: null,
        address: null,
        city: null,
        region: null,
        country: null,
        postal_code: null,
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/api/apples')
    },
    setInputs() {
      this.inputs = FormHelper.setNewLabels(validationRules, labels);
      // this.inputs['last_name'].element = 'Textarea';
    }
  },
}
</script>
