# Router Transactions Endpoint
The router transaction endpoint is used to process transaction when the merchant has a terminal. This drastically simplifies the process of running transactions through a terminal.

By using a terminal router, the process to run a transaction through a terminal is now down to one step. Simply send the transaction request to the /v2/routertransactions endpoint and the API does the rest. The https request will need to remain open for up to 300 seconds while the terminal is processing the transaction. Once the terminal has completed processing the transaction, the router transaction request will then return the transaction data.

### Mock Terminal
In order to help speed the development cycle, we have a feature called mock terminal. What this means is the we can create a virtual device for you to use for all of your terminal testing. This helps speed the development process in a number of ways:

You don't have to wait days for a terminal to arrive to begin development
Various API responses can easily be tested by sending different dollar amounts
The ability to test different types of transactions from different types of terminals is possible without having to order multiple terminals
In order to test different scenarios with a terminal, please visit the test data page to see how different dollar amounts can product different terminal transaction results.

## Endpoint Actions
### Create Record
`POST /v2/routertransactions`

Request
```json
{
    "routertransaction": {
        // Required fields
        "payment_method": "cc",
        "action": "sale",
        "location_id": "111111111111111111111111",
        "transaction_amount": "1.00",
        "terminal_id": "222222222222222222222222",
        "billing_zip": "12345"
    }
}
```

Response
```json
{
    "routertransaction": {
        "id": "222222222222222222222222", 
        "payment_method": "cc",
        "account_vault_id": null,
        "recurring_id": null,
        "first_six": "545454",
        "last_four": "5454",
        "account_holder_name": null,
        "transaction_amount": 1,
        "description": null,
        "transaction_code": null,
        "avs": "BAD",
        "batch": "2",
        "item": "10",
        "order_num": "433659378839",
        "timestamp": "1421951096",
        "verbiage": "APPROVED",
        "transaction_settlement_status": null,
        "effective_date": null,
        "routing": null,
        "return_date": null,
        "created_ts": 1421951061, 
        "modified_ts": null,
        "transaction_api_id": null,
        "terms_agree": null,
        "notification_email_address": null,
        "notification_email_sent": false,
        "response_message": null,
        "auth_amount": 1,
        "auth": "812823",
        "status_id": 101,
        "type_id": 20,
        "location_id": "111111111111111111111111",
        "settle_date": null,
        "charge_back_date": null,
        "void_date": null,
        "account_type": "mc",
        "is_recurring": false,
        "checkin_date": null,
        "checkout_date": null,
        "room_num": null,
        "room_rate": null,
        "advance_deposit": false,
        "no_show": false,
        "entry_mode_id": "C",
        "emv_receipt_data": {
            "AID":"a0000000042203",
            "APPLAB":"US Maestro",
            "APPN":"US Maestro",
            "CVM":"Pin Verified",
            "TSI":"e800",
            "TVR":"0800008000"
        },
        "folio_num": "433659378839",
        "_links": {
            "self": {
                "href": "https://apiv2.sandbox.domain.com/v2/transactions/222222222222222222222222"
            }
        }
    }
}
```

### Other Actions
The /v2/routertransactions endpoint is only for sending POST requests to process transactions through the terminal. For information on other Transaction actions like viewing, modifying, or deleting, please visit the [Transactions Endpoint](https://github.com/PayaDev/PayaConnect/tree/master/Endpoints/Transactions) documentation.

### Fields
| Name                       | Format     | Min | Max | POST Required | POST Allowed | Comments                                                                                                                                                                                                         |
|----------------------------|------------|-----|-----|---------------|--------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| id                         | string     |     | 36  |               |              | ID                                                                                                                                                                                                               |
| account_holder_name        | string     |     | 32  |               |              | Name of the Account Holder                                                                                                                                                                                       |
| account_type               | string     |     | 32  |               |              | A read only field that returns the card type                                                                                                                                                                     |
| account_vault_id           | string     |     | 36  |               |              | Account Vault id                                                                                                                                                                                                 |
| action                     | string     |     | 24  | ✔             | ✔            | One of the possible actions from the action list.                                                                                                                                                                |
| advance_deposit            | boolean    |     |     |               | ✔            | Advance Deposit                                                                                                                                                                                                  |
| auth_amount                | number     |     | 10  |               |              | Authentication Amount                                                                                                                                                                                            |
| auth_code                  | string     |     | 6   |               | ✔            | Authorization Code - Allowed only when action = force                                                                                                                                                            |
| avs                        | string     |     | 1   |               |              | AVS                                                                                                                                                                                                              |
| avs_enhanced               | string     |     | 1   |               |              |                                                                                                                                                                                                                  |
| batch                      | string     |     |     |               | ✔            | Batch - Allowed only when action = settle                                                                                                                                                                        |
| billing_street             | string     |     | 64  |               | ✔            | The billing street address for the account                                                                                                                                                                       |
| billing_zip                | string     |     | 10  |               | ✔            | The billing zip for the account                                                                                                                                                                                  |
| checkin_date               | yyyy-mm-dd |     | 10  |               | ✔            | Checkin Date                                                                                                                                                                                                     |
| checkout_date              | yyyy-mm-dd |     | 10  |               | ✔            | Checkout Date                                                                                                                                                                                                    |
| contact_id                 | string     |     | 36  |               | ✔            | Valid Contact Id                                                                                                                                                                                                 |
| created_ts                 | integer    |     | 10  |               |              | Created Timestamp                                                                                                                                                                                                |
| customer_id                | string     |     | 64  |               |              |                                                                                                                                                                                                                  |
| customer_ip                | string     |     | 39  |               |              |                                                                                                                                                                                                                  |
| cvv_response               | string     | 1   | 1   |               |              |                                                                                                                                                                                                                  |
| description                | string     |     | 64  |               | ✔            | Description                                                                                                                                                                                                      |
| emv_receipt_data           | string     |     | 512 |               |              | This field is a read only field. This field will only be populated for EMV transactions and will contain proper JSON formatted data with some or all of the following fields: TC,TVR,AID,TSI,ATC,APPLAB,APPN,CVM |
| entry_mode_id              | string     |     | 1   |               |              | Entry Mode - See entry mode section for more detail                                                                                                                                                              |
| first_six                  | string     |     | 6   |               |              | First six numbers                                                                                                                                                                                                |
| Item                       | string     |     |     |               |              | Recurring or not                                                                                                                                                                                                 |
| last_four                  | string     |     | 4   |               |              | item                                                                                                                                                                                                             |
| location_id                | string     |     | 36  | ✔             | ✔            | Location ID                                                                                                                                                                                                      |
| modified_ts                | integer    |     | 10  |               |              | Modified Timestamp                                                                                                                                                                                               |
| no_show                    | boolean    |     |     |               | ✔            | No Show                                                                                                                                                                                                          |
| notification_email_address | string     |     |     |               | ✔            | Notification Email Address                                                                                                                                                                                       |
| notification_email_sent    | boolean    |     |     |               |              | Email notification                                                                                                                                                                                               |
| order_num                  | string     |     | 32  |               | ✔            | Order Number                                                                                                                                                                                                     |
| payment_method             | string     |     |     | ✔             |              | Must be 'cc' for this endpoint.                                                                                                                                                                                  |
| po_number                  | string     |     | 24  |               | ✔            |                                                                                                                                                                                                                  |
| product_transaction_id     | string     |     | 36  |               | ✔            | The deposit account (product) to use for the transaction. This is required for multi-merchant setups.                                                                                                            |
| reason_code_id             | number     |     | 4   |               |              | Response reason code that provides more detail as to the result of the transaction                                                                                                                               |
| recurring_id               | string     |     | 36  |               |              | Recurring ID                                                                                                                                                                                                     |
| response_message           | string     |     | 255 |               |              | Response message                                                                                                                                                                                                 |
| room_num                   | string     |     | 12  |               | ✔            | Room Number                                                                                                                                                                                                      |
| room_rate                  | number     |     |     |               | ✔            | Room Rate                                                                                                                                                                                                        |
| save_account               | boolean    |     |     |               | ✔            | Specifies to save account to contacts profile if account_number/track_data is present with either contact_id or contact_api_id in params                                                                         |
| status_id                  | number     |     | 3   |               |              | Status ID - See status id section for more detail                                                                                                                                                                |
| tax                        | number     |     |     |               | ✔            | Amount of Sales tax - If supplied, this amount should be included in the total transaction_amount field                                                                                                          |
| terminal_id                | string     |     | 24  | ✔             |              | The id of the terminal that will process the transaction.                                                                                                                                                        |
| transaction_amount         | string     |     | 10  | ✔             | ✔            | Amount of the transaction                                                                                                                                                                                        |
| transaction_api_id         | string     |     | 64  |               | ✔            | Transaction Api ID                                                                                                                                                                                               |
| type_id                    | number     |     | 2   |               |              | Type ID - See type id section for more detail                                                                                                                                                                    |
| verbiage                   | string     |     |     |               |              | Verbiage -Do not use verbiage to see if the transaction was approved, use status_id                                                                                                                              |
