# Router Account Vaults Endpoint

The router accountvault endpoint is used to store cards when the merchant has a terminal. This allows for the storing of cards using the terminal without first having to run a transaction.

By using a terminal router, the process to store a card with a terminal is now down to one step. Simply send the request to the ```/v2/routeraccountvaults``` endpoint and the API does the rest. The https request will need to remain open for up to 300 seconds while the terminal is processing the request. Once the terminal has completed processing the request, the router accountvault request will then return the response data.

## Endpoint Actions

#### Create Record

```POST /v2/routeraccountvaults```

##### Request

```json
{
    "routeraccountvault": {
        "payment_method": "cc", // Required
        "action": "store", // Required
        "location_id": "{location_id}", // Required
        "contact_id":"{contact_id}", // Required
        "terminal_id":"{terminal_id}" // Required
    }
}
```

##### Response

```json
{
    "accountvault": {
        "id": "{accountvault_id}",
        "payment_method": "cc",
        "title": "",
        "account_holder_name": "SAMPLE TEST",
        "first_six": "411111",
        "last_four": "1111",
        "billing_address": null,
        "billing_zip": null,
        "exp_date": "1221",
        "routing": null,
        "account_type": "visa",
        "created_ts": 1500022106,
        "modified_ts": 1500022106,
        "account_vault_api_id": null,
        "contact_id": "{contact_id}",
        "location_id": "{location_id}",
        "expiring_in_months": 35,
        "accountvault_c1": null,
        "accountvault_c2": null,
        "accountvault_c3": null,
        "active": "1",
        "_links": {
            "self": {
                "href": "https://apiv2.sandbox.domain.com/v2/accountvaults/{account_vault_id}"
            }
        }
    }
}
```

#### Other Actions
For information on other Account Vault actions, please visit the [Account Vaults Endpoint](https://github.com/PayaDev/PayaConnect/tree/master/Endpoints/Account%20Vaults) documentation.
