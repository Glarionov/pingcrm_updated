<template>
  <nav v-if="links.length > 3">
    <ul class="pagination" >
      <template v-for="(link, key) in links" :key="key">
        <li class="page-item" :class="{ 'active': link.active, 'disabled':  link.url === null}" >
        <Link :key="`link-${key}`" class="page-link"  :href="link.url" v-html="link.label" />
        </li>
      </template>
    </ul>
  </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
  components: {
    Link,
  },
  props: {
    links: Array,
  },
}
</script>
