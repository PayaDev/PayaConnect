# Locations Endpoint

### Endpoint Actions

#### Create Record

```

##### Request

```json
{
    "location": {
        "parent_id":"22222222-2222-2222-2222-222222222222", // Required
        "name":"Brand Test", // Required
        "branding_domain_url":"test.domain.com", // Required
        ... // Optional Fields Here
    }
}
```

##### Response 

``` json
{
    "location": {
        "id": "54c11750-a6c9-af57-e77a-da021bf9c0b1",
        "account_number": null, 
        "location_api_id": null,
        "name": "Brand Test",
        "address1": null,
        "address2": null,
        "city": null,
        "state": null,
        "zip_code": null,
        "office_phone": null,
        "office_ext_phone": null,
        "fax": null,
        "aba": null,
        "dda": null,
        "ticket_hash_key": null,
        "tz": "America/New_York",
        "receipt_logo": null,
        "created_ts": 1421936806,
        "modified_ts": null,
        "location_api_key": null,
        "branding_domain_url": "test.domain.com",
        "parent_id": "22222222-2222-2222-2222-222222222222",
        "_links": {
            "self": {
                "href": "{url}/v2/locations/54c11750-a6c9-af57-e77a-da021bf9c0b1"
            }
        }
    }
}
```

#### Update Record

```

##### Request 

````json

```

##### Response

```json

```

##### View Single Resord

```

##### Request

```json

```

##### Response

```json

```





