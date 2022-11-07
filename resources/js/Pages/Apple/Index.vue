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
      <MassActionElement v-model="newSize" label="Set size:" :main-action="setNewSize" />
      <MassActionElement v-model="newWeight" label="Set weight:" :main-action="setNewWeight" />
      <form @submit.prevent="deleteSelected">
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
      </form>
    </MassActionsWrapper>
  </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'
import SlotTest from '@/Test/SlotTest'
import BaseTableWrapper from '@/Shared/Tables/BaseTableWrapper'
import SmallSearchElement from '@/Shared/Search/SmallSearchElement'
import SearchFormsWrapper from '@/Shared/Search/SearchFormsWrapper'
import MassActionElement from '@/Shared/MassActions/MassActionElement'
import MassActionsWrapper from '@/Shared/MassActions/MassActionsWrapper'
import TableCellsByObject from '@/Shared/Tables/TableCellsByObject'
import validationRules from "@/FormArrays/Apples";

export default {
  components: {
    TableCellsByObject,
    MassActionsWrapper,
    Head,
    Icon,
    Link,
    Pagination,
    SearchFilter,
    SlotTest,
    BaseTableWrapper,
    SmallSearchElement,
    SearchFormsWrapper,
    MassActionElement,
  },
  layout: Layout,
  props: {
    filters: Object,
    organizations: Object,
    mainObjects: Object,
    success: Boolean,
    error: String,
  },
  data() {
    return {
      defaultColNames: ['Color', 'Size', 'Weight', 'Quality'],
      selectedRows: [],
      selectedAll: false,
      validationRules,
      filter: this.$inertia.form({
        color: null,
        size: [null, null],
        weight: null,
        quality_id: null,
      }),
      massActionsForm: this.$inertia.form({
        newValues: {
          size: null,
        },
        filter: {
          id: null,
        },
      }),
      setNewSizeForm: this.$inertia.form({
        newValues: {
          size: null,
        },
        filter: {
          id: null,
        },
      }),
      setNewWeightForm: this.$inertia.form({
        newValues: {
          weight: null,
        },
        filter: {
          id: null,
        },
      }),
      newSize: null,
      newWeight: null,
      // form: this.$inertia.form({}),
      form: {
        search: this.filters? this.filters.search: null,
        trashed: this.filters? this.filters.trashed: null,

      },
    }
  },
  computed: {
    errorMessage() {
      // eslint-disable-next-line no-prototype-builtins
      return this.$page.props.hasOwnProperty('flash') ? this.$page.props.flash.errorMessage : ''
    },
    selectWord() {
      return this.selectedAll ? 'Unselect' : 'Select'
    },
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/organizations', pickBy(this.form), {preserveState: true})
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
    selectAll() {
      let newValue = !this.selectedAll
      this.selectedRows = []
      for (let index in this.mainObjects.data) {
        this.selectedRows[this.mainObjects.data[index].id] = newValue
      }
      this.selectedAll = newValue
    },
    search() {
      this.filter.get('/api/apples', {
        preserveState: true,
      })
    },
    getSelectedIds() {
      let filterId = []
      for (let id in this.selectedRows) {
        if (this.selectedRows[id]) {
          filterId.push((id))
        }
      }
      return filterId
    },
    updateSelected(newValues) {
      let newForm = {...this.massActionsForm, newValues: {}}
      for (let param in newValues) {
        newForm.newValues[param] = newValues[param]
      }

      newForm.filter.id = this.getSelectedIds()

      newForm.put('/api/apples')
    },
    setNewSize() {
      this.updateSelected({size: this.newSize})
    },
    setNewWeight() {
      this.updateSelected({weight: this.newWeight})
    },
    deleteSelected() {
      this.massActionsForm.filter.id = this.getSelectedIds()
      this.massActionsForm.delete('/api/apples')
    },
  },
}
</script>
