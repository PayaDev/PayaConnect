# API Reference

## Introduction

The Application Programming Interface (API) document describes how to process and run various payment related methods programmatically including Card (credit / debit) and Automated Clearing House (ACH) transactions. The Web Service is currently released to Production and is available for use by approved entities. Changes to the web services may be modified in future releases. The API utilizes REpresentational State Transfer (REST) and JavaScript Object Notation (JSON) to communicate. More about the JSON data format can be found at http://www.json.org/. These technologies are supported by every major programming language and environment.

## Intended Audience

The intended audience for this document is technical managers and software development professionals.

## Web Services Summary

There are various features of the API and some methods are not available unless the Client is signed up for certain features of the system. For example, a client not signed up for ACH service will receive a 403 response with a message that notifies the user they are not signed up for the service.

## Host Names/IP Addresses

When integrating with Paya Connect, developers should reference the host name api.sandbox.payaconnect.com.  Once certification is complete, developers will be provided new credentials to access the production application and should the direct traffic to api.payaconnect.com. 

We do, when necessary (typically with each production release), update the IP addresses affiliated with those domains and therefore strongly recommend that developers do not whitelist the Paya Connect IP addresses on their client side servers. For integrators wishing to discover the public IP addresses associated with our host names at any point in time, the following commands can be executed:
* For Windows: nslookup api.payaconnect.com 8.8.8.8
* For Linux: dig @8.8.8.8 api.payaconnect.com

## API Version Numbering

Please pay attention to the version number of the API they are utilizing. The version number is broken up into three positions: compatibility.features.fixes. For example, v1.2.3 the first position (1 in this example) represents the compatibility level. Any application utilizing version 1 of the API will always work with any other revision of version 1. Should the need ever arise to change the scope of the API a version 2 will be released which will not be backwards compatible. The latest compatibility version of the API will be available in the event a version 2 is released.

If a new compatibility version of the API is released, the URL will reflect the change to ensure integrations written utilizing any version will continue to function. The second position (2 in this example) refers to the addition of new fields/features. These features provide additional functionality and are backwards compatible. The third position (3 in this example) indicates bug fixes, when nothing structural has changed within the API.

## HTTPS (TLS1.2)

All requests MUST utilize HTTPS/TLS1.2 to communicate with the API. Non-TLS transactions are not supported and any non-TLS transactions will not receive a response.  The TLS ciphers supported within TLS 1.2 are listed below:
* ECDHE-ECDSA-AES128-GCM-SHA256
* ECDHE-RSA-AES128-GCM-SHA256
* ECDHE-ECDSA-AES256-GCM-SHA384
* ECDHE-RSA-AES256-GCM-SHA384

## Browser Version Policy

In order to maintain safe and secure solutions our browser version policy is to only support backwards compatibility for the latest two versions still supported by any vendor.  We recommend that integrations enforce the same policies for browser compatibility.  The chart below is compiled quarterly (last update 10-1-2021)
| **Browser**   | **Version** |
|---------------|-------------|
| Google Chrome | 94.x.x.x    |
| Safari        | 15.x        |
| Firefox       | 92.x.x      |
| Edge          | 94.x.x.x    |
| Opera         | 79.x.x.x    |

## Overview

Many APIs are similar in the way that they handle requests and response. Ours is not much different than the rest. Most of the same concepts apply, only the parameters may vary slightly. This section describes the basics of our API, including specific details that you will need in order to properly integrate with us.

## Request Types

Our API is a simple REST based API. It follows most of the standards for submitting data and handling requests. Each REST request and response has a specific format for the payload. The available request types for the API endpoints and their intended purpose are as follows:
* **POST** - Creates new records
* **PUT** - Updates existing records
* **GET** - Queries records
* **DELETE** - Deletes existing records

## Response Codes

Each of the above request types will return an HTTP response code. Any HTTP response in the 2xx or 3xx range is considered a successful response. Any response in the 4xx or 5xx range is considered a failure response. The following matrix shows the possible return codes for each request type.
| **Code** | **POST** | **GET** | **PUT** | **DELETE** | **Result** | **Description**                                                                                            |
|:--------:|:--------:|:-------:|:-------:|:----------:|:----------:|------------------------------------------------------------------------------------------------------------|
|    200   |          |    ✓    |    ✓    |            |   Success  |                                                                                                            |
|    201   |     ✓    |         |         |            |   Success  |                                                                                                            |
|    204   |          |         |         |      ✓     |   Success  |                                                                                                            |
|    302   |    ✓*    |    ✓*   |         |            |   Success  | Redirect response                                                                                          |
|    400   |     ✓    |         |    ✓    |            |    Error   | Usually invalid JSON format                                                                                |
|    401   |     ✓    |    ✓    |    ✓    |      ✓     |    Error   | Your credentials are invalid (developer-id, user-id, and/or user-api-key)                                  |
|    403   |     ✓    |    ✓    |    ✓    |      ✓     |    Error   | You do not have access to that endpoint                                                                    |
|    404   |     ✓    |    ✓    |    ✓    |      ✓     |    Error   | The Endpoint or record does not exist                                                                      |
|    405   |     ✓    |    ✓    |    ✓    |      ✓     |    Error   | Method not allowed (e.g. You are trying to perform a PUT on a GET only endpoint)                           |
|    409   |     ✓    |    ✓    |    ✓    |      ✓     |    Error   | Gone - The record has been deleted                                                                         |
|    422   |     ✓    |         |    ✓    |            |    Error   | Validation error - The data supplied in POST or PUT body is invalid                                        |
|    500   |     ✓    |    ✓    |    ✓    |      ✓     |    Error   | Server error - This should almost never happen, but if it does, take comfort in knowing its not your fault |

\* Special case used for contactsso endpoint

### **Useful Tip:**

The above response codes are HTTP response codes only. In order to determine if a transaction (which is a specific endpoint) is actually approved or declined, you will need to look at the payload body and evaluate the status_id field. More about this can be found by visiting the transactions endpoint documentation.

## Timeout Handling

If you receive a 500 or timeout within your solution it's best to determine if your request was successful before attempting it a second time. This is especially true with the 'Transactions Endpoint' as it may cause duplicate transactions. Please utilize a GET request against the Endpoint; querying a unique value for your request. This may be an *_api_id, order_num, or other unique value, that will allow you to retrieve the results of the original request.

## Endpoints

Below you will find a list of all our Endpoints.  You can click on any of the specific Endpoints to view information about allowed request types, expected format, and more.
* Account Vaults
* Authentication
* AuthRoleUsers
* Contacts
* Device Terms
* Level3 Data
* Locations
* Location Info
* Notes
* Post Back Configs
* Quick Invoices
* Recurrings
* Router Account Vaults
* Router Transactions
* Signatures
* Tags
* Transactions
* Transaction Batches
* Users
