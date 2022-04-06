# Quick Invoices Endpoint
Quick Invoices is a way for a merchant to send an email to a customer with a link to make a payment. This link, when clicked, opens a browser containing the Quick Invoice of whatever it is that the customer purchased. Each Quick Invoice email will have the ability to be customized by the merchant. There will be a default template provided for the merchant as a starting point. Once paid, the customer will receive an email thanking them for their payment. The system will send the customer email notifications prior to the due date, on the due date, and past the due at the discretion of the merchant. There will also be reporting provided to the merchant.

## Quick Invoice Process
The detail listed below in this document explains how to use the API to create and update quick invoices. Once an invoice is created, the system will send an email with the details of the quick invoice and a link on how to make a payment towards the invoice.

The email will contain a link that looks something like the following:

>https://{sandbox_project_name}.sandbox.payaconnect.com/#/quickinvoice/view/{quick_invoice_id}

When the end user receives this email, they will be able to click on the link and it will take them to a page that looks like the image below. This page is where they will be making their payment(s).

![image](https://user-images.githubusercontent.com/6975101/161562999-14f4f85e-9118-4c04-a56f-0816de661423.png)


Once a payment is made on the quick invoice, the transaction will show up in the transaction listing with a reference to the quick invoice.

## Endpoint Actions
### Create QuickInvoice
`POST /v2/quickinvoices`

Request
```json
{
    "quickinvoice": {
        "title":"Invoice with min fields", // Required
        "due_date":"{due_date}", // Required
        "item_list": { // Required
            "item1xx":10,
            "item2yy":11
        },
        "location_id":"{location_id}" // Required
	}
}
```
Response
```json
{
    "quickinvoice": {
        "id": "111111111111111111111111",
        "location_id": "{location_id}",
        "contact_id": null,
        "invoice_number": null,
        "title": "Invoice with min fields",
        "item_header": null,
        "item_list": {
            "item1xx": 10,
            "item2yy": 11
        },
        "item_footer": null,
        "status_id": 1,
        "payment_status_id": 1,
        "amount_due": "21.00",
        "remaining_balance": "21.00",
        "due_date": "{due_date}",
        "expire_date": null,
        "email": null,
        "allow_partial_pay": 0,
        "notification_days_before_due_date": 3,
        "notification_on_due_date": 1,
        "notification_days_after_due_date": 7,
        "cc_product_transaction_id": "222222222222222222222222",
        "ach_product_transaction_id": null,
        "is_active": 1,
        "created_ts": 1516368468,
        "created_user_id": "xxxxxxxxxxxxxxxxxxxxxxxx",
        "modified_ts": 1516368468,
        "modified_user_id": "xxxxxxxxxxxxxxxxxxxxxxxx",
        "_links": {
            "self": {
                "href": "{url}/v2/quickinvoice/view?id=111111111111111111111111"
            }
        }
    }
}
```



**Including File Attachments**

It is possible to create a QuickInvoice and attach files to it in a single request.  You just need to include all of the normally required fields along with the files and POST this data using multipart/form-data encoding. 

The following code examples demonstrate how this can be done across a few different popular languages.  You may need to extrapolate the concepts found here to whatever specific solution you are implementing.

For additional information on working with QuickInvoices and file attachments, please take a look at our [File Attachments](README.md#file-attachments) documentation further below on this page.

`POST /v2/quickinvoices`

PHP:
```php
<?php
$client = new http\Client;
$request = new http\Client\Request;

$body = new http\Message\Body;
$body->addForm(
  [
    'quickinvoice[title]' => ' quickinvoice_123',
    'quickinvoice[due_date]' => '{due_date}',
    'quickinvoice[location_id]' => '{location_id}',
    'quickinvoice[attach_files_to_email]' => '1',
    'quickinvoice[item_list][item1]' => '1',
    'quickinvoice[item_list][item2]' => '1',
    'quickinvoice[send_email]' => '1',
    'quickinvoice[email]' => 'test@email.com',
    'quickinvoice[tags][0]' => 'Test tag1',
    'quickinvoice[tags][1]' => 'Test tag2'
  ],
  [
    [
      'name' => 'quickinvoice[files][0]',
      'type' => null,
      'file' => '{source_file_path}',
      'data' => null
    ],
    [
      'name' => 'quickinvoice[files][1]',
      'type' => null,
      'file' => '{source_file2_path}',
      'data' => null
    ]
  ]
);

$request->setRequestUrl('https://{domain}/v2/quickinvoices');
$request->setRequestMethod('POST');
$request->setBody($body);

$request->setHeaders([
  'Content-Type' => 'multipart/form-data',
  'developer-id' => '{developer_id}',
  'user-api-key' => '{user_api_key}',
  'user-id' => '{user_id}'
]);

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();
```

NodeJS:
```javascript
var fs = require("fs");
var request = require("request");

var options = {
  method: 'POST',
  url: 'https://{domain}/v2/quickinvoices',
  headers: {
    'Content-Type': 'multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW',
    'developer-id': '{developer-id}',
    'user-api-key': '{user_api_key}',
    'user-id': '{user_id}',
  },
  formData: {
    'quickinvoice[title]': '{title}',
    'quickinvoice[due_date]': '{due_date}',
    'quickinvoice[location_id]': '{location_id}',
    'quickinvoice[attach_files_to_email]': '1',
    'quickinvoice[item_list][item1]': '1',
    'quickinvoice[item_list][item2]': '1',
    'quickinvoice[files][0]': {
        value: 'fs.createReadStream("File {source_file_path}")',
        options: { filename: 'File {source_file_path}', contentType: null }
    },
    'quickinvoice[files][1]': {
        value: 'fs.createReadStream("File {source_file_path}")',
        options: { filename: 'File {source_file_path}', contentType: null }
    },
    'quickinvoice[send_email]': '1',
    'quickinvoice[email]': 'test@email.com',
    'quickinvoice[tags][0]': 'Test tag1',
    'quickinvoice[tags][1]': 'Test tag2'
  }
};

request(options, function (error, response, body) {
  if (error) throw new Error(error);

  console.log(body);
});
```
cURL:
```cURL
curl -X POST \
  'https://{domain}/v2/quickinvoices' \
  -H 'Content-Type: multipart/form-data' \
  -H 'Postman-Token: e00169e3-bca1-4e74-8a35-74b8e578e1ba' \
  -H 'content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW' \
  -H 'developer-id: {developer_id}' \
  -H 'user-api-key: {user_api_key}' \
  -H 'user-id: {user_id}' \
  -F 'quickinvoice[title]= A test title' \
  -F 'quickinvoice[due_date]={due_date}' \
  -F 'quickinvoice[location_id]={location_id}' \
  -F 'quickinvoice[attach_files_to_email]=1' \
  -F 'quickinvoice[item_list][item1]=1' \
  -F 'quickinvoice[item_list][item2]=1' \
  -F 'quickinvoice[files][0]=@File {source_file_path}' \
  -F 'quickinvoice[files][1]=@File {source_file2_path}' \
  -F 'quickinvoice[send_email]=1' \
  -F 'quickinvoice[email]=test@email.com' \
  -F 'quickinvoice[tags][0]=Test tag1' \
  -F 'quickinvoice[tags][1]=Test tag2'
```


### Update Record
`PUT /v2/quickinvoices/{id}`

Request
```json
{
	"quickinvoice": {
		"title":"Invoice with new title", // Optional
		... // Other Optional Fields here
	}
}
```
Response
```json
{
    "quickinvoice": {
        "id": "11111111111111111111",
        "location_id": "{location_id}",
        "contact_id": null,
        "invoice_number": null,
        "title": "Invoice with new title",
        "item_header": null,
        "item_list": {
            "item1xx": 10,
            "item2yy": 11
        },
        "item_footer": null,
        "status_id": 1,
        "payment_status_id": 1,
        "amount_due": "21.00",
        "remaining_balance": "21.00",
        "due_date": "{due_date}",
        "expire_date": null,
        "email": null,
        "allow_partial_pay": 0,
        "notification_days_before_due_date": 3,
        "notification_on_due_date": 1,
        "notification_days_after_due_date": 7,
        "cc_product_transaction_id": "222222222222222222222222",
        "ach_product_transaction_id": null,
        "is_active": 1,
        "created_ts": 1516368468,
        "created_user_id": "xxxxxxxxxxxxxxxxxxxxxxxx",
        "modified_ts": 1516368747,
        "modified_user_id": "xxxxxxxxxxxxxxxxxxxxxxxx",
        "_links": {
            "self": {
                "href": "{url}/v2/quickinvoice/view?id=111111111111111111111111"
            }
        }
    }
}
```

### View Single Record
`GET /v2/quickinvoices/{id}`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```
Response
```json
{
    "quickinvoice": {
        "id": "11111111111111111111",
        "location_id": "{location_id}",
        "contact_id": null,
        "invoice_number": null,
        "title": "Invoice with new title",
        "item_header": null,
        "item_list": {
            "item1xx": 10,
            "item2yy": 11
        },
        "item_footer": null,
        "status_id": 1,
        "payment_status_id": 1,
        "amount_due": "21.00",
        "remaining_balance": "21.00",
        "due_date": "{due_date}",
        "expire_date": null,
        "email": null,
        "allow_partial_pay": 0,
        "notification_days_before_due_date": 3,
        "notification_on_due_date": 1,
        "notification_days_after_due_date": 7,
        "cc_product_transaction_id": "222222222222222222222222",
        "ach_product_transaction_id": null,
        "is_active": 1,
        "created_ts": 1516368468,
        "created_user_id": "xxxxxxxxxxxxxxxxxxxxxxxx",
        "modified_ts": 1516368747,
        "modified_user_id": "xxxxxxxxxxxxxxxxxxxxxxxx",
        "_links": {
            "self": {
                "href": "{url}/v2/quickinvoice/view?id=111111111111111111111111"
            }
        }
    }
}
```

### View Record List
`GET /v2/quickinvoices`

Note: Filters can be used to search for Quick Invoices by including the columns you want to filter on as URL parameters. i.e. /v2/quickinvoices?field=value&field2=value2

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```
Response
```json
{
    "quickinvoices": [
        {
            "id": "11111111111111111111",
            "location_id": "{location_id}",
            "contact_id": null,
            "invoice_number": null,
            "title": "Invoice with new title",
            "item_header": null,
            "item_list": {
                "item1xx": 10,
                "item2yy": 11
            },
            "item_footer": null,
            "status_id": 1,
            "payment_status_id": 1,
            "amount_due": "21.00",
            "remaining_balance": "21.00",
            "due_date": "{due_date}",
            "expire_date": null,
            "email": null,
            "allow_partial_pay": 0,
            "notification_days_before_due_date": 3,
            "notification_on_due_date": 1,
            "notification_days_after_due_date": 7,
            "cc_product_transaction_id": "222222222222222222222222",
            "ach_product_transaction_id": null,
            "is_active": 1,
            "created_ts": 1516368468,
            "created_user_id": "xxxxxxxxxxxxxxxxxxxxxxxx",
            "modified_ts": 1516368747,
            "modified_user_id": "xxxxxxxxxxxxxxxxxxxxxxxx"
        },
    ... // Other Quick Invoices here
    ],
    "meta": {
        "pagination": {
            "links": {
                "self": {
                    "href": "{url}/v2/quickinvoices?field=value&field2=value2&sort=-created_ts&page=2"
                },
                "next": {
                    "href": "{url}/v2/quickinvoices?field=value&field2=value2&sort=-created_ts&page=3"
                },
                "last": {
                    "href": "{url}/v2/quickinvoices?field=value&field2=value2&sort=-created_ts&page=1"
                }
            },
            "totalCount": 200,
            "pageCount": 10,
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

### Delete Record
`DELETE /v2/quickinvoices/{id}`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

Response
```json
No JSON Response.  HTTP Response Code Only.

204 - Success, Quick Invoice was deleted.
404 - Fail, Quick Invoice not found.
```

### Add Transaction
The following request can be used in scenarios where payment for a QuickInvoice was collected through another medium and the transaction needs to be associated with the QuickInvoice so that the remaining balance is updated accordingly.

`PUT /v2/quickinvoices/{id}/addTransaction`

Request
```json
{
    "quickinvoice": {
        "transaction_id": "xcv7s9fsusifhs9f39rsdfijsdix"
    }
}
```

Response
```json
{
        "quickinvoice": {
        "id": "111111111111111111111111",
        "location_id": "1111111111111111",
        "contact_id": null,
        "invoice_number": null,
        "title": "",
        "item_header": null,
        "item_list": {
        "item1": "1",
        "item2": "1"
            },
        "item_footer": null,
        "status_id": 1,
        "payment_status_id": 3,
        "amount_due": "2.00",
        "remaining_balance": "1.00",
        "due_date": "2022-02-05",
        "expire_date": null,
        "email": "",
        "allow_partial_pay": 1,
        "single_payment_min_amount": "0.00",
        "single_payment_max_amount": "9999999.99",
        "allow_overpayment": 0,
        "notification_days_before_due_date": 3,
        "notification_on_due_date": 1,
        "notification_days_after_due_date": 7,
        "cc_product_transaction_id": "",
        "ach_product_transaction_id": "",
        "active": 1,
        "created_ts": 1636661556,
        "created_user_id": "xxxxxxxxxxxxxxxxxxxxxxxx",
        "modified_ts": 1637249406,
        "modified_user_id": "xxxxxxxxxxxxxxxxxxxxxxxx",
        "note": null,
        "notification_email": null,
        "attach_files_to_email": 0,
        "_links": {
        "self": {
        "href": "{url}/v2/quickinvoice/view?id=111111111111111111111111"
                }
            },
        "transactions": {
        {
        "id": "111111111111111111111111",
        "payment_method": "cc",
        "account_vault_id": null,
        "recurring_id": null,
        "first_six": "411111",
        "last_four": "1111",
        "account_holder_name": null,
        "transaction_amount": "1.00",
        "description": null,
        "transaction_code": null,
        "avs": "GOOD",
        "batch": "10",
        "order_num": "123456789",
        "verbiage": "Test 4523",
        "transaction_settlement_status": null,
        "effective_date": null,
        "routing": "",
        "return_date": null,
        "created_ts": 1637164424,
        "modified_ts": 1637249406,
        "transaction_api_id": null,
        "terms_agree": 1,
        "notification_email_address": null,
        "notification_email_sent": true,
        "response_message": null,
        "auth_amount": "1.00",
        "auth_code": "47be8b",
        "status_id": 101,
        "type_id": 20,
        "location_id": "1111111111111111",
        "reason_code_id": 1000,
        "contact_id": null,
        "billing_zip": "32606",
        "billing_street": "5800 NW 39th AVE",
        "product_transaction_id": "",
        "tax": "0.00",
        "customer_ip": null,
        "customer_id": null,
        "po_number": null,
        "avs_enhanced": "Y",
        "cvv_response": "N",
        "billing_phone": null,
        "billing_city": null,
        "billing_state": null,
        "clerk_number": null,
        "tip_amount": "0.00",
        "bill_payment": null,
        "created_user_id": "xxxxxxxxxxxxxxxxxxxxxxxx",
        "modified_user_id": "xxxxxxxxxxxxxxxxxxxxxxxx",
        "ach_identifier": null,
        "check_number": null,
        "settle_date": null,
        "charge_back_date": null,
        "void_date": null,
        "account_type": "visa",
        "is_recurring": false,
        "is_accountvault": false,
        "transaction_c1": null,
        "transaction_c2": null,
        "transaction_c3": null,
        "additional_amounts": [],
        "terminal_serial_number": null,
        "entry_mode_id": "K",
        "terminal_id": null,
        "quick_invoice_id": "{id}",
        "ach_sec_code": null,
        "custom_data": null,
        "hosted_payment_page_id": null,
        "trx_source_id": 12,
        "transaction_batch_id": "",
        "recurring_flag": "no",
        "recurring_number": null,
        "installment_number": null,
        "installment_total_count": null,
        "emv_receipt_data": null,
        "_links": {
        "self": {
        "href": "{url}/v2/transactions/111111111111111111111111"
            }
        }
    }
}
```

### Remove Transaction
The following request can be used in scenarios where a Transaction needs to be disassociated from a QuickInvoice.

`PUT /v2/quickinvoices/{id}/removeTransaction`

Request
```json
{
    "quickinvoice": {
        "transaction_id": "xcv7s9fsusifhs9f39rsdfijsdix"
    }
}
```

Response
```json
{
        "quickinvoice": {
        "id": "{id}",
        "location_id": "111111111111111111111",
        "contact_id": null,
        "invoice_number": null,
        "title": "Testing JSNode",
        "item_header": null,
        "item_list": {
        "item1": "1",
        "item2": "1"
            },
        "item_footer": null,
        "status_id": 1,
        "payment_status_id": 1,
        "amount_due": "2.00",
        "remaining_balance": "2.00",
        "due_date": "2022-02-05",
        "expire_date": null,
        "email": "",
        "allow_partial_pay": 1,
        "single_payment_min_amount": "0.00",
        "single_payment_max_amount": "9999999.99",
        "allow_overpayment": 0,
        "notification_days_before_due_date": 3,
        "notification_on_due_date": 1,
        "notification_days_after_due_date": 7,
        "cc_product_transaction_id": "",
        "ach_product_transaction_id": "",
        "active": 1,
        "created_ts": 1636661556,
        "created_user_id": "xxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "modified_ts": 1637250056,
        "modified_user_id": "xxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "note": null,
        "notification_email": null,
        "attach_files_to_email": 0,
        "_links": {
        "self": {
        "href": "{url}/v2/quickinvoice/view?id={id}"
        }
            },
        "transactions": []
            }
        }
    }
}
```

### Resend Notification Email
There may be times when it is necessary to Resend the Notification Email to the recipient.  You can use the following request to make that happen.

`POST /v2/quickinvoices/{id}/resend`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

Response
```json
No JSON Response.  HTTP Response Code Only.

204 - Success, Quick Invoice Notification email was sent.
404 - Fail, Quick Invoice not found.
```
 

## Fields
| Name                              | Min | Max  | Format        | POST Required | POST Allowed | PUT Allowed | Comments                                                                                                                                                                                                                                                                                                                                                                       |
|-----------------------------------|-----|------|---------------|---------------|--------------|-------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| ach_product_transaction_id        | 24  | 36   | string        | ✔             | ✔            | ✔           | ACH product transaction on which QI is created. This field is optional and will default to default_ach product if not supplied at all. Either this or cc_product_transaction_id must be supplied. Changes are allowed on PUT if payments have not been made against QI.                                                                                                        |
| active                            | 1   | 1    | boolean       |               |              |             | Determines whether the invoice is currently active or not                                                                                                                                                                                                                                                                                                                      |
| allow_partial_pay                 | 1   | 1    | boolean       |               | ✔            | ✔           | Will determine if this quick invoice must be paid in full (0) or will accept partial payments (1)                                                                                                                                                                                                                                                                              |
| attach_files_to_email             | 1   | 1    | boolean       |               | ✔            | ✔           | If true, any files that are attached to the QuickInvoice will also be included in the QuickInvoice Notification email.                                                                                                                                                                                                                                                         |
| amount_due                        | 0   | 12   | decimal(10,2) |               |              |             | This is the amount that need to be paid (automatically calculated by system). amount_due= sum of items in item_list                                                                                                                                                                                                                                                            |
| cc_product_transaction_id         | 24  | 36   | string        | ✔             | ✔            | ✔           | CC product transaction on which QI is created. This field is optional and will default to default_cc product if not supplied at all. Either this or ach_product_transaction_id must be supplied. Changes are allowed on PUT if payments have not been made against QI.                                                                                                         |
| contact_id                        | 24  | 36   | string        |               | ✔            | ✔           | Optional. If the associated `contact.email` field has a value, it will be used to fill `email` unless `email` was specifically provided at creation (POST).                                                                                                                                                                                                                          |
| contact_api_id                    | 1   | 64   | string        |               | ✔            | ✔           | Optional. If there is a matching contact in the system, the API will translate this to a `contact.id` value and save it with the QuickInvoice.  If the associated `contact.email` field has a value, that value will be used to fill `email` unless  `email` was specifically provided at creation (POST). The `contact_id` will be returned in the response instead of  `contact_api_id.` |
| created_ts                        | 10  | 10   | timestamp     |               |              |             | System created timestamp                                                                                                                                                                                                                                                                                                                                                       |
| created_user_id                   | 24  | 36   | string        |               |              |             | User id who created the Quick invoice                                                                                                                                                                                                                                                                                                                                          |
| customer_id                       |     | 64   | string        |               | ✔            |             | Required for ACH transactions when Driver's License Verification is enabled on the terminal.  Either dl_number + dl_state OR customer_id will need to be passed in this scenario. Can also be used by Merchants to be able to identify Contacts in our system by an ID from another system.                                                                                    |
| dl_number                         | 1   | 50   | string        |               | ✔            |             | Required for ACH transactions when Driver's License Verification is enabled on the terminal.  Either dl_number + dl_state OR customer_id will need to be passed in this scenario.                                                                                                                                                                                              |
| dl_state                          | 2   | 2    | string        |               | ✔            |             | Required for ACH transactions when Driver's License Verification is enabled on the terminal.  Either dl_number + dl_state OR customer_id will need to be passed in this scenario.                                                                                                                                                                                              |
| dob_year                          | 4   | 4    | string        |               | ✔            |             | Required for certain ACH transactions where Identity Verification has been enabled for the terminal.  Either ssn4 or dob_year will need to be passed in this scenario but NOT BOTH.                                                                                                                                                                                            |
| due_date                          | 10  | 10   | date          | ✔             | ✔            | ✔           | The date that a Merchant would like a QuickInvoice to be paid by.                                                                                                                                                                                                                                                                                                              |
| email                             | 5   | 128  | string        |               | ✔            | ✔           | Optional. An email address that should be used as the "To" address when sending a QuickInvoice Notification email. This can be provided in POST and can be different from an associated Contact's email.  If not provided, this field will be backfilled from a Contact if possible.                                                                                           |
| expire_date                       | 10  | 10   | date          |               | ✔            | ✔           | Expire date of quickinvoice                                                                                                                                                                                                                                                                                                                                                    |
| files                             |     |      | array         |               | ✔            |             | An array of files that should be attached to the QuickInvoice. * Only applicable to multipart/form-data POST requests.                                                                                                                                                                                                                                                         |
| id                                | 24  | 36   | string        |               |              |             | System generated id                                                                                                                                                                                                                                                                                                                                                            |
| invoice_number                    | 0   | 64   | string        |               | ✔            | ✔           | Invoice number for the quick invoice                                                                                                                                                                                                                                                                                                                                           |
| is_active                         | 1   | 1    | boolean       |               |              |             | Whether or not this quick invoice is active                                                                                                                                                                                                                                                                                                                                    |
| item_footer                       | 0   | 250  | string        |               | ✔            | ✔           | Item footer used for item_list                                                                                                                                                                                                                                                                                                                                                 |
| item_header                       | 0   | 250  | string        |               | ✔            | ✔           | Item header used fo item_List                                                                                                                                                                                                                                                                                                                                                  |
| item_list                         | 5   | 4000 | string        | ✔             | ✔            | ✔           | List of item that quickinvoice hold. This is a json array of items                                                                                                                                                                                                                                                                                                             |
| location_id                       | 24  | 36   | string        | ✔             | ✔            |             | Location id to which quick invoice belongs to                                                                                                                                                                                                                                                                                                                                  |
| modified_ts                       | 10  | 10   | timestamp     |               |              |             | System created timestamp                                                                                                                                                                                                                                                                                                                                                       |
| modified_user_id                  | 24  | 36   | integer       |               |              |             | User id who modified the quick invoice                                                                                                                                                                                                                                                                                                                                         |
| note                              |     | 200  | string        |               | ✔            | ✔           | Used to display a Note from the Merchant to the Quick Invoice Recipient.                                                                                                                                                                                                                                                                                                       |
| notification_days_after_due_date  | 1   | 2    | integer       |               | ✔            | ✔           | If set, will cause a QuickInvoice Notification email to be sent 'x' # of days AFTER due_date.                                                                                                                                                                                                                                                                                  |
| notification_days_before_due_date | 1   | 2    | integer       |               | ✔            | ✔           | If set, will cause a QuickInvoice Notification email to be sent 'x' # of days BEFORE due_date.                                                                                                                                                                                                                                                                                 |
| notification_on_due_date          | 1   | 1    | boolean       |               | ✔            | ✔           | Sends notification to email on due_date                                                                                                                                                                                                                                                                                                                                        |
| payment_status_id                 | 1   | 1    | integer       |               |              |             | Must be one of 1, 2, or 3 1 = unpaid 2 = paid 3 = partially paid                                                                                                                                                                                                                                                                                                               |
| remaining_balance                 | 0   | 12   | decimal(10,2) |               |              |             | Upon creation it is same as amount_due; it will tell how much amount left to make a payment and is recalculated each time a payment is made                                                                                                                                                                                                                                    |
| send_email                        | 1   | 1    | boolean       |               | ✔            |             | Possible values: 0 \| 1 If set to 1, a QuickInvoice Notification email will be sent immediately upon creation (POST).                                                                                                                                                                                                                                                          |
| ssn4                              | 4   | 4    | string        |               | ✔            |             | For ACH transactions where Identity Verification is enabled the terminal. Only ssn4 OR dob_year should be passed, not both.                                                                                                                                                                                                                                                    |
| status_id                         | 1   | 1    | integer       |               |              | ✔           | The various statuses of the quick invoice (current values are open/closed). status_id = 0 (closed) status_id = 1 (open)                                                                                                                                                                                                                                                        |
| title                             | 1   | 64   | string        | ✔             | ✔            | ✔           | Title of quick invoice                                                                                                                                                                                                                                                                                                                                                         |

### Controlling Notification Emails
The following fields are described above, however they are re-listed here in the interest of highlighting those fields that specifically impact if and when QuickInvoice Notification emails should be sent, and how they relate to one another.

| Name                              | Description                                                                                                                                                                                                                                                                                                                                                                           |
|-----------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| contact_id                        | Optional. If the associated contact.email field has a value, contact.email will be used to fill email unless that value was specifically provided at creation (POST).                                                                                                                                                                                                                 |
| contact_api_id                    | Optional. If there is a matching contact in the system, the API will translate this to a contact.id value and save it with the QuickInvoice.  If the associated contact.email field has a value, contact.email will be used to fill `email` unless that value was specifically provided at creation (POST). The `contact_id` will be returned in the response instead of  `contact_api_id`. |
| email                             | Optional. An email address that should be used as the "To" address when sending a QuickInvoice Notification email.                                                                                                                                                                                                                                                                    |
| notification_days_before_due_date | Optional. If set, will cause a QuickInvoice Notification email to be sent 'x' # of days BEFORE `due_date`.                                                                                                                                                                                                                                                                              |
| notification_on_due_date          | Optional. Possible values: `0` \| `1` If set to `1`, a QuickInvoice Notification email will be sent on `due_date`.                                                                                                                                                                                                                                                                            |
| notification_days_after_due_date  | Optional. If set, will cause a QuickInvoice Notification email to be sent 'x' # of days AFTER `due_date`.                                                                                                                                                                                                                                                                               |
| due_date                          | Required. The date that a Merchant would like a QuickInvoice to be paid by. This field is used in comparisons for the notification_*_due_date fields.                                                                                                                                                                                                                                 |
| send_email                        | Optional. Possible values: `0` \| `1` If set to `1`, a QuickInvoice Notification email will be sent immediately upon creation (POST).                                                                                                                                                                                                                                                       |
 

## Expands (Related Records)
For detail on how to use Expands on an Endpoint, please visit the Expands (Related Records) page.

| Related Record         | Filter Name            |
|------------------------|------------------------|
| Contact                | contact                |
| Email Blacklist        | email_blacklist        |
| Files                  | files                  |
| Location               | location               |
| Tags                   | tags                   |
| User                   | created_user           |
| Quick Invoice Settings | quick_invoice_settings |
| Quick Invoice Views    | quick_invoice_views    |
 

An example of “expanding” this endpoint to one of the above related records would look like this:

`GET /v2/quickinvoices/xxxxxxxxxxxxxxxxxxxxxxxx?expand=contact`

To use multiple expands on this endpoint, simply include them both separated by a comma like so:

`GET /v2/quickinvoices/xxxxxxxxxxxxxxxxxxxxxxxx?expand=created_user,contact`

## File Attachments
It can be useful to attach files to a Quick Invoice for many different business models, but before getting started there are some items to consider.

FILE STORAGE SERVICE
In order to use file attachments with Quick Invoices, the File Storage Service must be enabled for the Location in which the Quick Invoice is being created. 

You can use the following request to enable the service:

`POST /v2/productfiles`

```json
{
    "productfile": {
        "title": "Productfile",
        "product_file_credential_id": "{storage_credentials_id}",
        "location_id": "{location_id}}"
    }
}
```

RESTRICTIONS
1. A Quick Invoice can have a maximum of 4 file attachments.
2. Each file attachment can be a maximum of 5MB in size.
CONSIDERATIONS
1. When provided, file attachments are always made available on the public facing QuickInvoice payment page where the recipient would be take to when clicking the link.
2. By default, file attachments are NOT included in any of the QuickInvoice Notification emails.  If you want the file attachments to be included then you will need to make sure that quickinvoice.attach_files_to_email is set to 1.  This can be done in the Create request or an Update later (would need to make Resend request after Update).
3. Some of the API interactions needed to manage files for QuickInvoices will require the using multipart/form-data encoding instead of JSON.

### Attach File
The following example demonstrates how to attach a file to an existing QuickInvoice. If you are interested in uploading files at the same time you are creating the QuickInvoice, take a look at our documentation above for Including File Attachments.

`POST /v2/quickinvoices/{id}/files`

PHP:
```php
<?php
$client = new http\Client;
$request = new http\Client\Request;

$body = new http\Message\Body;
$body->addForm(NULL, [
  [
    'name' => 'file[file]',
    'type' => null,
    'file' => '{source_file_path}',
    'data' => null
  ]
]);

$request->setRequestUrl('https://{domain}/v2/quickinvoices/{id}/files');
$request->setRequestMethod('POST');
$request->setBody($body);

$request->setHeaders([
  'Content-Type' => 'multipart/form-data',
  'developer-id' => '{developer_id}',
  'user-api-key' => '{user_api_key}',
  'user-id' => '{user_id}'
]);

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();
```

NodeJS:
```javascript
var fs = require("fs");
var request = require("request");

var options = { 
  method: 'POST',
  url: 'https://{domain}/v2/quickinvoices/{id}/files',
  headers: { 
    'Content-Type': 'multipart/form-data',
    'developer-id': '{developer_id}',
    'user-api-key': '{user_api_key}',
    'user-id': '{user_id}',
    'content-type': 'multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW'
  },
  formData: { 
    'file[file]': {
      value: 'fs.createReadStream("File {source_file_path}")',
      options: { filename: 'File {source_file_path}', contentType: null }
    }
  }
};

request(options, function (error, response, body) {
  if (error) throw new Error(error);

  console.log(body);
});
```

cURL:
```cURL
curl -X POST \
  'https://{domain}/v2/quickinvoices/{id}/files' \
  -H 'Content-Type: multipart/form-data' \
  -H 'content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW' \
  -H 'developer-id: {developer_id}' \
  -H 'user-api-key: {user_api_key}' \
  -H 'user-id: {user_id}' \
  -F 'file[file]=@File {source_file_path}'
```

### Remove File
`DELETE /v2/quickinvoices/{id}/files/{file_id}`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

Response
```json
No JSON Response.  HTTP Response Code Only.

204 - Success, file was removed from the QuickInvoice.
404 - Fail, QuickInvoice file attachment was not found.
```
