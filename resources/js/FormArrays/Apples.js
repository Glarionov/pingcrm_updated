let validationRules = 
{
    "size": {
        "required": false,
        "options": [
            {
                "text": "Not matter",
                "value": 0
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
        "type": "number",
        "id": "size",
        "attributes": {
            "max": "10",
            "min": "2",
            "id": "size"
        },
        "element": "select",
        "label": "size",
        "name": "size",
        "value": ""
    },
    "weight": {
        "required": false,
        "options": [
            {
                "text": "Not matter",
                "value": 0
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
        "type": "number",
        "id": "weight",
        "attributes": {
            "max": "101",
            "min": "1",
            "id": "weight"
        },
        "element": "select",
        "label": "weight",
        "name": "weight",
        "value": ""
    },
    "quality_id": {
        "required": false,
        "options": [
            {
                "text": "Not matter",
                "value": 0
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
        "type": "number",
        "id": "quality_id",
        "attributes": {
            "id": "quality_id"
        },
        "element": "select",
        "label": "quality_id",
        "name": "quality_id",
        "value": ""
    },
    "is_eaten": {
        "required": false,
        "options": [
            {
                "text": "Not matter",
                "value": 0
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
    "color": {
        "required": true,
        "options": [
            {
                "text": "Not matter",
                "value": 0
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
        "id": "color",
        "attributes": {
            "required": "1",
            "id": "color"
        },
        "element": "select",
        "label": "color",
        "name": "color",
        "value": ""
    }
}
export default validationRules