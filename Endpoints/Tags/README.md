# Tags Endpoint
## Endpoint Actions
The Tags Endpoint is used to classify a transaction with metadata tags for the purposes of filtering a group of transactions within your integrated solution. These fields can be subject matter related like a donation campaign or service type. These tags can be used as custom filters for the Transactions Endpoint.  

### Create Record
`POST /v2/tags`

Request
```json
{
    "tag": {
        "title":"Test Tag", // Required
        "location_id":"123456789012345678901234" // Required
    }
}
```
Response
```json
{
    "tag": {
        "id": "123456789012345678901234",
        "location_id": "123456789012345678901234",
        "title": "Test Tag",
        "created_ts": 1422040992,
        "modified_ts": 1422040992,
        "_links": {
            "self": {
                "href": "{url}/v2/tags/123456789012345678901234"
            }
        }
    }
}
```

### Update Record
`PUT /v2/tags/{id}`

Request
```json
{
    "tag": {
        "title":"Test Tag Alt",
        "location_id":"123456789012345678901234"
    }
}
```
Response
```json
{
    "tag": {
        "id": "123456789012345678901234",
        "location_id": "123456789012345678901234",
        "title": "Test Tag Alt",
        "created_ts": 1422040992,
        "modified_ts": 1432040992,
        "_links": {
            "self": {
                "href": "{url}/v2/tags/123456789012345678901234"
            }
        }
    }
}
```

### View Single Record
`GET /v2/tags/{id}`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```
Response
```json
{
    "tag": {
        "id": "123456789012345678901234",
        "location_id": "123456789012345678901234",
        "title": "Test Tag",
        "created_ts": 1422040992,
        "modified_ts": 1422040992,
        "_links": {
            "self": {
                "href": "{url}/v2/tags/123456789012345678901234"
            }
        }
    }
}
```

### View Record List
`GET /v2/tags`

*Note: Filters can be used to search for Tags by including the columns you want to filter on as **URL parameters.** i.e.* `/v2/tags?field=value&field2=value2`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```
Response
```json
{
    "tags": [
        {
            "id": "123456789012345678901234",
            "location_id": "123456789012345678901234",
            "title": "Test Tag",
            "created_ts": 1422040992,
            "modified_ts": 1422040992,
            "_links": {
                "self": {
                    "href": "{url}/v2/tags/123456789012345678901234"
                }
            }
        },
        ... // Other Tags Here
    ],
    "meta": {
        "pagination": {
            "links": {
                "self": {
                    "href": "{url}/v2/tags?location_id=123456789012345678901234&page_size=2&page=1"
                }
            },
            "totalCount": 2,
            "pageCount": 1,
            "currentPage": 0,
            "perPage": 2
        },
        "sort": {
            "attributes": {
                "id": "desc"
            }
        }
    }
}
```

### Delete Record
`DELETE /v2/tags`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```
Response
```json
No JSON Response.  Only HTTP Response Code:

204 - Success, Tag was deleted.
404 - Fail, Tag was not found.
```
 

Fields
| Name        | Min | Max | Format  | POST Required | POST Allowed | PUT Allowed | Comments                         |
|-------------|-----|-----|---------|---------------|--------------|-------------|----------------------------------|
| id          | 24  | 36  | string  |               |              |             | The tags unique identifier       |
| created_ts  |     | 10  | integer |               |              |             | The created timestamp            |
| location_id | 24  | 36  | sring   | ✔             | ✔            |             | The location this tag belongs to |
| modified_ts |     | 10  | integer |               |              |             | The last modified timestamp      |
| title       | 1   | 64  | string  | ✔             | ✔            | ✔           |                                  | 
 

Expands (Related Records)
For detail on how to use expands on an endpoint, please visit the [Expands (Related Records)](Expands%20(Related%20Records).md) page.

| Related Record | Filter Name  |
|----------------|--------------|
| Created User   | created_user |
 

An example of “expanding” this endpoint to one of the above related records would look like this:

`GET /v2/tags/xxxxxxxxxxxxxxxxxxxxxxxx?expand=location`
