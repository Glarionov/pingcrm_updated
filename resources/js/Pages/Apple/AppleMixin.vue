<script>

import FormHelper from "@/Helpers/FormHelper";
import validationRules from "@/FormArrays/Apples";

let labels = {
  size: 'Size',
  weight: 'Weight',
  quality_id: 'Quality'
};

export default {
  name: 'AppleMixin',
  data() {
    return {
      baseApiUrl: '/api/apples',
      baseUrl: '/apples',
    }
  },
  methods: {
    setInputs() {
      this.inputs = FormHelper.setNewLabels(validationRules, labels)
    }
  },
}
</script>
