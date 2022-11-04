export default class FormHelper {
  static setNewLabels(inputs, newLabels) {
    for (let param in newLabels) {
        if (inputs.hasOwnProperty(param)) {
            inputs[param].label = newLabels[param];
        }
    }
    return inputs;
  }
}
