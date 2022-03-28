# SSO (Single Sign-On) Integration Method
This resource is intended for a 3rd Party Integration/Partner who desires to be “Out of Scope” in regards to PCI compliance by allowing the partner to send customers to our API to handle all transactions.

This page describes how to pass new/existing contact data into the API.

Listed below is an overview of the process: A user of the partner will click a link from the partner system that will have an encrypted or hexed data string that can be used in either a GET or POST request using the variables defined below. The request will contain a JSON message with data required as defined in this document. When a transaction has run, the API will in real time will POST transactions back to the Partner system. These POST calls will contain the data as defined in this document. Please send the URL you would like the POSTBACK to be sent to our developer support team so they can configure it.

## Link Generation
The data being sent in the request can be sent in two ways:
1. Encrypted
2. Hexed

The data can be encrypted to prevent users from altering the data that is intended to be transmitted. This section will outline the method and encryption process to generate the link for the Partner’s users to click. It will also show how to simply hex the data if the full encryption method is not needed based on your security requirements.

The GET or POST request should be sent to the necessary URL, and the API will respond with a 302 request to redirect the user to the User Interface, and they will already be logged in.

### Sending the Request
**If Using GET**  
The GET request sent to the API should look like one of the two following methods:

1. ENCRYPTION METHOD SENT WITH THE “E_DATA” PARAMETER  
https://api.sandbox.payaconnect.com/custom/contactsso?developer-id=xxxxxxx&e_data=BD68908FB617CD45130B…  
Note: The encoded string will be a LOT longer.

2. HEX METHOD SENT WITH THE “DATA” PARAMETER  
https://api.sandbox.payaconnect.com/custom/contactsso?developer-id=xxxxxxx&data=A62B12C31FD34F…  
Note: The hex string will be a LOT longer.

**If Using POST**  
The POST variables sent should be:
* developer-id
* data or e_data if using encryption

You will need to request an encryption key in order to utilize the encryption method. Using the hex method does not require a shared encryption key.

## Standard SSO

### Required data parameters

| **Fields**     | **Type/Format** | **Length/Limit** | **Comments**                                                                                                                      |
|----------------|:---------------:|:----------------:|-----------------------------------------------------------------------------------------------------------------------------------|
| contact_api_id |     Varchar     |        64        | This Field should contain your key for this record. There is a unique key on location_id and contact_api_id to prevent duplicates |
| timestamp      |    timestamp    |                  | Timestamp when the link was created, Links expire after 15 minutes of being generated for security                                |
| first_name     |     varchar     |        64        | First Name                                                                                                                        |
| last_name      |     varchar     |        64        | Last Name                                                                                                                         |
| location_id    |       uuid      |        36        | This is a unique id for each location (account) setup under a user. Users can have many locations                                 |
| user_id        |       uuid      |        36        | API generated id that belongs to the user                                                                                         |
| user_api_key   |       uuid      |        36        | API generated “password” that belongs to the user_id                                                                              |

### Sample JSON

This sample JSON is for the standard “contactsso” endpoint and should include contact information so that when the contact is created, the user will be redirected to the UI and be placed on the contacts dashboard.
```json
{
    "timestamp": 1389348000,
    "user_id": "2CA00283-E470-4821-9CB0-DF7779EF73A1",
    "user_api_key": "780e4cd6-9096-11e2-84f2-160d0f54c7c5",
    "location_id": "535698",
    "contact_api_id": "3119275",
    "last_name" : "BROWN",
    "first_name":"CAROL",
    "address": "123 Main street" ,
    "city": "Jersey city",
    "state":"NJ",
    "zip":"07302",
    "cell_phone": "2222222222",
    "home_phone": "3333333333",
    "email" : "cbrown@example.com"
}
```

## Transaction SSO

### Optional data parameters

| **Fields**     | **Type/Format** | **Length/Limit** | **Comments**                                                                                                                      |
|----------------|:---------------:|:----------------:|-----------------------------------------------------------------------------------------------------------------------------------|
| contact_api_id |     Varchar     |        64        | This Field should contain your key for this record. There is a unique key on location_id and contact_api_id to prevent duplicates |
| timestamp      |    timestamp    |                  | Timestamp when the link was created, Links expire after 15 minutes of being generated for security                                |
| first_name     |     varchar     |        64        | First Name                                                                                                                        |
| last_name      |     varchar     |        64        | Last Name                                                                                                                         |
| location_id    |       uuid      |        36        | This is a unique id for each location (account) setup under a user. Users can have many locations                                 |
| user_id        |       uuid      |        36        | API generated id that belongs to the user                                                                                         |
| user_api_key   |       uuid      |        36        | API generated “password” that belongs to the user_id                                                                              |

### Sample JSON

This sample JSON is for sending optional transaction data when using the “contactsso” endpoint. If optional transaction data is sent, then the contact will be created/updated and then the user will be redirected to the charge page with the description and amount fields already pre-filled.
```json
{
    "timestamp": 1389348000,
    "user_id": "2CA00283-E470-4821-9CB0-DF7779EF73A1",
    "user_api_key": "780e4cd6-9096-11e2-84f2-160d0f54c7c5",
    "location_id": "535698",
    "contact_api_id": "3119275",
    "last_name" : "BROWN",
    "first_name":"CAROL",
    "address": "123 Main street" ,
    "city": "Jersey city",
    "state":"NJ",
    "zip":"07302",
    "cell_phone": "2222222222",
    "home_phone": "3333333333",
    "email" : "cbrown@example.com",
    "claim_id": "12345",
    "tags": ["POS"],
    "transaction_amt": 15.90,
    "line_items": [
        {
            "li_id": 1,
            "qty": 2,
            "tax_amount": 0.60,
            "description": "test",
            "line_total": 10.60
        },
        {
            "li_id": 2,
            "qty": 1,
            "tax_amount": 0.30,
            "description": "test222",
            "line_total": 5.30
        }
    ] 
}
```
## Virtual Terminal SSO

Another option that is available is to be redirected to the Virtual Terminal page instead of contact page. In order to do this, there is a separate set of parameters that need to be submitted. The following table shows the parameters that are required in order to be redirected to the Virtual Terminal page from the contactsso endpoint.

If this is the desired method of input and you would like to be redirected to the virtual terminal instead of the contact page, then the values in the below table need to be submitted instead of the values in the above tables.

### Data parameters

| **Fields**     | **Type/Format** | **Length/Limit** | **Comments**                                                                                                                      |
|----------------|:---------------:|:----------------:|-----------------------------------------------------------------------------------------------------------------------------------|
| contact_api_id |     Varchar     |        64        | This Field should contain your key for this record. There is a unique key on location_id and contact_api_id to prevent duplicates |
| timestamp      |    timestamp    |                  | Timestamp when the link was created, Links expire after 15 minutes of being generated for security                                |
| first_name     |     varchar     |        64        | First Name                                                                                                                        |
| last_name      |     varchar     |        64        | Last Name                                                                                                                         |
| location_id    |       uuid      |        36        | This is a unique id for each location (account) setup under a user. Users can have many locations                                 |
| user_id        |       uuid      |        36        | API generated id that belongs to the user                                                                                         |
| user_api_key   |       uuid      |        36        | API generated “password” that belongs to the user_id                                                                              |

Many fields that can be set on a transaction in the virtual terminal can be set using the above method. Here are the fields that can be set using the contactsso parameters field.
* account_holder_name
* advance_deposit
* billing_city
* billing_phone
* billing_state
* billing_street
* billing_zip
* checkin_date
* checkout_date
* clerk_number
* description
* email
* no_show
* order_num
* product_transaction_id
* room_number
* room_rate
* subtotal_amount
* tags
* tax
* transaction_amount

### Sample JSON

Here is what the sample JSON data might look like before it is converted into HEX data:
```json
{
    "timestamp": 1510948546,
    "user_id": "111111111111111111111111",
    "user_api_key": "222222222222222222222222",
    "location_id": "xxxxxxxxxxxxxxxxxxxxxxxx",
    "route" : "virtualterminal",
    "params": {
        "transaction_amount": 1.00,
        "billing_address": "123 Main Street" ,
        "room_rate": 0.80,
        "checkin_date":"2017-10-01",
        "checkout_date":"2017-10-02"
    }
}
```

Here is how the above JSON would be submitted in a GET request:
```
GET /custom/sso?developer-id=xxxxxxxx&data=7b0d0a20202020202020202274696d657374616d70223a20313531303934383534362c0d0a202020202020202022757365725f6964223a2022313131313131313131313131313131313131313131313131222c0d0a202020202020202022757365725f6170695f6b6579223a2022323232323232323232323232323232323232323232323232222c0d0a2020202020202020226c6f636174696f6e5f6964223a2022787878787878787878787878787878787878787878787878222c0d0a202020202020202022726f75746522203a20227669727475616c7465726d696e616c222c0d0a202020202020202022706172616d73223a207b0d0a202020202020202020202020227472616e73616374696f6e5f616d6f756e74223a20312e30302c0d0a2020202020202020202020202262696c6c696e675f61646472657373223a2022313233204d61696e2053747265657422202c0d0a20202020202020202020202022726f6f6d5f72617465223a20302e38302c0d0a20202020202020202020202022636865636b696e5f64617465223a22323031372d31302d3031222c0d0a20202020202020202020202022636865636b6f75745f64617465223a22323031372d31302d3032220d0a20202020202020207d0d0a7d
```

### Sample Code for Hex Process
```php
<?php
$timestamp = time();
$data = [
    'timestamp' => $timestamp,
    'user_id' => '2CA9X283-E470-4821-9CB0-DF7735EF73A1',
    'user_api_key' => '780x9cd6-9096-2037-84f2-160g1f64c7c5',
    'location_id' => '537798',
    'contact_api_id' => '3112875',
    'last_name' => 'BROWN',
    'first_name' => 'CAROL',
    'address' => '123 Main street',
    'city' => 'Jersey city',
    'state' => 'NJ',
    'zip' => '07302',
    'cell_phone' => '2222222222',
    'home_phone' => '3333333333',
    'email' => 'cbrown@example.com',
];

$url = 'https://apiv2.sandbox.payaconnect.com/custom/sso?developer-id=xxxxxxx&data=';
$url .= bin2hex(json_encode($data));
```

## Encryption/Decryption Sample Code

### PHP
```php
<?php
/**
* MCRYPT REQUIRED
*/
 
class AES
{
    public static function encrypt($data, $key)
    {
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_RAND);
        $encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);
 
        return bin2hex($iv.$encrypted);
    }

    public static function clean_string($string)
    {
        $string = preg_replace('/[\x00-\x08\x10\x0B\x0C\x0E-\x19\x7F]'.
            '|[\x00-\x7F][\x80-\xBF]+'.
            '|([\xC0\xC1]|[\xF0-\xFF])[\x80-\xBF]*'.
            '|[\xC2-\xDF]((?![\x80-\xBF])|[\x80-\xBF]{2,})'.
            '|[\xE0-\xEF](([\x80-\xBF](?![\x80-\xBF]))|(?![\x80-\xBF]{2})|[\x80-\xBF]{3,})/S',
            '', $string );
 
       //reject overly long 3 byte sequences and UTF-16 surrogates and replace with ?
        $string = preg_replace('/\xE0[\x80-\x9F][\x80-\xBF]'.
           '|\xED[\xA0-\xBF][\x80-\xBF]/S','', $string );
 
        return $string;
    }
 
    public static function decrypt($data, $key)
    {
        $blocksize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128,MCRYPT_MODE_CBC ); // 16
        $iv = substr($data, 0, $blocksize);
        $Encdata = substr($data, $blocksize);
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC,'');
        mcrypt_generic_init($td, $key, $iv);
        $decrypted = utf8_encode(mdecrypt_generic($td, $Encdata));
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $final = static::clean_string($decrypted);

        return $final;
    }
}
```

### Java
```Java
private static final String CIPHER_TRANSFORM = "AES/CBC/PKCS7Padding";
 
public String encrypt(final String plainMessage, final byte[] symKeyData) {
    final byte[] encodedMessage = plainMessage.getBytes(Charset.forName("UTF-8"));
    try {
        final Cipher cipher = Cipher.getInstance(CIPHER_TRANSFORM);
        final int blockSize = cipher.getBlockSize();
        // create the key
        final SecretKeySpec symKey = new SecretKeySpec(symKeyData, "AES");
        // generate random IV using block size
        final byte[] ivData = new byte[blockSize];
        final SecureRandom rnd = SecureRandom.getInstance("SHA1PRNG");
        rnd.nextBytes(ivData);
        final IvParameterSpec iv = new IvParameterSpec(ivData);
        cipher.init(Cipher.ENCRYPT_MODE, symKey, iv);
        final byte[] encryptedMessage = cipher.doFinal(encodedMessage);
        // concatenate IV and encrypted message
        final byte[] ivAndEncryptedMessage = new byte[ivData.length + encryptedMessage.length];
        System.arraycopy(ivData, 0, ivAndEncryptedMessage, 0, blockSize);
        System.arraycopy(encryptedMessage, 0, ivAndEncryptedMessage, blockSize, encryptedMessage.length);
        final String ivAndEncrypted = DatatypeConverter.printHexBinary(ivAndEncryptedMessage);
        
        return ivAndEncrypted;
    } catch (InvalidKeyException e) {
        throw new IllegalArgumentException("key argument does not contain a valid AES key");
    } catch (GeneralSecurityException e) {
        throw new IllegalStateException("Unexpected exception during encryption", e);
    }
}
 
public String decrypt(final String ivAndEncryptedMessageHex, final byte[] symKeyData) {
    final byte[] ivAndEncryptedMessage = DatatypeConverter.parseHexBinary(ivAndEncryptedMessageHex);
    try {
        final Cipher cipher = Cipher.getInstance(CIPHER_TRANSFORM);
        final int blockSize = cipher.getBlockSize();
        // create the key
        final SecretKeySpec symKey = new SecretKeySpec(symKeyData, "AES");
        // retrieve random IV from start of the received message
        final byte[] ivData = new byte[blockSize];
        System.arraycopy(ivAndEncryptedMessage, 0, ivData, 0, blockSize);
        final IvParameterSpec iv = new IvParameterSpec(ivData);
        // retrieve the encrypted message itself
        final byte[] encryptedMessage = new byte[ivAndEncryptedMessage.length - blockSize];
        System.arraycopy(ivAndEncryptedMessage, blockSize, encryptedMessage, 0, encryptedMessage.length);
        cipher.init(Cipher.DECRYPT_MODE, symKey, iv);
        final byte[] encodedMessage = cipher.doFinal(encryptedMessage);
        // concatenate IV and encrypted message
        final String message = new String(encodedMessage, Charset.forName("UTF-8"));
        return message;
    } catch (InvalidKeyException e) {
        throw new IllegalArgumentException("key argument does not contain a valid AES key");
    } catch (BadPaddingException e) {
        return null;
    } catch (GeneralSecurityException e) {
        throw new IllegalStateException("Unexpected exception during decryption", e);
    }
}
```
