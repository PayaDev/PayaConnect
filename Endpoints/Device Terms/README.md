# Deviceterms Endpoint

Below you will find information on all of the available endpoint actions, fields, requirements, and responses.

_**Note**: This endpoint is intended for use with signature capable terminals only.  On POST, if a device is not signature capable and require_signature is true, the API should return a 422 with the message "Device is not signature capable"_

### Endpoint Actions

#### Create Record

```POST /v2/deviceterms```

_**Note**: A POST request with a device_terms_api_id that matches an existing declined record will be treated as an update and allow the prompt to be tried again._

##### Request
```json
{
    "deviceterm": {
        "location_id": "{location_id}", // (required on POST)
        "terminal_id": "{terminal_id}", // (required on POST)
        "require_signature": 1, // (required on POST)
        "device_terms_api_id":"device_term134", // (optional)
        "terms_conditions": "FUNgib0Vh0B9c0Wbttvr50vNtGLOkTdFL0eFmhN1RJpKhK14IENeDa8irp2dEk9thEcVHvVEyriQeZLs5NjNsCzqNj9JDA4RSJwK647IFtYjrNPN1nBb9bw6hoQ71oT5kpsiXGt8HcqBFVBVeDA7psIzKAyDveAw2o1hfjipkOtXrPgWun0rYwyyFuvqkT1egQYKfYDj" // (required on POST)
    }
}
```

##### Response
```json
{
    "deviceterm": {
        "id": "{deviceterm_id}",
        "location_id": "{location_id}",
        "terminal_id": "{terminal_id}",
        "require_signature": 1,
        "reason_code_id": 1000,
        "device_term_api_id": "device_term134",
        "created_ts": 1555342753,
        "created_user_id": "user_ID",
        "signature": {
            "id": "{signature_ID}",
            "resource_id": "{resource_ID},
            "resource": "DeviceTerm",
            "signature": "iVBORw0KGgo...",
            "created_ts": 1555342753,
            "modified_ts": 1555342753,
            "_links": {
                "self": {
                    "href": "https://{domain}/v2/signatures/{signature_id}"
                }
            }
        },
        "_links": {
            "self": {
                "href": "https://{domain}/v2/deviceterms/view?id={deviceterm_id}"
            }
        }
    }
}
```

#### View Single Record

```GET /v2/deviceterms/{id}```

##### Request

```json
{
    // Empty Payload - Nothing Needed Here
}
```

##### Response

```json
{
    "deviceterm": {
        "id": "{deviceterm_id}",
        "location_id": "{location_id}",
        "terminal_id": "{terminal_id}",
        "require_signature": 1,
        "reason_code_id": 1000,
        "device_term_api_id": "device_term134",
        "created_ts": 1555342753,
        "created_user_id": "{created_user_id}",
        "signature": {
            "id": "{signature_id}",
            "resource_id": "{resource_id}",
            "resource": "DeviceTerm",
            "signature": "iVBORw0KGgo...",
            "created_ts": 1555342753,
            "modified_ts": 1555342753,
            "_links": {
                "self": {
                    "href": "https://{domain}/v2/signatures/{signature_id}"
                }
            }
        },
        "_links": {
            "self": {
                "href": "https://{domain}/v2/deviceterms/view?id={deviceterm_id}"
            }
        }
    }
}
```

#### View Record List

```GET /v2/deviceterms/```

_**Note**: Filters can be used to search for Device Terms by including the columns you want to filter on as **URL parameters**. i.e. ```/v2/deviceterms?field=value&field2=value2```_

##### Request

```json
{
    // Empty Payload - Nothing Needed Here
}
```

##### Response

```json
{
    "deviceterms": [
        {
            "id": "{deviceterm_id}",
            "location_id": "{location_id}",
            "terminal_id": "{terminal_id",
            "require_signature": 1,
            "reason_code_id": 1000,
            "device_term_api_id": "device_term134",
            "created_ts": 1555342753,
            "created_user_id": "{created_user_id}",
            "signature": {
                "id": "{signature_id}",
                "resource_id": "{resource_id}",
                "resource": "DeviceTerm",
                "signature": "iVBORw0KGgo...",
                "created_ts": 1555342753,
                "modified_ts": 1555342753,
                "_links": {
                    "self": {
                        "href": "https://{domain}/v2/signatures/{signature_id}"
                    }
                }
            },
            "_links": {
                "self": {
                    "href": "https://{domain}/v2/deviceterms/view?id={deviceterm_id}"
                }
            }
        },
        ... // Other deviceterm objects
    ],
    "meta": {
        "pagination": {
            "links": {
                "self": {
                    "href": "{url}/v2/deviceterms?field=value&field2=value2&sort=-created&page=1"
                },
                "next": {
                    "href": "{url}/v2/deviceterms?field=value&field2=value2&sort=-created&page=2"
                },
                "last": {
                    "href": "{url}/v2/deviceterms?field=value&field2=value2&sort=-created&page=11"
                }
            },
            "totalCount": 220,
            "pageCount": 11,
            "currentPage": 0,
            "perPage": 20
        },
        "sort": {
            "attributes": {
                "created": "desc"
            }
        }
    }
}
```

## Fields

| Name                | Min | Max  | Format  | POST Required | POST Allowed | PUT Allowed | Comments                                                                                         |
|---------------------|-----|------|---------|---------------|--------------|-------------|--------------------------------------------------------------------------------------------------|
| id                  | 24  | 36   | string  |               |              |             | System generated id                                                                              |
| created_ts          |     |      | integer |               |              |             | System generated timestamp                                                                       |
| created_user_id     |     |      | string  |               |              |             | System generated id for user who created record                                                  |
| device_terms_api_id |     | 36   | string  |               | ✔            |             | Can be used for associating record to external systems. Must be unique per location.             |
| location_id         |     | 36   | string  | ✔             |              |             | The id for the location that this record should be associated with                               |
| reason_code_id      |     |      | integer |               |              |             |                                                                                                  |
| require_signature   |     |      | boolean | ✔             |              |             | Set to true or 1 to require a signature from the customer                                        |
| terminal_id         |     | 36   | string  | ✔             |              |             | The id for a terminal that is attached to the location identified by location_id in the request. |
| terms_conditions    | 1   | 4096 | string  | ✔             |              |             |                                                                                                  |
| signature           |     |      | JSON    |               |              |             | A JSON object containing all the info about and including the signature blob (base64).           |

## Expands (Related Records)

For detail on how to use Expands on an Endpoint, please visit the [Expands (Related Records)](https://github.com/PayaDev/PayaConnect/blob/master/Expands%20(Related%20Records).md) page.

| Related Record | Filter Name  |
|----------------|--------------|
| Created User   | created_user |
| Location       | location     |
| Terminal       | terminal     |
| Reason Code    | reason_code  |
| Signature      | signature    |

An example of “expanding” this endpoint to one of the above related records would look like this:

GET ```/v2/deviceterms/xxxxxxxxxxxxxxxxxxxxxxxx?expand=location```

To use multiple expands on this endpoint, simply include them both separated by a comma like so:

GET ```/v2/deviceterms/xxxxxxxxxxxxxxxxxxxxxxxx?expand=location,terminal```

### Filters

In contrast to using expands to get extra data, you can use filters to limit record results. The following fields can be used for filtering on this endpoint:

 - id
 - location_id
 - terminal_id
 - device_terms_api_id
 - reason_code_id
 - created_ts
 - created_user_id
 - 
Say, for example, that you only wanted to find records from a specific location, you could include that filter in the URL of the GET request like so:

GET ```/v2/deviceterms?location_id=XXXXXXXXX```

Say, for example, that you only wanted to find records that were created by a specific terminal, you could include that filter in the URL of the GET request like so:

GET ```/v2/deviceterms?terminal_id=XXXXXXXXXXX```

#### Filtering by Date Created

There is additional functionality that allows searching and filtering on timestamp fields. If you are looking for a record from today, you can simply search on the created_ts field as follows:

```/v2/deviceterms?created_ts=today```

For yesterday you could do the following:

```/v2/deviceterms?created_ts=yesterday```

If you need more flexibility on dates, you can set the timestamp filter to custom and supply a custom from and to date like so:

```/v2/deviceterms?created_ts=custom&created_ts_from=1511382234&created_ts_to=1511385997```

When searching on timestamp fields, the list below contains all the predefined values that can be used:

 - today
 - yesterday
 - this week
 - last week
 - last 30 days
 - last 90 days
 - this month
 - last month
 - custom

