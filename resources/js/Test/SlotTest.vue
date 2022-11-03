<template>
  <table class="w-full whitespace-nowrap">
    <thead>
    <tr class="text-left font-bold">
      <th v-if="showSelectCheckboxes" class="pb-4 pt-6 px-6 select-rows-col" scope="col">
        <a href="" @click.prevent="selectAll">
          {{ selectWord }} all
        </a>
      </th>
      <th v-if="showIds" class="pb-4 pt-6 px-6" scope="col">
        ID
      </th>
      <th class="pb-4 pt-6 px-6" v-for="(defaultColName, defaultColNameIndex) in defaultColNames"
          :key="defaultColNameIndex"
          scope="col"
      >
        {{ defaultColName }}
      </th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(mainObject, index) in mainObjects.data" :key="index" class="hover:bg-gray-100 focus-within:bg-gray-100">
      <td v-if="showSelectCheckboxes" class="border-t" scope="row">
        <input v-model="selectedRows[mainObject.id]" type="checkbox">
      </td>
      <td v-if="showIds" class="border-t" scope="row">
        {{ mainObject.id }}
      </td>
      <slot :mainObject="mainObject"  v-bind="mainObject"></slot>
    </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: "SlotTest",
  props: {
    'defaultColNames': {}, 'mainObjects': {},
    showIds: {
      type: Boolean,
      default: true
    },
    showSelectCheckboxes: {
      type: Boolean,
      default: true
    },
    selectedRows: {
      type: Array,
      default: []
    },
    selectedAll: {},
    selectWord: {}
    // selectAll: {
    //     type: Function
    // }
  },
  data: () => {
    return {
      // selected: []
    }
  },
  methods: {
    selectAll() {
      this.$parent.selectAll();
    }
  }
}
</script>

<style scoped>
.select-rows-col {
  width: 135px;
}

.select-rows-col a {
  color: black;
}
</style>
