# Contacts Endpoint

The Contacts feature allows your integration to neatly organization transactions, account vault data, recurring payments, and quick invoices by customer.  This is beneficial for solutions that allow a customer to store multiple payment types and maybe looking to reference customer within there ecosystem.  Below, you will find information on the available endpoint actions, fields, requirements, and responses for the Contacts Endpoint. These samples include the initial request and response that is expected when building out your integration.

## Endpoint Actions

### Create Record

`POST /v2/contacts`

Request
```json
{
    "contact": {
        "location_id": "123456789012345678901234",
        "account_number": "1234",
        "contact_api_id": "137",
        "first_name": "John",
        "last_name": "Smith",
        "cell_phone": "1234567890",
        "contact_balance": "245.65"
    }
}
```

Response
```json
{
    "contact": {
        "id": "123456789012345678901234",
        "location_id": "123456789012345678901234",
        "account_number": "1234",
        "contact_api_id": "137",
        "company_name": null,
        "first_name": "John",
        "last_name": "Smith",
        "email": null,
        "address": null,
        "city": null,
        "zip": null,
        "home_phone": null,
        "cell_phone": "1234567890",
        "office_phone": null,
        "office_ext_phone": null,
        "contact_balance": "245.65",
        "email_trx_receipt": false,
        "created_ts": 1421870788,
        "modified_ts": null,
        "date_of_birth": null,
        "header_message": null,
        "header_message_type": 0,
        "_links": {
            "self": {
                "href": "https://{url}/v2/contacts/123456789012345678901234"
            }
        }
    }
}
```

### Update Record
`PUT /v2/contacts/{id}`

Request
```json
{
    "contact": {
        "cell_phone": "0987654321"
    }
}
```
Response
```json
{
    "contact": {
        "id": "123456789012345678901234",
        "location_id": "123456789012345678901234",
        "account_number": "1234",
        "contact_api_id": "137",
        "company_name": null,
        "first_name": "John",
        "last_name": "Smith",
        "email": null,
        "address": null,
        "city": null,
        "zip": null,
        "home_phone": null,
        "cell_phone": "0987654321",
        "office_phone": null,
        "office_ext_phone": null,
        "contact_balance": "245.65",
        "email_trx_receipt": false,
        "created_ts": 1421870788,
        "modified_ts": null,
        "date_of_birth": null,
        "header_message": null,
        "header_message_type": 0,
        "_links": {
            "self": {
                "href": "https://{url}/v2/contacts/123456789012345678901234"
            }
        }
    }
}
```
### View Single Record
`GET /v2/contacts/{id}`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```
Response
```json
{
    "contact": {
        "id": "123456789012345678901234",
        "location_id": "123456789012345678901234",
        "account_number": "1234",
        "contact_api_id": "137",
        "company_name": null,
        "first_name": "John",
        "last_name": "Smith",
        "email": null,
        "address": null,
        "city": null,
        "zip": null,
        "home_phone": null,
        "cell_phone": "0987654321",
        "office_phone": null,
        "office_ext_phone": null,
        "contact_balance": "245.65",
        "email_trx_receipt": false,
        "created_ts": 1421870788,
        "modified_ts": null,
        "date_of_birth": null,
        "header_message": null,
        "header_message_type": 0,
        "_links": {
            "self": {
                "href": "https://{url}/v2/contacts/123456789012345678901234"
            }
        }
    }
}
```

### View Record List
`GET /v2/contacts`

*Note: Filters can be used to search for Contacts by including the columns you want to filter on as URL parameters. for example `/v2/contacts?field=value&field2=value2`*

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```
Response
```json
{
    "contacts": [
        {
            "id": "123456789012345678901234",
            "location_id": "123456789012345678901234",
            "account_number": "1234",
            "contact_api_id": "137",
            "company_name": null,
            "first_name": "John",
            "last_name": "Smith",
            "email": null,
            "address": null,
            "city": null,
            "zip": null,
            "home_phone": null,
            "cell_phone": "2485551111",
            "office_phone": null,
            "office_ext_phone": null,
            "contact_balance": "245.65",
            "email_trx_receipt": false,
            "created_ts": 1421870788,
            "modified_ts": null,
            "date_of_birth": null,
            "header_message": null,
            "header_message_type": 0,
            "_links": {
                "self": {
                    "href": "{url}/v2/contacts/123456789012345678901234"
                }
            }
        },
        ... // Other Contact Records
 
        {
            "id": "123456789012345678901235",
            "location_id": "123456789012345678901234",
            "account_number": "9876",
            "contact_api_id": "654",
            "company_name": null,
            "first_name": "Billy",
            "last_name": "Bob",
            "email": null,
            "address": null,
            "city": null,
            "zip": null,
            "home_phone": null,
            "cell_phone": "3135558585",
            "office_phone": null,
            "office_ext_phone": null,
            "contact_balance": null,
            "email_trx_receipt": false,
            "created_ts": 1421870338,
            "modified_ts": null,
            "date_of_birth": null,
            "header_message": null,
            "header_message_type": 0,
            "_links": {
                "self": {
                    "href": "{url}/v2/contacts/123456789012345678901235"
                }
            }
        }
    ],
    "meta": {
        "pagination": {
            "links": {
                "self": {
                    "href": "{url}/v2/contacts?field=value&field2=value2&sort=-created&page=1"
                },
                "next": {
                    "href": "{url}/v2/contacts?field=value&field2=value2&sort=-created&page=2"
                },
                "last": {
                    "href": "{url}/v2/contacts?field=value&field2=value2&sort=-created&page=11"
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

### Delete Record
`DELETE /v2/contacts/{id}`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```
Response
```json
No JSON response provided.  HTTP Response Code only.

204 - Success, Contact was deleted.
404 - Fail, Contact not found.
```
 

## Fields
| Name                | Min | Max | Format     | POST Required | POST Allowed | PUT Allowed | Comments                                                                                                                                                                                                                                                                                                                                                  |
|---------------------|-----|-----|------------|---------------|--------------|-------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| id                  | 24  | 36  | string     |               |              |             | System generated id                                                                                                                                                                                                                                                                                                                                       |
| account_number      | 0   | 32  | string     |               | ✔            | ✔           | Contacts account number for bookkeeping                                                                                                                                                                                                                                                                                                                   |
| address             | 0   | 255 | string     |               | ✔            | ✔           | Address of contact                                                                                                                                                                                                                                                                                                                                        |
| cell_phone          | 10  | 10  | string     |               | ✔            | ✔           | Cell phone of contact                                                                                                                                                                                                                                                                                                                                     |
| city                | 0   | 100 | string     |               | ✔            | ✔           | City of contact                                                                                                                                                                                                                                                                                                                                           |
| company_name        | 0   | 64  | string     |               | ✔            | ✔           | Company name of contact if applicable                                                                                                                                                                                                                                                                                                                     |
| contact_api_id      | 0   | 36  | string     |               | ✔            | ✔           | Contacts unique id used by API clients. This field is required if update_if_exists is set to '1'. This field can be used to correlate Contacts in our system to data within an outside software integration. In addition, when running a transaction, this value can be used in place of contact_id in order to associate the transaction with a contact. |
| contact_balance     | 0   | 12  | string     |               | ✔            | ✔           | Can be used to maintain a balance for the contact.                                                                                                                                                                                                                                                                                                        |
| contact_c1          | 0   | 128 | string     |               | ✔            | ✔           | Custom field 1 for api users to store custom data                                                                                                                                                                                                                                                                                                         |
| contact_c2          | 0   | 128 | string     |               | ✔            | ✔           | Custom field 2 for api users to store custom data                                                                                                                                                                                                                                                                                                         |
| contact_c3          | 0   | 128 | string     |               | ✔            | ✔           | Custom field 3 for api users to store custom data                                                                                                                                                                                                                                                                                                         |
| created_ts          | 10  | 10  | integer    |               |              |             | System created timestamp                                                                                                                                                                                                                                                                                                                                  |
| date_of_birth       | 10  | 10  | yyyy-mm-dd |               | ✔            | ✔           | Contacts DOB                                                                                                                                                                                                                                                                                                                                              |
| email               | 5   | 64  | string     |               | ✔            | ✔           | Contacts email                                                                                                                                                                                                                                                                                                                                            |
| email_trx_receipt   | 1   | 1   | string     |               | ✔            | ✔           | Whether or not to email all transactions receipts to contact (1 or 0)                                                                                                                                                                                                                                                                                     |
| first_name          | 0   | 64  | string     |               | ✔            | ✔           | Contacts first name                                                                                                                                                                                                                                                                                                                                       |
| header_message      | 0   | 250 | string     |               | ✔            | ✔           | Header message to display in user interface                                                                                                                                                                                                                                                                                                               |
| header_message_type | 0   | 1   | integer    |               | ✔            | ✔           | header message type (0 = popup, 1-4 = colored banners)                                                                                                                                                                                                                                                                                                    |
| home_phone          | 10  | 10  | string     |               | ✔            | ✔           | Contacts home phone                                                                                                                                                                                                                                                                                                                                       |
| last_name           | 1   | 64  | string     | ✔             | ✔            | ✔           | Contacts last name                                                                                                                                                                                                                                                                                                                                        |
| location_id         | 24  | 36  | string     | ✔             | ✔            |             | Location id the contact belongs to                                                                                                                                                                                                                                                                                                                        |
| modified_ts         | 10  | 10  | integer    |               |              |             | System modified timestamp                                                                                                                                                                                                                                                                                                                                 |
| office_ext_phone    | 0   | 10  | string     |               | ✔            | ✔           | Optional phone extension for office phone                                                                                                                                                                                                                                                                                                                 |
| office_phone        | 10  | 10  | string     |               | ✔            | ✔           | Contacts office phone                                                                                                                                                                                                                                                                                                                                     |
| state               | 2   | 2   | string     |               | ✔            | ✔           | Contacts valid two character state (e.g. MI, OH, NY)                                                                                                                                                                                                                                                                                                      |
| update_if_exists    | 1   | 1   | integer    |               | ✔            |             | Allows for updating of contacts using the POST method. If this field is set to '1' when POSTing, the contact will be updated (instead of returning 422 error) if it already exists.                                                                                                                                                                       |
| zip                 | 4   | 12  | string     |               | ✔            | ✔           | Alphanumeric, spaces, and dashes to accomodate domestic and international posyal codes                                                                                                                                                                                                                                                                    |
 

## Expands (Related Records)
For detail on how to use Expands on an endpoint, please visit the Expands (Related Records) page.

| Related Record | Filter Name  |
|----------------|--------------|
| Created User   | created_user |
| Notes          | notes        |
| Location       | location     |
| User           | user         |
 

An example of “expanding” this endpoint to one of the above related records would look like this:

`GET /v2/contacts/xxxxxxxxxxxxxxxxxxxxxxxx?expand=created_user`

To use multiple expands on this endpoint, simply include them both separated by a comma like so:

`GET /v2/contacts/xxxxxxxxxxxxxxxxxxxxxxxx?expand=created_user,notes`
