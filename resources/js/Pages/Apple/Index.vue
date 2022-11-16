<template>
  <div>
    <Head title="Apples" />
    <h1 class="mb-8 text-3xl font-bold">Apples</h1>

    <SearchFormsWrapper>
      <SmallSearchElement v-model="filter.size[0]" label="Size min:" />
      <SmallSearchElement v-model="filter.size[1]" label="Size max:" />
      <SmallSearchElement v-model="filter.weight" label="Weight:" />
      <SmallSearchElement v-model="filter.color" label="Color:" />
      <SmallSearchElement v-model="filter.quality_id" label="Quality:" input-element="Select" :input-data="validationRules.quality_id"/>
    </SearchFormsWrapper>

    <div class="justify-content-around d-flex flex-column mb-6 mt-2">

        <Link href="/apples/create">
          <div class="btn btn-success">
          <span>Create</span>
          <span class="hidden md:inline">&nbsp;Apple</span>
          </div>
        </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <BaseTableWrapper
        :default-col-names="defaultColNames"
        :main-objects="mainObjects"
        :select-all="selectAll"
        :selected-rows="selectedRows"
        :select-word="selectWord"
      >
        <template #default="{mainObject}">
          <TableCellImage :src="mainObject.image"/>
          <TableCellsByObject :keys="['color', 'size', 'weight', 'quality']" :main-object="mainObject" />
        </template>

        <template #edit-buttons="{mainObject}">
          <Link class="flex items-center px-4" :href="`/apples/${mainObject.id}/edit`" tabindex="-1">
            <div class="btn btn-success">
              Edit
            </div>
          </Link>
          <Link class="flex items-center px-4" :href="`/apples/${mainObject.id}`" tabindex="-1">
            <div class="btn btn-success">
              Show
            </div>
          </Link>
        </template>
      </BaseTableWrapper>
    </div>

    <MassActionsWrapper>
      <MassActionElement
        v-model="massUpdateValues.size" label="Set size:"
        :main-action="() => massUpdateValue('size')" />
      <MassActionElement
        v-model="massUpdateValues.weight" label="Set weight:"
        :main-action="() => massUpdateValue('weight')" />

      <form @submit.prevent="deleteSelected">
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
      </form>
    </MassActionsWrapper>
    <pagination class="mt-6" :links="mainObjects.meta.links" />
  </div>
</template>

<script>

import validationRules from '@/FormArrays/Apples'
import IndexMixin from '@/Mixins/ResourceMixins/IndexMixin'
import AppleMixin from '@/Pages/Apple/AppleMixin'
import { useForm } from '@inertiajs/inertia-vue3'
import DefaultLayout from "@/Shared/DefaultLayout";

export default {
  data() {
    return {
      massUpdateValues: {
        size: null,
        weight: null,
      },
      defaultColNames: ['Image', 'Color', 'Size', 'Weight', 'Quality'],
      validationRules,
      filter: useForm({
        color: null,
        size: [null, null],
        weight: null,
        quality_id: null,
      }),
    }
  },
  layout: DefaultLayout,
  mixins: [IndexMixin, AppleMixin],
}
</script>
