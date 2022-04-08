

# AccountForm Integrations
## Overview
Here you can learn how to create Account Vaults using our AccountForm widget, which will keep you out of scope for PCI as the form code is being generated and hosted by us, another key part of staying out of scope for PCI Compliance.

The AccountForm widget will allow you to add accountholder data to the AccountVaults Endpoint. 

Whether you are attempting to use PayForm or AccountForm, the process for generating either form is very similar.

1. Prepare a data variable as a JSON string.
2. Hex the data variable and use with `hash-key`, `developer-id`, `user-id`, and `timestamp`, to create the URL to retrieve the form.
3. The URL can be used as an iframe source to embed within another application, or can be accessed directly. 
   - The URL will return an HTML form with the necessary fields to gather the appropriate information.
     - Note: The client software from the ISV will be either an installed application or a website loading an iFrame/vault form.
4. The user will then complete and submit the form back to the server for processing.
5. Depending on additional parameters that the developer can supply, the iframe may close the window it appears in automatically or redirect to another URL.

### Important Security Note
When utilizing a widget-style hosted payment form such as AccountForm, Paya recommends enabling security factoring of some kind to prevent malicious activity.  While the below-listed methods are not an exhaustive list, they are the most common: 

* Require login access (username/password)
* Utilize CAPTCHA/reCAPTCHA
* Tokenize URL that hosts access to the hosted form
* Utilize IP Address velocity detection

## 1. Preparing data for the request
Below you will see examples of a data JSON object for AccountForm.  These requests are for demonstrative purposes only and there are additional fields that can be provided that are outlined below.
```json
{
    "accountvault": {
        // Required fields
        "payment_method": "{cc or ach}", 
        "location_id": "1111111111111111111111111",
        "account_vault_api_id": "1111111111111111111111111",
        // Optional fields for accountvaults endpoint 
        "contact_id": "1111111111111111111111111",
        "title": "Account_vault",
        "account_holder_name": "john smith",
        // Optional Fields used to control iframe behavior
        "show_account_holder_name": true,
        "show_street": true,
        "show_zip": true,
        "stylesheet_url": "{full URL - i.e. https://third.party.domain/css/styles.css}",
        // Optional Fields used to control iframe after completion
        "display_close_button": true,
        "parent_close": true,
        "parent_close_delay": 3,
        "parent_origin": null,
        "redirect_url_on_approval": "https://www.google.com",
        "redirect_url_delay": 10
    }
}
```
### Optional Fields
Any field from the AccountVaults Endpoint can be passed in the JSON above for use with the vault record that will be created when the AccountForm is submitted.

In addition to the fields that can be supplied in the AccountVaults Endpoint, the following can be supplied to control the final outcome of the AccountForm:

| Field Name | Type | Max Length | Description |
| --- | --- | --- | --- |
| parent_close | boolean | | If set as true, it will close the payment form after transaction is made. |
| parent_close_delay	| integer	| |	defaults to 10 sec, only if parent_close=true. Can be sent in the data with different delay timing. |
| display_close_button |	boolean	 | | By default this field is set to true. If you don’t want to display the “close” button, submit it as false in the data. |
| entry_method	| string | 8 | The option to send for method of processing transaction. This field is optional, but if supplied must be one of "manual", "terminal", or "both". |
| show_title |	boolean | | 	By default is set to true, can be set to false in data for not displaying “title” in AccountForm. |
| show_account_holder_name |	boolean | |	true/false or 1/0	By default it is true, can be set to false in data for not displaying “Account Holder Name” in Account Storage Form widget.|
| show_street |	boolean | |	true/false or 1/0	This field is set to true if product transaction has vt_show_street set to true. |
| show_zip |	boolean | |	true/false or 1/0	This field is set to true if product transaction has vt_show_zip set to true. |
| stylesheet_url |	string |	256 |	API loads the default one, can be overridden with the file that is sent in the data. Should be full url, ie. https://example.com/stylsheet.css |
| redirect_url_on_approval | string |	256 |	The page a user will get redirected to upon successful storage of Account Vault. |
| parent_send_message |	boolean | |	true/false or 1/0	When set to 1or true, this will allow for the JSON response from the form submission to be posted back to the parent window containing the iframe. For more info see Using postMessage. |

### Overriding the Styles for AccountForm
Within the optional fields described above you will notice there is a `stylesheet_url`.  This field can be used to include your own stylesheet to override the default styles already included on the page.  You can use the following link to download the latest default CSS for AccountForm as a starting point for your custom stylesheet:
https://api.payaconnect.com/css/accountform.css

Once you have prepared your custom CSS and made it available on a public URL you can include it in your AccountForm request as illustrated below:
```json
{
    "accountvault": {
        // Required fields
        "payment_method": "{cc or ach}", 
        "location_id": "1111111111111111111111111",
        "account_vault_api_id": "1111111111111111111111111",
        // Optional Fields used to control iframe behavior
        "stylesheet_url": "{full URL - i.e. https://third.party.domain/css/styles.css}",
        [...] // Other optional fields
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
// In this example, data is for a vault request
$data = implode(unpack("H*", '{"accountvault":{...}}'));

// [3] Build the URL to retreive the form
$domain = "https://api.sandbox.payaconnect.com";
$endpoint = "accountform"; // could also be "payform"
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
        "accountvault": {
            "payment_method": "cc",
            "location_id": "{location_id}",
            "account_vault_api_id": "{account_vault_api_id}",
            "...": ""
        }
    }
};

// [1] Generate the secure hash
params['hash-key'] = CryptoJS.HmacSHA256(params['user-id'] + params['timestamp'], "{my_user_hash_key}");

// [2] Convert the data to hex
params['data'] = asctohex(JSON.stringify(params['data']));

// [3] Build the URL to retreive the form
var url = "https://api.sandbox.payaconnect.com/v2/accountform?";// could also be "payform"
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
https://api.sandbox.payaconnect.com/v2/accountform?developer-id=b1111111&hash-key=c7fbcad5d892de8d16d94545216cb29c0951b8ae4eec35af7e7674cd25454c01f&user-id=11e7e1b2531a187a87647ed8&timestamp=1513362490&data=7b227472616e73616374696f6e22...
```
If you embed that iframe or attempt to access the URL directly, you should see something similar to the following:

![AccountForm Image](https://docs.payaconnect.com/download_file/53/0)

## 4. User completes and submits the form
When the user submits this form, the form data will then be submitted back to the API for processing through the AccountVaults Endpoint.

## 5. Process is complete
Once the process is complete, the iframe may either automatically close the window it appears in or the user may be redirected to a different URL.  There are 3 methods to obtain the response data from the vault request.
1. The simplest method is to assign an `account_vault_api_id` to the request within the request JSON then use a GET request against the AccountVaults Endpoint to obtain the data from the Account Vault record.

   **Example:**
   ```
   GET https://api.sandbox.payaconnect.com/v2/accountvaults?account_vault_api_id=[Account Vault API ID]
   ```
2. Next, would be to setup a listener and use our [Postback](https://docs.payaconnect.com/developers/api/post-backs) service to obtain realtime results POSTed to your server.
3. Finally, there is the option of Post Message allowing the transaction data that is sent back to be passed to the parent page. With changes to iframe permissions in most recent browser releases this method is not recommended as we cannot guarantee consistent results.

### If you have any question please reach out to our team.
* Full Documentation: https://docs.payaconnect.com/developers
* Integration Support Team: sdksupport@paya.com
