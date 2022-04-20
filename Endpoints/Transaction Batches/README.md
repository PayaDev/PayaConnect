# Transaction Batches

Any user with the available permissions can perform a request to manually settle a transaction batch. This is done by using the transactionbatches endpoint with an action of "settle".

### Endpoint Actions

#### Get Transaction Batches

```GET /v2/transactionbatches```

_**Note**: It may be useful to include ```sort=-created_ts``` as a query string parameter so that the most recent Transaction Batch is first in the list._

##### Request

```json
{
    // Empty Payload - Nothing needed here
}
```

##### Response

```json
{
  "transactionbatches": [
    {
      "id": "{transactionbatches_id}",
      "batch_num": 3,
      "product_transaction_id": "{product_transaction_id}",
      "created_ts": 1526051483,
      "processing_status_id": 1,
      "is_open": 1,
      "batch_close_ts": null
    },
    {
      "id": "{transactionbatches_id}",
      "batch_num": 2,
      "product_transaction_id": "{product_transaction_id}",
      "created_ts": 1526048228,
      "processing_status_id": 2,
      "is_open": 0,
      "batch_close_ts": 1526051458
    },
    {
      "id": "{transactionbatches_id}",
      "batch_num": 1,
      "product_transaction_id": "{product_transaction_id}",
      "created_ts": 1526047654,
      "processing_status_id": 2,
      "is_open": 0,
      "batch_close_ts": 1526047665
    }
  ],
  "meta": {
    "pagination": {
      "links": {
        "self": {
          "href": "https://api.domain.com/v2/transactionbatches"
        }
      },
      "totalCount": 3,
      "pageCount": 1,
      "currentPage": 0,
      "perPage": 15
    },
    "sort": {
      "attributes": {
        "created_ts": "desc"
      }
    }
  }
}
```

#### Get Specific Transaction Batch

```GET /v2/transactionbatches/{id}```

##### Request

```json
{
    // Empty Payload - Nothing Needed Here
}
```

##### Request

```json
{
  "transactionbatch": {
      "id": "transactionbatches_id",
      "batch_num": 3,
      "product_transaction_id": "{product_transaction_id}",
      "created_ts": 1526051483,
      "processing_status_id": 1,
      "is_open": 1,
      "batch_close_ts": null
    }
}
```

#### Get Specific Transaction Batch

```json

```

#### Processing Status Ids

There are only 6 processing status ids that can be returned in the response when the action is "settle". They are listed in the table below.

| Status Id | Description   |
|-----------|---------------|
| 1         | To Settle     |
| 2         | Settled       |
| 3         | Error         |
| 4         | Re-process    |
| 5         | Processing    |
| 6         | Forced Closed |

#### Batch Error Responses

Using the following amount for last transaction in the batch will return the following error response in status_message for batch settlement:

| Amount(cents) | Error type | Error record type | Error data field number | Error response                                                                                                                                                                                                                         |
|---------------|------------|-------------------|-------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| $90200.11     | B          | 0                 | 11                      | Blocked Terminal Error                                                                                                                                                                                                                 |
| $90300.00     | C          | 0                 | 0                       | Contact Merchant Services/Technical Support                                                                                                                                                                                            |
| $90300.01     | C          | 0                 | 1                       | Contact Merchant Services/Technical Support                                                                                                                                                                                            |
| $90300.02     | C          | 0                 | 2                       | Contact Merchant Services/Technical Support                                                                                                                                                                                            |
| $90300.03     | C          | 0                 | 3                       | Contact Merchant Services/Technical Support                                                                                                                                                                                            |
| $90300.04     | C          | 0                 | 4                       | Contact Merchant Services/Technical Support                                                                                                                                                                                            |
| $90300.05     | C          | 0                 | 5                       | Contact Merchant Services/Technical Support                                                                                                                                                                                            |
| $90300.06     | C          | 0                 | 6                       | Contact Merchant Services/Technical Support                                                                                                                                                                                            |
| $90300.07     | C          | 0                 | 7                       | MISSING SERIAL NUM – The terminal has not yet completed the boarding process. The Serial Number has not been set up.                                                                                                                   |
| $90300.12     | C          | 0                 | 12                      | Terminal not enabled to Capture for either American Express, PayPal or Discover Card                                                                                                                                                   |
| $90300.15     | C          | 0                 | 15                      | American Express Card Account Number is invalid.                                                                                                                                                                                       |
| $90300.16     | C          | 0                 | 16                      | Discover/PayPal Card Account Number is invalid.                                                                                                                                                                                        |
| $90300.17     | C          | 0                 | 17                      | Diners Card Account Number is invalid.                                                                                                                                                                                                 |
| $90300.18     | C          | 0                 | 18                      | Cashback transaction that is not Visa or Discover and is not Debit or Check Service; or an American Express transaction that contains Passenger Transport or Auto Rental without the American Express Auto Rental optional data group. |
| $90300.21     | C          | 0                 | 21                      | Card Type not activated for the terminal.                                                                                                                                                                                              |
| $90300.22     | C          | 0                 | 22                      | A non-American Express transaction which includes one of the optional data groups for American Express Transaction Advice Addenda data.                                                                                                |
| $90300.23     | C          | 0                 | 23                      | Could not translate the Card Account Number.                                                                                                                                                                                           |
| $90501.01     | E          | A                 | 01                      | American Express Line Item Routing ID is not 'Z'.                                                                                                                                                                                      |
| $90501.55     | E          | A                 | 55                      | American Express Line Item Type is invalid.                                                                                                                                                                                            |
| $90501.57     | E          | A                 | 57                      | American Express TAD Line Item Additional Amount Type is invalid.                                                                                                                                                                      |
| $90501.58     | E          | A                 | 58                      | American Express TAD Line Item Additional Amount is invalid.                                                                                                                                                                           |
| $90501.61     | E          | A                 | 61                      | American Express Retail Line Item Quantity is invalid.                                                                                                                                                                                 |
| $90501.62     | E          | A                 | 62                      | American Express Retail Line Item Amount is invalid.                                                                                                                                                                                   |
| $90501.63     | E          | A                 | 63                      | American Express Lodging Line Item Room Rate is invalid.                                                                                                                                                                               |
| $90501.64     | E          | A                 | 64                      | American Express Lodging Line Item Number of Nights is invalid.                                                                                                                                                                        |
| $90503.06     | E          | C                 | 06                      | Transaction Type is invalid.                                                                                                                                                                                                           |
| $90503.07     | E          | C                 | 07                      | Terminal Transaction Date is invalid.                                                                                                                                                                                                  |
| $90503.08     | E          | C                 | 08                      | Terminal Verification Results missing.                                                                                                                                                                                                 |
| $90503.09     | E          | C                 | 09                      | Transaction Currency Code missing.                                                                                                                                                                                                     |
| $90503.10     | E          | C                 | 10                      | Application Transaction Counter missing.                                                                                                                                                                                               |
| $90503.11     | E          | C                 | 11                      | Application Interchange Profile missing.                                                                                                                                                                                               |
| $90503.12     | E          | C                 | 12                      | Application Cryptogram missing.                                                                                                                                                                                                        |
| $90503.13     | E          | C                 | 13                      | Unpredictable Number is missing on a Visa, Mastercard, or American Express transaction.                                                                                                                                                |
| $90503.14     | E          | C                 | 14                      | Issuer Application Data missing on a Visa or American Express transaction.                                                                                                                                                             |
| $90503.15     | E          | C                 | 15                      | Cryptogram Information Data missing on a Mastercard or American Express transaction.                                                                                                                                                   |
| $90503.16     | E          | C                 | 16                      | Terminal Capability Profile missing on a Visa or Discover transaction                                                                                                                                                                  |
| $90503.17     | E          | C                 | 17                      | Card Sequence Number is missing on a Visa, American Express, or Discover transaction.                                                                                                                                                  |
| $90503.18     | E          | C                 | 18                      | Issuer Authentication Data is missing on a Visa transaction.                                                                                                                                                                           |
| $90503.19     | E          | C                 | 19                      | CVM Results are missing on a Mastercard transaction.                                                                                                                                                                                   |
| $90503.20     | E          | C                 | 20                      | Issuer Script Results are missing on a Visa transaction.                                                                                                                                                                               |
| $90503.21     | E          | C                 | 21                      | Form Factor Identifier missing on a Visa transaction.                                                                                                                                                                                  |
| $90503.25     | E          | C                 | 25                      | Interface Device Serial Number is invalid                                                                                                                                                                                              |
| $90504.01     | E          | D                 | 01                      | Routing ID is not 'Z'.                                                                                                                                                                                                                 |
| $90504.04     | E          | D                 | 04                      | Routing ID is invalid.                                                                                                                                                                                                                 |
| $90504.05     | E          | D                 | 05                      | Record Type or optional data groups are invalid.                                                                                                                                                                                       |
| $90504.06     | E          | D                 | 06                      | Transaction Code is invalid.                                                                                                                                                                                                           |
| $90504.07     | E          | D                 | 07                      | Cardholder Identification Code is invalid.                                                                                                                                                                                             |
| $90504.08     | E          | D                 | 08                      | Account Data Source is invalid.                                                                                                                                                                                                        |
| $90504.09     | E          | D                 | 09                      | Cardholder Account Number is invalid.                                                                                                                                                                                                  |
| $90504.10     | E          | D                 | 10                      | Requested ACI value is invalid.                                                                                                                                                                                                        |
| $90504.11     | E          | D                 | 11                      | Returned ACI is invalid.                                                                                                                                                                                                               |
| $90504.12     | E          | D                 | 12                      | Authorization Source Code is invalid.                                                                                                                                                                                                  |
| $90504.13     | E          | D                 | 13                      | Transaction Sequence Number is invalid.                                                                                                                                                                                                |
| $90504.14     | E          | D                 | 14                      | Response Code is invalid.                                                                                                                                                                                                              |
| $90504.15     | E          | D                 | 15                      | Approval Code is invalid.                                                                                                                                                                                                              |
| $90504.16     | E          | D                 | 16                      | Local Transaction Date is invalid.                                                                                                                                                                                                     |
| $90504.17     | E          | D                 | 17                      | Local Transaction Time is invalid.                                                                                                                                                                                                     |
| $90504.18     | E          | D                 | 18                      | AVS Result Code is invalid.                                                                                                                                                                                                            |
| $90504.19     | E          | D                 | 19                      | Transaction Identifier is invalid.                                                                                                                                                                                                     |
| $90504.20     | E          | D                 | 20                      | Validation Code is invalid.                                                                                                                                                                                                            |
| $90504.21     | E          | D                 | 21                      | Void Indicator is invalid.                                                                                                                                                                                                             |
| $90504.22     | E          | D                 | 22                      | Transaction Status Code is invalid.                                                                                                                                                                                                    |
| $90504.23     | E          | D                 | 23                      | Reimbursement Attribute is invalid.                                                                                                                                                                                                    |
| $90504.24     | E          | D                 | 24                      | Settlement Amount is invalid.                                                                                                                                                                                                          |
| $90504.25     | E          | D                 | 25                      | Authorized Amount is invalid.                                                                                                                                                                                                          |
| $90504.26     | E          | D                 | 26                      | Cashback Amount is invalid.                                                                                                                                                                                                            |
| $90504.27     | E          | D                 | 27                      | Gratuity Amount is invalid.                                                                                                                                                                                                            |
| $90504.28     | E          | D                 | 28                      | Total Authorized Amount is invalid.                                                                                                                                                                                                    |
| $90504.29     | E          | D                 | 29                      | Purchase Identifier Format Code is invalid.                                                                                                                                                                                            |
| $90504.30     | E          | D                 | 30                      | Purchase Identifier is invalid.                                                                                                                                                                                                        |
| $90504.31     | E          | D                 | 31                      | Market Specific Data ID is invalid.                                                                                                                                                                                                    |
| $90504.32     | E          | D                 | 32                      | Special Program Indicator is invalid.                                                                                                                                                                                                  |
| $90504.33     | E          | D                 | 33                      | Extra Charges is invalid.                                                                                                                                                                                                              |
| $90504.34     | E          | D                 | 34                      | Rental or Check In Date is invalid.                                                                                                                                                                                                    |
| $90504.35     | E          | D                 | 35                      | Merchant Category Code Override is invalid.                                                                                                                                                                                            |
| $90504.36     | E          | D                 | 36                      | Charge Type is invalid.                                                                                                                                                                                                                |
| $90504.37     | E          | D                 | 37                      | Checkout Date is invalid.                                                                                                                                                                                                              |
| $90504.38     | E          | D                 | 38                      | Stay Duration is invalid.                                                                                                                                                                                                              |
| $90504.39     | E          | D                 | 39                      | Lodging Room Rate is invalid.                                                                                                                                                                                                          |
| $90504.40     | E          | D                 | 40                      | Optional Amount Identifier is invalid.                                                                                                                                                                                                 |
| $90504.41     | E          | D                 | 41                      | Optional Amount is invalid.                                                                                                                                                                                                            |
| $90504.42     | E          | D                 | 42                      | Purchase Order Number is invalid.                                                                                                                                                                                                      |
| $90504.43     | E          | D                 | 43                      | Restricted Ticket Indicator is invalid.                                                                                                                                                                                                |
| $90504.44     | E          | D                 | 44                      | Multiple Clearing Sequence Number is invalid.                                                                                                                                                                                          |
| $90504.45     | E          | D                 | 45                      | Multiple Clearing Sequence Count is invalid.                                                                                                                                                                                           |
| $90504.46     | E          | D                 | 46                      | Ticket Number is invalid.                                                                                                                                                                                                              |
| $90504.47     | E          | D                 | 47                      | Passenger Name or TAD Line Item Count is invalid.                                                                                                                                                                                      |
| $90504.48     | E          | D                 | 48                      | Departure Date or TAA Line Item Count is invalid.                                                                                                                                                                                      |
| $90504.49     | E          | D                 | 49                      | City Airport Code is invalid.                                                                                                                                                                                                          |
| $90504.50     | E          | D                 | 50                      | Trip Leg Info is invalid.                                                                                                                                                                                                              |
| $90504.51     | E          | D                 | 51                      | Retrieval Reference Number is invalid.                                                                                                                                                                                                 |
| $90504.52     | E          | D                 | 52                      | System Trace Audit Number is invalid.                                                                                                                                                                                                  |
| $90504.53     | E          | D                 | 53                      | Network Identification Code is invalid.                                                                                                                                                                                                |
| $90504.54     | E          | D                 | 54                      | Settlement Date is invalid.                                                                                                                                                                                                            |
| $90504.55     | E          | D                 | 55                      | Lane ID is invalid.                                                                                                                                                                                                                    |
| $90504.56     | E          | D                 | 56                      | MOTO / e-Commerce Indicator is invalid.                                                                                                                                                                                                |
| $90504.57     | E          | D                 | 57                      | Renter Name or American Express Auto Rental Pickup Time is invalid.                                                                                                                                                                    |
| $90504.58     | E          | D                 | 58                      | Rental Return City is invalid.                                                                                                                                                                                                         |
| $90504.59     | E          | D                 | 59                      | Rental Return State / Country is invalid.                                                                                                                                                                                              |
| $90504.60     | E          | D                 | 60                      | Rental Return Location ID is invalid.                                                                                                                                                                                                  |
| $90504.61     | E          | D                 | 61                      | Level 3 Order Date or ACH Security Code is invalid.                                                                                                                                                                                    |
| $90504.62     | E          | D                 | 62                      | Level 3 Line Item Count or ACH Routing Number is invalid.                                                                                                                                                                              |
| $90504.64     | E          | D                 | 64                      | American Express CPS Total Tax Amount or Group Version Number is invalid.                                                                                                                                                              |
| $90504.66     | E          | D                 | 66                      | Fleet Motor Fuel Unit of Measure is invalid.                                                                                                                                                                                           |
| $90504.71     | E          | D                 | 71                      | Fleet Purchase Product Code or ACH Payment Type is invalid.                                                                                                                                                                            |
| $90504.72     | E          | D                 | 72                      | ACH Presentment is invalid.                                                                                                                                                                                                            |
| $90504.74     | E          | D                 | 74                      | Fleet Tax Rate or ACH Check Reversal Indicator is invalid.                                                                                                                                                                             |
| $90504.75     | E          | D                 | 75                      | VAT Tax Amount is invalid.                                                                                                                                                                                                             |
| $90504.76     | E          | D                 | 76                      | VAT Tax Rate is invalid.                                                                                                                                                                                                               |
| $90504.77     | E          | D                 | 77                      | Line Item Count is invalid.                                                                                                                                                                                                            |
| $90504.78     | E          | D                 | 78                      | Freight Amount is invalid.                                                                                                                                                                                                             |
| $90504.79     | E          | D                 | 79                      | Duty Amount is invalid.                                                                                                                                                                                                                |
| $90504.80     | E          | D                 | 80                      | Destination Postal / ZIP Code is invalid                                                                                                                                                                                               |
| $90504.81     | E          | D                 | 81                      | Ship From Postal / ZIP Code is invalid.                                                                                                                                                                                                |
| $90504.82     | E          | D                 | 82                      | ODG 45 Transaction Security Indicator is invalid.                                                                                                                                                                                      |
| $90504.83     | E          | D                 | 83                      | Alternate Tax Amount Indicator is invalid.                                                                                                                                                                                             |
| $90504.84     | E          | D                 | 84                      | Alternate Tax Amount is invalid.                                                                                                                                                                                                       |
| $90504.85     | E          | D                 | 85                      | Line Item Count is invalid.                                                                                                                                                                                                            |
| $90504.86     | E          | D                 | 86                      | Service Development Indicator is invalid.                                                                                                                                                                                              |
| $90504.91     | E          | D                 | 91                      | Existing Debt Indicator is invalid.                                                                                                                                                                                                    |
| $90504.92     | E          | D                 | 92                      | E-Commerce Goods Indicator is invalid.                                                                                                                                                                                                 |
| $90504.93     | E          | D                 | 93                      | UCAF Collection Indicator or POS Data Code is invalid.                                                                                                                                                                                 |
| $90504.96     | E          | D                 | 96                      | Merchant Verification Value is invalid.                                                                                                                                                                                                |
| $90504.99     | E          | D                 | 99                      | Detail Extension ODG 41 Validation Error. The specific tag and value will be added to the error description.                                                                                                                           |
| $90505.05     | E          | E                 | 05                      | ETB record received with no terminal authentication.                                                                                                                                                                                   |
| $90505.06     | E          | E                 | 06                      | Encryption Type is invalid.                                                                                                                                                                                                            |
| $90505.07     | E          | E                 | 07                      | Encrypted Transmission Block Data Size is invalid.                                                                                                                                                                                     |
| $90505.08     | E          | E                 | 08                      | Encrypted Transmission Block is invalid.                                                                                                                                                                                               |
| $90511.04     | E          | K                 | 04                      | Routing ID is not 'Z'.                                                                                                                                                                                                                 |
| $90511.05     | E          | K                 | 05                      | Record Type is invalid.                                                                                                                                                                                                                |
| $90511.06     | E          | K                 | 06                      | BIN is invalid.                                                                                                                                                                                                                        |
| $90511.07     | E          | K                 | 07                      | Agent Number is invalid.                                                                                                                                                                                                               |
| $90511.08     | E          | K                 | 08                      | Chain Number is invalid.                                                                                                                                                                                                               |
| $90511.09     | E          | K                 | 09                      | Merchant Number is invalid.                                                                                                                                                                                                            |
| $90511.10     | E          | K                 | 10                      | Store Number is invalid.                                                                                                                                                                                                               |
| $90511.11     | E          | K                 | 11                      | Terminal Number is invalid.                                                                                                                                                                                                            |
| $90511.12     | E          | K                 | 12                      | Device Code is invalid.                                                                                                                                                                                                                |
| $90511.13     | E          | K                 | 13                      | Merchant Currency Code is invalid.                                                                                                                                                                                                     |
| $90511.14     | E          | K                 | 14                      | Language Indicator is invalid.                                                                                                                                                                                                         |
| $90511.15     | E          | K                 | 15                      | Time Zone Differential is invalid.                                                                                                                                                                                                     |
| $90511.16     | E          | K                 | 16                      | Batch Transmission Date is invalid.                                                                                                                                                                                                    |
| $90511.17     | E          | K                 | 17                      | Batch Number is invalid.                                                                                                                                                                                                               |
| $90511.18     | E          | K                 | 18                      | Blocking Number is invalid.                                                                                                                                                                                                            |
| $90511.19     | E          | K                 | 19                      | Travel Agency Code is invalid.                                                                                                                                                                                                         |
| $90511.20     | E          | K                 | 20                      | Travel Agency Name is invalid.                                                                                                                                                                                                         |
| $90511.21     | E          | K                 | 21                      | Merchant Local Telephone Number is invalid.                                                                                                                                                                                            |
| $90511.22     | E          | K                 | 22                      | Customer Service Telephone Number is invalid.                                                                                                                                                                                          |
| $90511.23     | E          | K                 | 23                      | GenKey ID is invalid.                                                                                                                                                                                                                  |
| $90511.24     | E          | K                 | 24                      | Developer ID is invalid.                                                                                                                                                                                                               |
| $90511.25     | E          | K                 | 25                      | Version ID is invalid.                                                                                                                                                                                                                 |
| $90511.26     | E          | K                 | 26                      | Gateway ID is invalid.                                                                                                                                                                                                                 |
| $90511.27     | E          | K                 | 27                      | Payment Service Provider Name is invalid.                                                                                                                                                                                              |
| $90512.01     | E          | L                 | 01                      | Routing ID is not 'Z'.                                                                                                                                                                                                                 |
| $90516.04     | E          | P                 | 04                      | Routing ID is not 'Z'.                                                                                                                                                                                                                 |
| $90516.05     | E          | P                 | 05                      | Record Type is invalid.                                                                                                                                                                                                                |
| $90516.06     | E          | P                 | 06                      | Merchant Country Code is invalid.                                                                                                                                                                                                      |
| $90516.07     | E          | P                 | 07                      | Merchant City Code (ZIP/Postal) is invalid.                                                                                                                                                                                            |
| $90516.08     | E          | P                 | 08                      | Merchant Category Code is invalid.                                                                                                                                                                                                     |
| $90516.09     | E          | P                 | 09                      | Merchant Name/City/State is invalid.                                                                                                                                                                                                   |
| $90516.10     | E          | P                 | 10                      | Merchant Location Number is invalid.                                                                                                                                                                                                   |
| $90516.11     | E          | P                 | 11                      | Merchant Terminal ID Number is invalid.                                                                                                                                                                                                |
| $90520.04     | E          | T                 | 04                      | Routing ID is not 'Z'.                                                                                                                                                                                                                 |
| $90520.05     | E          | T                 | 05                      | Record Type is invalid.                                                                                                                                                                                                                |
| $90520.06     | E          | T                 | 06                      | Batch Transmission Date is invalid.                                                                                                                                                                                                    |
| $90520.07     | E          | T                 | 07                      | Batch Number is invalid.                                                                                                                                                                                                               |
| $90520.08     | E          | T                 | 08                      | Batch Record Count is invalid.                                                                                                                                                                                                         |
| $90520.09     | E          | T                 | 09                      | Batch Hashing Total is invalid.                                                                                                                                                                                                        |
| $90520.10     | E          | T                 | 10                      | Cash Back Total is invalid.                                                                                                                                                                                                            |
| $90520.11     | E          | T                 | 11                      | Batch Net Deposit is invalid.                                                                                                                                                                                                          |
| $90524.06     | E          | X                 | 06                      | Invalid Canadian Tax Line Item Tax Amount Indicator                                                                                                                                                                                    |
| $90524.07     | E          | X                 | 07                      | Invalid Canadian Tax Line Item Tax Amount format                                                                                                                                                                                       |
| $90524.08     | E          | X                 | 08                      | Invalid Canadian Tax Line Item Tax Rate format                                                                                                                                                                                         |
| $90524.09     | E          | X                 | 09                      | Invalid Canadian Tax Line Item Tax Rate Exponent format                                                                                                                                                                                |
| $90524.11     | E          | X                 | 11                      | Invalid Canadian Tax Line Item Tax Type Identifier                                                                                                                                                                                     |
| $90999.99     | I          | N/A               | N/A                     | Input/Output System Error has occurred.                                                                                                                                                                                                |
| $91600.20     | P          | 0                 | 20                      | Hierarchy Validation Error                                                                                                                                                                                                             |
| $91600.21     | P          | 0                 | 21                      | Card Type Validation Error                                                                                                                                                                                                             |
| $91999.99     | S          | N/A               | N/A                     | Record Sequence Error                                                                                                                                                                                                                  |
| $92199.99     | U          | N/A               | N/A                     | Unknown Message or System Error has occurred.                                                                                                                                                                                          |

#### Filters

In contrary to using expands to get extra data, you can use filters to limit record results. Most fields listed in the fields section can be used to filter results.

Say, for example, that you only wanted to find the open batch. You could include that filter in the URL of the GET request like so:

```/v2/transactionbatches?is_open=1```

Additional filters include: ```processing_status_id```, and ```product_transaction_id```.

There is additional functionality that allows searching and filtering on timestamp fields. If you are looking for transaction from today, you can simply search on the created_ts field as follows:

```/v2/transactionbatches?created_ts=today```

And for yesterday you could do the following:

```/v2/transactionbatches?created_ts=yesterday```

If you need more flexibility on dates, you can set the timestamp filter to custom and supply a custom from and to date like so:

```/v2/transactionbatches?created_ts=custom&created_ts_from=1511382234&created_ts_to=1511385997```

You can do the same thing with batch_close_ts like so:

```/v2/transactionbatches?batch_close_ts=custom&batch_close_ts_from=1511382234&batch_close_ts_to=1511385997```

When searching on timestamp fields, the list below contains all the predefined values that can be used:

 - today
 - yesterday
 - this week
 - last week
 - last 30 days
 - this month
 - last month
 - custom

