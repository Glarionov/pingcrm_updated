let validationRules = 
{
    "size": {
        "required": false,
        "type": "number",
        "id": "size",
        "attributes": {
            "max": "10",
            "min": "2",
            "id": "size"
        },
        "attributes_wo_value": [],
        "element": "Input",
        "label": "size",
        "name": "size",
        "value": ""
    },
    "weight": {
        "required": false,
        "type": "number",
        "id": "weight",
        "attributes": {
            "max": "101",
            "min": "1",
            "id": "weight"
        },
        "attributes_wo_value": [],
        "element": "Input",
        "label": "weight",
        "name": "weight",
        "value": ""
    },
    "color": {
        "required": true,
        "type": "text",
        "id": "color",
        "attributes": {
            "required": "1",
            "id": "color"
        },
        "attributes_wo_value": [
            "required"
        ],
        "element": "Input",
        "label": "color",
        "name": "color",
        "value": ""
    }
}
export default validationRules