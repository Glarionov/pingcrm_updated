<template>
  <div class="mt-3">
    <loading-button :loading="form.processing" class="btn btn-success" type="submit">{{label}}</loading-button>
  </div>
</template>

<script>
import LoadingButton from '@/Shared/LoadingButton';

export default {
  name: 'EditButton',
  components: {LoadingButton},
  props: {
    label: {
      type: String,
      default: 'Save changes'
    },
    form: Object,
  }
}
</script>

<style scoped>

</style>
