<template>
  <div>
    <Head title="Create Apple"/>
    <ResourceTopInfo href="/apples" group-name="Apples" section-name="Create"/>
    <div class="">
      <div class="flex flex-wrap -mb-8 -mr-6 p-8">
        <form @submit.prevent="store">
          <FormConstructor :inputs="inputs"
                           v-model:form="form"
          />
          <CreateButton :form="form" label="Create apple"/>
        </form>
      </div>

      <flash-messages/>
    </div>
  </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
import FormConstructor from "@/Shared/Forms/FormConstructor";
import TextInput from '../../Shared/TextInput';
import SelectInput from '../../Shared/SelectInput';
import LoadingButton from '../../Shared/LoadingButton';
import validationRules from "@/FormArrays/Apples";
import FormHelper from "@/Helpers/FormHelper";
import PassModelTest from "@/Test/PassModelTest";
import FormElementDefaultTemplate from "@/Shared/Forms/FormElementDefaultTemplate";
import FlashMessages from '@/Shared/FlashMessages'
import DefaultLayout from "@/Shared/DefaultLayout";
import AppleMixin from "@/Pages/Apple/AppleMixin";
import CreateMixin from "@/Mixins/ResourceMixins/CreateMixin";
import CreateButton from "@/Shared/Forms/Buttons/CreateButton";
import ResourceTopInfo from "@/Shared/Resources/ResourceTopInfo";

export default {
  components: {
    Head,
    FormConstructor,
    FlashMessages,
    CreateButton,
    ResourceTopInfo
  },
  mixins: [AppleMixin, CreateMixin],
  layout: DefaultLayout,
  data() {
    return {
      validationRules
    }
  },

}
</script>
