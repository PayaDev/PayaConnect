# Expands (Related Records)
Most endpoints in the API have a way to retrieve extra data related to the current record being retrieved. For example, if the API request is for the accountvaults endpoint, and the end user also needs to know which contact the account vault belongs to, this data can be returned in the accountvaults endpoint request.

Here is a URL and snippet of JSON that represent part of the response from the accountvaults endpoint:

`GET /v2/accountvaults/xxxxxxxxxxxxxxxxxxxxxxxx`

Response
```json
{
    "accountvault": {
        "id": "xxxxxxxxxxxxxxxxxxxxxxx",
        "payment_method": "cc",
        "title": "Test CC Account",
        "account_holder_name": "John Smith",
        "contact_id": "123",
        "created_user_id":"456",
        ..., // Other Fields Here 
        "_links": {
            "self": {
                "href": "{url}/v2/accountvaults/xxxxxxxxxxxxxxxxxxxxxxxx"
            }
        }
    }
}
```
 

When dissecting this JSON response, you may have noticed that there is a contact_id present. So, normally, when someone does a request to the accountvaults endpoint to retrieve this record, and then wants the contact information, a second request would need to be done to retrieve this data. With the API, you can simply supply and extra filter to the URL to get this information embedded in the accountvaults response. Here is an example URK and snippet of JSON that shows how this can be achieved:

`GET /v2/accountvaults/xxxxxxxxxxxxxxxxxxxxxxxx?expand=contact`

Response
```json
{
    "accountvault": {
        "id": "xxxxxxxxxxxxxxxxxxxxxxx",
        "payment_method": "cc",
        "title": "Test CC Account",
        "account_holder_name": null,
        "contact_id": "123",
        "contact": {
            "id": "123",
            "first_name":"John",
            "last_name":"Smith",
            ..., // Other Contact Fields Here
        }
        "created_user_id":"456",
        ..., // Other AccountVault Fields Here
        "_links": {
            "self": {
                "href": "{url}/v2/accountvaults/xxxxxxxxxxxxxxxxxxxxxxxx"
            }
        }
    }
}
```
 

Each endpoint has it’s own section for Expands (Related Records) the details which expands are available for each endpoint. Currently, any time an expand is performed for a record, the fields that are returned are the default fields for the expanded endpoint.
