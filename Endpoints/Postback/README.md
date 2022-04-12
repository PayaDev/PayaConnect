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

```json
{
  "postbackconfig": {
    "id": "1028asnfias9f2j9sddf92jrwfskd",
    "location_id": "23948sdnfia1129i9asf92",
    "resource": "contact",
    "on_create": "1",
    "on_update": "1",
    "on_delete": "0",
    "url": "https://127.0.0.1/updates",
    "is_active": "1",
    "format": "api-default",
    "number_of_attempts": 3,
    "attempt_interval": 300,
    "expands": "",
    "created_ts": 1539268970,
    "modified_ts": 1539269531,
    "_links": {
      "self": {
        "href": "https://api.sandbox.domain.com/v2/postbackconfigs/1028asnfias9f2j9sddf92jrwfskd"
      }
    }
  }
}
```

## Postback Data Format

### Contact
##### ON_CREATE
```json
{
    "type":"CREATE",
    "resource":"contact",
    "number_of_attempts":1,
    "data":"{\"id\":\"11e66c8a943ff4b2bf1b2102\",\"location_id\":\"23948sdnfia1129i9asf92\",\"account_number\":null,\"contact_api_id\":null,\"company_name\":null,\"first_name\":null,\"last_name\":\"Lue\",\"email\":null,\"address\":null,\"city\":null,\"state\":null,\"zip\":null,\"home_phone\":null,\"cell_phone\":null,\"office_phone\":null,\"office_ext_phone\":null,\"email_trx_receipt\":false,\"created_ts\":1472325312,\"modified_ts\":1472325312,\"date_of_birth\":null,\"header_message\":null,\"header_message_type_id\":0,\"contact_c1\":null,\"contact_c2\":null,\"contact_c3\":null,\"contact_balance\":null}"
}
```
##### ON_UPDATE
```json
{
    "type": "UPDATE",
    "resource": "contact",
    "number_of_attempts": "1",
    "data": "{\"id\":\"11e936d6559825f4ac10d9fe\",\"location_id\":\"11e936d64d69cd92845615e4\",\"account_number\":null,\"contact_api_id\":null,\"company_name\":\"sdffhgj\",\"first_name\":null,\"last_name\":\"setupe_contactL3U1C1\",\"email\":\"contact3@gmail.com\",\"address\":null,\"city\":null,\"state\":null,\"zip\":null,\"home_phone\":null,\"cell_phone\":null,\"office_phone\":null,\"office_ext_phone\":null,\"email_trx_receipt\":true,\"created_ts\":1550862979,\"modified_ts\":1550863706,\"date_of_birth\":null,\"header_message\":null,\"header_message_type_id\":0,\"contact_c1\":null,\"contact_c2\":null,\"contact_c3\":null,\"contact_balance\":null}"
}
```

### Transaction
##### ON_CREATE
```json
{
    "type": "CREATE",
    "resource": "transaction",
    "number_of_attempts": "1",
    "data": "{\"id\":\"11e936d6fc3bd9f0a5bfb0e0\",\"payment_method\":\"cc\",\"account_vault_id\":null,\"recurring_id\":null,\"first_six\":\"545454\",\"last_four\":\"5454\",\"account_holder_name\":null,\"transaction_amount\":\"1.00\",\"description\":null,\"transaction_code\":null,\"avs\":\"BAD\",\"batch\":\"1\",\"order_num\":\"655684728790\",\"verbiage\":\"APPROVAL\",\"transaction_settlement_status\":null,\"effective_date\":null,\"routing\":null,\"return_date\":null,\"created_ts\":1550863259,\"modified_ts\":1550863259,\"transaction_api_id\":null,\"terms_agree\":null,\"notification_email_address\":null,\"notification_email_sent\":true,\"response_message\":null,\"auth_amount\":\"1.00\",\"auth_code\":\"36d6fc\",\"status_id\":101,\"type_id\":20,\"location_id\":\"11e936d64b8b4956b0d41be0\",\"reason_code_id\":1000,\"contact_id\":null,\"billing_zip\":\"12345\",\"billing_street\":null,\"product_transaction_id\":\"11e936d6d3dcd8b0ba78ae83\",\"tax\":\"0.00\",\"customer_ip\":null,\"customer_id\":null,\"po_number\":null,\"avs_enhanced\":\"N\",\"cvv_response\":\"N\",\"billing_phone\":null,\"billing_city\":null,\"billing_state\":null,\"clerk_number\":null,\"tip_amount\":\"0.98\",\"created_user_id\":\"11e936d64ef008ac9e3f5164\",\"modified_user_id\":\"11e936d64ef008ac9e3f5164\",\"ach_identifier\":null,\"check_number\":null,\"settle_date\":null,\"charge_back_date\":null,\"void_date\":null,\"account_type\":\"mc\",\"is_recurring\":false,\"is_accountvault\":false,\"transaction_c1\":null,\"transaction_c2\":null,\"transaction_c3\":null,\"additional_amounts\":[],\"terminal_serial_number\":null,\"entry_mode_id\":\"K\",\"terminal_id\":null,\"quick_invoice_id\":null,\"ach_sec_code\":null,\"custom_data\":null,\"hosted_payment_page_id\":null,\"trx_source_id\":12,\"emv_receipt_data\":null}"
}
```

##### ON_UPDATE
```json
{
    "type": "UPDATE",
    "resource": "transaction",
    "number_of_attempts": "1",
    "data": "{\"id\":\"11e936d6fc3bd9f0a5bfb0e0\",\"payment_method\":\"cc\",\"account_vault_id\":null,\"recurring_id\":null,\"first_six\":\"545454\",\"last_four\":\"5454\",\"account_holder_name\":null,\"transaction_amount\":\"1.00\",\"description\":\"testupdate\",\"transaction_code\":null,\"avs\":\"BAD\",\"batch\":\"1\",\"order_num\":\"655684728790\",\"verbiage\":\"APPROVAL\",\"transaction_settlement_status\":null,\"effective_date\":null,\"routing\":null,\"return_date\":null,\"created_ts\":1550863259,\"modified_ts\":1550863452,\"transaction_api_id\":null,\"terms_agree\":null,\"notification_email_address\":null,\"notification_email_sent\":true,\"response_message\":null,\"auth_amount\":\"1.00\",\"auth_code\":\"36d6fc\",\"status_id\":101,\"type_id\":20,\"location_id\":\"11e936d64b8b4956b0d41be0\",\"reason_code_id\":1000,\"contact_id\":null,\"billing_zip\":\"12345\",\"billing_street\":null,\"product_transaction_id\":\"11e936d6d3dcd8b0ba78ae83\",\"tax\":\"0.00\",\"customer_ip\":null,\"customer_id\":null,\"po_number\":null,\"avs_enhanced\":\"N\",\"cvv_response\":\"N\",\"billing_phone\":null,\"billing_city\":null,\"billing_state\":null,\"clerk_number\":null,\"tip_amount\":\"0.98\",\"created_user_id\":\"11e936d64ef008ac9e3f5164\",\"modified_user_id\":\"11e936d64ef008ac9e3f5164\",\"ach_identifier\":null,\"check_number\":null,\"settle_date\":null,\"charge_back_date\":null,\"void_date\":null,\"account_type\":\"mc\",\"is_recurring\":false,\"is_accountvault\":false,\"transaction_c1\":null,\"transaction_c2\":null,\"transaction_c3\":null,\"additional_amounts\":[],\"terminal_serial_number\":null,\"entry_mode_id\":\"K\",\"terminal_id\":null,\"quick_invoice_id\":null,\"ach_sec_code\":null,\"custom_data\":null,\"hosted_payment_page_id\":null,\"trx_source_id\":12,\"emv_receipt_data\":null}"
}
```

### Transaction Batch
##### ON_CREATE
```json
{
    "type": "CREATE",
    "resource": "transactionbatch",
    "number_of_attempts": "1",
    "data": "{\"id\":\"11e92008f72039289e394e29\",\"batch_num\":1,\"is_open\":1,\"processing_status_id\":1,\"product_transaction_id\":\"11e92008e5414a3a84b4313b\",\"created_ts\":1548355848,\"settlement_file_name\":null,\"batch_close_ts\":null,\"changelogs\":[{\"id\":\"11e92008f724cf74a3894128\",\"created_ts\":1548355848,\"action\":\"CREATE\",\"model\":\"TransactionBatch\",\"model_id\":\"11e92008f72039289e394e29\",\"user_id\":\"11e91ff683036176a3616800\",\"changelog_details\":[],\"user\":{\"id\":\"11e91ff683036176a3616800\",\"username\":\"Test Retail me29!ksozlwb\",\"first_name\":\"test\",\"last_name\":\"dummy\"}}]}"
}
```

##### ON_UPDATE
```json
{
    "type": "UPDATE",
    "resource": "transactionbatch",
    "number_of_attempts": "1",
    "data": "{\"id\":\"11e92008f72039289e394e29\",\"batch_num\":1,\"is_open\":0,\"processing_status_id\":2,\"product_transaction_id\":\"11e92008e5414a3a84b4313b\",\"created_ts\":1548355848,\"settlement_file_name\":null,\"batch_close_ts\":1548355947,\"changelogs\":[{\"id\":\"11e92009324b13ec8f40afb2\",\"created_ts\":1548355948,\"action\":\"UPDATE\",\"model\":\"TransactionBatch\",\"model_id\":\"11e92008f72039289e394e29\",\"user_id\":\"11e91ff683036176a3616800\",\"changelog_details\":[{\"id\":\"11e9200932514a82ac56be1c\",\"changelog_id\":\"11e92009324b13ec8f40afb2\",\"field\":\"batch_close_ts\",\"old_value\":null},{\"id\":\"11e92009324d39eca8e32af4\",\"changelog_id\":\"11e92009324b13ec8f40afb2\",\"field\":\"is_open\",\"old_value\":\"1\"},{\"id\":\"11e92009324f0dda9bb4094a\",\"changelog_id\":\"11e92009324b13ec8f40afb2\",\"field\":\"processing_status_id\",\"old_value\":\"1\"}],\"user\":{\"id\":\"11e91ff683036176a3616800\",\"username\":\"Test Retail megusozlwb\",\"first_name\":\"test\",\"last_name\":\"dummy\"}},{\"id\":\"11e92009321e23dca349f83e\",\"created_ts\":1548355947,\"action\":\"UPDATE\",\"model\":\"TransactionBatch\",\"model_id\":\"11e92008f72039289e394e29\",\"user_id\":\"11e91ff683036176a3616800\",\"changelog_details\":[{\"id\":\"11e920093227afce9690a3f0\",\"changelog_id\":\"11e92009321e23dca349f83e\",\"field\":\"batch_close_ts\",\"old_value\":null},{\"id\":\"11e920093222b97eaa64aaee\",\"changelog_id\":\"11e92009321e23dca349f83e\",\"field\":\"is_open\",\"old_value\":\"1\"},{\"id\":\"11e92009322546bcb6e6552a\",\"changelog_id\":\"11e92009321e23dca349f83e\",\"field\":\"processing_status_id\",\"old_value\":\"1\"}],\"user\":{\"id\":\"11e91ff683036176a3616800\",\"username\":\"Test Retail megusozlwb\",\"first_name\":\"test\",\"last_name\":\"dummy\"}},{\"id\":\"11e92008f724cf74a3894128\",\"created_ts\":1548355848,\"action\":\"CREATE\",\"model\":\"TransactionBatch\",\"model_id\":\"11e92008f72039289e394e29\",\"user_id\":\"11e91ff683036176a3616800\",\"changelog_details\":[],\"user\":{\"id\":\"11e91ff683036176a3616800\",\"username\":\"Test Retail megusozlwb\",\"first_name\":\"test\",\"last_name\":\"dummy\"}}]}"
}
```













