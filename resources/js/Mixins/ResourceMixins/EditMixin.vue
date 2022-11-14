<script>
import {useForm} from '@inertiajs/inertia-vue3';
import FormHelper from "@/Helpers/FormHelper";
import {Inertia} from "@inertiajs/inertia";

export default {
  name: 'EditMixin',
  props: {
    success: Boolean,
    errorType: String,
    mainObject: Object
  },
  created() {
    this.setInputs();
    this.setForm();
  },
  remember: 'form',
  methods: {
    update() {
      Inertia.post(this.baseApiUrl + '/' + this.$props.mainObject.id, {
        _method: 'patch',
        image: this.form.image,
        ...this.form
      })
    },
    setForm() {
      this.form = useForm(
        FormHelper.setValuesFromObjects(this.validationRules, this.$props.mainObject)
      )
    },
  },
}
</script>

