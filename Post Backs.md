# Postback Operations
This purpose of this page is to explain in more depth the process for configuring a postback, and what details are sent in a postback.

Postback Management is relative to REST based API that is full of great functionality. As you integrate with us, we can reciprocate by providing the data back to the user when “this” happens. A brief overview of the capability for Postbacks and its features are provided in this document.

Visit the [Postbackconfigs Endpoint]() for information about what fields and actions are supported.

## Workflow Steps
1. Client subscribes to postback updates for the said resource by [Creating a Postback Config]().
2. Execute a resource event, like creating a contact or running a transaction.
3. API will send a POST request to the configured URL. The URL must respond with an HTTP status of 2xx to acknowledge the request.
4. If the URL does not respond with an HTTP status 2xx, the application will try to submit the postback again. (The number of postback retries is based on the number_of_attempts and attempt_interval values as defined in the postback configuration).

## Postback Data Format
The following table defines the fields that will be sent in the request to the postback URL.

| Parameter          | Description                                                                                                                                                                             |
|--------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| type               | The type of event that happened, values can be CREATE, UPDATE, DELETE                                                                                                                   |
| resource           | The name of the resource                                                                                                                                                                |
| number_of_attempts | Number of times it was attempted to be posted back to the address value of url                                                                                                          |
| data               | A JSON string containing the properties of the resource at the time of the event, the string should have similar properties as you would get in the API responses for the said resource |
 

### Workflow Example - Contact Postbacks
#### Step 1) Create Postback Config**
The postback configuration needs to be created in order to set the trigger that is need for the postback.  Visit Postback Configs Endpoint for more information on what fields are available for use during creation.

`POST /v2/postbackconfigs`

Request
```json
{
  "postbackconfig": {
    "attempt_interval": 300,
    "basic_auth_username": null,
    "basic_auth_password": null,
    "expands": "",
    "format": "api-default",
    "is_active": "1",
    "location_id": "23948sdnfia1129i9asf92",
    "number_of_attempts": 1,
    "on_create": "1",
    "on_delete": "1",
    "on_update": "1",
    "resource": "contact",
    "url": "https://127.0.0.1/receiver"
  }
}
```
Response
```json
{
  "postbackconfig": {
    "id": "1028asnfias9f2j9sddf92jrwfskd",
    "location_id": "23948sdnfia1129i9asf92",
    "resource": "contact",
    "on_create": "1",
    "on_update": "1",
    "on_delete": "1",
    "url": "https://127.0.0.1/receiver",
    "is_active": "1",
    "format": "api-default",
    "number_of_attempts": 1,
    "attempt_interval": 300,
    "expands": "",
    "created_ts": 1539268970,
    "modified_ts": 1539268970,
    "_links": {
      "self": {
        "href": "https://api.sandbox.domain.com/v2/postbackconfigs/1028asnfias9f2j9sddf92jrwfskd"
      }
    }
  }
}
```

This can also be done within the user interface as follows:

1. Log into your user interface.
2. Go to Locations.
3. Select your desired location. If you have many locations, you may need to search for the desired location first.
4. Go to settings→postback config
5. Click “Add Postback” in the upper right corner.
6. Add the **url** field and other relevant information needed for your postback.

#### **Step 2) Create Contact**

`POST /v2/contacts`

Request
```json
{
    "contact":{
        "last_name":"Jones",
        "location_id":"23948sdnfia1129i9asf92"
    }
}
```
Response
```json
{
    "contact": {
        "id": "123456789012345678901234",
        "location_id": "23948sdnfia1129i9asf92",
        "account_number": null,
        "contact_api_id": null,
        "company_name": null,
        "first_name": null,
        "last_name": "Jones",
        ..., // Other Contact Fields here
    }
}
```
 
#### Step 3) Postback Contact Data**
Confirm that the contact postback was successfully sent to your server. The postback data is defined below as to what fields will be sent and what it will look like. The body is encoded using www-urlencoded, with the “data” parameter containing the new record data as a JSON string.

The following data block is a JSON representation of what the parameters look like that are sent in the postback. The actual data packet will be sent as www-urlencoded.

```json
{
    "type":"CREATE",
    "resource":"contact",
    "number_of_attempts":1,
    "data":"{\"id\":\"11e66c8a943ff4b2bf1b2102\",\"location_id\":\"23948sdnfia1129i9asf92\",\"account_number\":null,\"contact_api_id\":null,\"company_name\":null,\"first_name\":null,\"last_name\":\"Lue\",\"email\":null,\"address\":null,\"city\":null,\"state\":null,\"zip\":null,\"home_phone\":null,\"cell_phone\":null,\"office_phone\":null,\"office_ext_phone\":null,\"email_trx_receipt\":false,\"created_ts\":1472325312,\"modified_ts\":1472325312,\"date_of_birth\":null,\"header_message\":null,\"header_message_type_id\":0,\"contact_c1\":null,\"contact_c2\":null,\"contact_c3\":null,\"contact_balance\":null}"
}
```
