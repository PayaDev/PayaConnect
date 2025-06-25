# Recurrings Endpoint

The recurrings endpoint is used to run a recurring transaction one or more times. There are two different types of recurrings:

 1. **Ongoing** (recurring_type_id="o") - a recurring that runs until it is deleted or an end date has been set.
 2. **Installment** (recurring_type_id="i") - a recurring that runs a fixed number of times, regardless of approval or decline. 

When setting up a reccuring, it isn't necessarily linked directly to a contact, it is linked to an account vault through the account_vault_id or account_vault_api_id field. The account vault is then in turn linked to a contact. So in order to create a recurring, you must first create a contact, then create an account vault for that contact. Then the id of the account vault can be used for the recurring as account_vault_id.

### Endpoint Actions

#### Create Record
```POST /v2/recurrings```

##### Request
```json
{
    "recurring": {
        "account_vault_id": "111111111111111111111111",
        "location_id": "9as8df9asufas9fs9dfjas9fjas",
        "product_transaction_id": "02320asd9fjasf983nasd9asdf",
        "interval": 1,
        "interval_type": "m",
        "start_date": "2018-01-01",
        "description": "Test Recurring",
        "transaction_amount": "1.50",
        "notification_days": 2
    }
}
```

##### Response
```json
{
    "recurring": {
        "id": "123456789012345678901",
        "account_vault_id": "111111111111111111111111",
        "location_id": "9as8df9asufas9fs9dfjas9fjas",
        "product_transaction_id": "02320asd9fjasf983nasd9asdf",
        "description": "Test Recurring",
        "transaction_amount": "1.50",
        "interval_type": "m",
        "interval": 1,
        "next_run_date": "2018-01-01",
        "payment_method": "cc",
        "start_date": "2018-01-01",
        "end_date": "0000-00-00",
        "notification_days": 2,
        "created_ts": 1422282050,
        "modified_ts": 1422282050,
        "status": "active",
        "active": 1,
        "recurring_type_id": "o",
        "_links": {
            "self": {
                "href": "{url}/v2/recurrings/123456789012345678901"
            }
        }
    }
}
```

#### Update Record

```PUT /v2/recurrings/{id}```

##### Request
```json
{
    "recurring": {
        "next_run_date": "2018-01-01",
        ... // Other Optional Fields here
    }
}
```

##### Response
```json
{
    "recurring": {
        "id": "123456789012345678901",
        "account_vault_id": "111111111111111111111111",
        "location_id": "9as8df9asufas9fs9dfjas9fjas",
        "product_transaction_id": "02320asd9fjasf983nasd9asdf",
        "description": "Test Recurring",
        "transaction_amount": "1.50",
        "interval_type": "m",
        "interval": 1,
        "next_run_date": "2018-01-01",
        "payment_method": "cc",
        "start_date": "2018-01-01",
        "end_date": "0000-00-00",
        "notification_days": 2,
        "created_ts": 1422282050,
        "modified_ts": 1422282050,
        "status": "active",
        "active": 1,
        "recurring_type_id": "o",
        "_links": {
            "self": {
                "href": "{url}/v2/recurrings/123456789012345678901"
            }
        }
    }
}
```

#### View Single Record

```GET /v2/recurrings/{id}```

##### Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

##### Response
```json
{
    "recurring": {
        "id": "123456789012345678901",
        "account_vault_id": "111111111111111111111111",
        "location_id": "9as8df9asufas9fs9dfjas9fjas",
        "product_transaction_id": "02320asd9fjasf983nasd9asdf",
        "description": "Test Recurring",
        "transaction_amount": "1.50",
        "interval_type": "m",
        "interval": 1,
        "next_run_date": "2018-01-01",
        "payment_method": "cc",
        "start_date": "2018-01-01",
        "end_date": "0000-00-00",
        "notification_days": 2,
        "created_ts": 1422282050,
        "modified_ts": 1422282050,
        "status": "active",
        "active": 1,
        "recurring_type_id": "o",
        "_links": {
            "self": {
                "href": "{url}/v2/recurrings/123456789012345678901"
            }
        }
    }
}
```

#### View Record List

```GET /v2/recurrings```

_**Note**: Filters can be used to search for Recurrings by including the columns you want to filter on as **URL parameters.** i.e ```/v2/recurrings?field=value&field2=value2```_

##### Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

##### Response
```json
{
    "recurrings": [
        {
            "id": "123456789012345678901234",
            "account_vault_id": "111111111111111111111111",
            "location_id": "9as8df9asufas9fs9dfjas9fjas",
            "product_transaction_id": "02320asd9fjasf983nasd9asdf",
            "description": "Test Recurring",
            "transaction_amount": "1.50",
            "interval_type": "m",
            "interval": 1,
            "next_run_date": "2018-01-01",
            "payment_method": "cc",
            "start_date": "2018-01-01",
            "end_date": "0000-00-00",
            "notification_days": 2,
            "created_ts": 1422282050,
            "modified_ts": 1422282050,
            "status": "active",
            "active": 1,
            "recurring_type_id": "o",
            "_links": {
                "self": {
                    "href": "{url}/v2/recurrings/123456789012345678901234"
                }
            }
        },
        ... // Other Recurrings here
    ],
    "meta": {
        "pagination": {
            "links": {
                "self": {
                    "href": "{url}/v2/recurrings?page_size=2&page=1"
                },
                "next": {
                    "href": "{url}/v2/recurrings?page_size=2&page=2"
                },
                "last": {
                    "href": "{url}/v2/recurringspage_size=2&page=2"
                }
            },
            "totalCount": 4,
            "pageCount": 2,
            "currentPage": 0,
            "perPage": 2
        },
        "sort": {
            "attributes": {
                "next_run_date": "asc"
            }
        }
    }
}
```

#### Delete Resord

```DELETE /v2/recurrings/{id}```

##### Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

##### Response
```http
No JSON Response. Only HTTP Response code.

204 - Success, Recurring was deleted
404 - Fail, Recurring not found.
```

##### Skip Payment
This can be used to skip the next ```{number}``` of regularly scheduled recurring payment(s). Skipping a payment will not change the recurring end date. For recurrings with an installment count, the number of total installments collected will be reduced with each payment that is skipped. 

```POST /v2/recurrings/{id}/skipPayment?skip_count={number}```

##### Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

##### Response
```json
{
  "recurring": {
    "id": "11e936cf38dhgc0698fc5e71",
    "account_vault_id": "11e89b093jrsef664cbd0b6ebe",
    "description": "Test Recurring 022219",
    "transaction_amount": "10.00",
    "interval_type": "m",
    "interval": 1,
    "installment_total_count": 20,
    "installment_amount_total": "200.00",
    "next_run_date": "2019-03-23",
    "payment_method": "cc",
    "start_date": "2019-02-23",
    "end_date": "2020-10-22",
    "created_ts": 1550859859,
    "notification_days": 2,
    "modified_ts": 1550860111,
    "status": "active",
    "recurring_c1": null,
    "recurring_c2": null,
    "recurring_c3": null,
    "active": "1",
    "product_transaction_id": "11e8a09609asdjfasd0bafea6b3",
    "recurring_type_id": "i",
    "_links": {
      "self": {
        "href": "https://{domain}/v2/recurrings/11e936cf38dhgc0698fc5e71"
      }
    }
  }
}
```

#### Defer Payment

This can be used to skip the next {number} of regularly scheduled recurring payment(s) and add them to the end of the existing recurring cycle. Deferring a payment will ensure that original quantity of installment payments are still collected.

_**Note**: Ongoing Recurrings (recurring_type_id = "o") are NOT applicable for Defer._

```POST /v2/recurrings/{id}/deferPayment?defer_count={number}```

##### Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

##### Response
```json
{
  "recurring": {
    "id": "11e936cf38dhgc0698fc5e71",
    "account_vault_id": "11e89b093jrsef664cbd0b6ebe",
    "description": "Test Recurring 022219",
    "transaction_amount": "10.00",
    "interval_type": "m",
    "interval": 1,
    "installment_total_count": 20,
    "installment_amount_total": "200.00",
    "next_run_date": "2019-04-23",
    "payment_method": "cc",
    "start_date": "2019-02-23",
    "end_date": "2020-11-22",
    "created_ts": 1550859859,
    "notification_days": 2,
    "modified_ts": 1550860718,
    "status": "active",
    "recurring_c1": null,
    "recurring_c2": null,
    "recurring_c3": null,
    "active": "1",
    "product_transaction_id": "11e8a09609asdjfasd0bafea6b3",
    "recurring_type_id": "i",
    "_links": {
      "self": {
        "href": "https://{domain}/v2/recurrings/11e936cf38dhgc0698fc5e71"
      }
    }
  }
}
```

#### Put On Hold

This can be used to move a recurring to a status of "on hold" from "active".

```POST /v2/recurrings/{id}/placeOnHold```

##### Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

##### Response
```json
{
  "recurring": {
    "id": "11e939e551e3b57e8893cc51",
    "account_vault_id": "11e89b1acdf08g44a5ee5802",
    "description": "test ach recurring 3",
    "transaction_amount": "3.00",
    "interval_type": "m",
    "interval": 1,
    "installment_total_count": null,
    "installment_amount_total": null,
    "next_run_date": "0000-00-00",
    "payment_method": "ach",
    "start_date": "2019-02-27",
    "end_date": "0000-00-00",
    "created_ts": 1551199269,
    "notification_days": 0,
    "modified_ts": 1551199294,
    "status": "on hold",
    "recurring_c1": null,
    "recurring_c2": null,
    "recurring_c3": null,
    "active": "1",
    "product_transaction_id": "11e7a845d9f85568e1dea7d",
    "recurring_type_id": "o",
    "_links": {
      "self": {
        "href": "https://{domain}/v2/recurrings/11e939e551e3b57e8893cc51"
      }
    }
  }
}
```

#### Activate

This can be used to move a recurring to a status of "active" from "on hold".

```POST /v2/recurrings/{id}/activate```

##### Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

##### Request
```json
{
  "recurring": {
    "id": "11e939e551e3b57e8893cc51",
    "account_vault_id": "11e89b1acdf08g44a5ee5802",
    "description": "test ach recurring 3",
    "transaction_amount": "3.00",
    "interval_type": "m",
    "interval": 1,
    "installment_total_count": null,
    "installment_amount_total": null,
    "next_run_date": "0000-00-00",
    "payment_method": "ach",
    "start_date": "2019-02-27",
    "end_date": "0000-00-00",
    "created_ts": 1551199269,
    "notification_days": 0,
    "modified_ts": 1551199294,
    "status": "active",
    "recurring_c1": null,
    "recurring_c2": null,
    "recurring_c3": null,
    "active": "1",
    "product_transaction_id": "11e7a845d9f85568e1dea7d",
    "recurring_type_id": "o",
    "_links": {
      "self": {
        "href": "https://{domain}/v2/recurrings/11e939e551e3b57e8893cc51"
      }
    }
  }
}
```

# Fields

| Name                    | Min | Max | Format     | POST Required | POST Allowed | PUT Allowed | Comments                                                                                                                                                      |
|-------------------------|-----|-----|------------|---------------|--------------|-------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------|
| id                      | 24  | 36  | string     |               |              |             | System generated id                                                                                                                                           |
| account_vault_id        | 24  | 36  | string     | ✔             | ✔            | ✔           | The account_vault_id of the account vault to use when runnint the recurring transaction.                                                                      |
| active                  | 1   | 1   | string     |               | ✔            | ✔           | Current status (1 or 0) Note: Only "ongoing" recurrings (recurring_type_id="o") can be made inactive by PUT request.  Otherwise this field is ignored on PUT. |
| created_ts              | 10  | 10  | integer    |               |              |             | System created timestamp                                                                                                                                      |
| description             | 0   | 36  | string     |               | ✔            | ✔           | Description of Recurring Payment                                                                                                                              |
| end_date                | 10  | 10  | yyyy-mm-dd |               | ✔            | ✔           | End date of recurring                                                                                                                                         |
| installment_total_count | 0   | 2   | integer    |               | ✔            |             | Number of times to process the payment (optional)                                                                                                             |
| interval                | 1   | 3   | string     | ✔             | ✔            |             | Interval of recurring                                                                                                                                         |
| interval_type           | 1   | 1   | string     | ✔             | ✔            |             | Type of interval (enum of d, w, or m)                                                                                                                         |
| location_id             | 24  | 36  | string     | ✔              | ✔            |             | The ID for the Location where the Recurring is configured.                                                                                                    |
| next_run_date           | 10  | 10  | yyyy-m-dd  |               |              | ✔           | Next run date of recurring                                                                                                                                    |
| notification_days       | 1   | 2   | string     |               | ✔            | ✔           | Days to notify contact before next recurring processes                                                                                                        |
| payment_method          | 2   | 3   | string     |               | ✔            |             | Payment Method of recurring (enum of cc or ach)                                                                                                               |
| product_transaction_id  | 24  | 36  | string     |                | ✔            | ✔           | The ID for the Product Transaction to use when running the Recurring.                                                                                         |
| recurring_type_id       | 24  | 36  | string     |               |              |             | System Generated Flag based on configuration.  Returned in GET/PUT/POST responses for each record.                                                            |
| start_date              | 10  | 10  | yyyy-mm-dd | ✔             | ✔            |             | Start Date of recurring                                                                                                                                       |
| status                  | 5   | 7   | string     |               |              |             | Current status of recurring Possible values include: "active", "on hold", and "ended"                                                                         |
| transaction_amount      | 1   | 12  | string     | ✔             | ✔            |             | Amount of recurring                                                                                                                                           |

## Expands (Related Records)

For detail on how to use Expands on an Endpoint, please visit the [Expands (Related Records)] (https://github.com/kcskw/PayaConnect/blob/patch-1/Expand%20(Related%20Records).md) page.

| Related Record      | Filter Name         |
|---------------------|---------------------|
| Created User        | created_user        |
| Account Vault       | account_vault       |
| Transactions        | transactions        |
| Signature           | signature           |
| Location            | location            |
| Contact             | contact             |
| Tags                | tags                |
| Product Transaction | product_transaction |

An example of “expanding” this endpoint to one of the above related records would look like this:

```GET /v2/recurrings/xxxxxxxxxxxxxxxxxxxxxxxx?expand=location```

To use multiple expands on this endpoint, simply include them both separated by a comma like so:

```GET /v2/recurrings/xxxxxxxxxxxxxxxxxxxxxxxx?expand=location,created_user```


