<template>
  <li class="mb-4">
    <Link class="group flex items-center py-3" :href="'/' + url">
<!--      <icon :name="iconName" class="mr-2 w-4 h-4" :class="isUrl(url) ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />-->
      <div>
        {{ label }}
      </div>
    </Link>
  </li>
</template>

<script>

import { Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'

export default {
  name: "MenuItem",
  components: {
    Icon,
    Link,
  },
  props: {
    url: String,
    label: String,
    iconName: String
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length
    },
  },
}
</script>

<style scoped>

</style>
