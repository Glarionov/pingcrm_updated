<template>
  <div>
    <Head title="Apples"/>
    <h1 class="mb-8 text-3xl font-bold">Apples</h1>

    <div class="filters">
      <form @submit.prevent="search">
        <div class="d-flex">
          <div class="col-2 d-flex">
            Size min:
            <!--                        <input type="text" class="form-control-sm mx-2 w-25" v-model="filter.filter.size[0]">-->
            <input type="text" class="form-control form-control-sm mx-2 w-25" v-model="filter.size[0]">
          </div>

          <div class="col-2 d-flex">
            Size max:
            <input type="text" class="form-control form-control-sm mx-2 w-25" v-model="filter.size[1]">
          </div>

          <div class="col-2 d-flex">
            Weight:
            <input type="text" class="form-control form-control-sm mx-2 w-25" v-model="filter.weight">

          </div>
          <div class="col-2">
            <button type="submit" class="btn btn-success btn-sm ml-1">Submit</button>
          </div>
          <!--                        <input type="text" class="form-control-sm mx-2 w-25" v-model="filter.filter.size[1]">-->

        </div>

      </form>


    </div>

    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null"/>
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>
      <Link class="btn-indigo" href="/apples/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;Apple</span>
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
                    <div class="flex items-center px-6 py-4 focus:text-indigo-500">
                      {{ slotProps.mainObject.color }}
                    </div>

                  </td>
                  <td class="border-t">
                    <div class="flex items-center px-6 py-4 focus:text-indigo-500">
                      {{ slotProps.mainObject.size }}
                    </div>

                  </td>
                  <td class="border-t">
                    <div class="flex items-center px-6 py-4 focus:text-indigo-500">
                      {{ slotProps.mainObject.weight }}
                    </div>

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
      // form: this.$inertia.form({}),
      form: {
        search: this.filters? this.filters.search: null,
        trashed: this.filters? this.filters.trashed: null,
        newSize: null,
        newWeight: null,
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
  },
}
</script>
