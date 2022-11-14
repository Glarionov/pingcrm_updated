<template>
  <h1 class="mb-8 text-3xl font-bold">
    <Link class="text-indigo-400 hover:text-indigo-600" :href="href"><span>{{groupName}}</span></Link>
    <span class="text-indigo-400 font-medium">/</span>{{sectionName}}
  </h1>
</template>

<script>

import {Link} from '@inertiajs/inertia-vue3'

export default {
  name: "ResourceTopInfo",
  components: {
    Link,
  },
  props: {
    href: String,
    groupName: String,
    sectionName: String
  }
}
</script>

<style scoped>

</style>
