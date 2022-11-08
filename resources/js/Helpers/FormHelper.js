export default class FormHelper {
  static setNewLabels(inputs, newLabels) {
    for (let param in newLabels) {
        if (inputs.hasOwnProperty(param)) {
            inputs[param].label = newLabels[param];
        }
    }
    return inputs;
  }

  static setDefaultValues(inputs) {
      let result = {};
      for (let param in inputs) {
          result[param] = null;
      }
      return result;
  }

    static setValuesFromObjects(inputs, mainObject) {
        let result = {};
        for (let param in inputs) {
            result[param] = mainObject[param];
        }
        return result;
    }


}
