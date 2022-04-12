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
        "location_id": "11e95f8ec39de8f0a4f1abdb", // (required on POST)
        "terminal_id": "11e95f9458a7a580b0c76706", // (required on POST)
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
        "id": "11e95f949ec7887897cf600b",
        "location_id": "11e95f8ec39de8f0a4f1abdb",
        "terminal_id": "11e95f9458a7a580b0c76706",
        "require_signature": 1,
        "reason_code_id": 1000,
        "device_term_api_id": "device_term134",
        "created_ts": 1555342753,
        "created_user_id": "11e95f8ec7feb9d8b1649ecc",
        "signature": {
            "id": "11e95f949eecd286b935688c",
            "resource_id": "11e95f949ec7887897cf600b",
            "resource": "DeviceTerm",
            "signature": "iVBORw0KGgo...",
            "created_ts": 1555342753,
            "modified_ts": 1555342753,
            "_links": {
                "self": {
                    "href": "https://{domain}/v2/signatures/11e95f949eecd286b935688c"
                }
            }
        },
        "_links": {
            "self": {
                "href": "https://{domain}/v2/deviceterms/view?id=11e95f949ec7887897cf600b"
            }
        }
    }
}
```
