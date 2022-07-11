

# PayForm Integrations
## Overview
Here you can learn how to create Account Vaults and Transactions using our AccountForm and PayForm widgets, which will keep you out of scope for PCI as the form code is being generated and hosted by us, another key part of staying out of scope for PCI Compliance.

The PayForm widget can be used for running *sale*, *debit (ACH)*, *authonly*, *avsonly*, or *refund (non-referenced)*, transactions. Any *void*, *authincrement*, or *authcomplete*, transactions are done as PUT transactions using the id returned from the `/v2/payform` endpoint. PUT transactions do not require `account_number` and `exp_date` fields to be submitted, therefore need to be done on the `/v2/transactions` endpoint. 

Whether you are attempting to use Payform or Accountform, the process for generating either form is very similar.

1. Prepare a data variable as a JSON string.
2. Hex the data variable and use with `hash-key`, `developer-id`, `user-id`, and `timestamp`, to create the URL to retrieve the form.
3. The URL can be used as an iframe source to embed within another application, or can be accessed directly. 
   - The URL will return an HTML form with the necessary fields to gather the appropriate information.
     - Note: The client software from the ISV will be either an installed application or a website loading an iFrame/payment form.
4. The user will then complete and submit the form back to the server for processing.
5. Depending on additional parameters that the developer can supply, the iframe may close the window it appears in automatically or redirect to another URL.

### Important Security Note
When utilizing a widget-style hosted payment form such as PayForm, Paya recommends enabling security factoring of some kind to prevent malicious activity.  While the below-listed methods are not an exhaustive list, they are the most common: 

* Require login access (username/password)
* Utilize CAPTCHA/reCAPTCHA
* Tokenize URL that hosts access to the hosted form
* Utilize IP Address velocity detection

## 1. Preparing data for the request
Below you will see examples of a data JSON object for PayForm.  These requests are for demonstrative purposes only and there are additional fields that can be provided that are outlined below.
```json
{
    "transaction":{
        // Required fields
        "payment_method": "{cc or ach}",
        "action": "sale",
        "transaction_amount": "13.00",
        // Optional fields for the transactions endpoint
        "location_id": "1111111111111111111111111",
        "transaction_api_id": "111111111111111111111111",
        "billing_street": "43155 novi",
        "billing_zip": "12342",
        "tip_amount": "12",
        "subtotal_amount": "13.00", // Required if surcharge_amount is included
        "surcharge_amount": "0",
        "product_transaction_id": "1111111111111111",
        "order_num": "1234567890",
        "contact_id": "222222222222222",
        // Optional field for controling iframe behavior
        "stylesheet_url": "{full URL - i.e. https://third.party.domain/css/styles.css}",
        "parent_close": 0,
        "parent_close_delay": 0,
        "display_close_button": false
    }
}
```
### Important
If you are using `"payment_method": "ach"`, you must provide a `product_transaction_id` for a Service that supports ACH transactions.

### Optional Fields
Any field from the Transactions Endpoint can be passed in the JSON above for use with the transaction that will be created when the PayForm is submitted.  For example, `"save_account": 1` can be added so that an Account Vault is created with the payment information provided for the transaction. 

In addition to the fields that can be supplied in the Transactions Endpoint, the following can be supplied to control the final outcome of the PayForm:

| Field Name | Type | Max Length | Description |
| --- | --- | --- | --- |
| parent_close | boolean | | If set as true, it will close the payment form after transaction is made. |
| parent_close_delay	| integer	| |	defaults to 10 sec, only if parent_close=true. Can be sent in the data with different delay timing. |
| display_close_button |	boolean	 | | By default this field is set to true. If you don’t want to display the “close” button, submit it as false in the data. |
| entry_method	| string | 8 | The option to send for method of processing transaction. This field is optional, but if supplied must be one of "manual", "terminal", or "both". |
| show_account_holder_name |	boolean | |	true/false or 1/0	By default it is true, can be set to false in data for not displaying “Account Holder Name” in Account Storage Form widget.|
| show_street |	boolean | |	true/false or 1/0	This field is set to true if product transaction has vt_show_street set to true. |
| show_zip |	boolean | |	true/false or 1/0	This field is set to true if product transaction has vt_show_zip set to true. |
| require_street |	boolean | |	true/false or 1/0	This field is set to true if product transaction has vt_require_street set to true. |
| require_zip |	boolean | |	true/false or 1/0	This field is set to true if product transaction has vt_require_zip set to true. |
| show_cvv |	boolean | |	true/false or 1/0	By default it is true, can be set it to false in the data. |
| stylesheet_url |	string |	256 |	API loads the default one, can be overridden with the file that is sent in the data. Should be full url, ie. https://example.com/stylsheet.css |
| parent_send_message |	boolean | |	true/false or 1/0	When set to 1or true, this will allow for the JSON response from the form submission to be posted back to the parent window containing the iframe. For more info see Using postMessage. |
| redirect_url_on_approve |  string |     256    | The page a user will get redirected to upon approval of transaction.                                                                                                             |
| redirect_url_on_decline |  string |     256    | The page a user will get redirected to upon decline of transaction.                                                                                                              |

### Overriding the Styles for PayForm
WIthin the optional fields described above you will notice there is a `stylesheet_url`.  This field can be used to include your own stylesheet to override the default styles already included on the page.  You can use the following link to download the latest default CSS for PayForm as a starting point for your custom stylesheet:
https://api.payaconnect.com/css/payform.css

Once you have prepared your custom CSS and made it available on a public URL you can include it in your PayForm request as illustrated below:
```json
{
    "transaction":{
        // Required fields
        "payment_method": "{cc or ach}",
        "action": "sale",
        "transaction_amount": "13.00",
        // Optional field for controling iframe behavior
        "stylesheet_url": "{full URL - i.e. https://third.party.domain/css/styles.css}",
        [...] // Other Optional Fields
    }
}
```

## 2. Build the URL to retrieve the form
In the following code example you will see the steps necessary to generate the URL that can be used for retrieving the desired form.
1. Generate the secure hash.
2. Convert the data to hex.
3. Build the URL to retrieve the form.

**PHP Example:**
```php
<?php
// [1] Generate the secure hash
$user_hash_key = 'my_user_hash_key'; // secret hash key used for hashing the variables
$user_id = 'my_user_id'; //  variables for generating the required hash
$timestamp = time(); // variables for generating the required hash
$salt = $user_id . $timestamp; //$user_id and $timestamp need to be in this order
$hash_key = hash_hmac('sha256', $salt, $user_hash_key);

// [2] Convert the data to hex
// In this example, data is for a transaction
$data = implode(unpack("H*", '{"transaction":{...}}'));

// [3] Build the URL to retreive the form
$domain = "https://api.sandbox.payaconnect.com";
$endpoint = "payform"; // could also be "accountform"
$url = sprintf("%s/v2/%s?developer-id=%s&hash-key=%s&user-id=%s&timestamp=%s&data=%s",
    $domain,
    $endpoint,
    $developer_id,
    $hash_key,
    $user_id,
    $timestamp,
    $data
);
```

**JavaScript Example:**
```JavaScript
// Function needed to convert string to hex
function asctohex(asc) {
  var hex = '';
  for (var i = 0; i < asc.length; i++) {
    hex += ('0' + asc.charCodeAt(i).toString(16)).slice(-2);
  }
  return hex;
}

// JS Object holding all of the required parameters
var params = {
    "developer-id": "{api_developer_id}",
    "hash-key": "",
    "user-id": "{my_user_id}",
    "timestamp": Math.floor((Math.floor(Date.now()) - (1*60000))/1000),
    "data": {
        "transaction": {
            "payment_method": "cc",
            "action": "sale",
            "transaction_amount": "12.00",
            "location_id": "{location_id}",
            "transaction_api_id": "{transaction_api_id}",
            "show_cvv": "1",
            "tax": "3"
        }
    }
};

// [1] Generate the secure hash
params['hash-key'] = CryptoJS.HmacSHA256(params['user-id'] + params['timestamp'], "{my_user_hash_key}");

// [2] Convert the data to hex
params['data'] = asctohex(JSON.stringify(params['data']));

// [3] Build the URL to retreive the form
var url = "https://api.sandbox.payaconnect.com/v2/payform?";// could also be "accountform"
Object.keys(params).forEach(function (key) {
    url += key + '=' + params[key] + '&';
});
```

### Required Parameters
There are 5 required parameters for making the request. The following table describes those parameters as well as where they can be passed:

| Parameter | Header | URL | Description |
| --- | --- | --- | --- |
| user-id |	✔ |	✔ |	The user-id |
| timestamp |	✔	| ✔	| The current time when the page has been generated. It has an expiry period of 5 minutes. |
| hash-key |	✔ |	✔ |	This is the hash key provided by the API that is used to generate the signature hash. This key is secret and should not be shared with anyone. |
| developer-id |	✔ |	✔ |	The developer-id is something that should be hard coded into your software. This is only for you to use and should be embedded in your software so that you shouldn't have to openly provide it to merchants/customers. |
| data	| |	✔	| This should be hexed to prevent users from altering the data that is intended to be transmitted. |

### HMAC Authentication
The user-id and timestamp which are passed in the request to the API, will generate another HMAC using user’s user_hash_key. This will check against what was submitted in the hash-key parameter. If they don’t match, you will see a validation message as “Hash key is invalid”

There are 3 parameters that are required to generate a signature hash.
* User ID: Provided when a User is setup
* Timestamp: The current time when the page has been generated. it has an expire period of 5 minutes
* User Hash Key: This is the users hash key provided that is used to generate the signature hash. This key is secret and should not be shared with anyone.

The hash is generated using the user id and timestamp, in that specific order. The generated HMAC will be good for 15 minutes.

## 3. Using the URL to retrieve the form
After following the steps outlined above, you should have a URL that can be used to embed the form into another website or application.  That URL should look similar to the following:

```
https://api.sandbox.payaconnect.com/v2/payform?developer-id=b1111111&hash-key=c7fbcad5d892de8d16d94545216cb29c0951b8ae4eec35af7e7674cd25454c01f&user-id=11e7e1b2531a187a87647ed8&timestamp=1513362490&data=7b227472616e73616374696f6e22...
```
If you embed that iframe or attempt to access the URL directly, you should see something similar to the following:

![PayForm Image](https://docs.payaconnect.com/application/files/1415/3330/9807/payform_when_location_has_no_terminal.png)

## 4. User completes and submits the form
When the user submits this form, the form data will then be submitted back to the API for processing through the Transactions Endpoint.

## 5. Process is complete
Once the process is complete, the iframe may either automatically close the window it appears in or the user may be redirected to a different URL.  There are 3 methods to obtain the response data from the transaction request.
1. The simplest method is to assign a `transaction_api_id` to the transaction within the request JSON then use a GET request against the Transactions Endpoint to obtain the data from the transaction record.

   **Example:**
   ```
   GET https://api.sandbox.payaconnect.com/v2/transactions?transaction_api_id=[Transaction API ID]
   ```
2. Next, would be to setup a listener and use our [Postback](https://docs.payaconnect.com/developers/api/post-backs) service to obtain realtime results POSTed to your server.
3. Finally, there is the option of Post Message allowing the transaction data that is sent back to be passed to the parent page. With changes to iframe permissions in most recent browser releases this method is not recommended as we cannot guarantee consistent results.

### If you have any question please reach out to our team.
* Full Documentation: https://docs.payaconnect.com/developers
* Integration Support Team: sdksupport@paya.com
