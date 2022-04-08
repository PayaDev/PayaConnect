# Authentication

_Note: **developer-id** is **required** in the headers OR in the query string parameters._

## 1) User Id / User Api Key Method

This method is used for system integrations where typing a username/password isn’t an option. For this method, you will need to use the user_id and user_api_key values for the User account performing the request. For more information on how to set or generate a user_api_key, please take a look at the Users Endpoint documentation.

Once you have these credentials, you can use one of the following methods:

 - Request Headers: Pass your user_id and user_api_key as "user-id" and "user-api-key" in your Request Headers.
 - Query String Parameters: Pass your user_id and user_api_key as "user-id" and "user-api-key" in the URL for your request.
 - You can also use your user_id and user_api_key as your "username" and "password" to construct a Basic Authentication Header.

##### REQUEST HEADERS

Below you can see an example in Node.js where we provide the user_id and user_api_key values as request headers. 

**Note:** Pay close attention to the fact that when providing these values in your request, you substitute the underscore characters \(_) with dashes (-). This is true for both the Request Header, and Query String Parameter methods.

```java
var request = require("request");

var options = {
  method: 'GET',
  url: 'https://{{host}}/v2/contacts/{{contact_id}}',
  headers: {
    'developer-id': '{{developer_id}}',
    'user-id': '{{user_id}}',
    'user-api-key': '{{user_api_key}}'
  }
};

request(options, function (error, response, body) {
  if (error) throw new Error(error);
  console.log(body);
});
```
##### QUERY STRING PARAMETERS
Below you can see an example where we provide the user_id and user_api_key values as querystring parameters. 

**Note:** Pay close attention to the fact that when providing these values in your URL, you substitute the underscore characters \(_) with dashes (-). This is true for both the Request Header, and Query String Parameter methods.

```GET https://{{domain}}/v2/contacts?user-id={{user_id}}&user-api-key={{user_api_key}}&developer-id={{developer_id}}```

## 2) Token Method

1. Pass your username, password and domain in the format depicted below under **"POST  /v2/token"**
2. You will get a response object as shown below under the Response tab for **"POST  /v2/token"**
3. This contains the token that you can attach to your new requests in the following ways:
  - **GET /v2/contacts?access-token=3pPzNQstYfXDCE5x**
  - **Set your “access-token” as a header**
4. The expire time is included in the response, this is 15 minutes. Every successful request will refresh your expire time back to 15, after 15 minutes of idle time your token will expire and you have to acquire a new one
5. You can **manually expire** your token by doing this request: **DELETE /v2/token/3pPzNQstYfXDCE5x**
 

```POST /v2/token```

Request
```json
{
    "username": "myusername", //REQUIRED
    "password": "xxxxxxxx", //REQUIRED
    "domain": "xxxx.sandbox.domain.com" //REQUIRED
}
```
Response
```json
{
    "token": {
        "id": "123456789012345678901234",
        "expire": 15,
        "first_name": "John",
        "last_name": "Doe",
        "password_expire_ts": 1422283692,
        "time": 1402283692,
        "token": "abcdefghijklmnop",
        "username": "myusername",
        "primary_location_id": "123456789012345678901234",
        "timezone": "America/New_York",
        "user_type_id": 200
    }
}
```
 

```DELETE /v2/token/{token}```

Request

```json
{
    // Empty Payload - Nothing Needed Here
}
```
Response

```http
No JSON response provided.  Only HTTP response code.

204 - Success, Token Deleted
404 - Fail, Token Not Found
```

