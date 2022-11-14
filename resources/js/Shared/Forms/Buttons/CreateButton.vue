<template>
  <div class="mt-3">
    <loading-button :loading="form.processing" class="btn btn-success" type="submit">{{label}}</loading-button>
  </div>
</template>

<script>
import LoadingButton from "@/Shared/LoadingButton";

export default {
  name: "CreateButton",
  components: {LoadingButton},
  props: {
    label: {
      type: String,
      default: 'Create'
    },
    form: Object,
  }
}
</script>

<style scoped>

</style>
