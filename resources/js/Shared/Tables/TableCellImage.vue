<template>
  <td class="border-t">
    <div class="flex items-center px-1 py-1 focus:text-indigo-500">
      <img :src="src" v-if="src" class="table-image">
    </div>
  </td>
</template>

<script>
export default {
  name: "DefaultTableCell",
  props: {
    src: String
  }
}
</script>

<style scoped>
  .table-image {
    width: 3rem;
    height: 3rem;
  }
</style>
