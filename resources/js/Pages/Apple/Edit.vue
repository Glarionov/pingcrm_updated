<template>
  <SingleResourceWrapper>
    <ResourceTopInfo href="/apples" group-name="Apples" section-name="Edit"/>
    <div class="flex flex-wrap -mb-8 -mr-6 p-8">
      <form @submit.prevent="update">
        <FormConstructor  :inputs="inputs"
                          v-model:form="form"
                          :values="mainObject"
        />
        <edit-button :form="form" />
      </form>
    </div>
  </SingleResourceWrapper>
</template>

<script>
import LoadingButton from '../../Shared/LoadingButton';
import FormConstructor from "@/Shared/Forms/FormConstructor";
import validationRules from "@/FormArrays/Apples";
import AppleMixin from "@/Pages/Apple/AppleMixin";
import EditMixin from "@/Mixins/ResourceMixins/EditMixin";
import EditButton from "@/Shared/Forms/Buttons/EditButton";
import SingleResourceWrapper from "@/Shared/Resources/SingleResourceWrapper";
import ResourceTopInfo from "@/Shared/Resources/ResourceTopInfo";

export default {
  name: 'Show',
  components: {
    FormConstructor,
    LoadingButton,
    EditButton,
    SingleResourceWrapper,
    ResourceTopInfo
  },
  mixins: [AppleMixin, EditMixin],
  data() {
    return {
      validationRules,
    }
  },
}
</script>

<style scoped>

</style>
