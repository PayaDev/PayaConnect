# Notes Endpoint

Here you will information on how to interact with the Notes Endpoint including available endpoint actions, fields, and expands.

### Endpoint Actions

#### Create Record

```POST /v2/notes```

##### Request

```json
{
    "note": {
        "resource_id":"{{contact_id}}", // Required
        "resource":"Contact", // Required
        "note": "test note for contact", // Optional
        ... // Other optional Fields Here
    }
}
```

##### Response

```json
{
    "note": {
        "id": "54c2cb8b-8324-a0a1-44bc-89b55342d7fc",
        "resource_id": "54c285f1-678d-9510-318c-bcb13ab0c1b4",
        "resource": "Contact",
        "visibility_group_id": "",
        "note": "test note for contact",
        "created_ts": 1422045315,
        "modified_ts": 1422045315,
        "_links": {
            "self": {
                "href": "{url}/v2/contacts/54c285f1-678d-9510-318c-bcb13ab0c1b4/notes/54c2cb8b-8324-a0a1-44bc-89b55342d7fc"
            },
            "for": {
                "href": "{url}/v2/contacts/54c285f1-678d-9510-318c-bcb13ab0c1b4"
            } 
        }
    }
}
```

#### Update Record

```PUT /v2/notes/{id}```

##### Request

```json
{
    "note": {
        "note":"Updated Message",
        // All fields are optional for update.
    }
}
```

##### Response

```json
{
    "note": {
        "id": "54c2cb8b-8324-a0a1-44bc-89b55342d7fc",
        "resource_id": "54c285f1-678d-9510-318c-bcb13ab0c1b4",
        "resource": "Contact",
        "visibility_group_id": "",
        "note": "Updated Message",
        "created_ts": 1422045315,
        "modified_ts": 1422045315,
        "_links": {
            "self": {
                "href": "{url}/v2/contacts/54c285f1-678d-9510-318c-bcb13ab0c1b4/notes/54c2cb8b-8324-a0a1-44bc-89b55342d7fc"
            },
            "for": {
                "href": "{url}/v2/contacts/54c285f1-678d-9510-318c-bcb13ab0c1b4"
            } 
        }
    }
}
```

#### View Single Record

```GET /v2/notes/{id}```

##### Request

```json
{
    // Empty Payload - Nothing Needed Here
}
```

##### Reponse

```json
{
    "note": {
        "id": "54c2cb8b-8324-a0a1-44bc-89b55342d7fc",
        "resource_id": "54c285f1-678d-9510-318c-bcb13ab0c1b4",
        "resource": "Contact",
        "visibility_group_id": "",
        "note": "test note for contact",
        "created_ts": 1422045315,
        "modified_ts": 1422045315,
        "_links": {
            "self": {
                "href": "{url}/v2/contacts/54c285f1-678d-9510-318c-bcb13ab0c1b4/notes/54c2cb8b-8324-a0a1-44bc-89b55342d7fc"
            },
            "for": {
                "href": "{url}/v2/contacts/54c285f1-678d-9510-318c-bcb13ab0c1b4"
            }
        }
    }
}
```

#### View Record List

```

_**Note: Filters can be used to search for Notes by including the columns you want to filter on as URL parameters. i.e. /v2/notes?field=value&field2=value2

##### Request

```json

```


