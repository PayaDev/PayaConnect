# Paya Connect Recommended Path of Integration

## Overview

This page will walk through the Paya recommended path for integration.  This path will provide the easiest deployment of the Paya Connect APIs and should reduce the scope for PCI-DSS for most integrators that follow this method.

## Require Credentials
| **Intended For**  |      **Field Name**     | **Purpose**                                                                                                              |
|--------------------|:-----------------------:|---------------------------------------------------------------------------------------------------------------------------|
| Developer          | developer_id            | Used to identify the developer/solution making the request.                                                               |
| Location/Merchant  | location_id             | Container for the merchant account(s).                                                                                    |
| Location/Merchant  | product_transaction_id  | Container for the deposit account. A single location_id may contain many product_transaction_ids.                         |
| Integration User   | user_id                 | Used to identify the user making the [Direct API](https://github.com/PayaDev/PayaConnect/tree/master/Endpoints) (RESTful) request or initiating a [PayForm](https://github.com/PayaDev/PayaConnect/tree/master/PayForm) & [AccountForm](https://github.com/PayaDev/PayaConnect/tree/master/AccountForm).                  |
| Integration User   | user_api_key            | Used like a password with [Direct API](https://github.com/PayaDev/PayaConnect/tree/master/Endpoints) (RESTful) requests. This should be protected and not shared with anyone.             |
| Integration User   | user_hash_key           | Used when implementing [PayForm](https://github.com/PayaDev/PayaConnect/tree/master/PayForm) & [AccountForm](https://github.com/PayaDev/PayaConnect/tree/master/AccountForm) to build the hash_key. This should be protected and not shared with anyone.  |

## Obtaining Location Details

A solution may require the merchant to obtain their account details and credentials directly from Paya and enter them into the solution manually. However, an integrator may want to automate some of this process. Using a simple GET request, the integrated solution may only require the user_id, user_api_key, and user_hash_key. The first two will allow them to submit a GET request against our Location Info Endpoint which will return details such as the location_id and the various product_transaction_ids associated with their account.

### View Record List

`GET /v2/locationinfos`

**Note:** Empty Request Body.

#### Response Example
```json
{
  "locationinfos": [
    ... // Other Locations
    {
      "id": "11e39j49jfsdfs9j39ts9fj934te",
      "name": "Retail Location",
      "address1": "street address",
      "address2": "novi",
      "city": "novi",
      "state": "michigan",
      "zip": "12345",
      "office_phone": "1234564544",
      "office_ext_phone": "1021021209",
      "fax": "45455555",
      "tz": "America/New_York",
      "product_transactions": [
        ... // Other Product Transactions
        {
          "id": "",
          "payment_method": "ach",
          "processor": "ach",
          "title": "ACH Product 7ed7a",
          "receipt_header": null,
          "receipt_footer": null,
          "receipt_add_account_above_signature": null,
          "receipt_add_recurring_above_signature": null,
          "receipt_logo": null,
          "receipt_show_contact_name": false,
          "industry_type": "retail",
          "partner": null,
          "vt_cvv": false,
          "vt_street": false,
          "vt_zip": false,
          "vt_order_num": false,
          "display_avs": false,
          "vt_enable": false,
          "vt_enable_tip": 0,
          "velocity_settings": {
            "debit_hold_days": 0,
            "debit_items_per_day": 0,
            "debit_daily_aggregate": 0,
            "debit_items_per_month": 0,
            "debit_monthly_aggregate": 0,
            "refund_largest_item": 0,
            "refund_items_per_day": 0,
            "refund_daily_aggregate": 0,
            "refund_items_per_month": 0,
            "refund_monthly_aggregate": 0,
            "refund_hold_days": 0,
            "credit_largest_item": 0,
            "credit_daily_aggregate": 0,
            "credit_items_per_day": 0,
            "credit_items_per_month": 0,
            "credit_monthly_aggregate": 0
          },
          "surcharge": null,
          "default_transaction_type": "debit",
          "vt_require_street": false,
          "vt_require_zip": false,
          "vt_enable_sales_tax": true,
          "vt_override_sales_tax_allowed": true,
          "current_batch": 1,
          "vt_billing_phone": 0,
          "vt_clerk_number": 0,
          "quick_invoice_allow": 1,
          "active": 1,
          "hosted_payment_page_max_allowed": 5,
          "hosted_payment_page_allow": 0,
          "auto_decline_cvv": 0,
          "level3_allow": 0,
          "level3_default": null,
          "tax_surcharge_config": 2,
          "_links": {
            "self": {
              "href": "https://api.sandbox.domain.com/v2/producttransactions/11e439ru39dkfndg93msdf93"
            }
          }
        },
      ],
      "product_file": {
        "free_bytes": 13107200,
        "byte_increment": 1073741824,
        "increment_cost": "0.00",
        "monthly_fee": "0.00",
        "max_file_size_bytes": 5242880,
        "id": "11e885e3f154aafc896ee3d0",
        "title": "test",
        "product_file_credential_id": "11e7d15b34f2a004bf6c7653",
        "container": null,
        "file_ext_allowed": null,
        "created_user_id": "11e7a8452518e768b2661a9a",
        "modified_user_id": "11e7a8452518e768b2661a9a",
        "created_ts": 1531407468,
        "modified_ts": 1531407468,
        "active": 1,
        "_links": {
          "self": {
            "href": "https://api.sandbox.domain.com/v2/productfiles/11e885e3f154aafc896ee3d0"
          }
        }
      },
      "branding_domain_url": "subdomain.sandbox.domain.com",
      "product_accountvault": {
        "id": "11e7ced68df294668d8cd79b",
        "title": "test",
        "location_id": "11e39j49jfsdfs9j39ts9fj934te",
        "created_user_id": "11e7a8452518e768b2661a9a",
        "modified_user_id": "11e7a8452518e768b2661a9a",
        "billing_location_id": "11e39j49jfsdfs9j39ts9fj934te",
        "created_ts": 1511280655,
        "modified_ts": 1524844209,
        "active": 1,
        "_links": {
          "self": {
            "href": "https://api.sandbox.domain.com/v2/producttoken/view?id=11e7ced68df294668d8cd79b"
          }
        }
      },
      "product_recurring": {
        "id": "11e7d3b54f1a1fd296f4832e",
        "title": "Retail Location",
        "location_id": "11e39j49jfsdfs9j39ts9fj934te",
        "created_user_id": "11e7a8452518e768b2661a9a",
        "modified_user_id": "11e7a8452518e768b2661a9a",
        "billing_location_id": "11e39j49jfsdfs9j39ts9fj934te",
        "created_ts": 1511816132,
        "modified_ts": 1526048617,
        "send_declined_notifications": 1,
        "require_full_payment": 1,
        "active": 1,
        "_links": {
          "self": {
            "href": "https://api.sandbox.domain.com/v2/productrecurring/view?id=11e7d3b54f1a1fd296f4832e"
          }
        }
      },
      "default_cc": "11e855249e8df8b8863c14ea",
      "default_ach": "11e439ru39dkfndg93msdf93",
      "branding_domain": {
        "allow_contact_signup": true,
        "allow_contact_registration": false,
        "allow_contact_login": true,
        "registration_fields": [
          "email",
          "account_number"
        ],
        "id": "11e7c0019a94ec029ab0935f",
        "url": "subdomain.sandbox.domain.com",
        "title": "subdomain.sandbox.domain.com",
        "logo": null,
        "company_name": null,
        "support_email": null,
        "created_user_id": "11e7a8452518e768b2661a9a",
        "created": "2017-11-02 19:11:17",
        "modified_user_id": "11e7a8452518e768b2661a9a",
        "modified": "2018-09-25 05:16:36",
        "nav_color": null,
        "nav_logo": "https://1239j9fjsdfn239sdkf.s3.amazonaws.com/domain/kjdsf9au328sfkajsf9/logo.png",
        "fav_icon": null,
        "button_primary_color": null,
        "logo_background_color": null,
        "icon_background_color": null,
        "menu_text_background_color": null,
        "menu_text_color": "",
        "right_menu_background_color": null,
        "right_menu_text_color": null,
        "button_primary_text_color": null,
        "help_text": "{html markup}",
        "email_reply_to": null,
        "custom_javascript": null,
        "custom_theme": "default",
        "custom_css": "xzxzx"
      },
      "contact_email_trx_receipt_default": false,
      "terminals": [
        {
          "id": "11e7caddd7a71a2a9a56e0b7",
          "local_ip_address": null,
          "port": null,
          "title": "test_terminal",
          "_links": {
            "self": {
              "href": "https://api.sandbox.domain.com/v2/terminalinfo/view?id=11e7caddd7a71a2a9a56e0b7"
            }
          }
        },
        {
          "id": "11e7cae12e4b4b289e3ef939",
          "local_ip_address": null,
          "port": null,
          "title": "test_T1",
          "_links": {
            "self": {
              "href": "https://api.sandbox.domain.com/v2/terminalinfo/view?id=11e7cae12e4b4b289e3ef939"
            }
          }
        },
        {
          "id": "11e7cae16174355a9e98778c",
          "local_ip_address": null,
          "port": null,
          "title": "test terminal add",
          "_links": {
            "self": {
              "href": "https://api.sandbox.domain.com/v2/terminalinfo/view?id=11e7cae16174355a9e98778c"
            }
          }
        },
        {
          "id": "11e891c7eb4a62f6aaff1c41",
          "local_ip_address": null,
          "port": null,
          "title": "virtual terminal",
          "_links": {
            "self": {
              "href": "https://api.sandbox.domain.com/v2/terminalinfo/view?id=11e891c7eb4a62f6aaff1c41"
            }
          }
        },
        {
          "id": "11e891ce3a07c252b9a559d1",
          "local_ip_address": null,
          "port": null,
          "title": "reprint virtual device",
          "_links": {
            "self": {
              "href": "https://api.sandbox.domain.com/v2/terminalinfo/view?id=11e891ce3a07c252b9a559d1"
            }
          }
        }
      ],
      "tags": [
        {
          "id": "11e859f648dee9fabfebdb51",
          "location_id": "11e39j49jfsdfs9j39ts9fj934te",
          "title": "1",
          "created_ts": 1526577495,
          "modified_ts": 1526577495,
          "_links": {
            "self": {
              "href": "https://api.sandbox.domain.com/v2/tags/1?location_id=11e39j49jfsdfs9j39ts9fj934te"
            }
          }
        },
        {
          "id": "11e859f64ae3e8aeb6a94990",
          "location_id": "11e39j49jfsdfs9j39ts9fj934te",
          "title": "2",
          "created_ts": 1526577498,
          "modified_ts": 1526577498,
          "_links": {
            "self": {
              "href": "https://api.sandbox.domain.com/v2/tags/2?location_id=11e39j49jfsdfs9j39ts9fj934te"
            }
          }
        }
      ],
      "show_contact_notes": 1,
      "show_contact_files": 1,
      "_links": {
        "self": {
          "href": "https://api.sandbox.domain.com/v2/locationinfos/11e39j49jfsdfs9j39ts9fj934te"
        },
        "location": {
          "href": "https://api.sandbox.domain.com/v2/locations/11e39j49jfsdfs9j39ts9fj934te"
        }
      }
    }
  ],
  "meta": {
    "pagination": {
      "links": {
        "self": {
          "href": "https://api.sandbox.domain.com/v2/locationinfos?relationship=direct&page=1"
        }
      },
      "totalCount": 2,
      "pageCount": 1,
      "currentPage": 0,
      "perPage": 20
    },
    "sort": {
      "attributes": {
        "created_ts": "desc"
      }
    }
  }
}
```

## Direct API - Contact

Our Contacts Endpoint allows an integrator to build a container for customer information, vaulted data, and transaction history. A contact may be an individual, family, business, or any other entity you may give a name to. Once you build a contact record you can add that contact_id to any additional API requests such as Create Record (Account Vault), Perform a Sale (Transactions), Create Quick Invoice, and more.

### Create Contact

`POST /v2/contacts`

#### Request
```json
{
    "contact": {
        "location_id": "123456789012345678901234",
        "account_number": "1234",
        "contact_api_id": "137",
        "first_name": "Rick",
        "last_name": "Sanchez",
        "cell_phone": "1234567890",
        "contact_balance": "245.65"
    }
}
```

#### Response
```json
{
    "contact": {
        "id": "123456789012345678901234",
        "location_id": "123456789012345678901234",
        "account_number": "1234",
        "contact_api_id": "137",
        "company_name": null,
        "first_name": "Rick",
        "last_name": "Sanchez",
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

## Reduce PCI-DSS Scope with PayForm/AccountForm and Vaulted transactions

Paya Connect offers hosted forms to reduce PCI-DSS scope. Use these forms to collect PCI-sensitive data for one-time payments, recurring, or even store the data for future payments. We return values like the transaction_id and account_vault_id that will let you store a token in place of PCI-sensitive data for future transactions.

## PayForm

The PayForm widget can be used for running sale, authonly, avsonly, or debit (ach). For more information about the PayForm, please see the following resources.
* [PayForm Integration Documentation](https://github.com/PayaDev/PayaConnect/tree/master/PayForm)
* [PayForm Github Sample](https://github.com/PayaDev/PayaConnect/tree/master/PayForm)

**Notes on additional action that can be used inside Payform:** Use `“action”: “avsonly”` and `“save_account”: 1` with PayForm to validate and store accountholder data.

## AccountForm

The AccountForm widget is used strictly to generate an account vault token.  For more information about AccountForm, please see the following resources.
* [AccountForm Integration Documentation](https://github.com/PayaDev/PayaConnect/tree/master/AccountForm)
* [AccountForm Github Samples](https://github.com/PayaDev/PayaConnect/tree/master/AccountForm)

## Direct API - CC

Once you have obtained an account_vault_id or account_vault_api_id you can use our RESTful Direct API Endpoints to process additional requests without falling into scope for PCI-DSS.

### Sale Request

`POST /v2/transactions`

#### Request
```json
{
    "transaction": {
        "action": "sale",
        "payment_method": "cc",
        "account_vault_id": "{account_vault_id}",
        "transaction_amount": 1,
        "location_id": "{location_id}",
        "product_transction_id": "{product_transaction_id}",
        "billing_street": "5800 NW 39th AVE",
        "billing_zip": "32606"
    }
}
```

#### Response
```json
{
    "transaction": {
        "id": "333333333333333333333333", 
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
        "location_id": "{location_id}",
        "settle_date": null,
        "charge_back_date": null,
        "void_date": null,
        "account_type": "mc",
        "is_recurring": false,
        "is_accountvault": true,
        "checkin_date": null,
        "checkout_date": null,
        "room_num": null,
        "room_rate": null,
        "advance_deposit": false,
        "no_show": false,
        "entry_mode_id": "C"
        "emv_receipt_data": {},         
        "folio_num": "",
        "_links": {
            "self": {
                "href": "{url}/v2/transactions/222222222222222222222222"
            }
        }
    }
}
```

### Auth Only Request

`POST /v2/transactions`

#### Request
```json
{
  "transaction": {
    "payment_method": "cc",
    "action": "authonly",
    "account_vault_id":"{account_vault_id}",
    "transaction_amount": "120.00",
    "product_transaction_id": "{product_transaction_id}",
    "billing_street": "5800 NW 39th AVE",
    "billing_zip": "32606"
  }
}
```

#### Response
```json
{
  "transaction": {
    "id": "11ebd9c8dc96d3429d9ae783",
    "payment_method": "cc",
    "account_vault_id": null,
    "recurring_id": null,
    "first_six": "545454",
    "last_four": "5454",
    "account_holder_name": "Test Paya",
    "transaction_amount": "200.00",
    "description": null,
    "transaction_code": null,
    "avs": null,
    "batch": null,
    "order_num": "780044371927",
    "verbiage": "Test 1014",
    "transaction_settlement_status": null,
    "effective_date": null,
    "routing": null,
    "return_date": null,
    "created_ts": 1625074228,
    "modified_ts": 1625074228,
    "transaction_api_id": null,
    "terms_agree": null,
    "notification_email_address": null,
    "notification_email_sent": true,
    "response_message": null,
    "auth_amount": "200.00",
    "auth_code": "d9c8dc",
    "status_id": 102,
    "type_id": 20,
    "location_id": "11e919aa3c4a4ed6a04860ff",
    "reason_code_id": 1000,
    "contact_id": null,
    "billing_zip": null,
    "billing_street": null,
    "product_transaction_id": "11e919aa3c630002afd9e7db",
    "tax": "0.00",
    "customer_ip": null,
    "customer_id": null,
    "po_number": null,
    "avs_enhanced": "V",
    "cvv_response": "M",
    "billing_phone": null,
    "billing_city": null,
    "billing_state": null,
    "clerk_number": null,
    "tip_amount": "0.00",
    "created_user_id": "11e919aa3d639af2a5c5d689",
    "modified_user_id": "11e919aa3d639af2a5c5d689",
    "ach_identifier": null,
    "check_number": null,
    "settle_date": null,
    "charge_back_date": null,
    "void_date": null,
    "account_type": "mc",
    "is_recurring": false,
    "is_accountvault": false,
    "transaction_c1": null,
    "transaction_c2": null,
    "transaction_c3": null,
    "additional_amounts": [],
    "terminal_serial_number": null,
    "entry_mode_id": "K",
    "terminal_id": null,
    "quick_invoice_id": null,
    "ach_sec_code": null,
    "custom_data": null,
    "hosted_payment_page_id": null,
    "trx_source_id": 12,
    "transaction_batch_id": null,
    "checkin_date": null,
    "checkout_date": null,
    "room_num": null,
    "room_rate": "0.00",
    "advance_deposit": false,
    "no_show": false,
    "emv_receipt_data": null,
    "_links": {
      "self": {
        "href": "https://api.sandbox.payaconnect.com/v2/transactions/11ebd9c8dc96d3429d9ae783"
      }
    }
  }
}
```

**Important Note:** All authonly requests need to be either captured (action = authcomplete) or voided (action = void). Please do not allow authonly requests to remain on the gateway incomplete.

### Capture or Completion Request

This request uses the transaction_id returned from the authonly request. 

`POST /v2/transactions`

#### Request
```json
{
    "transaction": {
        "action": "authcomplete",
        // Request can provide transaction_amount for higher or lesser amount than auth
        "transaction_amount": "60.00"
    }
}
```

#### Response
```json
{
    "transaction": {
        "id": "222222222222222222222222",
        "payment_method": "cc", 
        "account_vault_id": null,
        "recurring_id": null,
        "first_six": "545454",
        "last_four": "5454",
        "account_holder_name": null,
        "transaction_amount": "60.00",
        "description": null,
        "transaction_code": null, 
        "code": "AUTH",
        "avs": "BAD",
        "batch": "2",
        "item": "10",
        "order_num": "433659378839",
        "timestamp": "1421953180",
        "verbiage": "APPROVED",
        "transaction_settlement_status": null,
        "effective_date": null,
        "routing": null,
        "return_date": null,
        "created_ts": 1421951061, 
        "modified_ts": 1421953145,
        "transaction_api_id": null,
        "terms_agree": null,
        "notification_email_address": null, 
        "notification_email_sent": false,
        "response_message": null,
        "auth_amount": 1,
        "auth": "220093",
        "status_id": 101,
        "type_id": 20,
        "location_id": "{location_id}",
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
        "folio_num": "433659378839",
        "_links": {
            "self": { 
                "href": "{url}/v2/transactions/{location_id}" 
            }
        } 
    }
}
```

### Void Request

This is similar in design to the capture request above. This allows you to reverse an authorization hold on the funds rather than waiting the time it takes for the funds to be released by the issuing bank. A void must be performed prior to batch settlement which usually takes place at the end of the day but will vary from merchant to merchant. 

`POST /v2/transactions`

#### Request
```json
{
    "transaction": {
        "action": "void"
    }
}
```

#### Response
```json
{
    "transaction": {
        "id": "222222222222222222222222",
        "payment_method": "cc", 
        "account_vault_id": null,
        "recurring_id": null,
        "first_six": "545454",
        "last_four": "5454",
        "account_holder_name": null,
        "transaction_amount": 0,
        "description": null,
        "transaction_code": null, 
        "code": "AUTH",
        "avs": "BAD",
        "batch": "2",
        "item": "10",
        "order_num": "433659378839",
        "timestamp": "1421953180",
        "verbiage": "APPROVED",
        "transaction_settlement_status": null,
        "effective_date": null,
        "routing": null,
        "return_date": null,
        "created_ts": 1421951061, 
        "modified_ts": 1421953145,
        "transaction_api_id": null,
        "terms_agree": null,
        "notification_email_address": null, 
        "notification_email_sent": false,
        "response_message": null,
        "auth_amount": 1,
        "auth": "220093",
        "status_id": 201,
        "type_id": 20,
        "location_id": "{location_id}",
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
        "folio_num": "433659378839",
        "_links": {
            "self": { 
                "href": "{url}/v2/transactions/{location_id}" 
            }
        } 
    }
}
```

### Refund from a previous transaction

This request uses the transaction_id from a previous transaction. It is passed within the previous_transaction_id field. A refund should be utilized after a transaction is settled. This is usually the next day after settlement occurs or later. 

`POST /v2/transactions`

#### Request
```json
{
    "transaction": {
        "action": "refund",
        "payment_method": "cc",
        "previous_transaction_id": "{transaction_id}",
        "transaction_amount": 200.00,
        "location_id": "{location_id}"
    }
}
```

#### Response
```json
{
  "transaction": {
    "id": "11ebd9d8b400f8bc8c0cbfb2",
    "payment_method": "cc",
    "account_vault_id": null,
    "recurring_id": null,
    "first_six": "545454",
    "last_four": "5454",
    "account_holder_name": "Test Paya",
    "transaction_amount": "200.00",
    "description": null,
    "transaction_code": null,
    "avs": null,
    "batch": "166",
    "order_num": "497055530905",
    "verbiage": "Test 3622",
    "transaction_settlement_status": null,
    "effective_date": null,
    "routing": null,
    "return_date": null,
    "created_ts": 1625081032,
    "modified_ts": 1625081032,
    "transaction_api_id": null,
    "terms_agree": null,
    "notification_email_address": null,
    "notification_email_sent": true,
    "response_message": null,
    "auth_amount": "200.00",
    "auth_code": "",
    "status_id": 111,
    "type_id": 30,
    "location_id": "11e919aa3c4a4ed6a04860ff",
    "reason_code_id": 1000,
    "contact_id": null,
    "billing_zip": null,
    "billing_street": null,
    "product_transaction_id": "11e919aa3c630002afd9e7db",
    "tax": "0.00",
    "customer_ip": null,
    "customer_id": null,
    "po_number": null,
    "avs_enhanced": "V",
    "cvv_response": "N",
    "billing_phone": null,
    "billing_city": null,
    "billing_state": null,
    "clerk_number": null,
    "tip_amount": "0.00",
    "created_user_id": "11e919aa3d639af2a5c5d689",
    "modified_user_id": "11e919aa3d639af2a5c5d689",
    "ach_identifier": null,
    "check_number": null,
    "settle_date": null,
    "charge_back_date": null,
    "void_date": null,
    "account_type": "mc",
    "is_recurring": false,
    "is_accountvault": false,
    "transaction_c1": null,
    "transaction_c2": null,
    "transaction_c3": null,
    "additional_amounts": [],
    "terminal_serial_number": null,
    "entry_mode_id": "K",
    "terminal_id": null,
    "quick_invoice_id": null,
    "ach_sec_code": null,
    "custom_data": null,
    "hosted_payment_page_id": null,
    "trx_source_id": 12,
    "transaction_batch_id": "11ebd9d81d8c9d50b71d5610",
    "checkin_date": null,
    "checkout_date": null,
    "room_num": null,
    "room_rate": "0.00",
    "advance_deposit": false,
    "no_show": false,
    "emv_receipt_data": null,
    "_links": {
      "self": {
        "href": "https://api.sandbox.payaconnect.com/v2/transactions/11ebd9d8b400f8bc8c0cbfb2"
      }
    }
  }
}
```

## Direct API - ACH

Once you have obtained an account_vault_id or account_vault_api_id you can use our RESTful Direct API Endpoints to process additional requests. 

### WEB Debit Request from an Account Vault

This is the main request for processing customer-initiated payments using a web interface. 

`POST /v2/transactions`

#### Request
```json
{
  "transaction": {
    "action": "debit",
    "payment_method": "ach",
    "transaction_amount": "10.00",
    "product_transaction_id": "{product_transaction_id}",
    "location_id": "{location_id}",
    "ach_sec_code": "WEB",
    "account_holder_name": "Test Account",
    "account_type": "checking",
    "account_vault_id": "{account_vault_id}",
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "billing_phone": "7894561230",
    "dob_year": "1990",
    "ssn4": "1234",
    "dl_number": "012345678",
    "dl_state": "GA"
  }
}
```

#### Response
```json
{
  "transaction": {
    "id": "11ebd9dc11edb192acc537ba",
    "payment_method": "ach",
    "account_vault_id": "11eb8bdf1ae2385e9ec6747a",
    "recurring_id": null,
    "first_six": null,
    "last_four": "7890",
    "account_holder_name": "John Smith",
    "transaction_amount": "10.00",
    "description": null,
    "transaction_code": null,
    "avs": null,
    "batch": null,
    "order_num": "058674928276",
    "verbiage": "Test 5272",
    "transaction_settlement_status": null,
    "effective_date": null,
    "routing": "072000326",
    "return_date": null,
    "created_ts": 1625082478,
    "modified_ts": 1625082478,
    "transaction_api_id": null,
    "terms_agree": null,
    "notification_email_address": null,
    "notification_email_sent": true,
    "response_message": null,
    "auth_amount": "10.00",
    "auth_code": "AUTH NUM 272-172",
    "status_id": 131,
    "type_id": 50,
    "location_id": "11e919aa3c4a4ed6a04860ff",
    "reason_code_id": 1000,
    "contact_id": null,
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "product_transaction_id": "11ea4f5216b3141c91042a55",
    "tax": "0.00",
    "customer_ip": null,
    "customer_id": null,
    "po_number": null,
    "avs_enhanced": null,
    "cvv_response": null,
    "billing_phone": "7894561230",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "clerk_number": null,
    "tip_amount": "0.00",
    "created_user_id": "11e919aa3d639af2a5c5d689",
    "modified_user_id": "11e919aa3d639af2a5c5d689",
    "ach_identifier": null,
    "check_number": null,
    "settle_date": null,
    "charge_back_date": null,
    "void_date": null,
    "account_type": "checking",
    "is_recurring": false,
    "is_accountvault": true,
    "transaction_c1": null,
    "transaction_c2": null,
    "transaction_c3": null,
    "additional_amounts": [],
    "terminal_serial_number": null,
    "entry_mode_id": "K",
    "terminal_id": null,
    "quick_invoice_id": null,
    "ach_sec_code": "WEB",
    "custom_data": null,
    "hosted_payment_page_id": null,
    "trx_source_id": 12,
    "transaction_batch_id": null,
    "checkin_date": null,
    "checkout_date": null,
    "room_num": null,
    "room_rate": "0.00",
    "advance_deposit": false,
    "no_show": false,
    "emv_receipt_data": null,
    "_links": {
      "self": {
        "href": "https://api.sandbox.payaconnect.com/v2/transactions/11ebd9dc11edb192acc537ba"
      }
    }
  }
}
```

### WEB Refund using Previous Transaction data

This use a transaction_id from a previous WEB debit refund to perform a full refund (action = refund).  Note that any partial refund cannot be run on a WEB ach_sec_code; for partial refunds, please review the next section on Credit Request (Refund) using Previous Transaction data.

`POST /v2/transactions`

#### Request
```json
{
  "transaction": {
    "action": "refund",
    "payment_method": "ach",
    "transaction_amount": "10.00",
    "product_transaction_id": "{product_transaction_id}",
    "location_id": "{location_id}",
    "ach_sec_code": "WEB",
    "previous_transaction_id": "{transaction_id}",
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "billing_phone": "7894561230",
    "dob_year": "1990",
    "ssn4": "1234",
    "dl_number": "012345678",
    "dl_state": "GA"
  }
}
```

#### Response
```json
{
  "transaction": {
    "id": "11ebd9e0be6318fa8bccec90",
    "payment_method": "ach",
    "account_vault_id": null,
    "recurring_id": null,
    "first_six": null,
    "last_four": "7890",
    "account_holder_name": "Test Account",
    "transaction_amount": "10.00",
    "description": null,
    "transaction_code": null,
    "avs": null,
    "batch": null,
    "order_num": "764971189338",
    "verbiage": "Test 2229",
    "transaction_settlement_status": null,
    "effective_date": null,
    "routing": "072000326",
    "return_date": null,
    "created_ts": 1625084485,
    "modified_ts": 1625084485,
    "transaction_api_id": null,
    "terms_agree": null,
    "notification_email_address": null,
    "notification_email_sent": true,
    "response_message": null,
    "auth_amount": "10.00",
    "auth_code": "AUTH NUM 272-172",
    "status_id": 131,
    "type_id": 30,
    "location_id": "11e919aa3c4a4ed6a04860ff",
    "reason_code_id": 1000,
    "contact_id": null,
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "product_transaction_id": "11ea4f5216b3141c91042a55",
    "tax": "0.00",
    "customer_ip": null,
    "customer_id": null,
    "po_number": null,
    "avs_enhanced": null,
    "cvv_response": null,
    "billing_phone": "7894561230",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "clerk_number": null,
    "tip_amount": "0.00",
    "created_user_id": "11e919aa3d639af2a5c5d689",
    "modified_user_id": "11e919aa3d639af2a5c5d689",
    "ach_identifier": null,
    "check_number": null,
    "settle_date": null,
    "charge_back_date": null,
    "void_date": null,
    "account_type": "checking",
    "is_recurring": false,
    "is_accountvault": false,
    "transaction_c1": null,
    "transaction_c2": null,
    "transaction_c3": null,
    "additional_amounts": [],
    "terminal_serial_number": null,
    "entry_mode_id": "K",
    "terminal_id": null,
    "quick_invoice_id": null,
    "ach_sec_code": "WEB",
    "custom_data": null,
    "hosted_payment_page_id": null,
    "trx_source_id": 12,
    "transaction_batch_id": null,
    "checkin_date": null,
    "checkout_date": null,
    "room_num": null,
    "room_rate": "0.00",
    "advance_deposit": false,
    "no_show": false,
    "emv_receipt_data": null,
    "_links": {
      "self": {
        "href": "https://api.sandbox.payaconnect.com/v2/transactions/11ebd9e0be6318fa8bccec90"
      }
    }
  }
}
```

### Credit Request (Refund) using Previous Transaction data

This uses a transaction_id from a previous debit request to perform the refund (action = credit). Note that an ACH Credit will need to be performed against the ach_sec_code “CCD” using a product_transaction_id from a CCD service within Paya Connect. 

`POST /v2/transactions`

#### Request
```json
{
  "transaction": {
    "action": "credit",
    "payment_method": "ach",
    "transaction_amount": "10.00",
    "product_transaction_id": "{product_transaction_id}",
    "location_id":"{location_id}",
    "ach_sec_code": "CCD",
    "previous_transaction_id": "{transaction_id}",
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "billing_phone": "7894561230",
    "dob_year": "1990",
    "ssn4": "1234",
    "dl_number": "012345678",
    "dl_state": "GA"
  }
}
```

#### Response
```json
{
  "transaction": {
    "id": "11eb8be9838349169ec53b8e",
    "payment_method": "ach",
    "account_vault_id": null,
    "recurring_id": null,
    "first_six": null,
    "last_four": "7890",
    "account_holder_name": "Test Account",
    "transaction_amount": "10.00",
    "description": null,
    "transaction_code": null,
    "avs": null,
    "batch": null,
    "order_num": "042679827978",
    "verbiage": "Test 6714",
    "transaction_settlement_status": null,
    "effective_date": null,
    "routing": "072000326",
    "return_date": null,
    "created_ts": 1616512061,
    "modified_ts": 1616512061,
    "transaction_api_id": null,
    "terms_agree": null,
    "notification_email_address": null,
    "notification_email_sent": true,
    "response_message": null,
    "auth_amount": "10.00",
    "auth_code": "AUTH NUM 272-172",
    "status_id": 131,
    "type_id": 40,
    "location_id": "11e919aa3c4a4ed6a04860ff",
    "reason_code_id": 1000,
    "contact_id": null,
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "product_transaction_id": "11ea4f51cb20259e9187cd73",
    "tax": "0.00",
    "customer_ip": null,
    "customer_id": null,
    "po_number": null,
    "avs_enhanced": null,
    "cvv_response": null,
    "billing_phone": "7894561230",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "clerk_number": null,
    "tip_amount": "0.00",
    "created_user_id": "11e919aa3d639af2a5c5d689",
    "modified_user_id": "11e919aa3d639af2a5c5d689",
    "ach_identifier": null,
    "check_number": null,
    "settle_date": null,
    "charge_back_date": null,
    "void_date": null,
    "account_type": "checking",
    "is_recurring": false,
    "is_accountvault": false,
    "transaction_c1": null,
    "transaction_c2": null,
    "transaction_c3": null,
    "additional_amounts": [],
    "terminal_serial_number": null,
    "entry_mode_id": "K",
    "terminal_id": null,
    "quick_invoice_id": null,
    "ach_sec_code": "CCD",
    "custom_data": null,
    "hosted_payment_page_id": null,
    "trx_source_id": 12,
    "transaction_batch_id": null,
    "checkin_date": null,
    "checkout_date": null,
    "room_num": null,
    "room_rate": "0.00",
    "advance_deposit": false,
    "no_show": false,
    "emv_receipt_data": null,
    "_links": {
      "self": {
        "href": "https://api.sandbox.payaconnect.com/v2/transactions/11eb8be9838349169ec53b8e"
      }
    }
  }
}
```

## Summary

While the examples provided are available to get you started with your integration. Please keep in mind that this is a basic method of integration to be used as a guide. Should you have any questions relating to your integration, please reach out to the SDK Team at [sdksupport@nuvei.com](mailto:sdksupport@nuvei.com).
