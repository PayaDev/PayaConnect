# Locations Endpoint

### Endpoint Actions

#### Create Record

```POST /v2/locations```

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

```PUT /v2/locations/{id}```

##### Request 

```json
{
    "location": {
        "office_phone": "2485551111",
        ...// Other fields and values for update
    }
}
```

##### Response

```json
 {
    "location": {
        "id": "54c1b053-f074-1795-1ba3-2feb99d91491",
        "account_number": null,
        "location_api_id": null,
        "name": "Test Retail (m9clq830w769lik9)123",
        "address1": null,
        "address2": null,
        "city": null,
        "state": null,
        "zip_code": null,
        "office_phone": "2485551111",
        "office_ext_phone": null,
        "fax": null,
        "aba": null,
        "dda": null,
        "ticket_hash_key": null, 
        "tz": "America/New_York",
        "receipt_logo": null,
        "created_ts": 1421937392,
        "modified_ts": 1421937514,
        "location_api_key": null,
        "branding_domain_url": "wo74cjoi4u8oajor.domain.com",
        "parent_id": "54c0bf68-e516-ebb1-ba80-ee5793e30557",
        "_links": {
            "self": {
                "href": "{url}/index.php/v2/locations/54c1b053-f074-1795-1ba3-2feb99d91491"
            } 
        }
    }
}
```

#### View Single Record

```GET /v2/locations/{id}```

##### Request

```json
{
    // Empty Payload - Not Needed Here
}
```

##### Response

```json
{
    "location": { 
        "id": "54c1b053-f074-1795-1ba3-2feb99d91491",
        "account_number": null,
        "location_api_id": null,
        "name": "Test Retail (m9clq830w769lik9)123",
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
        "created_ts": 1421937392, 
        "modified_ts": 1421937514,
        "location_api_key": null,
        "branding_domain_url": "wo74cjoi4u8oajor.domain.com",
        "parent_id": "54c0bf68-e516-ebb1-ba80-ee5793e30557",
        "_links": {
            "self": {
                "href":"{url}/v2/locations/54c1b053-f074-1795-1ba3-2feb99d91491" 
            }
        }  
    }
}
```

#### View Record List

```GET /v2/locations```

_**Note**: Filters can be used to search for Locations by including the columns you want to filter on as URL parameters. i.e._ ```/v2/locations?field=value&field2=value2```

##### Request

```json
{
    // Empty Payload - Nothing Needed Here
}
```

##### Response 

```json
Conditional JSON response.  Only HTTP Response Code for Success.

204 - Success, Location was deleted.
409 - Fail, validation error provided in JSON.
```

## Fields

| Name                                | Format  | Min | Max | Required on Post (Create) | Required on Put (Update) | System Generated | Comments                                                                  |
|-------------------------------------|---------|-----|-----|---------------------------|--------------------------|------------------|---------------------------------------------------------------------------|
| id                                  | string  | 24  | 36  |                           |                          | ✔                | Unique id of location                                                     |
| aba                                 | string  | 9   | 9   |                           |                          |                  | Aba / Routing                                                             |
| account_number                      | string  | 0   | 32  |                           |                          |                  | Account number                                                            |
| address1                            | string  | 0   | 32  |                           |                          |                  | Address 1                                                                 |
| address2                            | string  | 0   | 32  |                           |                          |                  | Address 2                                                                 |
| branding_domain_id                  | string  | 24  | 36  |                           |                          |                  | GUID for Branding Domain                                                  |
| city                                | string  | 0   | 100 |                           |                          |                  | City name                                                                 |
| contact_email_trx_receipt_default   | boolean |     |     |                           |                          |                  | If true, will email contact receipt for any transaction                   |
| created_ts                          | integer | 10  | 10  |                           |                          | ✔                | created timestamp                                                         |
| dda                                 | string  | 3   | 32  |                           |                          |                  | Dda                                                                       |
| default_ach                         | string  | 24  | 36  |                           |                          |                  | GUID for Location's default ACH Product Transaction                       |
| default_cc                          | string  | 24  | 36  |                           |                          |                  | GUID for Location's default CC Product Transaction                        |
| developer_company_id                | string  | 24  | 36  |                           |                          |                  | GUID for Developer Company                                                |
| email_reply_to                      | string  |     | 60  |                           |                          |                  | Used as from email address when sending various notifications             |
| fax                                 | string  | 10  | 10  |                           |                          |                  | Fax number                                                                |
| location_api_id                     | string  | 24  | 36  |                           |                          |                  | Location api ID                                                           |
| location_api_key                    | string  | 36  | 36  |                           |                          | ✔                | Location api key                                                          |
| location_c1                         | string  |     | 128 |                           |                          |                  | Can be used to store custom information for location.                     |
| location_c2                         | string  |     | 128 |                           |                          |                  | Can be used to store custom information for location.                     |
| location_c3                         | string  |     | 128 |                           |                          |                  | Can be used to store custom information for location.                     |
| modified_ts                         | integer | 10  | 10  |                           |                          |                  | Timestamp for last modification                                           |
| name                                | string  | 1   | 64  | ✔                         |                          |                  | Name of the company                                                       |
| office_phone                        | string  | 10  | 10  |                           |                          |                  | Office phone number                                                       |
| office_ext_phone                    | string  | 0   | 10  |                           |                          |                  | Office phone extension number                                             |
| parent_id                           | string  | 24  | 36  | ✔                         |                          |                  | Location GUID of the parent location                                      |
| recurring_notification_days_default | integer |     |     |                           |                          |                  | # of days prior to a Recurring running that a notification should be sent |
| receipt_logo                        | string  | 0   | 256 |                           |                          |                  | Receipt logo                                                              |
| show_contact_files                  | boolean |     |     |                           |                          |                  | If set to true will show "Files" tab on Contact                           |
| show_contact_notes                  | boolean |     |     |                           |                          |                  | If set to true will show "Notes" tab on Contact                           |
| state                               | string  |     | 100 |                           |                          |                  | State name                                                                |
| ticket_hash_key                     | string  | 36  | 36  |                           |                          | ✔                | Ticket hash key                                                           |
| tz                                  | string  | 0   | 24  |                           |                          |                  | Time zone                                                                 |
| zip_code                            | string  | 5   | 10  |                           |                          |                  | Zip code of the city                                                      |

## Expands (Related Records)

For detail on how to use Expands on an Endpoint, please visit the [Expands (Related Records)](https://github.com/PayaDev/PayaConnect/blob/master/Expands%20(Related%20Records).md) page.

| Related Record      | Expand ID            |
|---------------------|----------------------|
| Branding Domain     | branding_domain      |
| Created User        | created_user         |
| Developer Company   | developer_company    |
| Product Transaction | product_transactions |
| Product Recurring   | product_recurring    |
| Product File        | product_file         |
| Parent              | parent               |
| Terminals           | terminal             |

#### Expand Examples
Below are some examples of “expanding” this endpoint to one of the above related records.

#### Parent Location

```GET /v2/locations/{location_id}?expand=parent```

```json
{
    "locations": [
        {
            "id": "{location_id}",
            "name": "Sample Company Location",
            ... // Other Location properties
            "parent": {
                "id": "{parent_location_id}",
                "location_api_id": "{integrator's location uuid}",
                "name": "Sample Company Headquarters",
                "address1": "123 Main Street",
                "address2": "",
                "city": "Novi",
                "state": "MI",
                "zip_code": "48375",
                "office_phone": "2481234567",
                "office_ext_phone": "",
                "fax": "",
                "account_number": "",
                "ticket_hash_key": "{system generated value}",
                "tz": "America/New_York",
                "created_ts": 1392066931,
                "modified_ts": 1549634496,
                "location_api_key": "{system generated value}",
                "email_reply_to": "reply@some.email",
                "branding_domain_id": "{UUID for location's branding domain}",
                "parent_id": "{location_id for parent of this location parent}",
                "location_c1": null,
                "location_c2": null,
                "location_c3": null,
                "contact_email_trx_receipt_default": false,
                "default_cc": "{location's default CC Product Service UUID}",
                "default_ach": "{location's default ACH Product Service UUID}",
                "show_contact_notes": 1,
                "show_contact_files": 1,
                "recurring_notification_days_default": 0,
                "_links": {
                  "self": {
                    "href": "{domain}/v2admin/locations/{parent_location_id}"
                    }
                }
            }
        }
    ]
}
```

#### Developer Company

```json
{
    "locations": [
        {
            "id": "{location_id}",
            "name": "Sample Company Location",
            ... // Other Location properties
            "developer_company": {
                "id": "{developer company uuid}",
                "title": "ACME Developers Group",
                "description": null,
                "created_ts": 1529005121,
                "modified_ts": 1529005121,
                "created_user_id": "{user UUID that created record}",
                "modified_user_id": "{user UUID that last modified record}",
                "_links": {
                    "self": {
                        "href": "{domain}/v2/developercompanies/{developer company uuid}"
                    }
                }
            }
        }
    ]
}
```

#### Branding Domain

```GET /v2/locations/{location_id}?expand=branding_domain```

```json
{
    "locations": [
        {
            "id": "{location_id}",
            "name": "Sample Company Location",
            ... // Other Location properties
            "branding_domain": {
                "allow_contact_signup": false,
                "allow_contact_registration": true,
                "allow_contact_login": true,
                "registration_fields": [
                  "city",
                  "account_number"
                ],
                "id": "{Branding Domain UUID}",
                "url": "{domain}",
                "title": "Sample Branding Domain",
                "logo": null,
                "company_name": null,
                "support_email": null,
                "created_user_id": "{user_id}",
                "created": "2017-11-02 19:11:17",
                "modified_user_id": "{user_id}",
                "modified": "2018-11-12 18:42:40",
                "nav_color": null,
                "nav_logo": "{images.domain.com}/.../logo.png",
                "fav_icon": null,
                "button_primary_color": null,
                "logo_background_color": null,
                "icon_background_color": null,
                "menu_text_background_color": null,
                "menu_text_color": "",
                "right_menu_background_color": null,
                "right_menu_text_color": null,
                "button_primary_text_color": null,
                "aes_key": null,
                "help_text": "{... help message html ...}",
                "email_reply_to": null,
                "custom_javascript": null,
                "custom_theme": "default",
                "custom_css": "xzxzx",
                "created_ts": 1509649877
            }
        }
    ]
}
```

#### Using Multiple Expands

You can use multiple expands on an endpoint. Simply include them separated by a comma(s) like so:

```GET /v2/locations/{location_id}?expand=branding_domain,developer_company,parent```

```json
{
    "locations": [
        {
            "id": "{location_id}",
            "name": "Sample Company Location",
            ... // Other Location properties
            "branding_domain": {
                ... // Branding domain properties
            },
            "parent": {
                ... // Parent properties
            },
            "developer_company": {
                ... // Developer Company properties
            }
        }
    ]
}
```
