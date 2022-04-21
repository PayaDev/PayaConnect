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

```GET /v2/notes```

_**Note**: Filters can be used to search for Notes by including the columns you want to filter on as URL parameters._ i.e. ```/v2/notes?field=value&field2=value2```

##### Request

```json
{
    // Empty Payload - Nothing Needed Here
}
```

##### Response

```json
{
    "notes": [
        {
            "id": "54c2eda8-25c7-9021-f56b-7acfece33e7f",
            "resource_id": "54c285f1-678d-9510-318c-bcb13ab0c1b4",
            "resource": "Contact",
            "visibility_group_id": "",
            "note": "test note for contact",
            "created_ts": 1422043941,
            "modified_ts": 1422043941,
            "_links": {
                "self": {
                    "href": "{url}/v2/contacts/54c285f1-678d-9510-318c-bcb13ab0c1b4/notes/54c2eda8-25c7-9021-f56b-7acfece33e7f"
                },
                "for": {
                    "href": "{url}/v2/contacts/54c285f1-678d-9510-318c-bcb13ab0c1b4"
                }
            }
        },
        {
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
        },
        ... // Other Notes here
    ],
    "meta": {
        "pagination": {
            "links": {
                "self": {
                    "href": "{url}/v2/notes?model_id=54c285f1-678d-9510-318c-bcb13ab0c1b4&model_name=Contact&page_size=3&page=1"
                }
            },
            "totalCount": 2,
            "pageCount": 1,
            "currentPage": 0,
            "perPage": 3
        },
        "sort": {
            "attributes": {
                "id": "desc"
            }
        }
    }
}
```

#### Delete Record

```DELETE /v2/notes/{id}```

##### Request

```json
{
    // Empty Payload - Nothing Needed Here
}
```

##### Response

```json
Conditional JSON Response on HTTP Response Code:

204 - Success, Note was deleted.
409 - Fail, validation error in JSON.
```

## Fields

| Name                | Format  | Min. | Max.   | Allowed on POST (Create) | Allowed on PUT (Update) | Default           |
|---------------------|---------|------|--------|--------------------------|-------------------------|-------------------|
| id                  | string  |      |  36    |                          | System Generated        |  System Generated |
| created_ts          | integer |      |  10    |                          | System Generated        |  System Generated |
| resource_id         | string  |      |  36    |                          | System Generated        |  System Generated |
| resource            | string  |      |        |                          |                         |                   |
| modified_ts         | integer |      |  10    |                          | System Generated        |  System Generated |
| note                | string  |      |  16384 |                          |                         |  Default          |
| visibility_group_id | string  |      |        |                          |                         |                   |

## Expands (Related Records)

For detail on how to use Expands on an Endpoint, please visit the [Expands (Related Records)](https://github.com/PayaDev/PayaConnect/blob/master/Expands%20(Related%20Records).md) page.

| Related Record   | Filter Name      |
|------------------|------------------|
| Created User     | created_user     |
| Visibility Group | visibility_group |

An example of “expanding” this endpoint to one of the above related records would look like this:

```GET /v2/notes/xxxxxxxxxxxxxxxxxxxxxxxx?expand=created_user```

To use multiple expands on this endpoint, simply include them both separated by a comma like so:

```GET /v2/notes/xxxxxxxxxxxxxxxxxxxxxxxx?expand=created_user,visibility_group```
