<template>

</template>

<script>
import TableCellsByObject from '@/Shared/Tables/TableCellsByObject'
import MassActionsWrapper from '@/Shared/MassActions/MassActionsWrapper'
import {Head, Link, useForm} from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'
import SlotTest from '@/Test/SlotTest'
import BaseTableWrapper from '@/Shared/Tables/BaseTableWrapper'
import SmallSearchElement from '@/Shared/Search/SmallSearchElement'
import SearchFormsWrapper from '@/Shared/Search/SearchFormsWrapper'
import MassActionElement from '@/Shared/MassActions/MassActionElement'
import Layout from '@/Shared/Layout'
import DefaultLayout from "@/Shared/DefaultLayout";
import TableCellImage from "@/Shared/Tables/TableCellImage";

export default {
  name: "IndexMixin",
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
    TableCellImage
  },
  layout: DefaultLayout,
  props: {
    filters: Object,
    mainObjects: Object,
    success: Boolean,
    error: String,
  },
  data() {
    return {
      selectedRows: [],
      selectedAll: false,
      massActionsForm: useForm({
        filter: {
          id: null,
        },
        newValues: {}
      }),
    }
  },
  computed: {
    errorMessage() {
      return 'flash' in this.$page.props ? this.$page.props.flash.errorMessage : ''
    },
    selectWord() {
      return this.selectedAll ? 'Unselect' : 'Select'
    },
  },
  methods: {
    selectAll() {
      let newValue = !this.selectedAll
      this.selectedRows = []
      for (let index in this.mainObjects.data) {
        this.selectedRows[this.mainObjects.data[index].id] = newValue
      }
      this.selectedAll = newValue
    },
    search() {
      this.filter.get(this.baseApiUrl, {
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
      newForm.patch(this.baseApiUrl)
    },
    massUpdateValue(param) {
      this.updateSelected({[param]: this.massUpdateValues[param]})
    },
    deleteSelected() {
      this.massActionsForm.filter.id = this.getSelectedIds()
      this.massActionsForm.delete(this.baseApiUrl)
    },
  },
}
</script>

<style scoped>

</style>
