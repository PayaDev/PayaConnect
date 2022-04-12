# HMAC Authentication Process
The user-id and timestamp which are passed in the request to the API, will generate another HMAC using user’s user_hash_key. This will check against what was submitted in the hash-key parameter. If they don’t match, you will see a validation message as “Hash key is invalid”

There are 3 parameters that are required to generate a signature hash.

- **User ID**: Provided when a User is setup
- **Timestamp**: The current time when the page has been generated. it has an expire period of 5 minutes
- **User Hash Key**: This is the users hash key provided that is used to generate the signature hash. This key is secret and should not be shared with anyone.

The hash is generated using the user id and timestamp, in that specific order. The generated HMAC will be good for 15 minutes. Here is sample code of how to generate the signature:

```php
<?php
// Define the secret ticket_hash_key used for hashing the variables
$user_hash_key = 'my_user_hash_key';
 
// Define variables for generating the required hash
$user_id = 'my_user_id';
$timestamp = time();
 
// Generate the secure hash, making sure the variables
// are in the proper sequence.
$salt = $user_id . $timestamp;
$hash_key = hash_hmac('sha256', $salt, $user_hash_key);
```
