<template>
  <td class="border-t">
    <div class="flex items-center px-6 py-4 focus:text-indigo-500">
      <slot></slot>
    </div>
  </td>
</template>

<script>
export default {
  name: "DefaultTableCell"
}
</script>

<style scoped>

</style>
