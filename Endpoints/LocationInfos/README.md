# Locationinfos Endpoint
The Locationinfos Endpoint is a great resource for retreiving information about Locations that already includes associated imforation that would otherwise require multiple API requests to obtain.  Additionally, this endpoint can be used to determine any specific requirements for your terminals when using an ACH processor.

| Methods                    | GET                                                                                                                                                                                                                                                                                                                   |
|----------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Filters                    | <table>  <thead>  <tr>  <th>Name</th>  <th>Description</th>  </tr>  </thead>  <tbody>  <tr>  <td>relationship</td>  <td>Possible Values: "all", "direct", "child"   If not provided, "direct is assumed.</td></tr>  <tr>  <td>product_transaction_active</td>  <td>Possible Values: 0 or 1</td> </tr>  </tbody>  </table>   Filters can be used to search for matching records by including the columns you want to filter on as URL parameters. i.e. `?field=value&field2=value2` |
| Expands                    | <table>  <thead>  <tr>  <th>Name</th>  <th>Description</th>  </tr>  </thead>  <tbody>  <tr>  <td>terminals</td>  <td>Will include all terminals array inside Product Transaction</td></tr> </tbody>  </table>       For detail on how to use Expands on an Endpoint, please visit the [Expands (Related Records)]() page.                                                                                                                         |

 

## Endpoint Actions
### View Record List

`GET /v2/locationinfos`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

Response
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


### Terminal Requirements
Terminals supporting ACH can often have different requirements as well as different capabilities for processing transactions.  These requirements and capabilities can easily be identified for your terminal so you know exactly what data you need to provide in order for the transaction to be accepted as well as what types of actions you can perform on a specific terminal.

If you are using a Terminal supporting ACH that has specific requirements, you will see this information under the associated Product Transaction. The code example below is similar to the one above although some areas have been omitted to give greater visibility to the Terminal specific data.

`GET /v2/locationinfos`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

Response
```json
{
    "locationinfo": {
        "id": "11e8c1v9fc87gf36b13b2a0c",
        "name": "Ach Gateway Test",
        ... // Other locationinfo fields here
        "product_transactions": [
            {
                "id": "11e8x1a92z06ew349f253774",
                "payment_method": "ach",
                "processor": "zach",
                "tax_surcharge_config": 2,
                ... // Other product transaction fields here
                "processor_data": {
                    "terminals": [
                        {
                            "terminal_id": "1119650",
                            "sec_code": "CCD",
                            "actions": [
                                "debit",
                                "refund",
                                "credit"
                            ],
                            "required": [
                                "account_holder_name",
                                "routing",
                                "account_number",
                                "account_type",
                                "driver_license",
                                "identity_verification",
                                "billing_street",
                                "billing_city",
                                "billing_state",
                                "billing_zip"
                            ]
                       },
                       {
                            "terminal_id": "1119651",
                            "sec_code": "TEL",
                            "actions": [
                                "debit",
                                "refund"
                            ],
                            "required": [
                                "account_holder_name",
                                "routing",
                                "account_number",
                                "account_type",
                                "check_number",
                                "driver_license",
                                "identity_verification",
                                "billing_street",
                                "billing_city",
                                "billing_state",
                                "billing_zip"
                            ]
                        },
                    ]
                }
            }
        ],
    }
}
```

In the example above, you can see that within a Product Transaction there is a "processor_data" field containing an array of Terminals.  For each terminal there will be an array of "actions" that the terminal can perform.  Additionally, there will be a "required" array that will list all of the requirements that must be met in order for the Terminal to accept the transaction.

In general, the values within the "required" array are the exact names of the fields that must be provided in order to satisfy the requirement.  However there are some values within the "required" array that correspond to a set of conditionally required fields. 

| Requirement           | Satisfaction                |
|-----------------------|-----------------------------|
| driver_license        | dl_number AND dl_state      |
| identity_verification | ssn4 OR dob_year. NOT both. |
