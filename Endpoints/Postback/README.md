# Postback Configs Endpoint

The purpose of theis endpoint is to allow for configuration of a POstback Configuration vai the API. 
Visit Postback Configs for more informaion about what these are and how they can be used.

## Fields

The following table defines the fields that are utilized in configuring the postback.

| Parameter              | Type    | Description                                                                                                                                                                                                        |
|------------------------|---------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| attempt_interval       | integer | Number of seconds before another retry is submitted                                                                                                                                                                |
| basic_auth_username    | string  | The Basic authorization username for the URL, if not supplied, the postback will be submitted without Basic authorization headers, Note: this is only expandable for response but settable in the POST/PUT request |
| basic_auth_password    | string  | The basic authorization password Note: this is only expandable for response but settable in the POST/PUT request                                                                                                   |
| expands                | string  | An option list of expanded data to send with base data. (i.e. set this field to “contact,account_vault” to get the contact an accountvault used to run a transaction.)                                             |
| format                 | string  | Options include: "api-default"                                                                                                                                                                                     |
| is_active              | boolean | Flag to indicate whether configuration is active (in effect).                                                                                                                                                      |
| location_id            | string  | The location identifier of the resource you want to recieve postbacks from.                                                                                                                                        |
| on_create              | boolean | To receive postbacks on the creation of a resource                                                                                                                                                                 |
| on_update              | boolean | To receive postbacks on the updating of a resource                                                                                                                                                                 |
| on_delete              | boolean | To receive postbacks when the record is deleted                                                                                                                                                                    |
| product_transaction_id | string  | Required when using "transaction" or "transactionbatch" resource                                                                                                                                                   |
| number_of_attempts     | integer | Maximum number of attempts on failure                                                                                                                                                                              |
| resource               | string  | The resource you want to subscribe the postbacks to. Possible values include: “contact”, “transaction”, "transactionbatch", "accountvault"                                                                         |
| url                    | string  | The URL where the postback will be submitted                                                                                                                                                                       |

## Endpoint Actions

#### Create Postback Config

```POST /v2/postbackconfigs```

### Contact

##### Request

```json
{
  "postbackconfig": {
    "attempt_interval": 300,
    "basic_auth_username": null,
    "basic_auth_password": null,
    "expands": "",
    "format": "api-default",
    "is_active": "1",
    "location_id": "11e7a84525008da8960b72e7",
    "number_of_attempts": 1,
    "on_create": "1",
    "on_delete": "1",
    "on_update": "1",
    "resource": "contact",
    "url": "https://127.0.0.1/receiver"
  }
}
```

##### Response

```json
{
  "postbackconfig": {
    "id": "1028asnfias9f2j9sddf92jrwfskd",
    "location_id": "23948sdnfia1129i9asf92",
    "resource": "contact",
    "on_create": "1",
    "on_update": "1",
    "on_delete": "1",
    "url": "https://127.0.0.1/receiver",
    "is_active": "1",
    "format": "api-default",
    "number_of_attempts": 1,
    "attempt_interval": 300,
    "expands": "",
    "created_ts": 1539268970,
    "modified_ts": 1539268970,
    "_links": {
      "self": {
        "href": "https://api.sandbox.domain.com/v2/postbackconfigs/1028asnfias9f2j9sddf92jrwfskd"
      }
    }
  }
}
```

### Transaction

##### Request

```json
{
    "postbackconfig": {
        "location_id": "11e936d64d69cd92845615e4",
        "resource": "transaction",
        "url": "https://127.0.0.1/v2/public/ping?developer-id=aOQxJK0",
        "product_transaction_id": "11e936d65afb106096f3f340",
        "basic_auth_username": "tester",
        "basic_auth_password": "Test@522",
        "expands": "changelogs,tags",
        "on_create": 1,
        "on_update": 1,
        "on_delete": 0,
        "is_active": 1
    }
}
```

##### Response

```json
{
    "postbackconfig": {
        "id": "11e936d6ea9sadfh74bf5bf3bd",
        "location_id": "11e936d6a9sdfj92845615e4",
        "resource": "transaction",
        "on_create": 1,
        "on_update": 0,
        "on_delete": 1,
        "url": "https://127.0.0.1/v2/public/ping?developer-id=aOQxJK0",
        "is_active": 1,
        "format": "api-default",
        "number_of_attempts": 1,
        "attempt_interval": 300,
        "expands": "changelogs,tags",
        "created_ts": 1550863225,
        "modified_ts": 1550863225,
        "product_transaction_id": "11e936d65afb106096f3f340",
        "_links": {
            "self": {
                "href": "https://127.0.0.1/v2/postbackconfigs/11e936d6ea9sadfh74bf5bf3b"
            }
        }
    }
}
```

### Transaction Batch

##### Request

```json
{
    "postbackconfig": {
        "location_id": "111111111111111111",
        "resource": "transactionbatch",
        "url": "https://127.0.0.1/v2/public/ping?developer-id=11111",
        "basic_auth_username": "testuname",
        "basic_auth_password": "Test@522",
        "product_transaction_id": "222222222222222222",
        "expands": "changelogs",
        "on_create": 1,
        "on_update": 0,
        "on_delete": 1,
        "is_active": 1
    }
}
```

##### Response

```json
{
    "postbackconfig": {
        "id": "11e92007dcf1fd268642b3f4",
        "location_id": "111111111111111111",
        "resource": "transactionbatch",
        "on_create": 1,
        "on_update": 0,
        "on_delete": 1,
        "url": "https://127.0.0.1/v2/public/ping?developer-id=11111",
        "is_active": 1,
        "format": "api-default",
        "number_of_attempts": 1,
        "attempt_interval": 300,
        "expands": "changelogs",
        "created_ts": 1548355375,
        "modified_ts": 1548355375,
        "product_transaction_id": "222222222222222222",
        "_links": {
            "self": {
                "href": "https://127.0.0.1/v2/postbackconfigs/11e92007dcf1fd268642b3f4"
            }
        }
    }
}
```

### Account Vault

##### Request

```json
{
    "postbackconfig": {
        "location_id": "111111111111111111",
        "resource": "accountvault",
        "url": "https://127.0.0.1/v2/public/ping?developer-id=11111",
        "basic_auth_username": "testuname",
        "basic_auth_password": "Test@522",
        "product_transaction_id": "222222222222222222",
        "expands": "location,contact,account_vault_cau_logs",
        "on_create": 1,
        "on_update": 1,
        "on_delete": 1,
        "is_active": 1
    }
}
```

##### Reponse

```json
{
    "postbackconfig": {
        "id": "11aa22bb33cc44dd55ee66ff",
         "location_id": "111111111111111111",
        "resource": "accountvault",
        "on_create": 1,
        "on_update": 1,
        "on_delete": 1,
        "url": "https://127.0.0.1/v2/public/ping?developer-id=11111",
        "is_active": "1",
        "format": "api-default",
        "number_of_attempts": 1,
        "attempt_interval": 300,
        "expands": "location,contact,account_vault_cau_logs",
        "created_ts": 1618795388,
        "modified_ts": 1618795388,
        "product_transaction_id": "222222222222222222",
        "_links": {
           "self": { 
                "href": "https://api.sandbox.payaconnect.com/v2/postbackconfigs/11eba0adccc09646ab7c41f3" }
            }
        }
    }
}
```

### Update Postback Config

```PUT /v2/postbackconfigs/{id}```

##### Request 

```json

{
  "postbackconfig": {
    "attempt_interval": 300,
    "basic_auth_username": null,
    "basic_auth_password": null,
    "expands": "",
    "format": "api-default",
    "is_active": "1",
    "location_id": "23948sdnfia1129i9asf92",
    "number_of_attempts": 3,
    "on_create": "1",
    "on_delete": "0",
    "on_update": "1",
    "resource": "contact",
    "url": "https://127.0.0.1/updates"
  }
}
```

##### Response



