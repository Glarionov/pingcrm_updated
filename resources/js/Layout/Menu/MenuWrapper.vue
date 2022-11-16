<template>
  <ul class="list-unstyled components">
    <MenuItem url="" label="Dashboard" icon-name="dashboard" />
    <MenuItem url="organizations" label="Organizations" icon-name="office" />
    <MenuItem url="contacts" label="Contacts" icon-name="users" />
    <MenuItem url="contacts" label="Contacts" icon-name="users" />
    <MenuItem url="reports" label="Reports" icon-name="printer" />
    <MenuItem url="my-tickets" label="My tickets" icon-name="printer" />
    <MenuItem url="fresh-tickets" label="Fresh tickets" icon-name="printer" />
    <MenuItem url="productivity" label="My productivity" icon-name="printer" />
    <MenuItem url="working-time" label="Working time" icon-name="printer" />
  </ul>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import MenuItem from "@/Layout/Menu/MenuItem";

export default {
  components: {
    MenuItem
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
