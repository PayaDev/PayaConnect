# Account Vaults Endpoint

The accountvaults endpoint is used as a tokenization endpoint to store account vault records. If there is a need to store accountvaults (tokens) for account numbers and card numbers for later use, then this is the endpoint to perform that task.

The account_vault_id field can be used in place of the account_number and exp_date fields on most endpoints in the system. So storing an accountvault on this endpoint will allow for the reuse of the account at a later time.

## Endpoint Actions
### Create Record
`POST /v2/accountvaults`

REQUIRED FIELDS FOR ACCOUNT VAULT CREATION BY PAYMENT METHOD

| ALL            | CC       | ACH                 |
|----------------|----------|---------------------|
| location_id    | exp_date | account_type        |
| payment_method |          | is_company          |
| account_number |          | routing             |
|                |          | account_holder_name |
 

EXAMPLE 1: CREATE CREDIT CARD ACCOUNT VAULT (CC)
Request
```json
{
    "accountvault": {
        "title": "Test CC Account",
        "payment_method": "cc", // Required
        "account_holder_name": "John Smith",
        "account_number":"5454545454545454", // Required
        "exp_date": "0919", // Required for "cc"
        "contact_id": "54c285f1-678d-9510-318c-bcb13ab0c1c2",
        "location_id": "sd9fusd9f-678d-9510-318c-bcb13ab4324" // Required
    }
}
```
Response
```json
{
    "accountvault": {
        "id": "54c285f1-8052-06b4-318c-f1a9ebf8a288",
        "payment_method": "cc",
        "title": "Test CC Account",
        "account_holder_name": "John Smith",
        "first_six": "545454",
        "last_four": "5454",
        "billing_address": null,
        "billing_zip": null,
        "exp_date": "0919",
        "routing": null,
        "account_type": "mc",
        "location_id": "sd9fusd9f-678d-9510-318c-bcb13ab4324",
        "contact_id": "54c285f1-678d-9510-318c-bcb13ab0c1c2",
        "created_ts": 1422037632,
        "modified_ts": 1422037632,
        "account_vault_api_id": null,
        "dl_number": null,
        "dl_state": null,
        "customer_id": null,
        "ssn4": null,
        "dob_year": null,
        "billing_state": null,
        "billing_city": null,
        "billing_phone": null,
        "accountvault_c1": null,
        "accountvault_c2": null,
        "accountvault_c3": null,
        "expiring_in_months": 12,
        "has_recurring": false,
        "ach_sec_code": null,
        "active": 1,
        "_links": {
            "self": {
                "href": "{url}/v2/accountvaults/54c285f1-8052-06b4-318c-f1a9ebf8a288"
            }
        }
    }
}
```
 

EXAMPLE 2: CREATE A BANK ACCOUNT VAULT (ACH)
Request
```json
{
    "accountvault": {
        "title": "Test ACH Account",
        "payment_method": "ach", // Required
        "account_holder_name": "John Smith",
        "account_number":"700953657", // Required
        "account_type": "checking", // Required for "ach"
        "is_company": false, // Required for "ach"
        "routing": "100020200", // Required for "ach"
        "contact_id": "54c285f1-678d-9510-318c-bcb13ab0c1c2",
        "location_id": "sd9fusd9f-678d-9510-318c-bcb13ab4324" // Required
    }
}
```
Response
```json
{
    "accountvault": {
        "id": "54c285f1-8052-06b4-318c-f1a9ebf8a288",
        "payment_method": "ach",
        "title": "Test ACH Account",
        "account_holder_name": "John Smith",
        "first_six": "700953",
        "last_four": "3657",
        "billing_address": null,
        "billing_zip": null,
        "exp_date": null,
        "routing": null,
        "account_type": "checking",
        "location_id": "sd9fusd9f-678d-9510-318c-bcb13ab4324",
        "contact_id": "54c285f1-678d-9510-318c-bcb13ab0c1c2",
        "created_ts": 1422037632,
        "modified_ts": 1422037632,
        "account_vault_api_id": null,
        "dl_number": null,
        "dl_state": null,
        "customer_id": null,
        "ssn4": null,
        "dob_year": null,
        "billing_state": null,
        "billing_city": null,
        "billing_phone": null,
        "accountvault_c1": null,
        "accountvault_c2": null,
        "accountvault_c3": null,
        "expiring_in_months": null,
        "has_recurring": false,
        "ach_sec_code": "WEB",
        "active": 1,
        "_links": {
            "self": {
                "href": "{url}/v2/accountvaults/54c285f1-8052-06b4-318c-f1a9ebf8a288"
            }
        }
    }
}
```

### Creating an account using Ticket
`POST /v2/accountvaults`

Request
```json
{
	"accountvault":{
		"payment_method":"cc", // Required
		"ticket":"123456789", // Required when creating from Ticket
		"location_id":"11111-11111-11111-11111", // Required
		"contact_id":"22222-22222-22222-22222", 
		"title": "CC Account from Ticket"
    }
}
```
Response
```json
{
    "accountvault": {
        "id": "54c285f1-8052-06b4-318c-f1a9ebf8a288",
        "payment_method": "cc",
        "title": "CC Account from Ticket",
        "account_holder_name": null,
        "first_six": "555555",
        "last_four": "5555",
        "billing_address": null,
        "billing_zip": "12345",
        "exp_date": "0919",
        "routing": null,
        "account_type": "mc",
        "location_id": "sd9fusd9f-678d-9510-318c-bcb13ab4324",
        "contact_id": "54c285f1-678d-9510-318c-bcb13ab0c1c2",
        "created_ts": 1422037632,
        "modified_ts": 1422037632,
        "account_vault_api_id": null,
        "dl_number": null,
        "dl_state": null,
        "customer_id": null,
        "ssn4": null,
        "dob_year": null,
        "billing_state": null,
        "billing_city": null,
        "billing_phone": null,
        "accountvault_c1": null,
        "accountvault_c2": null,
        "accountvault_c3": null,
        "expiring_in_months": 12,
        "has_recurring": false,
        "ach_sec_code": null,
        "active": 1,
        "_links": {
            "self": {
                "href": "{url}/v2/accountvaults/54c285f1-8052-06b4-318c-f1a9ebf8a288"
            }
        }
    }
}
```

### Create from Previous Transaction
`POST /v2/accountvaults`

REQUIRED FIELDS FOR ACCOUNT VAULT CREATION FROM PREVIOUS TRANSACTION
- previous_transaction_id
- payment_method
- location_id

Request
```json
{
    "accountvault": {
        "title": "CC Account from Trx", // Optional
        "payment_method": "cc", // Required
        "previous_transaction_id": "{transaction_id}", // Required when creating from Previous Transaction
        "contact_id": "{contact_id}",
        "location_id": "{location_id}"// Required
    }
}
```
Response
```json
{
    "accountvault": {
        "id": "54c285f1-8052-06b4-318c-f1a9ebf8a288",
        "payment_method": "cc",
        "title": "CC Account from Trx",
        "account_holder_name": null,
        "first_six": "555555",
        "last_four": "5555",
        "billing_address": null,
        "billing_zip": "12345",
        "exp_date": "0919",
        "routing": null,
        "account_type": "mc",
        "location_id": "sd9fusd9f-678d-9510-318c-bcb13ab4324",
        "contact_id": "54c285f1-678d-9510-318c-bcb13ab0c1c2",
        "created_ts": 1422037632,
        "modified_ts": 1422037632,
        "account_vault_api_id": null,
        "dl_number": null,
        "dl_state": null,
        "customer_id": null,
        "ssn4": null,
        "dob_year": null,
        "billing_state": null,
        "billing_city": null,
        "billing_phone": null,
        "accountvault_c1": null,
        "accountvault_c2": null,
        "accountvault_c3": null,
        "expiring_in_months": 12,
        "has_recurring": false,
        "ach_sec_code": null,
        "active": 1,
        "_links": {
            "self": {
                "href": "{url}/v2/accountvaults/54c285f1-8052-06b4-318c-f1a9ebf8a288"
            }
        }
    }
}
```

### Update Record
`PUT /v2/accountvaults/{id}`

-or-

`PUT /v2/accountvaults/{api_id}?api_id=1&location_id={location_id}`

Request
```json
{
    "accountvault": {
        "exp_date": "0921"
    }
}
```
Response
```json
{
    "accountvault": {
        "id": "54c285f1-8052-06b4-318c-f1a9ebf8a288",
        "payment_method": "cc",
        "title": "CC Account from Trx",
        "account_holder_name": null,
        "first_six": "555555",
        "last_four": "5555",
        "billing_address": null,
        "billing_zip": "12345",
        "exp_date": "0921",
        "routing": null,
        "account_type": "mc",
        "location_id": "sd9fusd9f-678d-9510-318c-bcb13ab4324",
        "contact_id": "54c285f1-678d-9510-318c-bcb13ab0c1c2",
        "created_ts": 1422037632,
        "modified_ts": 1422037632,
        "account_vault_api_id": null,
        "dl_number": null,
        "dl_state": null,
        "customer_id": null,
        "ssn4": null,
        "dob_year": null,
        "billing_state": null,
        "billing_city": null,
        "billing_phone": null,
        "accountvault_c1": null,
        "accountvault_c2": null,
        "accountvault_c3": null,
        "expiring_in_months": 36,
        "has_recurring": false,
        "ach_sec_code": null,
        "active": 1,
        "_links": {
            "self": {
                "href": "{url}/v2/accountvaults/54c285f1-8052-06b4-318c-f1a9ebf8a288"
            }
        }
    }
}
```

### View Single Record
`GET /v2/accountvaults/{id}`

-or-

`GET /v2/accountvaults/{api_id}?api_id=1&location_id={location_id}`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```
Response
```json
{
    "accountvault": {
        "id": "54c285f1-8052-06b4-318c-f1a9ebf8a288",
        "payment_method": "cc",
        "title": "CC Account from Trx",
        "account_holder_name": null,
        "first_six": "555555",
        "last_four": "5555",
        "billing_address": null,
        "billing_zip": "12345",
        "exp_date": "0919",
        "routing": null,
        "account_type": "mc",
        "location_id": "sd9fusd9f-678d-9510-318c-bcb13ab4324",
        "contact_id": "54c285f1-678d-9510-318c-bcb13ab0c1c2",
        "created_ts": 1422037632,
        "modified_ts": 1422037632,
        "account_vault_api_id": null,
        "dl_number": null,
        "dl_state": null,
        "customer_id": null,
        "ssn4": null,
        "dob_year": null,
        "billing_state": null,
        "billing_city": null,
        "billing_phone": null,
        "accountvault_c1": null,
        "accountvault_c2": null,
        "accountvault_c3": null,
        "expiring_in_months": 12,
        "has_recurring": false,
        "ach_sec_code": null,
        "active": 1,
        "_links": {
            "self": {
                "href": "{url}/v2/accountvaults/54c285f1-8052-06b4-318c-f1a9ebf8a288"
            }
        }
    }
}
```

### View Record List
`GET /v2/accountvaults`

Note:

- Filters can be used to search for accounts by including the columns you want to filter on as **URL parameters**.
- Expands can be used to include additional data associated with an Account Vault.  See Expands further below for more details.

Request
```json
{
    // Empty Payload - Nothing Needed here
}
```
Response
```json
{
    "accountvaults": [
        {
            "id": "54c285f1-8052-06b4-318c-f1a9ebf8a288",
            "payment_method": "cc",
            "title": "CC Account from Trx",
            "account_holder_name": null,
            "first_six": "555555",
            "last_four": "5555",
            "billing_address": null,
            "billing_zip": "12345",
            "exp_date": "0919",
            "routing": null,
            "account_type": "mc",
            "location_id": "sd9fusd9f-678d-9510-318c-bcb13ab4324",
            "contact_id": "54c285f1-678d-9510-318c-bcb13ab0c1c2",
            "created_ts": 1422037632,
            "modified_ts": 1422037632,
            "account_vault_api_id": null,
            "dl_number": null,
            "dl_state": null,
            "customer_id": null,
            "ssn4": null,
            "dob_year": null,
            "billing_state": null,
            "billing_city": null,
            "billing_phone": null,
            "accountvault_c1": null,
            "accountvault_c2": null,
            "accountvault_c3": null,
            "expiring_in_months": 12,
            "has_recurring": false,
            "ach_sec_code": null,
            "active": 1,
            "_links": {
                "self": {
                    "href": "{url}/v2/accountvaults/54c285f1-8052-06b4-318c-f1a9ebf8a288"
                }
            }
        },
        // Other Account Vaults Here
    ],
    "meta": {
        "pagination": {
            "links": {
                "self": {
                    "href": "{url}/v2/accountvaults?contact_id=54c285f1-678d-9510-318c-bcb13ab0c1b4&page_size=3&page=1"
                }
            },
            "totalCount": 1,
            "pageCount": 1,
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
`DELETE /v2/accountvaults/{id}`

-or-

`DELETE /v2/accountvaults/{api_id}?api_id=1&location_id={location_id}`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```
Response
```json
Response will be conditional on HTTP Response Code:

204 - Success, No JSON Response
422 - Fail, JSON will contain validation error
```

### Get BIN Info
`GET /v2/accountvaults/{id}/bininfo`
```json
{
   "bininfo": {
       "issuer_bank_name": "Cartasi S.P.A.",
       "country_code": "ITA",
       "detail_card_product": "V",
       "detail_card_indicator": "X",
       "fsa_indicator": "",
       "prepaid_indicator": "",
       "product_id": "G",
       "regulator_indicator": "N",
       "visa_product_sub_type": "",
       "visa_large_ticket_indicator": "",
       "account_fund_source": "C",
       "card_class": "B",
       "token_ind": "",
       "issuing_network": null
   }
}
```



### BIN Info Fields
For more information on BIN Info including the purpose of each field returned and the possible values for each take a look at our BIN Info documentation.
 

## Fields
| Name                          | Min | Max | Format  | POST Required | Post Allowed | PUT Allowed | Comments                                                                                                                                                                                                                                                                                                         |
|-------------------------------|-----|-----|---------|---------------|--------------|-------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| account_holder_name           | 1   | 32  | string  | ✔             | ✔            | ✔           | For CC, this is the "Name (as it appears) on Card".  For ACH, this is the "Name on Account".  Required for POST when payment_method is 'ach'. Not required when payment_method is 'cc'.                                                                                                                          |
| account_number                | 4   | 19  | string  | ✔             | ✔            |             | For CC transactions, a credit card number. For ACH transactions, a bank account number. String lengths are conditional, CC should be 13-19 and ACH should be 4-19. Required for POST unless creating Account Vault from Ticket or Previous Transaction.                                                          |
| account_type                  | 1   | 32  | string  |               | ✔            |             | For ACH, must be provided as either “checking” or “savings”. For CC, field is read only. System will identify card_type and generate a value for this field automatically. i.e. visa, mc, disc, amex, jcb, diners.                                                                                               |
| account_vault_api_id          | 1   | 36  | string  |               | ✔            | ✔           | Optional. Must be unique per location.  This field can be used to correlate Account Vaults in our system to data within an outside software integration. In addition, when running a transaction and using a stored account vault, this field can be used in place of account_vault_id. Alphanumeric values only |
| accountvault_c1               |     | 128 | string  |               | ✔            | ✔           | Custom field 1 for API users to store custom data                                                                                                                                                                                                                                                                |
| accountvault_c2               |     | 128 | string  |               | ✔            | ✔           | Custom field 2 for API users to store custom data                                                                                                                                                                                                                                                                |
| accountvault_c3               |     | 128 | string  |               | ✔            | ✔           | Custom field 3 for API users to store custom data                                                                                                                                                                                                                                                                |
| ach_sec_code                  |     | 3   | string  |               | ✔            | ✔           | SEC code for the account                                                                                                                                                                                                                                                                                         |
| billing_address               | 1   | 32  | string  |               | ✔            | ✔           | The Street portion of the address associated with the Credit Card (CC) or Bank Account (ACH).                                                                                                                                                                                                                    |
| billing_city                  | 1   | 36  | string  |               | ✔            | ✔           | The City portion of the address associated with the Credit Card (CC) or Bank Account (ACH).                                                                                                                                                                                                                      |
| billing_phone                 | 1   | 10  | string  |               | ✔            | ✔           | The Phone # to be used to contact Payer if there are any issues processing a transaction.                                                                                                                                                                                                                        |
| billing_state                 | 2   | 2   | string  |               | ✔            | ✔           | The State portion of the address associated with the Credit Card (CC) or Bank Account (ACH).                                                                                                                                                                                                                     |
| billing_zip                   | 4   | 12  | string  |               | ✔            | ✔           | The Zip or "Postal Code" portion of the address associated with the Credit Card (CC) or Bank Account (ACH). Alphanumeric, spaces, and dashes                                                                                                                                                                     |
| contact_id                    | 24  | 36  | string  |               | ✔            | ✔           | Used to associate the Account Vault with a Contact.                                                                                                                                                                                                                                                              |
| created_ts                    | 10  | 10  | integer |               |              |             | Created Timestamp. System will generate a value for this field automatically.                                                                                                                                                                                                                                    |
| customer_id                   | 1   | 50  | string  |               | ✔            | ✔           | Used to store a customer identification number.                                                                                                                                                                                                                                                                  |
| dl_number                     | 1   | 50  | string  |               | ✔            | ✔           | Used for certain ACH transactions where Driver's License is required by the terminal being used.  When providing dl_number, dl_state must also be provided.                                                                                                                                                      |
| dl_state                      | 2   | 2   | string  |               | ✔            | ✔           | Used for certain ACH transactions where Driver's License is required by the terminal being used.  When providing dl_state, dl_number must also be provided.                                                                                                                                                      |
| dob_year                      | 4   | 4   | string  |               | ✔            |             | Used for certain ACH transactions where Identity Verification is enabled on the terminal being used.                                                                                                                                                                                                             |
| expiring_in_months            |     |     | integer |               |              |             | Determined by API based on card exp_date.                                                                                                                                                                                                                                                                        |
| exp_date                      | 4   | 4   | string  |               | ✔            | ✔           | Required for CC. The Expiration Date for the credit card. (MMYY format).                                                                                                                                                                                                                                         |
| first_six                     | 6   | 6   | integer |               |              |             | The first six numbers of an account number.  System will generate a value for this field automatically.                                                                                                                                                                                                          |
| has_recurring                 |     |     | boolean |               |              |             | True indicates that this account vault is tied to a Recurring Payment                                                                                                                                                                                                                                            |
| id                            | 24  | 36  | string  |               |              |             | A unique, system-generated identifier for the Account Vault.                                                                                                                                                                                                                                                     |
| is_company                    | 1   | 1   | boolean |               | ✔            |             | Required for ACH. This identifies whether the ACH account belongs to a company or individual. This can affect which SEC code is used when attempting to run a transaction. For CC, this field is ignored.                                                                                                        |
| last_four                     | 4   | 4   | integer |               |              |             | The last four numbers of an account number.  System will generate a value for this field automatically.                                                                                                                                                                                                          |
| location_id                   | 24  | 36  | string  | ✔             | ✔            |             | A valid Location Id associated with the Contact for this Account Vault.                                                                                                                                                                                                                                          |
| modified_ts                   | 10  | 10  | integer |               |              |             | Modified Timestamp. System will generate a value for this field automatically.                                                                                                                                                                                                                                   |
| payment_method                | 2   | 3   | string  | ✔             | ✔            |             | Must be provided as either 'cc' or 'ach'.                                                                                                                                                                                                                                                                        |
| previous_account_vault_api_id |     | 64  | string  |               | ✔            |             | Can be used to pull payment info from a previous account vault api id.                                                                                                                                                                                                                                           |
| previous_account_vault_id     | 24  | 36  | string  |               | ✔            |             | Can be used to pull payment info from a previous account vault.                                                                                                                                                                                                                                                  |
| previous_transaction_api_id   |     | 64  | string  |               | ✔            |             | Can be used to pull payment info from a previous transaction api id.                                                                                                                                                                                                                                             |
| previous_transaction_id       | 24  | 36  | string  |               | ✔            |             | Can be used to pull payment info from a previous transaction.                                                                                                                                                                                                                                                    |
| routing                       | 9   | 9   | string  |               | ✔            |             | Required for ACH. The Routing Number for the bank account being used.                                                                                                                                                                                                                                            |
| ssn4                          |     | 4   | string  |               | ✔            | ✔           | The last four of the account_holder social security number.                                                                                                                                                                                                                                                      |
| ticket                        | 1   | 36  | string  |               | ✔            |             | A valid ticket that was created to store the accountvault.                                                                                                                                                                                                                                                       |
| title                         | 1   | 64  | string  |               | ✔            | ✔           | Used to describe the Account Vault for easier identification within our UI.                                                                                                                                                                                                                                      |
 

## Expands (Related Records)
For detail on how to use Expands on an Endpoint, please visit the Expands (Related Records) page.

| Related Record                                         | Expand                                |
|--------------------------------------------------------|---------------------------------------|
| Location                                               | location                              |
| Contact                                                | contact                               |
| Signature                                              | signature                             |
| Created User                                           | created_user                          |
| Product Transaction                                    | product_transaction                   |
| Account Vault Card Account Updates Product Transaction | account_vault_cau_product_transaction |
| Account Vault Card Account Update Logs                 | account_vault_cau_logs                |
 

An example of “expanding” this endpoint to one of the above related records would look like this:

`/v2/accountvaults/xxxxxxxxxxxxxxxxxxxxxxxx?expand=location`

To use multiple expands on this endpoint, simply include them both separated by a comma like so:

`/v2/accountvaults/xxxxxxxxxxxxxxxxxxxxxxxx?expand=location,created_user`
