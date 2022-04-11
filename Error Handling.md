# Error Handling
When submitting requests to the API, there will be cases when the data submitted is not valid. In these cases, an error object will be returned instead of the object normally associated with the endpoint.

In order to determine if an error object will be returned, you will need to evaluate the HTTP response code. If the response code is a 422 instead of a 200 or 201, you will be receiving an error object. Here is an example of an error response payload:

```json
{
    "errors": {
        "location_id": [
            "location_id provided is not valid"
        ],
        "product_transaction_id": [
            "Product Transaction Id cannot be blank."
        ]
    }
}
```
The response payload will contain an “errors” object, followed by each field that is invalid. Each field that is invalid will have a human readable text message as the description of what is invalid.
