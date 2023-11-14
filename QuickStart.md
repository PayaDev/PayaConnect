# Quick Start Guide
The purpose of this document is to detail the steps necessary to understand how to develop a proper integration to our API. This document should answer many of the basic questions around how our API operates and how to get integrated quickly and easily.

## [Developer Portal Access](https://developer.sandbox.payaconnect.com/)
Have you requested Developer Portal access yet? [Click here](https://developer.sandbox.payaconnect.com/) to fill out the Developer Portal application to request access.

## Getting Started
Before digging into the API endpoints, there are a few pieces of information that are needed in order to help understand the docs and make the integration more successful.

If you are not familiar with REST API's and you will be doing a direct integration as described in the next section, please be sure to read the details in the API Overview. The API Overview section not only explains some of the basics about API's in general, but also provides more detail about how our API works. Understanding this section will be critical in completing a robust integration.

### Integrator Primary Key Support (*_api_id)
The platform (in most endpoints) has a field with the suffix "api_id" which is forced unique per Location in the platform and is meant as a way to support the system that is integrating to the payment platform. An example of the typical use case is that when a Contact is created the integrator inputs their identifier for the contact in the contact_api_id field.  When this is done and a transaction is run, the integrated system can then reference their own ID when importing the transaction.  The integrating system does not need to modify their database schema to create a field to store our ID.

The other way we utilize this field is by creating a reference to a transaction that the integrated system may not know the ID when initiating the transaction (such as [PayForm](https://github.com/PayaDev/PayaConnect/tree/master/PayForm)), therefore we force the use of transaction_api_id.

### Identifiers and Keys
There are a variety of identifiers and keys used within the platform, here is a short list of what they are called and how they are used.

* Development Company - These are setup at the integration company level, if you are the merchant then you would receive this too.
* Location - This would be setup at the merchant's corporate level, typically there is only one for most small merchants, however larger merchants can have an unlimited number.  In more complex situations this can be setup using a hierarchy to provide access.
* User - These are user settings and are important as we have audit logs that track actions/changes within the system.  Users are also assigned "roles" for permissions to do certain items, for example a user can be restricted to not allow them to do a void or refund.

| **Intended for**    | **Name**                 | **Purpose**                                                                                                                                                                                                                                                                                                                             |
|---------------------|--------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Development Company | developer_id             | This is used to identify the developer that is making the request in our logs.                                                                                                                                                                                                                                                          |
| Development Company | developer_encryption_key | This is used when implementing SSO (Single Sign-On) integration method.                                                                                                                                                                                                                                                                 |
| Location            | location_id              | This is typically a single merchant, however a user can belong to multiple.                                                                                                                                                                                                                                                             |
| Location            | ticket_hash_key          | This is used when implementing the Hosted Payment Page (HPP) integration method.                                                                                                                                                                                                                                                        |
| Location            | product_transaction_id   | This is equivelant to a merchant account (Deposit account), a location can have multiple configured for use.  When integrating and your customers may have multiple merchant accounts this product_transaction_id should be passed when running a transaction otherwise the system will default to what is configured for the location. |
| User                | user_api_key             | This is like a password and should be protected and not shared with anyone.                                                                                                                                                                                                                                                             |
| User                | user_hash_key            | This is used when implementing PayForm & AccountForm or HMAC Authorization Process                                                                                                                                                                                                                                                      |
| User                | user_id                  | Every user is assigned an id.                                                                                                                                                                                                                                                                                                           |

### Integration Methods
One main thing that needs to be determined is the integration method that will be used. This will dictate the method of authentication, and how much coding will need to be done. There are currently 3 main ways to integrate to the API, and each of these methods are listed below.

* [DIRECT INTEGRATION](https://github.com/PayaDev/PayaConnect/tree/master/Endpoints)
  * Most common industries: **Retail**, **Lodging**, **Restaurant**
  * This method is usually used in any of the following scenarios:
    * Running transactions through an EMV terminal (to remain out of scope for PCI DSS).
    * Creating contacts, account vaults, recurrings, etc.
    * Directly connecting to the API to run transactions or download data.
    * Most situations where requests will be made server to server using the integrated software.
    * Software vendors wish to remain out of scope for PCI by running transactions through an EMV terminal.
* [ACCOUNTFORM](https://github.com/PayaDev/PayaConnect/tree/master/AccountForm) / [PAYFORM](https://github.com/PayaDev/PayaConnect/tree/master/PayForm)
  * Most common industries: **Retail**, **MOTO**, **Lodging**, **Restaurant**
  * This method is usually used in the following scenarios:
    * POS software that incorporates payments
    * Internal web sites where users authenticate internally and accept payment
  * This method should not be used for external payments. For external payments the Hosted Payment Page method should be used.
* [HOSTED PAYMENT PAGE](https://github.com/PayaDev/PayaConnect/tree/master/HostedPaymentPage)
  * Most common industries: **E-commerce**
  * This method is usually used in the following scenarios:
    * Donation pages
    * Anonymous payment pages
    * Shopping carts and other online purchases
    * Other external payment accepting pages
* [SINGLE SIGN ON](https://github.com/PayaDev/PayaConnect/tree/master/SSO/)
  * Most common industries: **Retail**, **MOTO**
  * This method is usually used in the following scenario:
    * Where users will be using our pre-built user interface to run their transactions.

If done correctly, each of the above methods will allow you to limit your scope of PCI by not accepting, transmitting, or storing cardholder data.

### Certification
Once the implementation is complete, we have a brief certification process:

* **HOSTED SOLUTIONS (HOSTED PAYMENT PAGE, ACCOUNTFORM, PAYFORM)**
Reach out to us at sdksupport@nuvei.com to schedule your certification call. During the call we’ll make sure transaction data is passing correctly and properly formatted.
* **NON-HOSTED SOLUTION (DIRECT INTEGRATION)**
Email sdksupport@nuvei.com a copy of your PCI/PA-DSS certificate from an [Approved Scanning Vendor (ASV)](https://www.pcisecuritystandards.org/assessors_and_solutions/approved_scanning_vendors). Once we review your certificate we’ll provide a link to setup your certification call. During the call we’ll make sure transaction data is passing correctly and properly formatted.

Note: *Using tokenized transaction data or EMV/P2PE devices may alter PCI scope for Non-Hosted Solutions.*

## Direct Integration Method
The direct integration method might be as little as one API call, or as many as one hundred calls depending on your integration needs. For example, in order to run a transaction using an EMV capable terminal, this is simply one API call.

### Authentication
In order to authenticate an API request, there needs to be authentication data sent along with the request. Authentication data consists of the three following pieces of information:

* user-id (usually provided on a per user/merchant basis)
* user-api-key (usually provided on a per user/merchant basis)
* developer-id (will be hard coded in your software)
The user-id and user-api-key will be specific to each merchant account (location) that is connecting to the gateway. The developer-id is something that should be hard coded into your software. This is only for you to use and should be embedded in your software so that you shouldn't have to openly provide it to merchants/customers.

There will be two different environments for code, one for sandbox and one for production. Each environment will have their own URL and developer-id for submitting requests. The below code represents how you might setup your environment variables for submitting requests.

### Code Examples
C#
```C#
// Define everything initially as sandbox environment
bool isProduction = false;
var url = "https://api.sandbox.payaconnect.com";
var developer_id = "12345678";

// If it is production, update the variables
if (isProduction)
{
	url = "https://api.payaconnect.com";
	developer_id = "87654321";
}

// Setup url scheme
var router_transaction_endpoint = url + "/v2/routertransactions";
var transaction_endpoint = url + "/v2/transactions";
var contact_endpoint = url + '/v2/contacts';
```
Node
```JavaScript
// Define everything initially as sandbox environment
var isProduction = false;
var url = "https://api.sandbox.payaconnect.com";
var developer_id = "12345678";

// If it is production, update the variables
if (isProduction) {
	url = "https://api.payaconnect.com";
	developer_id = "87654321";
}

// Setup url scheme
var router_transaction_endpoint = url + "/v2/routertransactions";
var transaction_endpoint = url + "/v2/transactions";
var contact_endpoint = url + '/v2/contacts';
```
Ruby
```ruby
#!/usr/bin/ruby

# Define everything initially as sandbox environment
isProduction = false;
url = "https://api.sandbox.payaconnect.com";
developer_id = "12345678";

# If it is production, update the variables
if isProduction
	url = "https://api.payaconnect.com"
	developer_id = "87654321"
end

# Setup url scheme
router_transaction_endpoint = url + "/v2/routertransactions";
transaction_endpoint = url + "/v2/transactions";
contact_endpoint = url + '/v2/contacts';
```

### Sending Requests
Once you have established the basic variable setup for your environment, you should be able to send API requests. The following code demonstrates how to POST a request to the RouterTransactions Endpoint in order to initiate a Cloud EMV terminal via the terminal_id. In order to create a request, you will need the location_id, as well as the necessary credentials to authenticate the request. In addition, you will need to specify that you are sending a JSON formatted payload.

### Code Examples
C#
```C#
// Define everything initially as sandbox environment
bool isProduction = false;
var url = "https://api.sandbox.payaconnect.com";
var developer_id = "12345678";

// If it is production, update the variables
if (isProduction)
{
	url = "https://api.payaconnect.com";
	developer_id = "87654321";
}

// Setup url scheme
var router_transaction_endpoint = url + "/v2/routertransactions";
var transaction_endpoint = url + "/v2/transactions";
var contact_endpoint = url + '/v2/contacts';

NameValueCollection params = new NameValueCollection()
{
	{ "user_id", "xxxx" }, // This is the user-id (stored in the database) for this location
	{ "user_api_key", "yyyy" }, // This is the user-api-key (stored in the database) for this location
	{ "location_id", "zzzz" } // This is the location_id (stored in the database) for this location
};

var client = new RestClient(router_transaction_endpoint);
var request = new RestRequest(Method.POST);
request.AddHeader("Cache-Control", "no-cache");
request.AddHeader("developer-id", developer_id);
request.AddHeader("Content-Type", "application/json");
request.AddHeader("user-api-key", params["user_api_key"]);
request.AddHeader("user-id", params["user_id"]);
request.AddParameter("undefined", "{\n  \"routertransaction\": {\n    \"action\":\"sale"\",\n    \"payment_method\":\"cc"\",\n    \"location_id\":\"" + params["location_id"] + ""\",\n    \"terminal_id\":\"1111\",\n    \"transaction_amount\":\"1.00\"\n  }\n}", ParameterType.RequestBody);
IRestResponse response = client.Execute(request);
```
Node
```JavaScript
var request = require("request");

// Define everything initially as sandbox environment
var isProduction = false;
var url = "https://api.sandbox.payaconnect.com"; // This will be the sandbox server url
var developer_id = "12345678"; // This will be your given sandbox developer id

// If it is production, update the variables
if (isProduction) {
	url = "https://api.payaconnect.com"; // This will be the production server url
	developer_id = "87654321"; // This will be your given production developer id
}

// Setup url scheme
var router_transaction_endpoint = url + "/v2/routertransactions";
var transaction_endpoint = url + "/v2/transactions";
var contact_endpoint = url + '/v2/contacts';

// Stored variable for this merchant/location_id
var params = {
	user_id = 'xxxx', // This is the user-id (stored in the database) for this location
	user_api_key: 'yyyy', // This is the user-api-key (stored in the database) for this location
	location_id: 'zzzz' // This is the location_id (stored in the database) for this location
	terminal_id: '1111' // This is the terminal_id (stored in the database) for this location
};

// Setup options for request
var options = {
	method: 'POST',
	url: router_transaction_endpoint,
	headers: {
		'Cache-Control': 'no-cache',
		'developer-id': developer_id,
		'Content-Type': 'application/json',
		'user-id': params.user_id,
		'user-api-key': params.user_api_key
	},
	body: {
		routertransaction: {
			action: 'sale',
			payment_method: 'cc',
			location_id: params.location_id,
			terminal_id: params.terminal_id,
			transaction_amount: 1.00
		}
	},
	json: true
};

// Send request to API
request(options, function (error, response, body) {
	if (error) throw new Error(error);

	console.log(body);
});
```
Shell
```Shell
curl -X POST \
https://terminalrouter.payaconnect.com/v2/routertransactions \
-H 'Cache-Control: no-cache' \
-H 'Content-Type: application/json' \
-H 'developer-id: dev-id' \
-H 'user-api-key: 111111111111' \
-H 'user-id: 222222222222' \
-d '{
	"routertransaction": {
		"action": "sale",
		"payment_method": "cc",
		"location_id": "location_id",
		"terminal_id":"terminal_id",
		"transaction_amount":"1.00"
	}
}'
```
Ruby
```Ruby
require 'url'
require 'net/http'

# Define everything initially as sandbox environment
isProduction = false;
url = "https://api.sandbox.payaconnect.com";
developer_id = "12345678";

# If it is production, update the variables
if isProduction
	url = "https://api.payaconnect.com"
	developer_id = "87654321"
end

# Setup url scheme
router_transaction_endpoint = url + "/v2/routertransactions";
transaction_endpoint = url + "/v2/transactions";
contact_endpoint = url + '/v2/contacts';

params = {
	"user_id" => "xxxx",
	"user_api_key" => "yyyy",
	"location_id" => "zzzz",
	"terminal_id" => "1111"
}

http = Net::HTTP.new(router_transaction_endpoint, 443)

request = Net::HTTP::Post.new(params.url)
request["user-id"] = params.user_id
request["user-api-key"] = params.user_api_key
request["Content-Type"] = 'application/json'
request["developer-id"] = developer_id
request["Cache-Control"] = 'no-cache'
request.body = "{\n  \"routertransaction\": {\n    \"action\": \"sale\",\n    \"payment_method\": \"cc\",\n    \"location_id\": \"" + params.location_id + ""\",\n    \"terminal_id\":\"" + params.terminal_id + "\",\n    \"transaction_amount\":\"1.00\"\n  }\n}"

response = http.request(request)
puts response.read_body
```
### Useful Tip:
There is an optional field called transaction_api_id. Most endpoints have an *api_id field. These fields can be used for you to create and store your own IDs so that you don't have to use ours. For example, If you would like to create a transaction and not worry about storing the returned id, you can send your own transaction_api_id. Then when you need to reference this transaction record in the future, you can use transaction_api_id in requests instead of the Paya-generated transaction_id.

Now that you are familiar with how to send requests, you can visit the API Reference to see all of the different endpoints and required parameters. The API Reference can be found [here](https://github.com/PayaDev/PayaConnect/tree/master/Endpoints).


## Hosted Integration Methods

### [AccountForm](https://github.com/PayaDev/PayaConnect/tree/master/AccountForm) / [PayForm](https://github.com/PayaDev/PayaConnect/tree/master/PayForm)
This section explains how to create Account Vaults and Transactions using a widget with no previous data stored needed. All the data will come from the widget and shall keep you out of scope for PCI as the form code is being generated by us, another key part of staying out of scope for PCI Compliance.

This PayForm endpoint should be used for running new Transactions for sale, authonly, or refund transactions. Any void, authincrement, or authcomplete transactions are done as PUT transactions using the id returned from this endpoint. PUT transactions do not require account_number and exp_date fields to be submitted, therefore need to be done on the transactions endpoint.

For more information on how to use AccountForm or PayForm, visit the [AccountForm](https://github.com/PayaDev/PayaConnect/tree/master/AccountForm) / [PayForm](https://github.com/PayaDev/PayaConnect/tree/master/PayForm) Integrations page.

### [Hosted Payment Page(HPP)](https://github.com/PayaDev/PayaConnect/tree/master/HostedPaymentPage) 
This section describes how to accept payments using hosted payment pages in order to keep your servers out of scope for PCI. The payment form will be created in an iFrame or new page that will be loaded from our API. The page will then be submitted and the user can be redirected back to your hosted page.

#### BASIC SETUP
Here is an overview of the steps involved in getting the hosted payment page setup. These are basic steps to create a static payment page for accepting payments.

* Log in to the User Interface.
* Navigate to the Location settings and then click on Hosted Payment Page.
* This section will allow you to add a Hosted Payment Page setup for your desired payment service.
* Select the template you wish to use and then click “Create Hosted Payment Page”
* Customize the new Hosted Payment Page to meet your needs.
* Click the “save” button in the upper right hand corner.
* Click the “use” button in the upper right hand corner.
* Copy the button text to your web site and place it where you would like someone to be able to make a payment.

The base setup will work for situations that require static content. It the transaction amount is fixed, the above for will work nicely. The above setup will also work well for a donation type Hosted Payment Page where the end customer will be able to supply there own dollar amount.

If your Hosted Payment Page requires a different transaction amount for each payment, and the end customer is not allowed to alter the transaction amount, then you will need to use a slightly more advanced setup. This method is detailed further under the [Hosted Payment Page](https://github.com/PayaDev/PayaConnect/tree/master/HostedPaymentPage) documentation.

## [Single Sign On](https://github.com/PayaDev/PayaConnect/tree/master/SSO/)
The single sign on method is another way to help keep your software out of scope. This method is very quick and easy to code, and only requires a minimal amount of API knowledge. This method should be used in a closed environment and controlled with user access within your software. There are two parts to this method, one is running the transaction, and the other, which is optional, is to download the transaction.

The concept of this method is as follows:

* Place a clickable button inside your software or on your internal web app.
* When a user clicks this button, it will open a GET request to our API in the user's browser.
* The web request then hits our API server, authenticates the user, and redirects them to our user interface to a secure page.
* Our user interface is then used to run a transaction by either keying in the card data, or capturing the card data with an EMV terminal.

Once the transaction has been run and the user returns to your software, you will need to download the transaction(s) to make sure it is logged properly in your system. Alternatively, if you have an online app, we can perform a postback to your system so you can log the transaction properly. Our API performs real time postbacks once a transaction has been created or updated.

The specifics on how to perform the above sequence of events can be found [here](https://github.com/PayaDev/PayaConnect/tree/master/SSO/).
