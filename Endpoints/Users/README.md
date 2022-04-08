# Users Endpoint

## Endpoint Actions

### Create Record
`POST /v2/users`

Request
```json
{
    "user": {
        "primary_location_id":"{{location_id}}",
        "branding_domain_id":"{{branding_domain_id}}",
        "first_name":"test",
        "last_name":"user",
        "email":"testuser@test.com",
        "username":"{{user_name}}",
        "password":"Password123!",
        "user_type_id":"200",
        "user_api_key": "jfg9j8ashf83hrisdjw983hu4rbfsd8h3" // Optional
    }
}
```

Response
```json
{
    "user": {
        "id": "{id}",
        "domain_id": "{branding_domain_id}",
        "contact_id": "{contact_id}",
        "username": "{user_name}",
        "email": "testuser@test.com",
        "user_type_id": 200,
        "locale": "en-US",
        "status": 1,
        "tz": "America/New_York",
        "login_attempts": null,
        "current_login_ip": "",
        "current_login": null,
        "last_login_ts": 1518627249,
        "requires_new_password": "",
        "created_ts": 1422030616,
        "modified_ts": 1422030616,
        "primary_location_id": "{location_id}",
        "branding_domain_url": "{branding_domain_url}",
        "created_user_id": "11e7a84asdf098as768b2661a9a",
        "terms_condition_id": "20136422.00",
        "terms_accepted_ts": 1518627249,
        "terms_agree_ip": "24.255.177.186",
        "current_date_time": "2019-03-11T10:38:26-0700",
        "ui_prefs": {
            "entry_page": "dashboard",
            "page_size": 15,
            "report_export_type": "csv",
            "process_method": "virtual_terminal",
            "default_terminal": "11e7ce9sd8f9d388281db01"
        },
        "user_api_key": null,
        "user_hash_key": null,
        "first_name": "test",
        "last_name": "user",
        "address": null,
        "city": null,
        "state": null,
        "zip": null,
        "account_number": null,
        "date_of_birth": null,
        "email_trx_receipt": false,
        "company_name": null,
        "home_phone": null,
        "cell_phone": null,
        "office_phone": null,
        "office_ext_phone": null,
        "_links": {
            "self": {
                "href": "{url}/v2/users/{id}"
            }
        }
    }
}
```

### Generate User API Key
For more information about using **user_api_key** please take a look at the [Authentication]() page.

**IMPORTANT**: If you want to use a custom *user_api_key* you need to provide this value during the [Create Record](readme.md#create-record) POST.  If you need to to use a user_api_key after the user is already created there is a specific endpoint that can be used to generate a *user_api_key*.  Details about using this other endpoint to generate a user_api_key can be found below.

`POST /v2/users/{id}/generateuserapikey`

**Sample Response**

Request
```json
{
    // Empty Payload - Nothing needed here
}
```
Response
```json
{
    "user": {
        "user_api_key": "234bas8dfn8238f923w2"
    }
}
```
### Update Record
`PUT /v2/users/{id}`

Request
```json
{
    "user": {
        "first_name":"John"
        ... // Other fields to update
    }
}
```
Response
```json
{
    "user": {
        "id": "{id}",
        "domain_id": "{branding_domain_id}",
        "contact_id": "{contact_id}",
        "username": "{user_name}",
        "email": "testuser@test.com",
        "user_type_id": 200,
        "locale": "en-US",
        "status": 1,
        "tz": "America/New_York",
        "login_attempts": null,
        "current_login_ip": "",
        "current_login": null,
        "last_login_ts": 1518627249,
        "requires_new_password": "",
        "created_ts": 1422030616,
        "modified_ts": 1422030616,
        "primary_location_id": "{location_id}",
        "branding_domain_url": "{branding_domain_url}",
        "created_user_id": "11e7a84asdf098as768b2661a9a",
        "terms_condition_id": "20136422.00",
        "terms_accepted_ts": 1518627249,
        "terms_agree_ip": "24.255.177.186",
        "current_date_time": "2019-03-11T10:38:26-0700",
        "ui_prefs": {
            "entry_page": "dashboard",
            "page_size": 15,
            "report_export_type": "csv",
            "process_method": "virtual_terminal",
            "default_terminal": "11e7ce9sd8f9d388281db01"
        },
        "user_api_key": null,
        "user_hash_key": null,
        "first_name": "John",
        "last_name": "user",
        "address": null,
        "city": null,
        "state": null,
        "zip": null,
        "account_number": null,
        "date_of_birth": null,
        "email_trx_receipt": false,
        "company_name": null,
        "home_phone": null,
        "cell_phone": null,
        "office_phone": null,
        "office_ext_phone": null,
        "_links": {
            "self": {
                "href": "{url}/v2/users/{id}"
            }
        }
    }
}
```
### Update Password
`PUT /v2/users/{id}`

This endpoint can be used to change a users password. When changing a users password the following criteria apply:

- If the logged in user changing the password of another user, the password is only good for one time use.
- If the logged in user is changing their own password, the old password field must be supplied.
Below is an example of a user changing another users password which is good for one time use.

Request
```json
{
    "user": {
        "old_password": "Password123!",
        "password": "New_Password123!
    }
}
```
Response
```json
{
    "user": {
        "id": "{id}",
        "domain_id": "{branding_domain_id}",
        "contact_id": "{contact_id}",
        "username": "{user_name}",
        "email": "testuser@test.com",
        "user_type_id": 200,
        "locale": "en-US",
        "status": 1,
        "tz": "America/New_York",
        "login_attempts": null,
        "current_login_ip": "",
        "current_login": null,
        "last_login_ts": 1518627249,
        "requires_new_password": "",
        "created_ts": 1422030616,
        "modified_ts": 1422030616,
        "primary_location_id": "{location_id}",
        "branding_domain_url": "{branding_domain_url}",
        "created_user_id": "11e7a84asdf098as768b2661a9a",
        "terms_condition_id": "20136422.00",
        "terms_accepted_ts": 1518627249,
        "terms_agree_ip": "24.255.177.186",
        "current_date_time": "2019-03-11T10:38:26-0700",
        "ui_prefs": {
            "entry_page": "dashboard",
            "page_size": 15,
            "report_export_type": "csv",
            "process_method": "virtual_terminal",
            "default_terminal": "11e7ce9sd8f9d388281db01"
        },
        "user_api_key": null,
        "user_hash_key": null,
        "first_name": "John",
        "last_name": "user",
        "address": null,
        "city": null,
        "state": null,
        "zip": null,
        "account_number": null,
        "date_of_birth": null,
        "email_trx_receipt": false,
        "company_name": null,
        "home_phone": null,
        "cell_phone": null,
        "office_phone": null,
        "office_ext_phone": null,
        "_links": {
            "self": {
                "href": "{url}/v2/users/{id}"
            }
        }
    }
}
```

### View Single Record
`GET /v2/users/{id}`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```
Response
```json
{
    "user": {
        "id": "{id}",
        "domain_id": "{branding_domain_id}",
        "contact_id": "{contact_id}",
        "username": "{user_name}",
        "email": "testuser@test.com",
        "user_type_id": 200,
        "locale": "en-US",
        "status": 1,
        "tz": "America/New_York",
        "login_attempts": null,
        "current_login_ip": "",
        "current_login": null,
        "last_login_ts": 1518627249,
        "requires_new_password": "",
        "created_ts": 1422030616,
        "modified_ts": 1422030616,
        "primary_location_id": "{location_id}",
        "branding_domain_url": "{branding_domain_url}",
        "created_user_id": "11e7a84asdf098as768b2661a9a",
        "terms_condition_id": "20136422.00",
        "terms_accepted_ts": 1518627249,
        "terms_agree_ip": "24.255.177.186",
        "current_date_time": "2019-03-11T10:38:26-0700",
        "ui_prefs": {
            "entry_page": "dashboard",
            "page_size": 15,
            "report_export_type": "csv",
            "process_method": "virtual_terminal",
            "default_terminal": "11e7ce9sd8f9d388281db01"
        },
        "user_api_key": null,
        "user_hash_key": null,
        "first_name": "test",
        "last_name": "user",
        "address": null,
        "city": null,
        "state": null,
        "zip": null,
        "account_number": null,
        "date_of_birth": null,
        "email_trx_receipt": false,
        "company_name": null,
        "home_phone": null,
        "cell_phone": null,
        "office_phone": null,
        "office_ext_phone": null,
        "_links": {
            "self": {
                "href": "{url}/v2/users/{id}"
            }
        }
    }
}
```

### View Self Record
`GET /v2/users/me`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```
Response
```json
{
    "user": {
        "id": "{id}",
        "domain_id": "{branding_domain_id}",
        "contact_id": "{contact_id}",
        "username": "{user_name}",
        "email": "testuser@test.com",
        "user_type_id": 200,
        "locale": "en-US",
        "status": 1,
        "tz": "America/New_York",
        "login_attempts": null,
        "current_login_ip": "",
        "current_login": null,
        "last_login_ts": 1518627249,
        "requires_new_password": "",
        "created_ts": 1422030616,
        "modified_ts": 1422030616,
        "primary_location_id": "{location_id}",
        "branding_domain_url": "{branding_domain_url}",
        "created_user_id": "11e7a84asdf098as768b2661a9a",
        "terms_condition_id": "20136422.00",
        "terms_accepted_ts": 1518627249,
        "terms_agree_ip": "24.255.177.186",
        "current_date_time": "2019-03-11T10:38:26-0700",
        "ui_prefs": {
            "entry_page": "dashboard",
            "page_size": 15,
            "report_export_type": "csv",
            "process_method": "virtual_terminal",
            "default_terminal": "11e7ce9sd8f9d388281db01"
        },
        "user_api_key": null,
        "user_hash_key": null,
        "first_name": "test",
        "last_name": "user",
        "address": null,
        "city": null,
        "state": null,
        "zip": null,
        "account_number": null,
        "date_of_birth": null,
        "email_trx_receipt": false,
        "company_name": null,
        "home_phone": null,
        "cell_phone": null,
        "office_phone": null,
        "office_ext_phone": null,
        "_links": {
            "self": {
                "href": "{url}/v2/users/{id}"
            }
        }
    }
}
```

### View Record List
`GET /v2/users`

*Note: Filters can be used to search for Users by including the columns you want to filter on as URL parameters. i.e.* `/v2/users?field=value&field2=value2`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

Response
```json
{
    "users": [
        {
            "id": "{id}",
            "domain_id": "{branding_domain_id}",
            "contact_id": "{contact_id}",
            "username": "{user_name}",
            "email": "testuser@test.com",
            "user_type_id": 200,
            "locale": "en-US",
            "status": 1,
            "tz": "America/New_York",
            "login_attempts": null,
            "current_login_ip": "",
            "current_login": null,
            "last_login_ts": 1518627249,
            "requires_new_password": "",
            "created_ts": 1422030616,
            "modified_ts": 1422030616,
            "primary_location_id": "{location_id}",
            "branding_domain_url": "{branding_domain_url}",
            "created_user_id": "11e7a84asdf098as768b2661a9a",
            "terms_condition_id": "20136422.00",
            "terms_accepted_ts": 1518627249,
            "terms_agree_ip": "24.255.177.186",
            "current_date_time": "2019-03-11T10:38:26-0700",
            "ui_prefs": {
                "entry_page": "dashboard",
                "page_size": 15,
                "report_export_type": "csv",
                "process_method": "virtual_terminal",
                "default_terminal": "11e7ce9sd8f9d388281db01"
            },
            "user_api_key": null,
            "user_hash_key": null,
            "first_name": "test",
            "last_name": "user",
            "address": null,
            "city": null,
            "state": null,
            "zip": null,
            "account_number": null,
            "date_of_birth": null,
            "email_trx_receipt": false,
            "company_name": null,
            "home_phone": null,
            "cell_phone": null,
            "office_phone": null,
            "office_ext_phone": null,
            "_links": {
                "self": {
                    "href": "{url}/v2/users/{id}"
                }
            }
        },
        ... // Other Users Here
    ],
    "meta": {
        "pagination": {
            "links": {
                "self": {
                    "href": "{url}/v2/users?page_size=3&page=1"
                },
                "next": {
                    "href": "{url}/v2/users?page_size=3&page=2"
                },
                "last": {
                    "href": "{url}/v2/users?page_size=3&page=3"
                }
            },
            "totalCount": 8,
            "pageCount": 3,
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

### Delete Record
`DELETE /v2/users/{id}`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

Response
```json
Conditional JSON Response on HTTP Response Code:

204 - Success, User was deleted.
409 - Fail, User was not deleted. Validation error provided.
```
 

## Fields
| Name                         | Format     | Min. | Max. | Allowed on POST | Allowed on PUT | System Generated | Comments                                                                                               |
|------------------------------|------------|------|------|-----------------|----------------|------------------|--------------------------------------------------------------------------------------------------------|
| id                           | string     |      |  36  |                 |                | ✔                | ID                                                                                                     |
| account_number               | string     |      |  32  | ✔               |                |                  | Account Number                                                                                         |
| address                      | string     |      |  64  | ✔               |                |                  | Address                                                                                                |
| branding_domain_url          | string     |      | 64   |                 |                |                  | system generated                                                                                       |
| cell_phone                   | string     |      | 10   |                 |                |                  |                                                                                                        |
| city                         | string     |      |  100 |                 |                |                  | City Name                                                                                              |
| company_name                 | string     |      | 64   |                 |                |                  |                                                                                                        |
| contact_id                   | string     |      |  36  |                 |                | ✔                | Contact ID                                                                                             |
| created_ts                   | integer    |      |  10  |                 |                | ✔                | Created Time Stamp                                                                                     |
| created_user_id              | string     |      | 36   |                 |                |                  |                                                                                                        |
| current_date_time            | string     |      |      |                 |                | ✔                | Current date and time                                                                                  |
| current_login                | date       |      |      |                 |                | ✔                | Datetime                                                                                               |
| current_login_ip             | string     |      | 64   |                 |                | ✔                | Current Login IP                                                                                       |
| date_of_birth                | yyyy-mm-dd |      |      |                 |                |                  | Datetime                                                                                               |
| domain_id                    | string     |      | 36   |                 |                | ✔                | Payment method                                                                                         |
| email                        | string     |      |  128 | ✔               |                |                  | Email                                                                                                  |
| email_trx_receipt            | boolean    |      |      | ✔               |                |                  | Set to true to email transaction receipts                                                              |
| home_phone                   | string     |      | 10   |                 |                |                  |                                                                                                        |
| first_name                   | string     |      |  64  |                 |                |                  | First Name                                                                                             |
| last_login_ts                | integer    |      |      |                 |                |                  | Last login timestamp                                                                                   |
| last_name                    | string     |      |  64  |                 |                |                  | Last Name                                                                                              |
| locale                       | string     |      |  8   |                 |                |                  | Locale                                                                                                 |
| login_attempts               | integer    |      |      |                 |                |                  | Login attempts                                                                                         |
| modified_ts                  | integer    |      |  10  |                 |                | ✔                | Modified Time Stamp                                                                                    |
| office_phone                 | string     |      | 10   |                 |                |                  |                                                                                                        |
| office_ext_phone             | string     |      | 10   |                 |                |                  |                                                                                                        |
| primary_location_id          | string     |      | 36   |                 |                | ✔                | Primary Location ID                                                                                    |
| requires_new_password        | string     |      |  1   |                 |                |                  | Required new password                                                                                  |
| state                        | string     |      |  100 |                 |                |                  | State name                                                                                             |
| status                       | boolean    |      |      |                 |                | ✔                | True indicates an "active" status for the User record.                                                 |
| terms_accepted_ts            | integer    |      |      |                 |                | ✔                | Timestamp of when terms were accepted                                                                  |
| terms_agree_ip               | string     |      |      |                 |                |                  | IP address of client machine from which terms were accepted                                            |
| terms_condition_id           | string     |      | 36   |                 |                |                  | UUID for set of terms and conditions                                                                   |
| tz                           | string     |      | 30   |                 |                |                  | Time Zone                                                                                              |
| ui_prefs                     | JSON       |      |      |                 |                | ✔                | Contains various User preferences in JSON object                                                       |
| ui_prefs[entry_page]         | string     |      |      |                 |                | ✔                | Default: "dashboard"                                                                                   |
| ui_prefs[page_size]          | integer    |      |      |                 |                | ✔                | Default: 15                                                                                            |
| ui_prefs[report_export_type] | string     |      |      |                 |                | ✔                | Default: "csv"                                                                                         |
| ui_prefs[process_method]     | string     |      |      |                 |                | ✔                | Default: "virtual_terminal"                                                                            |
| ui_prefs[default_terminal]   | string     |      | 36   |                 |                | ✔                | Default: {Default terminal UUID from User's Location}                                                  |
| username                     | string     |      |  64  |                 |                | ✔                | User name used for logging into UI depending on integration                                            |
| user_api_key                 | string     |      | 64   | ✔               |                | ✔                | Used for authentication with certain integration types                                                 |
| user_hash_key                | string     |      |      |                 |                | ✔                | Used for authentication with certain integration types                                                 |
| user_type_id                 | integer    |      |  8   |                 |                |                  | Used to identify role/permissions. Users with user_type_id of 250 are labelled as Client Admins in UI. |
| zip                          | string     |      |  10  |                 |                |                  | Zip code                                                                                               |
 
