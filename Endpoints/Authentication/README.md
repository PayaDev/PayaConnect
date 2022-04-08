# Authroleusers Endpoint
This endpoint is used for assigning roles to users. This is required when adding a user through an integrated system. A user will not have any system permission until at least one role has been assigned to their user id.

## Endpoint Actions
### Create Record
POST /v2/authroleusers

#### Request
`{
    "authroleuser": {
        "user_id":"{{user_id}}",
        "auth_role_id":"{{auth_role_id}}"
    }
}
`

#### Response
`{
    "authroleuser": {
        "user_id":"{{user_id}}",
        "auth_role_id":"{{auth_role_id}}"
    }
}
`
## View Record
GET /v2/authroleusers/{id}

Request
Response

View Record List
GET /v2/authroleusers

RequestResponse

FILTERS
You can search for your authroleusers by including the columns you want to filter on as URL parameters as like this:
/v2/authroleusers?field=value&field2=value2

EXAMPLE
To get a list of all authroles assigned to a specific user:
/v2/authroleusers?user_id={user_id}

Delete Record
DELETE /v2/authroleusers/{id}

RequestResponse

 

Fields
Name	Min	Max	Format	POST Required	POST Allowed	Comments
id	24	36	string	 	 	The authroleusers unique identifier
user_id	24	36	string	✔	✔	 
auth_role_id	1	11	string	✔	✔	 
