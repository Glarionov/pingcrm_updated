<template>
  <div>
    <Head title="Apples"/>
    <h1 class="mb-8 text-3xl font-bold">Apples</h1>

    <SearchFormsWrapper>
      <SmallSearchElement v-model="filter.size[0]" label="Size min:"/>
      <SmallSearchElement v-model="filter.size[1]" label="Size max:"/>
      <SmallSearchElement v-model="filter.weight" label="Weight:"/>
      <SmallSearchElement v-model="filter.color" label="Color:"/>
    </SearchFormsWrapper>

    <div class="flex items-center justify-between mb-6 mt-2">
      <Link class="btn-indigo" href="/apples/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;Apple</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <BaseTableWrapper
                :defaultColNames="defaultColNames"
                                :mainObjects="mainObjects"
                                :selectAll="selectAll"
                                :selectedRows="selectedRows"
                                :selectWord="selectWord"
        >

        <template #default="{mainObject}">
          <td class="border-t">
            <div class="flex items-center px-6 py-4 focus:text-indigo-500">
              {{ mainObject.color }}
            </div>

          </td>
          <td class="border-t">
            <div class="flex items-center px-6 py-4 focus:text-indigo-500">
              {{ mainObject.size }}
            </div>

          </td>
          <td class="border-t">
            <div class="flex items-center px-6 py-4 focus:text-indigo-500">
              {{ mainObject.weight }}
            </div>
          </td>
        </template>

        <template #edit-buttons="{mainObject}">
            <Link class="flex items-center px-4" :href="`/apples/${mainObject.id}/edit`" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
        </template>
      </BaseTableWrapper>
    </div>

    <MassActionsWrapper>
      <MassActionElement v-model="newSize" label="Set size:" :mainAction="setNewSize"/>
      <MassActionElement v-model="newWeight" label="Set weight:" :mainAction="setNewWeight"/>
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
import SlotTest from "@/Test/SlotTest";
import BaseTableWrapper from "@/Shared/Tables/BaseTableWrapper";
import SmallSearchElement from "@/Shared/Search/SmallSearchElement";
import SearchFormsWrapper from "@/Shared/Search/SearchFormsWrapper";
import MassActionElement from "@/Shared/MassActions/MassActionElement";
import MassActionsWrapper from "@/Shared/MassActions/MassActionsWrapper";

export default {
  components: {
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
    MassActionElement
  },
  layout: Layout,
  props: {
    filters: Object,
    organizations: Object,
    mainObjects: Object,
    success: Boolean,
    error: String,
  },
  computed: {
    errorMessage() {
      // eslint-disable-next-line no-prototype-builtins
      return this.$page.props.hasOwnProperty('flash') ? this.$page.props.flash.errorMessage : '';
    },
    selectWord() {
      return this.selectedAll ? 'Unselect' : 'Select';
    }
  },
  data() {
    return {
      defaultColNames: ['Color', 'Size', 'Weight'],
      selectedRows: [],
      selectedAll: false,
      filter: this.$inertia.form({
        color: null,
        size: [null, null],
        weight: null
      }),
      massActionsForm: this.$inertia.form({
        newValues: {
          size: null
        },
        filter: {
          id: null
        }
      }),
      setNewSizeForm: this.$inertia.form({
        newValues: {
          size: null
        },
        filter: {
          id: null
        }
      }),
      setNewWeightForm: this.$inertia.form({
        newValues: {
          weight: null,
        },
        filter: {
          id: null
        }
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
      let newValue = !this.selectedAll;
      this.selectedRows = [];
      for (let index in this.mainObjects.data) {
        this.selectedRows[this.mainObjects.data[index].id] = newValue;
      }
      this.selectedAll = newValue;
    },
    search() {
      this.filter.get('/api/apples', {
        preserveState: true
      });
    },
    getSelectedIds() {
      let filterId = []
      for (let id in this.selectedRows) {
        if (this.selectedRows[id]) {
          filterId.push((id));
        }
      }
      return filterId;
    },
    updateSelected(newValues) {
      let newForm = {...this.massActionsForm, newValues: {}};
      for (let param in newValues) {
        newForm.newValues[param] = newValues[param];
      }

      newForm.filter.id = this.getSelectedIds();

      newForm.put(`/api/apples`)
    },
    setNewSize() {
      this.updateSelected({size: this.newSize});
    },
    setNewWeight() {
      this.updateSelected({weight: this.newWeight});
    },
    deleteSelected() {
      this.massActionsForm.filter.id = this.getSelectedIds();
      this.massActionsForm.delete('/api/apples');
    },
  },
}
</script>
