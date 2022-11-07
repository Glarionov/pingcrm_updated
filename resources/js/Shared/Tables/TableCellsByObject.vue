<template>
  <component :is="tableCellWrapper" v-for="(key, keyIndex) in keys" :key="keyIndex">
    {{ mainObject[key] }}
  </component>
</template>

<script>
import DefaultTableCell from '@/Shared/Tables/DefaultTableCell';
export default {
  name: 'TableCellsByObject',
  components: {DefaultTableCell},
  props: {
    tableCellWrapper: {
      type: String,
      default: 'DefaultTableCell'
    },
    mainObject: {
      type: Object
    },
    keys: {
      type: Array
    }
  }
}
</script>

<style scoped>

</style>
