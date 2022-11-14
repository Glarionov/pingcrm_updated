<script>
import {useForm} from "@inertiajs/inertia-vue3";
import FormHelper from "@/Helpers/FormHelper";

export default {
  name: 'CreateMixin',
  props: {
    success: Boolean,
    errorType: String,
    mainObject: Object,
  },
  created() {
    this.setInputs();
    this.setForm();
  },
  remember: 'form',
  methods: {
    store() {
      this.form.post(this.baseApiUrl)
    },
    setForm() {
      this.form = useForm(
        FormHelper.setDefaultValues(this.validationRules)
      )
    },
  },
}
</script>

