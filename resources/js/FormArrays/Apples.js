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
        "element": "Select",
        "label": "quality_id",
        "name": "quality_id",
        "value": ""
    },
    "is_eaten": {
        "required": false,
        "options": [
            {
                "text": "Not matter",
                "value": ""
            },
            {
                "text": "No",
                "value": 1
            },
            {
                "text": "Yes",
                "value": 2
            }
        ],
        "type": "text",
        "id": "is_eaten",
        "attributes": {
            "id": "is_eaten"
        },
        "element": "select",
        "label": "is_eaten",
        "name": "is_eaten",
        "value": ""
    },
    "image": {
        "required": false,
        "type": "file",
        "id": "image",
        "attributes": {
            "id": "image"
        },
        "element": "Input",
        "label": "image",
        "name": "image",
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
        "element": "Input",
        "label": "color",
        "name": "color",
        "value": ""
    }
}
export default validationRules