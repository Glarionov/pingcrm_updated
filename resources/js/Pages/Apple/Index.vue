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
      <div class="btn btn-success">
        <Link href="/apples/create">
          <span>Create</span>
          <span class="hidden md:inline">&nbsp;Apple</span>
        </Link>
      </div>

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
      <MassActionElement v-model="massUpdateValues.size" label="Set size:" :main-action="setNewSize" />
      <MassActionElement v-model="massUpdateValues.weight" label="Set weight:" :main-action="setNewWeight" />
      <form @submit.prevent="deleteSelected">
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
      </form>
    </MassActionsWrapper>
  </div>
</template>

<script>

import Layout from '@/Shared/Layout'
import validationRules from "@/FormArrays/Apples";
import IndexMixin from "@/Mixins/ResourceMixins/IndexMixin";

export default {

  layout: Layout,
  props: {
    filters: Object,
    mainObjects: Object,
    success: Boolean,
    error: String,
  },
  data() {
    return {
      baseApiUrl: '/api/apples',
      baseUrl: '/apples',
      massUpdateValues: {
        size: null,
        weight: null,
      },
      defaultColNames: ['Color', 'Size', 'Weight', 'Quality'],
      validationRules,
      filter: this.$inertia.form({
        color: null,
        size: [null, null],
        weight: null,
        quality_id: null,
      }),
      massActionsForm: this.$inertia.form({
        filter: {
          id: null,
        },
      }),
      form: {
        search: this.filters? this.filters.search: null,
        trashed: this.filters? this.filters.trashed: null,
      },
    }
  },
  mixins: [IndexMixin],
  methods: {
  },
}
</script>
