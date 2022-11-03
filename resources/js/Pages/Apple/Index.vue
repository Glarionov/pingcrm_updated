<template>
  <div>
    <Head title="Organizations"/>
    <h1 class="mb-8 text-3xl font-bold">Organizations</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null"/>
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>
      <Link class="btn-indigo" href="/organizations/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;Organization</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <BaseTableWrapper v-slot="slotProps"

                :defaultColNames="defaultColNames"
                                :mainObjects="mainObjects"
                                :selectAll="selectAll"
                                :selectedRows="selectedRows"
                                :selectWord="selectWord"
        >
                  <td class="border-t">
                    {{ slotProps.mainObject.color }}
                  </td>
                  <td class="border-t">
                    {{ slotProps.mainObject.size }}
                  </td>
                  <td class="border-t">
                    {{ slotProps.mainObject.weight }}
                  </td>

      </BaseTableWrapper>
<!--      <BaseTableWrapper-->
<!--        v-slot="slotProps" :defaultColNames="this.defaultColNames"-->
<!--                        :mainObjects="mainObjects"-->
<!--                        :selectAll="selectAll"-->
<!--                        :selectedRows="selectedRows"-->
<!--                        :selectWord="selectWord"-->
<!--      >-->
<!--        <template v-if="slotProps.hasOwnProperty('mainObject')">-->
<!--          <td class="border-t">-->
<!--            {{ slotProps.mainObject.color }}-->
<!--          </td>-->
<!--          <td class="border-t">-->
<!--            {{ slotProps.mainObject.size }}-->
<!--          </td>-->
<!--          <td class="border-t">-->
<!--            {{ slotProps.mainObject.weight }}-->
<!--          </td>-->
<!--        </template>-->

<!--      </BaseTableWrapper>-->
    </div>
<!--    <pagination class="mt-6" :links="organizations.links"/>-->
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

export default {
  components: {
    Head,
    Icon,
    Link,
    Pagination,
    SearchFilter,
    SlotTest,
    BaseTableWrapper
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
      form: {
        search: this.filters? this.filters.search: null,
        trashed: this.filters? this.filters.trashed: null,

        newSize: null,
        newWeight: null,
        selectedRows: [],
        selectedAll: false,
        filter: this.$inertia.form({
          // filter: {
          //     size: [null, null],
          //     weight: null
          // }
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
        form: this.$inertia.form({}),
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
  },
}
</script>
