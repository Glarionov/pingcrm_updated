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
    "quality_id": {
        "required": false,
        "options": [
            {
                "text": "low",
                "value": 1
            },
            {
                "text": "medium",
                "value": 2
            },
            {
                "text": "high",
                "value": 3
            }
        ],
        "type": "number",
        "id": "quality_id",
        "attributes": {
            "id": "quality_id"
        },
        "attributes_wo_value": [],
        "element": "Select",
        "label": "quality_id",
        "name": "quality_id",
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