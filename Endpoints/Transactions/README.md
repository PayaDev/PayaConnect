# Transactions Endpoint
*Note:

- Please see the [Test Data](https://github.com/PayaDev/PayaConnect/blob/master/TestData.md) section for more information on expected transaction responses.
- Please see ACH Testing transaction acceleration if you are using ACH to assist in speeding up the settlement process.*
 

## Fields
The following table describes all of the available fields available for use on the Transactions Endpoint. You can use the tabs at the top of the table to reveal additional details about the fields including what Actions a field is applicable to, as well as whether a field is required (R), optional (O), conditional (C) or not required (N) for each of the Endpoint Actions.

 

Definitions
| Fields                          | Format     | Min | Max   | POST Required | POST Allowed | PUT Allowed | Edit | Comments                                                                                                                                                                                                                                                                                                                                                                                                   |
|---------------------------------|------------|-----|-------|---------------|--------------|-------------|------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| account_holder_name             | string     |     | 32    |               | ✔            | ✔           | N    | For CC, this is the "Name (as it appears) on Card".  For ACH, this is the "Name on Account". Required for ACH transactions if account_vault_id is not provided.                                                                                                                                                                                                                                            |
| account_number                  | string     | 4   | 19    | ✔             | ✔            |             | N    | For CC transactions, a credit card number. For ACH transactions, a bank account number. String lengths are conditional, CC should be 13-19 and ACH should be 4-19. Required if account_vault_id , track_data, or micr_data is not provided.                                                                                                                                                                |
| account_type                    | string     | 1   | 32    |               | ✔            |             |      | Required for ACH transactions if account_vault_id is not provided. For ACH, allowed values are “checking” or “savings”. For CC, this field is read only. The system will identify card type and generate a value for this field automatically. possible values are: visa, mc, disc, amex, jcb, diners, and debit.                                                                                          |
| account_vault_api_id            | string     |     | 36    |               | ✔            | ✔           |      | This can be supplied in place of account_vault_id if you would like to use an account vault for the transaction and are using your own custom api_id's to track accountvaults in the system.                                                                                                                                                                                                               |
| account_vault_id                | string     |     | 36    |               | ✔            |             | N    | Required if account_number,  track_data, micr_data is not provided.                                                                                                                                                                                                                                                                                                                                        |
| ach_identifier                  | string     | 1   | 1     |               | ✔            |             |      | Required for ACH transactions in certain scenarios                                                                                                                                                                                                                                                                                                                                                         |
| ach_sec_code                    | string     | 3   | 3     |               | ✔            |             | N    | Required for ACH transactions if account_vault_id is not provided. See the Merchant ACH section for more info                                                                                                                                                                                                                                                                                              |
| action                          | string     |     | 24    | ✔             | ✔            | ✔           |      | One of the possible actions from the action list.                                                                                                                                                                                                                                                                                                                                                          |
| additional_amounts[type]        | string     | 2   | 2     |               | ✔            |             |      | type of the amount [4S-Healthcare(Visa and MC Only), 4U-Prescription/Rx(Visa and MC Only), 4V-Vision/Optical(Visa Only), 4W-clinic/other qualified medical(Visa Only) ,4X-Dental(Visa Only)].                                                                                                                                                                                                              |
| additional_amounts[amount]      | string     | 1   | 12    |               | ✔            |             |      | The amount of additional amount.                                                                                                                                                                                                                                                                                                                                                                           |
| advance_deposit                 | boolean    |     |       |               | ✔            |             | N    | Used in Lodging                                                                                                                                                                                                                                                                                                                                                                                            |
| auth_amount                     | number     |     | 10    |               |              |             |      | Authorization Amount                                                                                                                                                                                                                                                                                                                                                                                       |
| auth_code                       | string     | 6   | 6     |               | ✔            |             | N    | Required on force transactions. Ignored for all other actions.                                                                                                                                                                                                                                                                                                                                             |
| avs                             | string     |     | 1     |               |              |             |      | AVS                                                                                                                                                                                                                                                                                                                                                                                                        |
| avs_enhanced                    | string     |     | 1     |               |              |             |      |                                                                                                                                                                                                                                                                                                                                                                                                            |
| batch                           | string     |     |       |               |              |             |      |                                                                                                                                                                                                                                                                                                                                                                                                            |
| billing_city                    | string     |     | 36    |               | ✔            |             | N    | The City portion of the address associated with the Credit Card (CC) or Bank Account (ACH).                                                                                                                                                                                                                                                                                                                |
| billing_phone                   | string     |     | 10    |               | ✔            |             | N    | The Phone # to be used to contact Payer if there are any issues processing a transaction.                                                                                                                                                                                                                                                                                                                  |
| billing_state                   | string     |     | 2     |               | ✔            |             | N    | The State portion of the address associated with the Credit Card (CC) or Bank Account (ACH).                                                                                                                                                                                                                                                                                                               |
| billing_street                  | string     |     | 32    |               | ✔            |             | N    | The Street portion of the address associated with the Credit Card (CC) or Bank Account (ACH). Required for CC transactions if vt_require_street is true on producttransaction(Merchant Deposit Account).                                                                                                                                                                                                   |
| billing_zip                     | string     | 4   | 12    |               | ✔            |             | N    | The Zip or "Postal Code" portion of the address associated with the Credit Card (CC) or Bank Account (ACH). Alphanumeric with spaces and dashes to accomodate domestic and international postal codes Required for CC transactions if vt_require_zip is true on producttransaction(Merchant Deposit Account).                                                                                              |
| card_present                    | boolean    |     | 1     |               | ✔            |             | N    | A POST only field to specify whether or not the card is present. This field will be defaulted to "1" for all card present industries (retail, lodging, restaurant) and "0" for card not present industries (MOTO/e-commerce). For lodging, if the no_show flag is set to "1", this field will automatically be set to "0". For transactions where account_vault_id is used, this filed will be set to "0". |
| cavv                            | string     |     | 40    |               | ✔            |             |      | The cavv contains the Cardholder Authentication Verification Value (cavv) for 3-D Secure transactions (If Amex, cavv field can contain Amex SafeKey/Token Block A).                                                                                                                                                                                                                                        |
| charge_back_date                | yyyy-mm-dd |     | 10    |               |              |             |      | Charge Back Date (ACH Trxs)                                                                                                                                                                                                                                                                                                                                                                                |
| check_number                    | string     | 1   | 15    |               | ✔            |             |      | Required for transactions using TEL SEC code.                                                                                                                                                                                                                                                                                                                                                              |
| checkin_date                    | yyyy-mm-dd |     | 10    |               | ✔            |             | N    | Checkin Date - The time difference between checkin_date and checkout_date must be less than or equal to 99 days. Required if merchant industry type is lodging.                                                                                                                                                                                                                                            |
| checkout_date                   | yyyy-mm-dd |     | 10    |               | ✔            | ✔           | N    | Checkout Date - The time difference between checkin_date and checkout_date must be less than or equal to 99 days. Required if merchant industry type is lodging.                                                                                                                                                                                                                                           |
| clerk_number                    | string     |     | 16    |               | ✔            |             |      | Clerk or Employee Identifier                                                                                                                                                                                                                                                                                                                                                                               |
| contact_api_id                  | string     |     | 36    |               | ✔            | ✔           |      | This can be supplied in place of contact_id if you would like to use a contact for the transaction and are using your own custom api_id's to track contacts in the system.                                                                                                                                                                                                                                 |
| contact_id                      | string     |     | 36    |               | ✔            | ✔           | N    | if contact_id is provided, ensure it belongs to the same location as the transaction. You cannot move transaction across locations.                                                                                                                                                                                                                                                                        |
| created_ts                      | integer    |     | 10    |               |              |             |      | Created Timestamp                                                                                                                                                                                                                                                                                                                                                                                          |
| custom_data                     | JSON       |     | 512   |               | ✔            | ✔           |      | A field that allows custom JSON to be entered to store extra data.                                                                                                                                                                                                                                                                                                                                         |
| customer_id                     | string     |     | 64    |               |              |             |      | Can be used by Merchants to identify Contacts in our system by an ID from another system.                                                                                                                                                                                                                                                                                                                  |
| customer_ip                     | string     |     | 39    |               |              |             |      |                                                                                                                                                                                                                                                                                                                                                                                                            |
| cvv                             | string     |     | 4     |               | ✔            |             | N    | Required for CC transactions if vt_require_cvv is true on producttransaction(Merchant Deposit Account).                                                                                                                                                                                                                                                                                                    |
| cvv_response                    | string     | 1   | 1     |               |              |             |      |                                                                                                                                                                                                                                                                                                                                                                                                            |
| description                     | string     |     | 64    |               | ✔            | ✔           | O    | Description                                                                                                                                                                                                                                                                                                                                                                                                |
| dl_number                       | string     | 1   | 50    |               | ✔            |             |      | Required for ACH transactions when Driver's License Verification is enabled on the terminal.  Either dl_number + dl_state OR customer_id will need to be passed in this scenario.                                                                                                                                                                                                                          |
| dl_state                        | string     | 2   | 2     |               | ✔            |             |      | Required for ACH transactions when Driver's License Verification is enabled on the terminal.  Either dl_number + dl_state OR customer_id will need to be passed in this scenario.                                                                                                                                                                                                                          |
| dob_year                        | string     | 4   | 4     |               | ✔            |             |      | Required for certain ACH transactions where Identity Verification has been enabled for the terminal.  Either ssn4 or dob_year will need to be passed in this scenario but NOT BOTH.                                                                                                                                                                                                                        |
| e_format                        | enum       |     |       |               | ✔            |             |      | Encrypted Track Data Format.  Possible values are: 'ksn', 'ksnpin', 'idtech', 'magnesafe'. Click here for examples.                                                                                                                                                                                                                                                                                        |
| e_track_data                    | hex        |     |       |               | ✔            |             |      | Encrypted Track Data                                                                                                                                                                                                                                                                                                                                                                                       |
| e_serial_number                 | hex        |     | 20    |               | ✔            |             |      | Encrypted Track Data KSN                                                                                                                                                                                                                                                                                                                                                                                   |
| effective_date                  | yyyy-mm-dd |     | 10    |               | ✔            |             | N    | For ACH only, this is optional and defaults to current day.                                                                                                                                                                                                                                                                                                                                                |
| emv_receipt_data                | string     |     | 512   |               |              |             |      | This field is a read only field. This field will only be populated for EMV transactions and will contain proper JSON formatted data with some or all of the following fields: TC,TVR,AID,TSI,ATC,APPLAB,APPN,CVM                                                                                                                                                                                           |
| entry_mode_id                   | string     |     | 1     |               |              |             |      | Entry Mode - See entry mode section for more detail                                                                                                                                                                                                                                                                                                                                                        |
| exp_date                        | mmyy       | 4   | 4     |               | ✔            | ✔           | N    | Required for CC. The Expiration Date for the credit card. (MMYY format).                                                                                                                                                                                                                                                                                                                                   |
| first_six                       | string     |     | 6     |               |              |             |      | First six numbers of account_number.  Automatically generated by system.                                                                                                                                                                                                                                                                                                                                   |
| id                              | string     |     | 36    |               |              |             |      | A unique identifer for a transaction. Automatically generated by the system.                                                                                                                                                                                                                                                                                                                               |
| image_front                     | base64     |     | 65535 |               | ✔            |             |      | A base64 encoded string for the image.  Used with Check21 ACH transactions.                                                                                                                                                                                                                                                                                                                                |
| image_back                      | base64     |     | 65535 |               | ✔            |             |      | A base64 encoded string for the image.  Used with Check21 ACH transactions.                                                                                                                                                                                                                                                                                                                                |
| is_recurring                    | boolean    |     |       |               |              |             |      | Indicates whether this transaction was performed as part of a Recurring.                                                                                                                                                                                                                                                                                                                                   |
| last_four                       | string     | 4   | 4     |               |              |             |      | Last four numbers of account_number.  Automatically generated by the system.                                                                                                                                                                                                                                                                                                                               |
| location_api_id                 | string     |     | 36    |               | ✔            | ✔           |      | This can be supplied in place of location_id for the transaction if you are using your own custom api_id's for your locations.                                                                                                                                                                                                                                                                             |
| location_id                     | string     | 24  | 36    |               | ✔            |             | N    | A valid Location Id to associate the transaction with.  If not provided with POST, will be defaulted to that of the User's Primary Location.                                                                                                                                                                                                                                                               |
| modified_ts                     | integer    |     | 10    |               |              |             |      | A date automatically generated by the system whenever any data is changed.                                                                                                                                                                                                                                                                                                                                 |
| move_account_vault              | boolean    |     |       |               |              | ✔           | C    | Used to move account vault to new contact                                                                                                                                                                                                                                                                                                                                                                  |
| move_account_vault_transactions | boolean    |     |       |               |              | ✔           | C    | Used to move account vault transactions along with account vault to new contact                                                                                                                                                                                                                                                                                                                            |
| no_show                         | boolean    |     |       |               | ✔            |             | N    | Used in Lodging                                                                                                                                                                                                                                                                                                                                                                                            |
| notification_email_address      | string     |     |       |               | ✔            |             | N    | if email is supplied then receipt will be emailed                                                                                                                                                                                                                                                                                                                                                          |
| notification_email_sent         | string     |     |       |               |              |             |      |                                                                                                                                                                                                                                                                                                                                                                                                            |
| order_num                       | string     |     | 32    |               | ✔            |             | N    | Required for CC transactions , if merchant's deposit account's duplicate check per batch has "order_num" field                                                                                                                                                                                                                                                                                             |
| payment_method                  | string     |     |       | ✔             | ✔            |             | N    | 'cc' or 'ach'                                                                                                                                                                                                                                                                                                                                                                                              |
| po_number                       | string     |     | 24    |               | ✔            |             |      |                                                                                                                                                                                                                                                                                                                                                                                                            |
| previous_transaction_id         | string     |     | 36    |               | ✔            |             | N    | previous_transaction_id is used as token to run transaction. Account details OR previous_transaction_id should be passed to run transaction.                                                                                                                                                                                                                                                               |
| product_transaction_id          | string     |     | 36    |               | ✔            |             |      | The Product's method (cc/ach) has to match the action. If not provided, the API will use the default configured for the Location.                                                                                                                                                                                                                                                                          |
| quick_invoice_id                | string     |     | 24    |               | ✔            | ✔           |      | Can be used to associate a transaction to a Quick Invoice.  Quick Invoice transactions will have a value for this field automatically. See Linking Transactions to Quick Invoices for more information.                                                                                                                                                                                                    |
| reason_code_id                  | number     |     | 4     |               |              |             |      | Response reason code that provides more detail as to the result of the transaction. The reason code list can be found here: Response Reason Codes                                                                                                                                                                                                                                                          |
| recurring_id                    | string     |     | 36    |               |              |             |      | A unique identifer used to associate a transaction with a Recurring.                                                                                                                                                                                                                                                                                                                                       |
| response_message                | string     |     | 255   |               |              |             |      | Response Message                                                                                                                                                                                                                                                                                                                                                                                           |
| return_date                     | yyyy-mm-dd |     | 10    |               |              |             |      | Return Date                                                                                                                                                                                                                                                                                                                                                                                                |
| room_num                        | string     |     | 12    |               | ✔            | ✔           | N    | Used in Lodging                                                                                                                                                                                                                                                                                                                                                                                            |
| room_rate                       | number     |     |       |               | ✔            | ✔           | N    | Required if merchant industry type is lodging.                                                                                                                                                                                                                                                                                                                                                             |
| routing                         | string     |     | 9     |               | ✔            |             | N    | This field is read only for ach on transactions. Must be supplied if account_vault_id is not provided.                                                                                                                                                                                                                                                                                                     |
| save_account                    | boolean    |     |       |               | ✔            |             |      | Specifies to save account to contacts profile if account_number/track_data is present with either contact_id or contact_api_id in params.                                                                                                                                                                                                                                                                  |
| save_account_title              | string     |     | 16    |               | ✔            |             |      | If saving account vault while running a transaction, this will be the title of the account vault.                                                                                                                                                                                                                                                                                                          |
| settle_date                     | yyyy-mm-dd |     | 10    |               |              |             |      | Settle date                                                                                                                                                                                                                                                                                                                                                                                                |
| ssn4                            | string     | 4   | 4     |               | ✔            |             |      | For ACH transactions where Identity Verification is enabled for terminal. Only ssn4 or dob_year should be passed. not both.                                                                                                                                                                                                                                                                                |
| status_id                       | number     |     | 3     |               |              |             |      | Status ID - See status id section for more detail                                                                                                                                                                                                                                                                                                                                                          |
| subtotal_amount                 | number     |     | 10    |               | ✔            |             |      | This field is allowed and required for transactions that have a product where surcharge is configured.                                                                                                                                                                                                                                                                                                     |
| surcharge_amount                | number     |     | 10    |               | ✔            |             |      | This field is allowed and required for transactions that have a product where surcharge is configured.                                                                                                                                                                                                                                                                                                     |
| tags                            | string     |     |       |               | ✔            | ✔           | O    |                                                                                                                                                                                                                                                                                                                                                                                                            |
| tax                             | number     |     |       |               | ✔            | ✔           |      | Amount of Sales tax - If supplied, this amount should be included in the total transaction_amount field                                                                                                                                                                                                                                                                                                    |
| terminal_serial_number          | string     |     | 24    |               | ✔            | ✔           |      | If transaction was processed using a terminal, this field would contain the terminal's serial number                                                                                                                                                                                                                                                                                                       |
| terms_agree                     | integer    |     |       |               |              |             |      | Terms Agreement                                                                                                                                                                                                                                                                                                                                                                                            |
| threedsecure                    | boolean    |     |       |               | ✔            |             |      | Specify if the transaction is obtained by 3DSecure.                                                                                                                                                                                                                                                                                                                                                        |
| threedsecure_validated          | boolean    |     |       |               |              |             |      | Specify if 3DSecure has been validated.                                                                                                                                                                                                                                                                                                                                                                    |
| track_data                      | string     |     | 256   |               | ✔            |             | N    | Track Data from a magnetic card swipe.                                                                                                                                                                                                                                                                                                                                                                     |
| transaction_amount              | string     |     | 10    | ✔             | ✔            |             | N    | Amount of the transaction. This should always be the desired settle amount of the transaction.                                                                                                                                                                                                                                                                                                             |
| transaction_api_id              | string     |     | 64    |               | ✔            |             | N    | See api_id page for more details                                                                                                                                                                                                                                                                                                                                                                           |
| transaction_c1                  | string     |     | 128   |               | ✔            | ✔           |      | Custom field 1 for api users to store custom data                                                                                                                                                                                                                                                                                                                                                          |
| transaction_c2                  | string     |     | 128   |               | ✔            | ✔           |      | Custom field 2 for api users to store custom data                                                                                                                                                                                                                                                                                                                                                          |
| transaction_c3                  | string     |     | 128   |               | ✔            | ✔           |      | Custom field 3 for api users to store custom data                                                                                                                                                                                                                                                                                                                                                          |
| transaction_c4                  | string     |     | 128   |               | ✔            | ✔           |      | Custom field 4 for api users to store custom data                                                                                                                                                                                                                                                                                                                                                          |
| transaction_settlement_status   | string     |     | 32    |               |              |             |      | (Deprecated field)                                                                                                                                                                                                                                                                                                                                                                                         |
| trx_source_id                   | integer    |     | 2     |               |              |             |      | How the transaction was obtained by the API.                                                                                                                                                                                                                                                                                                                                                               |
| type_id                         | number     |     | 2     |               |              |             |      | Type ID - See type id section for more detail                                                                                                                                                                                                                                                                                                                                                              |
| wallet_id                       | string     |     | 3     |               |              |             |      | This value provides information about transactions initiation (If transaction initiated from Apple Pay In App, this field should contain 100 value).                                                                                                                                                                                                                                                       |
| verbiage                        | string     |     |       |               |              |             |      | Verbiage -Do not use verbiage to see if the transaction was approved, use status_id                                                                                                                                                                                                                                                                                                                        |
| void_date                       | yyyy-mm-dd |     | 10    |               |              |             |      | void date                                                                                                                                                                                                                                                                                                                                                                                                  |
| xid                             | string     |     | 40    |               | ✔            |             |      | The xid contains a value assigned to a 3-D Secure transaction as a unique transaction identifier (If Amex, xid field can contain Amex SafeKey/Token Block B).                                                                                                                                                                                                                                              |

Applicable Actions
| Fields                          | Sale | Refund | Void | PartialReversal | AuthOnly | AuthComplete | AuthIncrement | Force | TipAdjust | Debit | Credit | Edit | Comments                                                                                                                                                                                                                                                                                                                                                                                                   |
|---------------------------------|------|--------|------|-----------------|----------|--------------|---------------|-------|-----------|-------|--------|------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| account_holder_name             | O    | O      | O    | O               | O        | O            | O             | O     | N         | C     | C      | N    | For CC, this is the "Name (as it appears) on Card".  For ACH, this is the "Name on Account". Required for ACH transactions if account_vault_id is not provided.                                                                                                                                                                                                                                            |
| account_number                  | C    | C      | N    | N               | C        | N            | N             | C     | N         | C     | C      | N    | For CC transactions, a credit card number. For ACH transactions, a bank account number. String lengths are conditional, CC should be 13-19 and ACH should be 4-19. Required if account_vault_id , track_data, or micr_data is not provided.                                                                                                                                                                |
| account_type                    |      |        |      |                 |          |              |               |       |           | C     | C      |      | Required for ACH transactions if account_vault_id is not provided. For ACH, allowed values are “checking” or “savings”. For CC, this field is read only. The system will identify card type and generate a value for this field automatically. possible values are: visa, mc, disc, amex, jcb, diners, and debit.                                                                                          |
| account_vault_api_id            |      |        |      |                 |          |              |               |       |           |       |        |      | This can be supplied in place of account_vault_id if you would like to use an account vault for the transaction and are using your own custom api_id's to track accountvaults in the system.                                                                                                                                                                                                               |
| account_vault_id                | C    | C      | N    | N               | C        | N            | N             | C     | N         | C     | C      | N    | Required if account_number,  track_data, micr_data is not provided.                                                                                                                                                                                                                                                                                                                                        |
| ach_identifier                  |      |        |      |                 |          |              |               |       |           |       |        |      | Required for ACH transactions in certain scenarios                                                                                                                                                                                                                                                                                                                                                         |
| ach_sec_code                    | N/A  | C      | N/A  | N/A             | N/A      | N/A          | N/A           | N/A   | N/A       | C     | C      | N    | Required for ACH transactions if account_vault_id is not provided. See the Merchant ACH section for more info                                                                                                                                                                                                                                                                                              |
| action                          |      |        |      |                 |          |              |               |       |           |       |        |      | One of the possible actions from the action list.                                                                                                                                                                                                                                                                                                                                                          |
| additional_amounts[type]        |      |        |      |                 |          |              |               |       |           |       |        |      | type of the amount [4S-Healthcare(Visa and MC Only), 4U-Prescription/Rx(Visa and MC Only), 4V-Vision/Optical(Visa Only), 4W-clinic/other qualified medical(Visa Only) ,4X-Dental(Visa Only)].                                                                                                                                                                                                              |
| additional_amounts[amount]      |      |        |      |                 |          |              |               |       |           |       |        |      | The amount of additional amount.                                                                                                                                                                                                                                                                                                                                                                           |
| advance_deposit                 | O    | N      | N    | N               | O        | O            | O             | O     | N         | N/A   | N/A    | N    | Used in Lodging                                                                                                                                                                                                                                                                                                                                                                                            |
| auth_amount                     |      |        |      |                 |          |              |               |       |           |       |        |      | Authorization Amount                                                                                                                                                                                                                                                                                                                                                                                       |
| auth_code                       | N/A  | N/A    | N/A  | N/A             | N/A      | N/A          | N/A           | R     | N/A       | N/A   | N/A    | N    | Required on force transactions. Ignored for all other actions.                                                                                                                                                                                                                                                                                                                                             |
| avs                             |      |        |      |                 |          |              |               |       |           |       |        |      | AVS                                                                                                                                                                                                                                                                                                                                                                                                        |
| avs_enhanced                    |      |        |      |                 |          |              |               |       |           |       |        |      |                                                                                                                                                                                                                                                                                                                                                                                                            |
| batch                           |      |        |      |                 |          |              |               |       |           |       |        |      |                                                                                                                                                                                                                                                                                                                                                                                                            |
| billing_city                    | O    | O      | N    | N               | O        | N            | N             | O     | N         | O     | O      | N    | The City portion of the address associated with the Credit Card (CC) or Bank Account (ACH).                                                                                                                                                                                                                                                                                                                |
| billing_phone                   | O    | O      | N    | N               | O        | N            | N             | O     | N         | O     | O      | N    | The Phone # to be used to contact Payer if there are any issues processing a transaction.                                                                                                                                                                                                                                                                                                                  |
| billing_state                   | O    | O      | N    | N               | O        | N            | N             | O     | N         | O     | O      | N    | The State portion of the address associated with the Credit Card (CC) or Bank Account (ACH).                                                                                                                                                                                                                                                                                                               |
| billing_street                  | C    | C      | N    | N               | C        | N            | N             | C     | N         | O     | O      | N    | The Street portion of the address associated with the Credit Card (CC) or Bank Account (ACH). Required for CC transactions if vt_require_street is true on producttransaction(Merchant Deposit Account).                                                                                                                                                                                                   |
| billing_zip                     | C    | C      | N    | N               | C        | N            | N             | C     | N         | O     | O      | N    | The Zip or "Postal Code" portion of the address associated with the Credit Card (CC) or Bank Account (ACH). Alphanumeric with spaces and dashes to accomodate domestic and international postal codes Required for CC transactions if vt_require_zip is true on producttransaction(Merchant Deposit Account).                                                                                              |
| card_present                    | O    | O      | N    | N               | N        | N            | N             | O     | N         | N     | N      | N    | A POST only field to specify whether or not the card is present. This field will be defaulted to "1" for all card present industries (retail, lodging, restaurant) and "0" for card not present industries (MOTO/e-commerce). For lodging, if the no_show flag is set to "1", this field will automatically be set to "0". For transactions where account_vault_id is used, this filed will be set to "0". |
| cavv                            |      |        |      |                 |          |              |               |       |           |       |        |      | The cavv contains the Cardholder Authentication Verification Value (cavv) for 3-D Secure transactions (If Amex, cavv field can contain Amex SafeKey/Token Block A).                                                                                                                                                                                                                                        |
| charge_back_date                |      |        |      |                 |          |              |               |       |           |       |        |      | Charge Back Date (ACH Trxs)                                                                                                                                                                                                                                                                                                                                                                                |
| check_number                    |      |        |      |                 |          |              |               |       |           |       |        |      | Required for transactions using TEL SEC code.                                                                                                                                                                                                                                                                                                                                                              |
| checkin_date                    | C    | C      | N    | N               | C        | C            | C             | C     | N         | N/A   | N/A    | N    | Checkin Date - The time difference between checkin_date and checkout_date must be less than or equal to 99 days. Required if merchant industry type is lodging.                                                                                                                                                                                                                                            |
| checkout_date                   | C    | C      | N    | N               | C        | C            | C             | C     | N         | N/A   | N/A    | N    | Checkout Date - The time difference between checkin_date and checkout_date must be less than or equal to 99 days. Required if merchant industry type is lodging.                                                                                                                                                                                                                                           |
| clerk_number                    |      |        |      |                 |          |              |               |       |           |       |        |      | Clerk or Employee Identifier                                                                                                                                                                                                                                                                                                                                                                               |
| contact_api_id                  |      |        |      |                 |          |              |               |       |           |       |        |      | This can be supplied in place of contact_id if you would like to use a contact for the transaction and are using your own custom api_id's to track contacts in the system.                                                                                                                                                                                                                                 |
| contact_id                      | O    | O      | N/A  | N/A             | O        | N            | N             | O     | N         | O     | O      | N    | if contact_id is provided, ensure it belongs to the same location as the transaction. You cannot move transaction across locations.                                                                                                                                                                                                                                                                        |
| created_ts                      |      |        |      |                 |          |              |               |       |           |       |        |      | Created Timestamp                                                                                                                                                                                                                                                                                                                                                                                          |
| custom_data                     |      |        |      |                 |          |              |               |       |           |       |        |      | A field that allows custom JSON to be entered to store extra data.                                                                                                                                                                                                                                                                                                                                         |
| customer_id                     |      |        |      |                 |          |              |               |       |           |       |        |      | Can be used by Merchants to identify Contacts in our system by an ID from another system.                                                                                                                                                                                                                                                                                                                  |
| customer_ip                     |      |        |      |                 |          |              |               |       |           |       |        |      |                                                                                                                                                                                                                                                                                                                                                                                                            |
| cvv                             | C    | C      | N    | N               | C        | N            | N             | C     | N         | N/A   | N/A    | N    | Required for CC transactions if vt_require_cvv is true on producttransaction(Merchant Deposit Account).                                                                                                                                                                                                                                                                                                    |
| cvv_response                    |      |        |      |                 |          |              |               |       |           |       |        |      |                                                                                                                                                                                                                                                                                                                                                                                                            |
| description                     | O    | O      | O    | O               | O        | O            | O             | O     | N         | O     | O      | O    | Description                                                                                                                                                                                                                                                                                                                                                                                                |
| dl_number                       |      |        |      |                 |          |              |               |       |           |       |        |      | Required for ACH transactions when Driver's License Verification is enabled on the terminal.  Either dl_number + dl_state OR customer_id will need to be passed in this scenario.                                                                                                                                                                                                                          |
| dl_state                        |      |        |      |                 |          |              |               |       |           |       |        |      | Required for ACH transactions when Driver's License Verification is enabled on the terminal.  Either dl_number + dl_state OR customer_id will need to be passed in this scenario.                                                                                                                                                                                                                          |
| dob_year                        |      |        |      |                 |          |              |               |       |           |       |        |      | Required for certain ACH transactions where Identity Verification has been enabled for the terminal.  Either ssn4 or dob_year will need to be passed in this scenario but NOT BOTH.                                                                                                                                                                                                                        |
| e_format                        |      |        |      |                 |          |              |               |       |           |       |        |      | Encrypted Track Data Format.  Possible values are: 'ksn', 'ksnpin', 'idtech', 'magnesafe'. Click here for examples.                                                                                                                                                                                                                                                                                        |
| e_track_data                    |      |        |      |                 |          |              |               |       |           |       |        |      | Encrypted Track Data                                                                                                                                                                                                                                                                                                                                                                                       |
| e_serial_number                 |      |        |      |                 |          |              |               |       |           |       |        |      | Encrypted Track Data KSN                                                                                                                                                                                                                                                                                                                                                                                   |
| effective_date                  | N/A  | N/A    | N/A  | N/A             | N/A      | N/A          | N/A           | N/A   | N/A       | O     | O      | N    | For ACH only, this is optional and defaults to current day.                                                                                                                                                                                                                                                                                                                                                |
| emv_receipt_data                |      |        |      |                 |          |              |               |       |           |       |        |      | This field is a read only field. This field will only be populated for EMV transactions and will contain proper JSON formatted data with some or all of the following fields: TC,TVR,AID,TSI,ATC,APPLAB,APPN,CVM                                                                                                                                                                                           |
| entry_mode_id                   |      |        |      |                 |          |              |               |       |           |       |        |      | Entry Mode - See entry mode section for more detail                                                                                                                                                                                                                                                                                                                                                        |
| exp_date                        | C    | C      | N    | N               | C        | C            | C             | C     | N         | N/A   | N/A    | N    | Required for CC. The Expiration Date for the credit card. (MMYY format).                                                                                                                                                                                                                                                                                                                                   |
| first_six                       |      |        |      |                 |          |              |               |       |           |       |        |      | First six numbers of account_number.  Automatically generated by system.                                                                                                                                                                                                                                                                                                                                   |
| id                              |      |        |      |                 |          |              |               |       |           |       |        |      | A unique identifer for a transaction. Automatically generated by the system.                                                                                                                                                                                                                                                                                                                               |
| image_front                     |      |        |      |                 |          |              |               |       |           |       |        |      | A base64 encoded string for the image.  Used with Check21 ACH transactions.                                                                                                                                                                                                                                                                                                                                |
| image_back                      |      |        |      |                 |          |              |               |       |           |       |        |      | A base64 encoded string for the image.  Used with Check21 ACH transactions.                                                                                                                                                                                                                                                                                                                                |
| is_recurring                    |      |        |      |                 |          |              |               |       |           |       |        |      | Indicates whether this transaction was performed as part of a Recurring.                                                                                                                                                                                                                                                                                                                                   |
| last_four                       |      |        |      |                 |          |              |               |       |           |       |        |      | Last four numbers of account_number.  Automatically generated by the system.                                                                                                                                                                                                                                                                                                                               |
| location_api_id                 |      |        |      |                 |          |              |               |       |           |       |        |      | This can be supplied in place of location_id for the transaction if you are using your own custom api_id's for your locations.                                                                                                                                                                                                                                                                             |
| location_id                     | O    | O      | N    | N               | O        | N            | N             | O     | N         | O     | O      | N    | A valid Location Id to associate the transaction with.  If not provided with POST, will be defaulted to that of the User's Primary Location.                                                                                                                                                                                                                                                               |
| modified_ts                     |      |        |      |                 |          |              |               |       |           |       |        |      | A date automatically generated by the system whenever any data is changed.                                                                                                                                                                                                                                                                                                                                 |
| move_account_vault              | N    | N      | N    | N               | N        | N            | N             | N     | N         | N     | N      | C    | Used to move account vault to new contact                                                                                                                                                                                                                                                                                                                                                                  |
| move_account_vault_transactions | N    | N      | N    | N               | N        | N            | N             | N     | N         | N     | N      | C    | Used to move account vault transactions along with account vault to new contact                                                                                                                                                                                                                                                                                                                            |
| no_show                         | O    | O      | N    | N               | O        | O            | O             | O     | N         | N/A   | N/A    | N    | Used in Lodging                                                                                                                                                                                                                                                                                                                                                                                            |
| notification_email_address      | O    | O      | O    | O               | O        | O            | O             | O     | N         | O     | O      | N    | if email is supplied then receipt will be emailed                                                                                                                                                                                                                                                                                                                                                          |
| notification_email_sent         |      |        |      |                 |          |              |               |       |           |       |        |      |                                                                                                                                                                                                                                                                                                                                                                                                            |
| order_num                       | O    | O      | N    | N               | O        | O            | O             | O     | N         | O     | O      | N    | Required for CC transactions , if merchant's deposit account's duplicate check per batch has "order_num" field                                                                                                                                                                                                                                                                                             |
| payment_method                  | R    | R      | N    | N               | R        | O            | O             | R     | N         | R     | R      | N    | 'cc' or 'ach'                                                                                                                                                                                                                                                                                                                                                                                              |
| po_number                       |      |        |      |                 |          |              |               |       |           |       |        |      |                                                                                                                                                                                                                                                                                                                                                                                                            |
| previous_transaction_id         | C    | C      | N    | N               | C        | N            | N             | C     | N         | C     | C      | N    | previous_transaction_id is used as token to run transaction. Account details OR previous_transaction_id should be passed to run transaction.                                                                                                                                                                                                                                                               |
| product_transaction_id          |      |        |      |                 |          |              |               |       |           |       |        |      | The Product's method (cc/ach) has to match the action. If not provided, the API will use the default configured for the Location.                                                                                                                                                                                                                                                                          |
| quick_invoice_id                |      |        |      |                 |          |              |               |       |           |       |        |      | Can be used to associate a transaction to a Quick Invoice.  Quick Invoice transactions will have a value for this field automatically. See Linking Transactions to Quick Invoices for more information.                                                                                                                                                                                                    |
| reason_code_id                  |      |        |      |                 |          |              |               |       |           |       |        |      | Response reason code that provides more detail as to the result of the transaction. The reason code list can be found here: Response Reason Codes                                                                                                                                                                                                                                                          |
| recurring_id                    |      |        |      |                 |          |              |               |       |           |       |        |      | A unique identifer used to associate a transaction with a Recurring.                                                                                                                                                                                                                                                                                                                                       |
| response_message                |      |        |      |                 |          |              |               |       |           |       |        |      | Response Message                                                                                                                                                                                                                                                                                                                                                                                           |
| return_date                     |      |        |      |                 |          |              |               |       |           |       |        |      | Return Date                                                                                                                                                                                                                                                                                                                                                                                                |
| room_num                        | O    | O      | O    | O               | O        | O            | O             | O     | N         | N/A   | N/A    | N    | Used in Lodging                                                                                                                                                                                                                                                                                                                                                                                            |
| room_rate                       | C    | C      | O    | O               | C        | C            | C             | C     | N         | N/A   | N/A    | N    | Required if merchant industry type is lodging.                                                                                                                                                                                                                                                                                                                                                             |
| routing                         | N/A  | N/A    | N/A  | N/A             | N/A      | N/A          | N/A           | N/A   | N/A       | C     | C      | N    | This field is read only for ach on transactions. Must be supplied if account_vault_id is not provided.                                                                                                                                                                                                                                                                                                     |
| save_account                    |      |        |      |                 |          |              |               |       |           |       |        |      | Specifies to save account to contacts profile if account_number/track_data is present with either contact_id or contact_api_id in params.                                                                                                                                                                                                                                                                  |
| save_account_title              |      |        |      |                 |          |              |               |       |           |       |        |      | If saving account vault while running a transaction, this will be the title of the account vault.                                                                                                                                                                                                                                                                                                          |
| settle_date                     |      |        |      |                 |          |              |               |       |           |       |        |      | Settle date                                                                                                                                                                                                                                                                                                                                                                                                |
| ssn4                            |      |        |      |                 |          |              |               |       |           |       |        |      | For ACH transactions where Identity Verification is enabled for terminal. Only ssn4 or dob_year should be passed. not both.                                                                                                                                                                                                                                                                                |
| status_id                       |      |        |      |                 |          |              |               |       |           |       |        |      | Status ID - See status id section for more detail                                                                                                                                                                                                                                                                                                                                                          |
| subtotal_amount                 |      |        |      |                 |          |              |               |       |           |       |        |      | This field is allowed and required for transactions that have a product where surcharge is configured.                                                                                                                                                                                                                                                                                                     |
| surcharge_amount                |      |        |      |                 |          |              |               |       |           |       |        |      | This field is allowed and required for transactions that have a product where surcharge is configured.                                                                                                                                                                                                                                                                                                     |
| tags                            | O    | O      | O    | O               | O        | O            | O             | O     | O         | O     | O      | O    |                                                                                                                                                                                                                                                                                                                                                                                                            |
| tax                             |      |        |      |                 |          |              |               |       |           |       |        |      | Amount of Sales tax - If supplied, this amount should be included in the total transaction_amount field                                                                                                                                                                                                                                                                                                    |
| terminal_serial_number          |      |        |      |                 |          |              |               |       |           |       |        |      | If transaction was processed using a terminal, this field would contain the terminal's serial number                                                                                                                                                                                                                                                                                                       |
| terms_agree                     |      |        |      |                 |          |              |               |       |           |       |        |      | Terms Agreement                                                                                                                                                                                                                                                                                                                                                                                            |
| threedsecure                    |      |        |      |                 |          |              |               |       |           |       |        |      | Specify if the transaction is obtained by 3DSecure.                                                                                                                                                                                                                                                                                                                                                        |
| threedsecure_validated          |      |        |      |                 |          |              |               |       |           |       |        |      | Specify if 3DSecure has been validated.                                                                                                                                                                                                                                                                                                                                                                    |
| track_data                      | C    | C      | N    | N               | C        | N            | N             | C     | N         | N/A   | N/A    | N    | Track Data from a magnetic card swipe.                                                                                                                                                                                                                                                                                                                                                                     |
| transaction_amount              | R    | R      | O    | R               | R        | O            | R             | R     | R         | R     | R      | N    | Amount of the transaction. This should always be the desired settle amount of the transaction.                                                                                                                                                                                                                                                                                                             |
| transaction_api_id              | O    | O      | O    | O               | O        | O            | O             | O     | N         | O     | O      | N    | See api_id page for more details                                                                                                                                                                                                                                                                                                                                                                           |
| transaction_c1                  |      |        |      |                 |          |              |               |       |           |       |        |      | Custom field 1 for api users to store custom data                                                                                                                                                                                                                                                                                                                                                          |
| transaction_c2                  |      |        |      |                 |          |              |               |       |           |       |        |      | Custom field 2 for api users to store custom data                                                                                                                                                                                                                                                                                                                                                          |
| transaction_c3                  |      |        |      |                 |          |              |               |       |           |       |        |      | Custom field 3 for api users to store custom data                                                                                                                                                                                                                                                                                                                                                          |
| transaction_c4                  |      |        |      |                 |          |              |               |       |           |       |        |      | Custom field 4 for api users to store custom data                                                                                                                                                                                                                                                                                                                                                          |
| transaction_settlement_status   |      |        |      |                 |          |              |               |       |           |       |        |      | (Deprecated field)                                                                                                                                                                                                                                                                                                                                                                                         |
| trx_source_id                   |      |        |      |                 |          |              |               |       |           |       |        |      | How the transaction was obtained by the API.                                                                                                                                                                                                                                                                                                                                                               |
| type_id                         |      |        |      |                 |          |              |               |       |           |       |        |      | Type ID - See type id section for more detail                                                                                                                                                                                                                                                                                                                                                              |
| wallet_id                       |      |        |      |                 |          |              |               |       |           |       |        |      | This value provides information about transactions initiation (If transaction initiated from Apple Pay In App, this field should contain 100 value).                                                                                                                                                                                                                                                       |
| verbiage                        |      |        |      |                 |          |              |               |       |           |       |        |      | Verbiage -Do not use verbiage to see if the transaction was approved, use status_id                                                                                                                                                                                                                                                                                                                        |
| void_date                       |      |        |      |                 |          |              |               |       |           |       |        |      | void date                                                                                                                                                                                                                                                                                                                                                                                                  |
| xid                             |      |        |      |                 |          |              |               |       |           |       |        |      | The xid contains a value assigned to a 3-D Secure transaction as a unique transaction identifier (If Amex, xid field can contain Amex SafeKey/Token Block B).                                                                                                                                                                                                                                              |


 

### Product Transaction Setting Overrides
The following fields can be used on a per transaction basis.  If a field is provided, **the corresponding field from the Product Transaction being used will be ignored** and the override field value is then used instead.

For example, if `auto_decline_zip` is set to true on the Product Transaction, but `auto_decline_zip_override` is provided in transaction request with a value of `false`, then the transaction will NOT automatically decline due to a bad zip.

 
| Name                                 | Description                                                                                                                                                                                                                |
|--------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| allow_partial_authorization_override | `true` will allow for partially approved transactions less than the full requested transaction_amount. `false` will NOT allow for partially approved transactions. * Does not apply to recurrings                              |
| auto_decline_cvv_override            | `true` will auto reverse a transaction with an invalid CVV, even if the issuer approves it. `false` will NOT auto reverse a transaction with an invalid CVV. * CVV value must be provided for it to be evaluated               |
| auto_decline_street_override         | `true` will auto reverse transactions if street is determined bad when checking AVS with the issuer. `false` will NOT auto reverse a transaction with an invalid street * Street value must be provided for it to be evaluated |
| auto_decline_zip_override            | `true` will auto reverse transactions if zip is determined bad when checking AVS with the issuer. `false` will NOT auto reverse a transaction with an invalid zip * Zip value must be provided for it to be evaluated          |
 
## Endpoint Actions
Each transaction requires one of the these actions to be provided:

- sale
- refund
- void
- partialreversal
- authonly
- authcomplete
- authincrement
- force
- debit
- credit
- edit
- avsonly (not available with all Processors)

### Perform a Sale
`POST /v2/transactions`

Request
```json
{
    "transaction": {
        "action": "sale",
        "payment_method": "cc",
        "account_number": "5454545454545454",
        "exp_date":"1220",
        "transaction_amount": 1,
        "location_id": "{location_id}"
    }
}
```

Response
```json

    "transaction": {
        "id": "111111111111111111111111", 
        "payment_method": "cc",
        "account_vault_id": null,
        "recurring_id": null,
        "first_six": "545454",
        "last_four": "5454",
        "account_holder_name": null,
        "transaction_amount": 1,
        "description": null,
        "transaction_code": null,
        "avs": "BAD",
        "batch": "2",
        "item": "10",
        "order_num": "433659378839",
        "timestamp": "1421951096",
        "verbiage": "APPROVED",
        "transaction_settlement_status": null,
        "effective_date": null,
        "routing": null,
        "return_date": null,
        "created_ts": 1421951061, 
        "modified_ts": null,
        "transaction_api_id": null,
        "terms_agree": null,
        "notification_email_address": null,
        "notification_email_sent": false,
        "response_message": null,
        "auth_amount": 1,
        "auth": "812823",
        "status_id": 101,
        "type_id": 20,
        "location_id": "{location_id}",
        "settle_date": null,
        "charge_back_date": null,
        "void_date": null,
        "account_type": "mc",
        "is_recurring": false,
        "is_accountvault": false,
        "checkin_date": null,
        "checkout_date": null,
        "room_num": null,
        "room_rate": null,
        "advance_deposit": false,
        "no_show": false,
        "entry_mode_id": "C"
        "emv_receipt_data": {
            "AID":"a0000000042203",
            "APPLAB":"US Maestro",
            "APPN":"US Maestro",
            "CVM":"Pin Verified",
            "TSI":"e800",
            "TVR":"0800008000"
        },         
        "folio_num": "",
        "_links": {
            "self": {
                "href": "{url}/v2/transactions/11111111111111111111111"
            }
        }
    }
}
```

### Perform a Sale from Account Vault

`POST /v2/transactions`

Request
```json
{
    "transaction": {
        "action": "sale",
        "payment_method": "cc",
        "account_vault_id": "{account_vault_id}",
        "transaction_amount": 1,
        "location_id": "{location_id}"
    }
}
```
Response
```json
{
    "transaction": {
        "id": "333333333333333333333333", 
        "payment_method": "cc",
        "account_vault_id": null,
        "recurring_id": null,
        "first_six": "545454",
        "last_four": "5454",
        "account_holder_name": null,
        "transaction_amount": 1,
        "description": null,
        "transaction_code": null,
        "avs": "BAD",
        "batch": "2",
        "item": "10",
        "order_num": "433659378839",
        "timestamp": "1421951096",
        "verbiage": "APPROVED",
        "transaction_settlement_status": null,
        "effective_date": null,
        "routing": null,
        "return_date": null,
        "created_ts": 1421951061, 
        "modified_ts": null,
        "transaction_api_id": null,
        "terms_agree": null,
        "notification_email_address": null,
        "notification_email_sent": false,
        "response_message": null,
        "auth_amount": 1,
        "auth": "812823",
        "status_id": 101,
        "type_id": 20,
        "location_id": "{location_id}",
        "settle_date": null,
        "charge_back_date": null,
        "void_date": null,
        "account_type": "mc",
        "is_recurring": false,
        "is_accountvault": true,
        "checkin_date": null,
        "checkout_date": null,
        "room_num": null,
        "room_rate": null,
        "advance_deposit": false,
        "no_show": false,
        "entry_mode_id": "C"
        "emv_receipt_data": {},         
        "folio_num": "",
        "_links": {
            "self": {
                "href": "{url}/v2/transactions/222222222222222222222222"
            }
        }
    }
}
```

### Perform an AVS Only Transaction
For information about AVS response codes and what they indicate, please take a look at [AVS Response Codes]().  While this action does not require billing address information, that data is necessary to return a valid AVS response from the processor. 

Please note that the Paya Connect sandbox will return CVV responses here, but some of our processors do not support CVV responses for this transaction type.

See our [Test Data](https://github.com/PayaDev/PayaConnect/blob/master/TestData.md) for additional test scenarios.  Any other AVS will decline the AVS but not decline the transaction. Not sending AVS will decline the AVS but not decline the transaction. 

`POST /v2/transactions`

Request
```json
{
  "transaction": {
    "payment_method": "cc",
    "action": "avsonly",
    "account_number":"5454545454545454",
    "exp_date": "0220",
    "location_id":"{location_id}",
    "account_holder_name":"Joe Smith",
    "billing_street":"5800 NW 39th AVE", //this is valid AVS response in the sandbox
    "billing_zip":"32606" //this is valid AVS response in the sandbox
  }
}
```


Response
```json
{
    "transaction": {
        "id": "11e8de0660ed32b09377b9d7",
        "payment_method": "cc",
        "account_vault_id": null,
        "recurring_id": null,
        "first_six": "545454",
        "last_four": "5454",
        "account_holder_name": null,
        "transaction_amount": "0.00",
        "description": null,
        "transaction_code": null,
        "avs": "BAD",
        "batch": null,
        "order_num": "297051478934",
        "verbiage": "APPROVAL",
        "transaction_settlement_status": null,
        "effective_date": null,
        "routing": null,
        "return_date": null,
        "created_ts": 1541097961,
        "modified_ts": 1541097961,
        "transaction_api_id": null,
        "terms_agree": null,
        "notification_email_address": null,
        "notification_email_sent": true,
        "response_message": null,
        "auth_amount": "0.00",
        "auth_code": "",
        "status_id": 121,
        "type_id": 21,
        "location_id": "11111111-1111-1111-1111-111111111111",
        "reason_code_id": 1000,
        "contact_id": null,
        "billing_zip": "12345",
        "billing_street": null,
        "product_transaction_id": "11e8de062c7eb8468ceda2c2",
        "tax": "0.00",
        "customer_ip": null,
        "customer_id": null,
        "po_number": null,
        "avs_enhanced": "N",
        "cvv_response": "N",
        "billing_phone": null,
        "billing_city": null,
        "billing_state": null,
        "clerk_number": null,
        "created_user_id": "11111111-1111-1111-1111-111111111111",
        "modified_user_id": "11111111-1111-1111-1111-111111111111",
        "settle_date": null,
        "charge_back_date": null,
        "void_date": null,
        "account_type": "mc",
        "is_recurring": false,
        "is_accountvault": false,
        "transaction_c1": null,
        "transaction_c2": null,
        "transaction_c3": null,
        "additional_amounts": [],
        "terminal_serial_number": null,
        "entry_mode_id": "K",
        "terminal_id": null,
        "quick_invoice_id": null,
        "ach_sec_code": null,
        "custom_data": null,
        "hosted_payment_page_id": null,
        "checkin_date": null,
        "checkout_date": null,
        "room_num": null,
        "room_rate": "0.00",
        "advance_deposit": false,
        "no_show": false,
        "emv_receipt_data": null,
        "_links": {
            "self": {
                "href": "{url}/v2/transactions/11e8de0660ed32b09377b9d7"
            }
        }
    }
}
```

AVS ONLY RESULT CODES

In the response above you will notice that there is a field "avs".  This field will hold the AVS result.

| Value  | Description                               |
|--------|-------------------------------------------|
| GOOD   | Street or zip are both good (if provided) |
| BAD    | Both street and zip do not match          |
| STREET | Street does not match                     |
| ZIP    | Zip does not match                        |
 

Perform a Refund from Previous Transaction
`POST /v2/transactions`

Request
```json
{
    "transaction": {
        "action": "refund",
        "payment_method": "cc",
        "previous_transaction_id": "{id_of_transaction_to_refund}",
        "transaction_amount": 1,
        "location_id": "{location_id}"
    }
}
```

Response
```json
{
    "transaction": {
        "id": "111111111111111111111111",
        "payment_method": "cc",
        "account_vault_id": null,
        "recurring_id": null,
        "first_six": "545454",
        "last_four": "5454",
        "account_holder_name": "",
        "transaction_amount": "1.00",
        "description": null,
        "transaction_code": null,
        "avs": "BAD",
        "batch": "11",
        "order_num": "285841214993",
        "verbiage": "Test 4608",
        "transaction_settlement_status": null,
        "effective_date": null,
        "routing": null,
        "return_date": null,
        "created_ts": 1637250374,
        "modified_ts": 1637250374,
        "transaction_api_id": null,
        "terms_agree": null,
        "notification_email_address": null,
        "notification_email_sent": true,
        "response_message": null,
        "auth_amount": "1.00",
        "auth_code": "",
        "status_id": 111,
        "type_id": 30,
        "location_id": "{location_id}",
        "reason_code_id": 1000,
        "contact_id": null,
        "billing_zip": "32615",
        "billing_street": "2831 NW 41st St STE J",
        "product_transaction_id": "",
        "tax": "0.00",
        "customer_ip": null,
        "customer_id": null,
        "po_number": null,
        "avs_enhanced": "N",
        "cvv_response": "N",
        "billing_phone": null,
        "billing_city": "",
        "billing_state": "",
        "clerk_number": null,
        "bill_payment": null,
        "created_user_id": "xxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "modified_user_id": "xxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "ach_identifier": null,
        "check_number": null,
        "settle_date": null,
        "charge_back_date": null,
        "void_date": null,
        "account_type": "mc",
        "is_recurring": false,
        "is_accountvault": true,
        "transaction_c1": null,
        "transaction_c2": null,
        "transaction_c3": null,
        "additional_amounts": [],
        "terminal_serial_number": null,
        "entry_mode_id": "K",
        "terminal_id": null,
        "quick_invoice_id": null,
        "ach_sec_code": null,
        "custom_data": null,
        "hosted_payment_page_id": null,
        "trx_source_id": 12,
        "transaction_batch_id": "",
        "recurring_flag": "no",
        "recurring_number": null,
        "installment_number": null,
        "installment_total_count": null,
        "emv_receipt_data": null,
        "_links": {
        "self": {
        "href": "[Host}/v2/transactions/{location_id}"
            }
        } 
    }
}
```

### Perform an Auth Only Transaction 
This can be used to "capture" funds for e-commerce, lodging, or other situations where the transaction will be settled later.

`POST /v2/transactions`

Request
```json
{
    "transaction": {
        "payment_method": "cc",
        "action": "authonly",
        "account_number":"5454545454545454",
        "exp_date": "0220",
        "transaction_amount": "120.00"
  }
}
```
Response
```json
{
    "transaction": {
        "id": "111111111111111111111111",
        "payment_method": "cc",
        "account_vault_id": null,
        "recurring_id": null,
        "first_six": "545454",
        "last_four": "5454",
        "account_holder_name": null,
        "transaction_amount": "120.00",
        "description": null,
        "transaction_code": null,
        "avs": null,
        "batch": null,
        "order_num": "996376148694",
        "verbiage": "Test 3474",
        "transaction_settlement_status": null,
        "effective_date": null,
        "routing": null,
        "return_date": null,
        "created_ts": 1637250810,
        "modified_ts": 1637250810,
        "transaction_api_id": null,
        "terms_agree": null,
        "notification_email_address": null,
        "notification_email_sent": true,
        "response_message": null,
        "auth_amount": "120.00",
        "auth_code": "4887ad",
        "status_id": 102,
        "type_id": 20,
        "location_id": "{location_id}",
        "reason_code_id": 1000,
        "contact_id": null,
        "billing_zip": null,
        "billing_street": null,
        "product_transaction_id": "",
        "tax": "0.00",
        "customer_ip": null,
        "customer_id": null,
        "po_number": null,
        "avs_enhanced": "V",
        "cvv_response": "N",
        "billing_phone": null,
        "billing_city": null,
        "billing_state": null,
        "clerk_number": null,
        "bill_payment": null,
        "created_user_id": "xxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "modified_user_id": "xxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "ach_identifier": null,
        "check_number": null,
        "settle_date": null,
        "charge_back_date": null,
        "void_date": null,
        "account_type": "mc",
        "is_recurring": false,
        "is_accountvault": false,
        "transaction_c1": null,
        "transaction_c2": null,
        "transaction_c3": null,
        "additional_amounts": [],
        "terminal_serial_number": null,
        "entry_mode_id": "K",
        "terminal_id": null,
        "quick_invoice_id": null,
        "ach_sec_code": null,
        "custom_data": null,
        "hosted_payment_page_id": null,
        "trx_source_id": 12,
        "transaction_batch_id": null,
        "recurring_flag": "no",
        "recurring_number": null,
        "installment_number": null,
        "installment_total_count": null,
        "emv_receipt_data": null,
        "_links": {
        "self": {
        "href": "{url}/v2/transactions/{location_id}"
            }
        } 
    }
}
```

### Perform a Complete
`PUT /v2/transactions/{id}`

Request
```json
{
        "transaction": {
            "action": "authcomplete",
            // Can provide transaction_amount for lesser amount than auth
            "transaction_amount": "60.00"
    }
}
```

Response
```json
{
    "transaction": {
        "id": "222222222222222222222222",
        "payment_method": "cc", 
        "account_vault_id": null,
        "recurring_id": null,
        "first_six": "545454",
        "last_four": "5454",
        "account_holder_name": null,
        "transaction_amount": "60.00",
        "description": null,
        "transaction_code": null, 
        "code": "AUTH",
        "avs": "BAD",
        "batch": "2",
        "item": "10",
        "order_num": "433659378839",
        "timestamp": "1421953180",
        "verbiage": "APPROVED",
        "transaction_settlement_status": null,
        "effective_date": null,
        "routing": null,
        "return_date": null,
        "created_ts": 1421951061, 
        "modified_ts": 1421953145,
        "transaction_api_id": null,
        "terms_agree": null,
        "notification_email_address": null, 
        "notification_email_sent": false,
        "response_message": null,
        "auth_amount": 1,
        "auth": "220093",
        "status_id": 101,
        "type_id": 20,
        "location_id": "{location_id}",
        "settle_date": null,
        "charge_back_date": null,
        "void_date": null,
        "account_type": "mc",
        "is_recurring": false,
        "checkin_date": null,
        "checkout_date": null,
        "room_num": null,
        "room_rate": null,
        "advance_deposit": false,
        "no_show": false,
        "folio_num": "433659378839",
        "_links": {
            "self": { 
                "href": "{url}/v2/transactions/{location_id}" 
            }
        } 
    }
}
```

### Perform AuthIncrement
`PUT /v2/transactions/{id}`

Request
```json
{
        "transaction": {
        "action": "authincrement",
        "transaction_amount": "100.00"
    }
}
```

Response
```json
{
        "transaction": {
        "id": "11ec59d672ead50e89cd0553",
        "payment_method": "cc",
        "account_vault_id": null,
        "recurring_id": null,
        "first_six": "545454",
        "last_four": "5454",
        "account_holder_name": null,
        "transaction_amount": "100.00",
        "description": null,
        "transaction_code": null,
        "avs": "BAD",
        "batch": null,
        "order_num": "SDKTest 1639153812",
        "verbiage": "Test 9986",
        "transaction_settlement_status": null,
        "effective_date": null,
        "routing": null,
        "return_date": null,
        "created_ts": 1639153812,
        "modified_ts": 1639153833,
        "transaction_api_id": "SDK1639153812",
        "terms_agree": null,
        "notification_email_address": "thlinux@gmail.com",
        "notification_email_sent": true,
        "response_message": null,
        "auth_amount": "1.00",
        "auth_code": "59d673",
        "status_id": 102,
        "type_id": 20,
        "location_id": "11e89734da2f694aa9450156",
        "reason_code_id": 1000,
        "contact_id": null,
        "billing_zip": "31405",
        "billing_street": "123 Main St",
        "product_transaction_id": "11e955741583f3d2b6993987",
        "tax": "0.00",
        "customer_ip": null,
        "customer_id": null,
        "po_number": "123456",
        "avs_enhanced": "N",
        "cvv_response": "M",
        "billing_phone": null,
        "billing_city": null,
        "billing_state": null,
        "clerk_number": null,
        "bill_payment": null,
        "created_user_id": "11e8dbbbf6d7c9cc929ae0a9",
        "modified_user_id": "11e8dbbbf6d7c9cc929ae0a9",
        "ach_identifier": null,
        "check_number": null,
        "settle_date": null,
        "charge_back_date": null,
        "void_date": null,
        "account_type": "mc",
        "is_recurring": false,
        "is_accountvault": false,
        "transaction_c1": null,
        "transaction_c2": null,
        "transaction_c3": null,
        "additional_amounts": [],
        "terminal_serial_number": null,
        "entry_mode_id": "K",
        "terminal_id": null,
        "quick_invoice_id": null,
        "ach_sec_code": null,
        "custom_data": {
        "item_name": "cog",
        "item_sku": "123456",
        "item_value": "1.00"
            },
        "hosted_payment_page_id": null,
        "trx_source_id": 12,
        "transaction_batch_id": null,
        "recurring_flag": "no",
        "recurring_number": null,
        "installment_number": null,
        "installment_total_count": null,
        "emv_receipt_data": null,
        "_links": {
        "self": {
        "href": "https://api.sandbox.payaconnect.com/v2/transactions/11ec59d672ead50e89cd0553"
            }
        }
    }
}
```




### Perform a Void
`PUT /v2/transactions/{id}`

Request
```json
{
    "transaction": {
        "action": "void"
    }
}
```
Response
```json
{
    "transaction": {
        "id": "222222222222222222222222",
        "payment_method": "cc", 
        "account_vault_id": null,
        "recurring_id": null,
        "first_six": "545454",
        "last_four": "5454",
        "account_holder_name": null,
        "transaction_amount": 0,
        "description": null,
        "transaction_code": null, 
        "code": "AUTH",
        "avs": "BAD",
        "batch": "2",
        "item": "10",
        "order_num": "433659378839",
        "timestamp": "1421953180",
        "verbiage": "APPROVED",
        "transaction_settlement_status": null,
        "effective_date": null,
        "routing": null,
        "return_date": null,
        "created_ts": 1421951061, 
        "modified_ts": 1421953145,
        "transaction_api_id": null,
        "terms_agree": null,
        "notification_email_address": null, 
        "notification_email_sent": false,
        "response_message": null,
        "auth_amount": 1,
        "auth": "220093",
        "status_id": 201,
        "type_id": 20,
        "location_id": "{location_id}",
        "settle_date": null,
        "charge_back_date": null,
        "void_date": null,
        "account_type": "mc",
        "is_recurring": false,
        "checkin_date": null,
        "checkout_date": null,
        "room_num": null,
        "room_rate": null,
        "advance_deposit": false,
        "no_show": false,
        "folio_num": "433659378839",
        "_links": {
            "self": { 
                "href": "{url}/v2/transactions/{location_id}" 
            }
        } 
    }
}
```

### Perform a Partial Reversal
`PUT /v2/transactions/{id}`

In a partial reversal, the transaction_amount should be less than the original auth or sale. The transaction_amount should be the final settlement amount that the auth or sale will be reduced to.

Request
```json
{
    "transaction": {
        "action": "partialreversal",
        "transaction_amount": 20.00
    }
}
```

Response
```json
{
    "transaction": {
        "id": "222222222222222222222222",
        "payment_method": "cc", 
        "account_vault_id": null,
        "recurring_id": null,
        "first_six": "545454",
        "last_four": "5454",
        "account_holder_name": null,
        "transaction_amount": 20.00,
        "description": null,
        "transaction_code": null, 
        "code": "AUTH",
        "avs": "BAD",
        "batch": "2",
        "item": "10",
        "order_num": "433659378839",
        "timestamp": "1421953180",
        "verbiage": "APPROVED",
        "transaction_settlement_status": null,
        "effective_date": null,
        "routing": null,
        "return_date": null,
        "created_ts": 1421951061, 
        "modified_ts": 1421953145,
        "transaction_api_id": null,
        "terms_agree": null,
        "notification_email_address": null, 
        "notification_email_sent": false,
        "response_message": null,
        "auth_amount": 1,
        "auth": "220093",
        "status_id": 201,
        "type_id": 20,
        "location_id": "{location_id}",
        "settle_date": null,
        "charge_back_date": null,
        "void_date": null,
        "account_type": "mc",
        "is_recurring": false,
        "checkin_date": null,
        "checkout_date": null,
        "room_num": null,
        "room_rate": null,
        "advance_deposit": false,
        "no_show": false,
        "folio_num": "433659378839",
        "_links": {
            "self": { 
                "href": "{url}/v2/transactions/{location_id}" 
            }
        } 
    }
}
```


### View Single Record
`GET /v2/transactions/{id}`

Request
```json
{
    // Empty Payload - Nothing needed here
}
```

Response
```json
{
    "transaction": {
        "id": "54c15673-0d7f-5e82-8664-382641c13d24",
        "payment_method": "cc",
        "account_vault_id": null,
        "recurring_id": null,
        "first_six": "545454",
        "last_four": "5454",
        "account_holder_name": null,
        "transaction_amount": 1,
        "description": null,
        "transaction_code": null,
        "code": "AUTH",
        "avs": "BAD", 
        "batch": "2",
        "item": "11",
        "order_num": "596128155714",
        "timestamp": 1421953584,
        "verbiage": "APPROVED", 
        "transaction_settlement_status": null,
        "effective_date": null,
        "routing": null,
        "return_date": null,
        "created_ts": 1421953549, 
        "modified_ts": null,
        "transaction_api_id": null,
        "terms_agree": null,
        "notification_email_address": null,
        "notification_email_sent": false,
        "response_message": null,
        "auth_amount": 1,
        "auth": "392194",
        "status_id": 101,
        "type_id": 20,
        "location_id": "{location_id}",
        "settle_date": null,
        "charge_back_date": null,
        "void_date": null,
        "account_type": "mc",
        "is_recurring": false,
        "checkin_date": null,
        "checkout_date": null,
        "room_num": null,
        "room_rate": null,
        "advance_deposit": false,
        "no_show": false,
        "folio_num": "596128155714",
        "tags": [
            {
                "id": "Test Tag",
                "title": "Test Tag"
            }
        ],
        "_links": {
            "self": { 
                "href": "{url}/v2/transactions/54c15673-0d7f-5e82-8664-382641c13d24"
            }
        }
    }
}
```

### View Record List
`GET /v2/transactions`

*Note:*

- Filters can be used to search for transactions by including the columns you want to filter on as **URL parameters**.
- Expands can be used to include additional data associated with a Transaction.  See [Expands]() further below for more details.

Request
```json
{
    // Empty Payload - Nothing needed here
}
```
Response
```json
{
    "transactions": [ 
        {
            "id": "54c1c28a-5506-4935-59c9-07757d1621e8", 
            "payment_method": "cc",
            "account_vault_id": null,           
            "recurring_id": null,
            "first_six": "545454",
            "last_four": "5454",
            "account_holder_name": null,
            "transaction_amount": 0,
            "description": null,
            "transaction_code": null,
            "code": "AUTH",
            "avs": "BAD",
            "batch": "2",
            "item": "10",
            "order_num": "433659378839",
            "timestamp": 1421953180,
            "verbiage": "APPROVED",
            "transaction_settlement_status": null,
            "effective_date": null,
            "routing": null,
            "return_date": null,
            "created_ts": 1421951061,
            "modified_ts": 1421953145,
            "transaction_api_id": null,
            "terms_agree": null,
            "notification_email_address": null,
            "notification_email_sent": false,
            "response_message": null,
            "auth_amount": 1,
            "auth": "220093",
            "status_id": 201,
            "type_id": 20,
            "location_id": "{location_id}",
            "settle_date": null,
            "charge_back_date": null,
            "void_date": false,
            "account_type": "mc",
            "is_recurring": false,
            "checkin_date": null,
            "checkout_date": null,
            "room_num": null,
            "room_rate": null,
            "advance_deposit": false,
            "no_show": false,
            "folio_num": "433659378839",
            "_links": {
                "self": {
                    "href": "{url}/v2/transactions/54c1c28a-5506-4935-59c9-07757d1621e8"
                }
            }
        },
        {
            "id": "54c15673-0d7f-5e82-8664-382641c13d24",
            "payment_method": "cc",
            "account_vault_id": null,
            "recurring_id": null,
            "first_six": "545454",
            "last_four": "5454",
            "account_holder_name": null,
            "transaction_amount": 1,
            "description": null,
            "transaction_code": null,
            "code": "AUTH",
            "avs": "BAD",
            "batch": "2",
            "item": "11",
            "order_num": "596128155714",
            "timestamp": 1421953584,
            "verbiage": "APPROVED",
            "transaction_settlement_status": null,
            "effective_date": null,
            "routing": null,
            "return_date": null,
            "created_ts": 1421953549, 
            "modified_ts": null,
            "transaction_api_id": null,
            "terms_agree": null,
            "notification_email_address": null,
            "notification_email_sent": false,
            "response_message": null,
            "auth_amount": 1,
            "auth": "392194",
            "status_id": 101,
            "type_id": 20,
            "location_id": "{location_id}",
            "settle_date": null,
            "charge_back_date": null,
            "void_date": null,
            "account_type": "mc",
            "is_recurring": false,
            "checkin_date": null,
            "checkout_date": null,
            "room_num": null,
            "room_rate": null,
            "advance_deposit": false,
            "no_show": false,
            "folio_num": "596128155714",
            "_links": {
                "self": {
                    "href": "{url}/v2/transactions/54c15673-0d7f-5e82-8664-382641c13d24"
                }
            }
        },
        ... // other transactions here
    ],
    "meta": {
        "pagination": {
            "links": {
                "self": {
                    "href": "{url}/v2/transactions?page_size=3&location_id=54c105a8-46e2-9769-3cf2-63aeb95d29b3&page=1"
                },
                "next": {
                    "href": "{url}/v2/transactions?page_size=3&location_id=54c105a8-46e2-9769-3cf2-63aeb95d29b3&page=2"
                },
                "last": {
                    "href": "{url}/v2/transactions?page_size=3&location_id=54c105a8-46e2-9769-3cf2-63aeb95d29b3&page=5"
                }
            },
            "totalCount": 14,
            "pageCount": 5,
            "currentPage": 0,
            "perPage": 3
        },
        "sort": {
            "attributes": {
                "id": "desc"
            } 
        }
    }
}
```

**Searching for Records**

There are a number of filters that can be used to search for transactions by including them as querystring parameters in your Request URL.  Below you will find examples for a few use cases although we encourage you to take a look at the full Filters list to consider additional strategies that can be used for finding transactions.

### Quick Invoice Payments
By using the trx_source_id field as a querystring parameter we can search for transactions tied to Quick Invoices like so:

`GET /v2/transactions?trx_source_id=8`

You can add additional parameters to narrow your results even further like so:

`GET /v2/transactions?trx_source_id=8&created_ts=custom&created_ts_from=1556424000&created_ts_to=1556683199`

 
**Editing a Transaction**

- If contact_id is provided, ensure it belongs to the same location as the transaction.  You cannot move a transaction across locations.
- Only the fields depicted below are allowed for action of "edit" although which fields are necessary depend on the desired result.

`PUT /v2/transactions/{id}`

Request
```json
{
    "transaction": {
        "action": "edit",
        "contact_id": "123abc",
        "move_account_vault" : 1,
        "move_account_vault_transactions" : 1,
        "description" : "this is a description"
        }
}
```
Response
```json
{
    "transaction": {
        "id": "111111111111111111111111",
        "payment_method": "cc",
        "account_vault_id": null,
        "recurring_id": null,
        "first_six": "545454",
        "last_four": "5454",
        "account_holder_name": null,
        "transaction_amount": "50.00",
        "description": "this is a description",
        "transaction_code": null,
        "avs": null,
        "batch": "5",
        "order_num": "997504408577",
        "verbiage": "Test 8430",
        "transaction_settlement_status": null,
        "effective_date": null,
        "routing": null,
        "return_date": null,
        "created_ts": 1635442609,
        "modified_ts": 1637175933,
        "transaction_api_id": null,
        "terms_agree": null,
        "notification_email_address": null,
        "notification_email_sent": true,
        "response_message": null,
        "auth_amount": "150.00",
        "auth_code": "3815a1",
        "status_id": 101,
        "type_id": 20,
        "location_id": "{location_id}",
        "reason_code_id": 1001,
        "contact_id": "123abc",
        "billing_zip": null,
        "billing_street": null,
        "tax": "0.00",
        "customer_ip": null,
        "customer_id": null,
        "po_number": null,
        "avs_enhanced": "V",
        "cvv_response": "N",
        "billing_phone": null,
        "billing_city": null,
        "billing_state": null,
        "clerk_number": null,
        "bill_payment": null,
        "ach_identifier": null,
        "check_number": null,
        "settle_date": null,
        "charge_back_date": null,
        "void_date": null,
        "account_type": "mc",
        "is_recurring": false,
        "is_accountvault": false,
        "transaction_c1": null,
        "transaction_c2": null,
        "transaction_c3": null,
        "additional_amounts": [],
        "terminal_serial_number": null,
        "entry_mode_id": "K",
        "terminal_id": null,
        "quick_invoice_id": null,
        "ach_sec_code": null,
        "custom_data": null,
        "hosted_payment_page_id": null,
        "trx_source_id": 12,
        "recurring_flag": "no",
        "recurring_number": null,
        "installment_number": null,
        "installment_total_count": null,
        "emv_receipt_data": null,
        "_links": {
        "self": {
        "href": "{url}/v2/transactions/{location_id}"
                }
            } 
        }
}
```


EDIT ACTION FIELD PURPOSE

| Field                           | Purpose                                                                                                                                |
|---------------------------------|----------------------------------------------------------------------------------------------------------------------------------------|
| contact_id                      | Used to associate a transaction with a specific Contact. Can be set to "" to disassociate from current Contact.                        |
| move_account_vault              | Used to indicate that the account vault associated with the transaction should also be moved to the provided contact_id.               |
| move_account_vault_transactions | Used to indicate that all of the transactions linked to the account_vault being moved should also be moved to the provided contact_id. |
| description                     | Used to provide a note or explanation for a transaction.                                                                               |
| tags                            | Used to apply tags to a transaction.                                                                                                   |

### Get BIN Info

For more information on BIN Info including the purpose of each field returned and the possible values for each take a look at our BIN Info documentation.

`GET /v2/transactions/{id}/bininfo`

Request
```json
{
  "transaction": {
    "action": "debit",
    "payment_method": "ach",
    "transaction_amount": "10.00",
    "product_transaction_id": "22222-22222-22222-22222",
    "location_id": "11111-11111-11111-11111",
    "ach_sec_code": "WEB",
    "account_holder_name": "Test Account",
    "account_type": "checking",
    "account_number": "01234567890",
    "routing": "072000326",
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "billing_phone": "7894561230",
    "dob_year": "1990",
    "ssn4": "1234",
    "dl_number": "012345678",
    "dl_state": "GA"
  }
}

```

Response
```json
{
  "transaction": {
    "id": "11eb8bd6c1c86b7e89868db3",
    "payment_method": "ach",
    "account_vault_id": null,
    "recurring_id": null,
    "first_six": null,
    "last_four": "7890",
    "account_holder_name": "Test Account",
    "transaction_amount": "10.00",
    "description": null,
    "transaction_code": null,
    "avs": null,
    "batch": null,
    "order_num": "653743597474",
    "verbiage": "Test 1658",
    "transaction_settlement_status": null,
    "effective_date": null,
    "routing": "072000326",
    "return_date": null,
    "created_ts": 1616504005,
    "modified_ts": 1616504005,
    "transaction_api_id": null,
    "terms_agree": null,
    "notification_email_address": null,
    "notification_email_sent": true,
    "response_message": null,
    "auth_amount": "10.00",
    "auth_code": "AUTH NUM 272-172",
    "status_id": 131,
    "type_id": 50,
    "location_id": "11111-11111-11111-11111",
    "reason_code_id": 1000,
    "contact_id": null,
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "product_transaction_id": "22222-22222-22222-22222",
    "tax": "0.00",
    "customer_ip": null,
    "customer_id": null,
    "po_number": null,
    "avs_enhanced": null,
    "cvv_response": null,
    "billing_phone": "7894561230",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "clerk_number": null,
    "created_user_id": "11e919aa3d639af2a5c5d689",
    "modified_user_id": "11e919aa3d639af2a5c5d689",
    "ach_identifier": null,
    "check_number": null,
    "settle_date": null,
    "charge_back_date": null,
    "void_date": null,
    "account_type": "checking",
    "is_recurring": false,
    "is_accountvault": false,
    "transaction_c1": null,
    "transaction_c2": null,
    "transaction_c3": null,
    "additional_amounts": [],
    "terminal_serial_number": null,
    "entry_mode_id": "K",
    "terminal_id": null,
    "quick_invoice_id": null,
    "ach_sec_code": "WEB",
    "custom_data": null,
    "hosted_payment_page_id": null,
    "trx_source_id": 12,
    "transaction_batch_id": null,
    "checkin_date": null,
    "checkout_date": null,
    "room_num": null,
    "room_rate": "0.00",
    "advance_deposit": false,
    "no_show": false,
    "emv_receipt_data": null,
    "_links": {
      "self": {
        "href": "https://api.sandbox.payaconnect.com/v2/transactions/11eb8bd6c1c86b7e89868db3"
      }
    }
  }
}
```
 

## Paya ACH
### Perform a WEB Debit

`POST /v2/transactions`

The action “debit” is used to move funds from the account holder to the merchant. The SEC code of WEB indicates that this is a customer-initiated Check by Web transaction. See WEB within the [Paya ACH Authorization Requirements]() for more details.

 

Request
```json
{
  "transaction": {
    "action": "debit",
    "payment_method": "ach",
    "transaction_amount": "10.00",
    "product_transaction_id": "22222-22222-22222-22222",
    "location_id": "11111-11111-11111-11111",
    "ach_sec_code": "WEB",
    "account_holder_name": "Test Account",
    "account_type": "checking",
    "account_number": "01234567890",
    "routing": "072000326",
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "billing_phone": "7894561230",
    "dob_year": "1990",
    "ssn4": "1234",
    "dl_number": "012345678",
    "dl_state": "GA"
  }
}

```
Response
```json
{
  "transaction": {
    "id": "11eb8bd6c1c86b7e89868db3",
    "payment_method": "ach",
    "account_vault_id": null,
    "recurring_id": null,
    "first_six": null,
    "last_four": "7890",
    "account_holder_name": "Test Account",
    "transaction_amount": "10.00",
    "description": null,
    "transaction_code": null,
    "avs": null,
    "batch": null,
    "order_num": "653743597474",
    "verbiage": "Test 1658",
    "transaction_settlement_status": null,
    "effective_date": null,
    "routing": "072000326",
    "return_date": null,
    "created_ts": 1616504005,
    "modified_ts": 1616504005,
    "transaction_api_id": null,
    "terms_agree": null,
    "notification_email_address": null,
    "notification_email_sent": true,
    "response_message": null,
    "auth_amount": "10.00",
    "auth_code": "AUTH NUM 272-172",
    "status_id": 131,
    "type_id": 50,
    "location_id": "11111-11111-11111-11111",
    "reason_code_id": 1000,
    "contact_id": null,
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "product_transaction_id": "22222-22222-22222-22222",
    "tax": "0.00",
    "customer_ip": null,
    "customer_id": null,
    "po_number": null,
    "avs_enhanced": null,
    "cvv_response": null,
    "billing_phone": "7894561230",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "clerk_number": null,
    "created_user_id": "11e919aa3d639af2a5c5d689",
    "modified_user_id": "11e919aa3d639af2a5c5d689",
    "ach_identifier": null,
    "check_number": null,
    "settle_date": null,
    "charge_back_date": null,
    "void_date": null,
    "account_type": "checking",
    "is_recurring": false,
    "is_accountvault": false,
    "transaction_c1": null,
    "transaction_c2": null,
    "transaction_c3": null,
    "additional_amounts": [],
    "terminal_serial_number": null,
    "entry_mode_id": "K",
    "terminal_id": null,
    "quick_invoice_id": null,
    "ach_sec_code": "WEB",
    "custom_data": null,
    "hosted_payment_page_id": null,
    "trx_source_id": 12,
    "transaction_batch_id": null,
    "checkin_date": null,
    "checkout_date": null,
    "room_num": null,
    "room_rate": "0.00",
    "advance_deposit": false,
    "no_show": false,
    "emv_receipt_data": null,
    "_links": {
      "self": {
        "href": "https://api.sandbox.payaconnect.com/v2/transactions/11eb8bd6c1c86b7e89868db3"
      }
    }
  }
}
```

### Perform a WEB Debit from an Account Vault
`POST /v2/transactions`

The action “debit” is used to move funds from the account holder to the merchant. This request will pull the account information from the account_vault_id. The SEC code of WEB indicates that this is a customer-initiated Check by Web transaction. See WEB within the [Paya ACH Authorization Requirements]() for more details.

Request
```json
{
  "transaction": {
    "action": "debit",
    "payment_method": "ach",
    "transaction_amount": "10.00",
    "product_transaction_id": "22222-22222-22222-22222",
    "location_id": "11111-11111-11111-11111",
    "ach_sec_code": "WEB",
    "account_vault_id": "{account_vault_id}",
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "billing_phone": "7894561230",
    "dob_year": "1990",
    "ssn4": "1234",
    "dl_number": "012345678",
    "dl_state": "GA"
  }
}

```
Response
```json
{
  "transaction": {
    "id": "11eb8bdf6cfe0f9684c6b24f",
    "payment_method": "ach",
    "account_vault_id": "{account_vault_id}",
    "recurring_id": null,
    "first_six": null,
    "last_four": "7890",
    "account_holder_name": "John Smith",
    "transaction_amount": "10.00",
    "description": null,
    "transaction_code": null,
    "avs": null,
    "batch": null,
    "order_num": "647097660274",
    "verbiage": "Test 6378",
    "transaction_settlement_status": null,
    "effective_date": null,
    "routing": "072000326",
    "return_date": null,
    "created_ts": 1616507728,
    "modified_ts": 1616507728,
    "transaction_api_id": null,
    "terms_agree": null,
    "notification_email_address": null,
    "notification_email_sent": true,
    "response_message": null,
    "auth_amount": "10.00",
    "auth_code": "AUTH NUM 272-172",
    "status_id": 131,
    "type_id": 50,
    "location_id": "11111-11111-11111-11111",
    "reason_code_id": 1000,
    "contact_id": null,
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "product_transaction_id": "22222-22222-22222-22222",
    "tax": "0.00",
    "customer_ip": null,
    "customer_id": null,
    "po_number": null,
    "avs_enhanced": null,
    "cvv_response": null,
    "billing_phone": "7894561230",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "clerk_number": null,
    "created_user_id": "11e919aa3d639af2a5c5d689",
    "modified_user_id": "11e919aa3d639af2a5c5d689",
    "ach_identifier": null,
    "check_number": null,
    "settle_date": null,
    "charge_back_date": null,
    "void_date": null,
    "account_type": "checking",
    "is_recurring": false,
    "is_accountvault": true,
    "transaction_c1": null,
    "transaction_c2": null,
    "transaction_c3": null,
    "additional_amounts": [],
    "terminal_serial_number": null,
    "entry_mode_id": "K",
    "terminal_id": null,
    "quick_invoice_id": null,
    "ach_sec_code": "WEB",
    "custom_data": null,
    "hosted_payment_page_id": null,
    "trx_source_id": 12,
    "transaction_batch_id": null,
    "checkin_date": null,
    "checkout_date": null,
    "room_num": null,
    "room_rate": "0.00",
    "advance_deposit": false,
    "no_show": false,
    "emv_receipt_data": null,
    "_links": {
      "self": {
        "href": "https://api.sandbox.payaconnect.com/v2/transactions/11eb8bdf6cfe0f9684c6b24f"
      }
    }
  }
}
```

### Perform a PPD/CCD Debit
`POST /v2/transactions`

The action “debit” is used to move funds from the account holder to the merchant. The SEC codes of PPD or CCD indicate that this is a merchant-initiated transaction. See PPD and CCD within the [Paya ACH Authorization Requirements]() for more details.

Request
```json
{
  "transaction": {
    "action": "debit",
    "payment_method": "ach",
    "transaction_amount": "10.00",
    "product_transaction_id": "22222-22222-22222-22222",
    "location_id": "11111-11111-11111-11111",
    "ach_sec_code": "PPD",
    "account_holder_name": "Test Account",
    "account_type": "checking",
    "account_number": "01234567890",
    "routing": "072000326",
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "billing_phone": "7894561230",
    "dob_year": "1990",
    "ssn4": "1234",
    "dl_number": "012345678",
    "dl_state": "GA"
  }
}
```
Response
```json
{
  "transaction": {
    "id": "11eb8be325b50c9eab332ec7",
    "payment_method": "ach",
    "account_vault_id": null,
    "recurring_id": null,
    "first_six": null,
    "last_four": "7890",
    "account_holder_name": "Test Account",
    "transaction_amount": "10.00",
    "description": null,
    "transaction_code": null,
    "avs": null,
    "batch": null,
    "order_num": "470049304391",
    "verbiage": "Test 8194",
    "transaction_settlement_status": null,
    "effective_date": null,
    "routing": "072000326",
    "return_date": null,
    "created_ts": 1616509327,
    "modified_ts": 1616509327,
    "transaction_api_id": null,
    "terms_agree": null,
    "notification_email_address": null,
    "notification_email_sent": true,
    "response_message": null,
    "auth_amount": "10.00",
    "auth_code": "AUTH NUM 272-172",
    "status_id": 131,
    "type_id": 50,
    "location_id": "11111-11111-11111-11111",
    "reason_code_id": 1000,
    "contact_id": null,
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "product_transaction_id": "22222-22222-22222-22222",
    "tax": "0.00",
    "customer_ip": null,
    "customer_id": null,
    "po_number": null,
    "avs_enhanced": null,
    "cvv_response": null,
    "billing_phone": "7894561230",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "clerk_number": null,
    "created_user_id": "11e919aa3d639af2a5c5d689",
    "modified_user_id": "11e919aa3d639af2a5c5d689",
    "ach_identifier": null,
    "check_number": null,
    "settle_date": null,
    "charge_back_date": null,
    "void_date": null,
    "account_type": "checking",
    "is_recurring": false,
    "is_accountvault": false,
    "transaction_c1": null,
    "transaction_c2": null,
    "transaction_c3": null,
    "additional_amounts": [],
    "terminal_serial_number": null,
    "entry_mode_id": "K",
    "terminal_id": null,
    "quick_invoice_id": null,
    "ach_sec_code": "PPD",
    "custom_data": null,
    "hosted_payment_page_id": null,
    "trx_source_id": 12,
    "transaction_batch_id": null,
    "checkin_date": null,
    "checkout_date": null,
    "room_num": null,
    "room_rate": "0.00",
    "advance_deposit": false,
    "no_show": false,
    "emv_receipt_data": null,
    "_links": {
      "self": {
        "href": "https://api.sandbox.payaconnect.com/v2/transactions/11eb8be325b50c9eab332ec7"
      }
    }
  }
}
```
Perform a PPD/CCD Debit from an Account Vault
`POST /v2/transactions`

The action “debit” is used to move funds from the account holder to the merchant. This request will pull the account information from the account_vault_id. The SEC codes of PPD or CCD indicate that this is a merchant-initiated transaction. See PPD and CCD within the [Paya ACH Authorization Requirements]() for more details.

Request
```json
{
  "transaction": {
    "action": "debit",
    "payment_method": "ach",
    "transaction_amount": "10.00",
    "product_transaction_id": "22222-22222-22222-22222",
    "location_id": "11111-11111-11111-11111",
    "ach_sec_code": "PPD",
    "account_vault_id": "{account_vault_id}",
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "billing_phone": "7894561230",
    "dob_year": "1990",
    "ssn4": "1234",
    "dl_number": "012345678",
    "dl_state": "GA"
  }
}
```
Response
```json
{
  "transaction": {
    "id": "11eb8be4ff7b0d16b7712c69",
    "payment_method": "ach",
    "account_vault_id": "11eb8bdf1ae2385e9ec6747a",
    "recurring_id": null,
    "first_six": null,
    "last_four": "7890",
    "account_holder_name": "John Smith",
    "transaction_amount": "10.00",
    "description": null,
    "transaction_code": null,
    "avs": null,
    "batch": null,
    "order_num": "866554279940",
    "verbiage": "Test 5785",
    "transaction_settlement_status": null,
    "effective_date": null,
    "routing": "072000326",
    "return_date": null,
    "created_ts": 1616509692,
    "modified_ts": 1616509692,
    "transaction_api_id": null,
    "terms_agree": null,
    "notification_email_address": null,
    "notification_email_sent": true,
    "response_message": null,
    "auth_amount": "10.00",
    "auth_code": "AUTH NUM 272-172",
    "status_id": 131,
    "type_id": 50,
    "location_id": "11111-11111-11111-11111",
    "reason_code_id": 1000,
    "contact_id": null,
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "product_transaction_id": "22222-22222-22222-22222",
    "tax": "0.00",
    "customer_ip": null,
    "customer_id": null,
    "po_number": null,
    "avs_enhanced": null,
    "cvv_response": null,
    "billing_phone": "7894561230",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "clerk_number": null,
    "created_user_id": "11e919aa3d639af2a5c5d689",
    "modified_user_id": "11e919aa3d639af2a5c5d689",
    "ach_identifier": null,
    "check_number": null,
    "settle_date": null,
    "charge_back_date": null,
    "void_date": null,
    "account_type": "checking",
    "is_recurring": false,
    "is_accountvault": true,
    "transaction_c1": null,
    "transaction_c2": null,
    "transaction_c3": null,
    "additional_amounts": [],
    "terminal_serial_number": null,
    "entry_mode_id": "K",
    "terminal_id": null,
    "quick_invoice_id": null,
    "ach_sec_code": "PPD",
    "custom_data": null,
    "hosted_payment_page_id": null,
    "trx_source_id": 12,
    "transaction_batch_id": null,
    "checkin_date": null,
    "checkout_date": null,
    "room_num": null,
    "room_rate": "0.00",
    "advance_deposit": false,
    "no_show": false,
    "emv_receipt_data": null,
    "_links": {
      "self": {
        "href": "https://api.sandbox.payaconnect.com/v2/transactions/11eb8be4ff7b0d16b7712c69"
      }
    }
  }
}
```

### Perform a Credit

`POST /v2/transactions`

The action “credit” is used to move funds from the merchant to the account holder. This is typically utilized to initiate a refund to the account holder. The SEC code of CCD is used for all merchant-initiated ACH “credit” requests.

Request
```json
{
  "transaction": {
    "action": "credit",
    "payment_method": "ach",
    "transaction_amount": "10.00",
    "product_transaction_id": "22222-22222-22222-22222",
    "location_id": "11111-11111-11111-11111",
    "ach_sec_code": "CCD",
    "account_holder_name": "Test Account",
    "account_type": "checking",
    "account_number": "01234567890",
    "routing": "072000326",
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "billing_phone": "7894561230",
    "dob_year": "1990",
    "ssn4": "1234",
    "dl_number": "012345678",
    "dl_state": "GA"
  }
}
```

Response
```json
{
  "transaction": {
    "id": "11eb8be829fec09cc04463c8",
    "payment_method": "ach",
    "account_vault_id": null,
    "recurring_id": null,
    "first_six": null,
    "last_four": "7890",
    "account_holder_name": "Test Account",
    "transaction_amount": "10.00",
    "description": null,
    "transaction_code": null,
    "avs": null,
    "batch": null,
    "order_num": "360174578795",
    "verbiage": "Test 5710",
    "transaction_settlement_status": null,
    "effective_date": null,
    "routing": "072000326",
    "return_date": null,
    "created_ts": 1616511481,
    "modified_ts": 1616511481,
    "transaction_api_id": null,
    "terms_agree": null,
    "notification_email_address": null,
    "notification_email_sent": true,
    "response_message": null,
    "auth_amount": "10.00",
    "auth_code": "AUTH NUM 272-172",
    "status_id": 131,
    "type_id": 40,
    "location_id": "11111-11111-11111-11111",
    "reason_code_id": 1000,
    "contact_id": null,
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "product_transaction_id": "22222-22222-22222-22222",
    "tax": "0.00",
    "customer_ip": null,
    "customer_id": null,
    "po_number": null,
    "avs_enhanced": null,
    "cvv_response": null,
    "billing_phone": "7894561230",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "clerk_number": null,
    "created_user_id": "11e919aa3d639af2a5c5d689",
    "modified_user_id": "11e919aa3d639af2a5c5d689",
    "ach_identifier": null,
    "check_number": null,
    "settle_date": null,
    "charge_back_date": null,
    "void_date": null,
    "account_type": "checking",
    "is_recurring": false,
    "is_accountvault": false,
    "transaction_c1": null,
    "transaction_c2": null,
    "transaction_c3": null,
    "additional_amounts": [],
    "terminal_serial_number": null,
    "entry_mode_id": "K",
    "terminal_id": null,
    "quick_invoice_id": null,
    "ach_sec_code": "CCD",
    "custom_data": null,
    "hosted_payment_page_id": null,
    "trx_source_id": 12,
    "transaction_batch_id": null,
    "checkin_date": null,
    "checkout_date": null,
    "room_num": null,
    "room_rate": "0.00",
    "advance_deposit": false,
    "no_show": false,
    "emv_receipt_data": null,
    "_links": {
      "self": {
        "href": "https://api.sandbox.payaconnect.com/v2/transactions/11eb8be829fec09cc04463c8"
      }
    }
  }
}
```


### Perform a Credit from a Previous Transaction
`POST /v2/transactions`

The action “credit” is used to move funds from the merchant to the account holder. This is typically utilized to initiate a refund to the account holder. The SEC code of CCD is used for all merchant-initiated ACH “credit” requests. This request utilizes the transaction_id from a previous “debit” request in place of the account information.

Request
```json
{
  "transaction": {
    "action": "credit",
    "payment_method": "ach",
    "transaction_amount": "10.00",
    "product_transaction_id": "22222-22222-22222-22222",
    "location_id": "11111-11111-11111-11111",
    "ach_sec_code": "CCD",
    "previous_transaction_id": "{transaction_id}",
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "billing_phone": "7894561230",
    "dob_year": "1990",
    "ssn4": "1234",
    "dl_number": "012345678",
    "dl_state": "GA"
  }
}
```

Response
```json
{
  "transaction": {
    "id": "11eb8be9838349169ec53b8e",
    "payment_method": "ach",
    "account_vault_id": null,
    "recurring_id": null,
    "first_six": null,
    "last_four": "7890",
    "account_holder_name": "Test Account",
    "transaction_amount": "10.00",
    "description": null,
    "transaction_code": null,
    "avs": null,
    "batch": null,
    "order_num": "042679827978",
    "verbiage": "Test 6714",
    "transaction_settlement_status": null,
    "effective_date": null,
    "routing": "072000326",
    "return_date": null,
    "created_ts": 1616512061,
    "modified_ts": 1616512061,
    "transaction_api_id": null,
    "terms_agree": null,
    "notification_email_address": null,
    "notification_email_sent": true,
    "response_message": null,
    "auth_amount": "10.00",
    "auth_code": "AUTH NUM 272-172",
    "status_id": 131,
    "type_id": 40,
    "location_id": "11e919aa3c4a4ed6a04860ff",
    "reason_code_id": 1000,
    "contact_id": null,
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "product_transaction_id": "11ea4f51cb20259e9187cd73",
    "tax": "0.00",
    "customer_ip": null,
    "customer_id": null,
    "po_number": null,
    "avs_enhanced": null,
    "cvv_response": null,
    "billing_phone": "7894561230",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "clerk_number": null,
    "created_user_id": "11e919aa3d639af2a5c5d689",
    "modified_user_id": "11e919aa3d639af2a5c5d689",
    "ach_identifier": null,
    "check_number": null,
    "settle_date": null,
    "charge_back_date": null,
    "void_date": null,
    "account_type": "checking",
    "is_recurring": false,
    "is_accountvault": false,
    "transaction_c1": null,
    "transaction_c2": null,
    "transaction_c3": null,
    "additional_amounts": [],
    "terminal_serial_number": null,
    "entry_mode_id": "K",
    "terminal_id": null,
    "quick_invoice_id": null,
    "ach_sec_code": "CCD",
    "custom_data": null,
    "hosted_payment_page_id": null,
    "trx_source_id": 12,
    "transaction_batch_id": null,
    "checkin_date": null,
    "checkout_date": null,
    "room_num": null,
    "room_rate": "0.00",
    "advance_deposit": false,
    "no_show": false,
    "emv_receipt_data": null,
    "_links": {
      "self": {
        "href": "https://api.sandbox.payaconnect.com/v2/transactions/11eb8be9838349169ec53b8e"
      }
    }
  }
}
```


### Perform a Credit from an Account Vault
`POST /v2/transactions`

The action “credit” is used to move funds from the merchant to the account holder. This is typically utilized to initiate a refund to the account holder. The SEC code of CCD is used for all merchant-initiated ACH “credit” requests. This request utilizes the account_vault_id in place of the account information.

Request
```json
{
  "transaction": {
    "action": "credit",
    "payment_method": "ach",
    "transaction_amount": "10.00",
    "product_transaction_id": "22222-22222-22222-22222",
    "location_id": "11111-11111-11111-11111",
    "ach_sec_code": "CCD",
    "account_vault_id": "{account_vault_id}",
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "billing_phone": "7894561230",
    "dob_year": "1990",
    "ssn4": "1234",
    "dl_number": "012345678",
    "dl_state": "GA"
  }
}
```
Response
```json
{
  "transaction": {
    "id": "11eb8beacbc797a8a505a08b",
    "payment_method": "ach",
    "account_vault_id": "{account_vault_id}",
    "recurring_id": null,
    "first_six": null,
    "last_four": "7890",
    "account_holder_name": "John Smith",
    "transaction_amount": "10.00",
    "description": null,
    "transaction_code": null,
    "avs": null,
    "batch": null,
    "order_num": "533458045552",
    "verbiage": "Test 9280",
    "transaction_settlement_status": null,
    "effective_date": null,
    "routing": "072000326",
    "return_date": null,
    "created_ts": 1616512612,
    "modified_ts": 1616512612,
    "transaction_api_id": null,
    "terms_agree": null,
    "notification_email_address": null,
    "notification_email_sent": true,
    "response_message": null,
    "auth_amount": "10.00",
    "auth_code": "AUTH NUM 272-172",
    "status_id": 131,
    "type_id": 40,
    "location_id": "11111-11111-11111-11111",
    "reason_code_id": 1000,
    "contact_id": null,
    "billing_zip": "30346",
    "billing_street": "123 Main St",
    "product_transaction_id": "22222-22222-22222-22222",
    "tax": "0.00",
    "customer_ip": null,
    "customer_id": null,
    "po_number": null,
    "avs_enhanced": null,
    "cvv_response": null,
    "billing_phone": "7894561230",
    "billing_city": "Atlanta",
    "billing_state": "GA",
    "clerk_number": null,
    "created_user_id": "11e919aa3d639af2a5c5d689",
    "modified_user_id": "11e919aa3d639af2a5c5d689",
    "ach_identifier": null,
    "check_number": null,
    "settle_date": null,
    "charge_back_date": null,
    "void_date": null,
    "account_type": "checking",
    "is_recurring": false,
    "is_accountvault": true,
    "transaction_c1": null,
    "transaction_c2": null,
    "transaction_c3": null,
    "additional_amounts": [],
    "terminal_serial_number": null,
    "entry_mode_id": "K",
    "terminal_id": null,
    "quick_invoice_id": null,
    "ach_sec_code": "CCD",
    "custom_data": null,
    "hosted_payment_page_id": null,
    "trx_source_id": 12,
    "transaction_batch_id": null,
    "checkin_date": null,
    "checkout_date": null,
    "room_num": null,
    "room_rate": "0.00",
    "advance_deposit": false,
    "no_show": false,
    "emv_receipt_data": null,
    "_links": {
      "self": {
        "href": "https://api.sandbox.payaconnect.com/v2/transactions/11eb8beacbc797a8a505a08b"
      }
    }
  }
}
```


### Paya ACH Authorization Requirements
#### Authorization Page - PPD

PPD is for prearranged payment and deposit entries on personal bank account in which the Receiver is required to complete a written authorization form and must provide physical or digital signature. Digital signatures must be compliant with the ESign Act.

Additionally, the authorization must provide the Receiver with the method to revoke his authorization by notifying the Originator in the manner prescribed, and the time frame in which the revocation of the authorization must be provided.

The Originator (Merchant) must have the following verbiage (or substantially similar) on the written authorization form:

> By signing below, I authorize the Merchant to convert this transaction into an Electronic Funds Transfer transaction or paper draft, and to debit this account for the amount as identified above and to the terms stated here. This authorization shall remain in effect until the Merchant receives written notification from me of intent to terminate at such time and in such manner as to afford the Merchant a reasonable opportunity to act. I authorize this plan to continue as long as the payment amount remains unchanged until the amount owed the Merchant is paid off, or unless the plan is terminated earlier by me as stated above. I understand that all changes such as payment amount, frequency, bank account number change, will require a new ACH Debit Payment Authorization Form to be filled out and submitted to Merchant 15 days prior to any change being implemented.
>
> In the event that I choose to revoke this authorization, I will do so by contacting the merchant directly. Processing times may not allow for revocation of this authorization.
>
>I understand that this payment plan may be cancelled by the Merchant due to NSF (Non-sufficient Funds). In the event this draft or EFT is returned unpaid, I will be liable to pay an NSF fee of $25.00 (or the amount allowable by law), that may be automatically debited to this bank account via draft or EFT for each NSF.

#### Authorization Page - CCD
CCD is for Corporate Credit or Debit entries on business bank accounts in which the Receiver is required to complete a written authorization form, contract, or agreement that with the Originator and Receiver have both agreed to be bound by the ACH Rules and the Receiver must provide physical or digital signature. Digital signatures must be compliant with the ESign Act.

Additionally, the authorization must provide the Receiver with the method to revoke his authorization by notifying the Originator in the manner prescribed, and the time frame in which the revocation of the authorization must be provided.

The Originator (Merchant) must have the following verbiage (or substantially similar) listed on the written authorization form, contract, or agreement:

> Submission of this transaction assumes an agreement is in place between both parties to allow converting this transaction into an Electronic Funds Transfer transaction or paper draft, and to debit this account for the amount of the transaction. Additionally, the agreement further states that in the event this draft or EFT is returned unpaid, a service fee, as allowable by law, will be charged to this account via draft or EFT. In the event you choose to revoke this authorization, please do so by contacting the merchant directly. Please note that processing times may not allow for revocation of this authorization.

#### Authorization Page - WEB

For internet initiated (WEB) entries the receiver must have the following verbiage (or substantially similar) text listed on the authorization page of their site. Additionally, the authorization must provide the Receiver with the method to revoke his authorization by notifying the Originator in the manner prescribed, and the time frame in which the revocation of the authorization must be provided.

> By authorizing this transaction, customer agrees that merchant may convert this transaction into an Electronic Funds Transfer (EFT) transaction or paper draft, and to debit this account for the amount of the transaction. Additionally, in the event this draft or EFT is returned unpaid, a service fee, as allowable by law, will be charged to this account via EFT or draft. In the event you choose to revoke this authorization, please do so by contacting the merchant directly. Please note that processing times may not allow for revocation of this authorization.

Merchant or Integrator is required to use commercially reasonable methods to authenticate customer identity PRIOR to transaction authorization. Possible methods to authenticate:

- Shared Secrets
	- PIN
	- Password
- Request identifying customer information to verify against outsourced databases.
- Ask challenge questions to verify against credit bureau or outsourced databases.
- Sending customer a specific piece of information, either online or offline, and then ask customer to verify or provide that information as a second step in the authentication process.

Merchant or Integrator is required to retain the customers’ original authorization or copy of the original authorization in its original form.

Merchant or Integrator MUST be able to reproduce Customer authorization upon request. Industry best practice for reproduction to appear the same way that website appeared and/or presented to customer on the website at time of authorization including all verbiage and agreement terms provided on the website at time of authorization.

NACHA **does not** accept proof of an authorization as a list of the data or information captured at time of authorization.

The following information must be included in the authorization record:

- Consumer IP Address of Origination
- Consumer Name
- Consumer Address
- Transaction Amount
- Transaction Effective Date
- Consumer E-mail address (optional; industry recommended best practice)
- Website where payment was accepted
- Signifying whether authorization is for a single or recurring/multiple debits, and debit schedule if recurring/multiple
- Consumer Banking information
- Statement of how the consumer’s identity was authenticated

#### Recorded Authorization – TEL
For telephone initiated (TEL) entries the receiver must have the following verbiage (or substantially similar) read and captured on the recorded customer authorization. Additionally, the authorization must provide the Receiver with the method to revoke his authorization by notifying the Originator in the manner prescribed, and the time frame in which the revocation of the authorization must be provided.

>(Customer’s First and Last Name), by providing your bank account information and verbal authorization today, (Current Date MM/DD/YY),, you are authorizing (Business Name)to create an ACH debit to your account and that this Check by Phone may be drafted from your account as early as today. In the event your Check by Phone is returned from your bank unpaid, you further agree that a fee of $25.00 or as allowable by law shall also be charged to your account via draft or ACH debit. Do you authorize (Business Name) to proceed with this Check by Phone? Customer must state “Yes” or “No”.
>
> A Check by Phone will be drafted from your bank account with the following information (Bank Routing Number, Account Number, Check Number, and Check by Phone Amount). Please allow 12 to 72 business hours for this transaction to post to your account. Should you have any questions regarding your payment, or choose to revoke your authorization, you may reach our office at (Business Telephone that is answered during normal business hours).. Be advised that depending on the timing of your scheduled ACH, revocation of the authorization may not be available. 

#### Receipt Authorization – POP
For point-of-purchase (POP) single debit entries the receiver must receive a copy of the receipt and the voided check. The receipt provided to the receiver must contain the following for each of the transaction types below.

- Approved Sale or Override:
	- **Footer Text**: “I authorize the merchant to convert my check to an electronic funds transfer, or paper draft, and debit my account for the amount of the transaction. In the event that my draft or EFT is returned unpaid, I agree that a fee of $25 (or as allowed by law) may be charged to my account via draft or EFT .”
	- **Signature Line**: Yes
- Verification Only:
	- **Footer Text**: “Must retain check for deposit.”
	- **Signature Line**: No
- Decline:
	- **Footer Text**: None
	- **Signature Line**: No
- Void:
	- **Footer Text**: None
	- **Signature Line**: No
 

#### Additional Endpoint Actions
Depending on your ACH processor, there are additional actions that can be performed.  The table below describes these additional actions as well as the corresponding SEC codes they can be used with.

**Note**: *It is important to note that for the "Payroll" action, an additional field "ach_identifier" must be provided in the POST with value of "P".*

| Action   | Identifier | PPD | CCD | WEB | TEL | POP | C21 | Description                                                                                                                                                                                                                                                                                                                          |
|----------|------------|-----|-----|-----|-----|-----|-----|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Payroll  | P          |     |     |     |     | ✔   | ✔   | This is used in schemas for POP and Check 21 for business and payroll checks. What this does is NOT link the driver’s license to the routing/account numbers since the person writing/cashing the check is usually not the business.                                                                                                 |
| Override |            |     |     |     | ✔   | ✔   | ✔   | This is used in schemas for POP, TEL, and Check 21 when the host system receives a manager needed message to void the previous transaction and input a new transaction in its place.                                                                                                                                                 |
| Update   |            |     |     |     |     | ✔   | ✔   | This is used in schemas for POP and Check 21 for OCR transactions that already have complete data in the data packet. It forces the transaction to run as a normal POP or Check 21 transaction on an OCR terminal. This is normally done when a change is needed to a transaction that was submitted under a normal OCR transaction. |
 

### Performing a Payroll Transaction
In the example below we will demonstrate how the Payroll (P) ACH identifier can be used.

`POST /v2/transactions`

Request
```json
{
  "transaction": {
    "action": "debit",
    "payment_method": "ach",
    "ach_identifier": "P", // Notice the "P" identifier being used here
    "transaction_amount": "777777.07",
    "location_api_id": "location_api_id_zach_@#$%",
    "product_transaction_id": "11e8c590bb25026ea3f31cf6",
    "ach_sec_code": "C21",
    "account_holder_name": "trx+C21@1612 (1616/)-trx",
    "check_number": "8520748520963",
    "account_type": "checking",
    "account_number": "24345",
    "routing": "051904524",
    "image_front": "U29tZVN0cmluZ09idmlvdXNseU5vdEJhc2U2NEVuY29kZWQ=",
    "image_back": "U29tZVN0cmluZ09idmlvdXNseU5vdEJhc2U2NEVuY29kZWQ=",
    "billing_zip": "58469",
    "billing_street": "1612-1616*street",
    "billing_city": "1612-34645656city",
    "billing_state": "VI",
    "billing_phone": "7894561230",
    "track_data": "T051904524T 741025349520O 8520748520963",
    "dob_year": "2000",
    "ssn4": "8527"
  }
}
```
 

### Performing an Override
If the API responds with "Manager Approval Needed" message, an override transaction will also need to be created.

`POST /v2/transactions/{id}/override`

Request
```json
{
    // Nothing Needed Here - Empty Payload
}
```
 

### Performing an Update
If for whatever reason the track data or transaction amount need to be changed for a transaction, this can be acheived by performaning an Update.

- Updates can only be made in the same calendar day.
- You will need to [Void]() the original transaction (manually) and then POST the update.  
- If the original transaction cannot be Voided, you must perform a [Refund]() on the original transaction and then perform a new POST (not an update) to /v2/transactions.

`POST /v2/transactions/{id}/achupdate`

Request
```json
{
    "transaction": {
        "track_data": "T211287447T 234565432678O 4567890234567",
        "trnsaction_amount": "34.09"
    }
}
```
 

##Filters

In contrary to using expands to get extra data, you can use filters to limit record results. Most fields listed in the fields section can be used to filter results.

Say, for example, that you only wanted to find transactions where the last four digits of the card were 1234. You could include that filter in the URL of the GET request like so:

`/v2/transactions?last_four=1234`

Most of the filters use a “like” or “similar to” filter. so filtering on account_holder_name of “smith” would return records containing “john smith” and “jane smith”. Here is another example that filter records that are approved (auth and sale) and are also card type visa:

`/v2/transactions?account_type=visa&status_id=101,102`

One additional type of filter can be applied to the dollar amount fields. This filter allows for a range of values to be searched. If you would like to search for a dollar amount within a range, a pipe symbol is used. Here is an example of this type of filter:

`/v2/transactions?transaction_amount=10.00|10.99`

The above filter will limit results to transaction_amount between $10.00 and $10.99 inclusive.

There is additional functionality that allows searching and filtering on timestamp fields. If you are looking for transaction from today, you can simply search on the created_ts field as follows:

`/v2/transactions?created_ts=today`

And for yesterday you could do the following:

`/v2/transactions?created_ts=yesterday`

If you need more flexibility on dates, you can set the timestamp filter to custom and supply a custom from and to date like so:

`/v2/transactions?created_ts=custom&created_ts_from=1511382234&created_ts_to=1511385997`

When searching on timestamp fields, the list below contains all the predefined values that can be used:

- today
- yesterday
- this week
- last week
- last 30 days
- this month
- last month
- custom
 

## Expands (Related Records)
For detail on how to use Expands on an Endpoint, please visit the [Expands (Related Records)]() page.

| Filter Name           | Related Record        |
|-----------------------|-----------------------|
| account_vault         | Account Vault         |
| changelogs            | Change Logs           |
| contact               | Contact               |
| created_user          | Created User          |
| entrymode             | Entrymode             |
| is_completable        | Is Completable        |
| is_refundable         | Is Refundable         |
| is_reversible         | Is Reversible         |
| is_settled            | Is Settled            |
| is_voidable           | Is Voidable           |
| location              | Location              |
| product_transaction   | Product Transaction   |
| quick_invoice         | Quick Invoice         |
| reason_code           | Reason Code           |
| recurring             | Recurring             |
| signature             | Signature             |
| status                | Status                |
| surcharge             | Surcharge             |
| surcharge_transaction | Surcharge Transaction |
| tags                  | Tags                  |
| transaction_histories | Transaction Histories |
| type                  | Type                  |

An example of “expanding” this endpoint to one of the above related records would look like this:

`/v2/transactions/xxxxxxxxxxxxxxxxxxxxxxxx?expand=location`

To use multiple expands on this endpoint, simply include them both separated by a comma like so:

`/v2/transactions/xxxxxxxxxxxxxxxxxxxxxxxx?expand=location,created_user`

EXAMPLE: CONTACT EXPAND
`GET /v2/transactions?expand=contact`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

Response
```json
{
    "transactions": [
        {
            "id": "11e524ba26ba663e90bd08b9",
            "payment_method": "cc",
            "account_vault_id": "11e524ba1d257faabcef2de8",
            "recurring_id": null,
            "first_six": "545454",
            "last_four": "5454",
            "account_holder_name": "Account Test",
            "transaction_amount": "1.76",
            "description": null,
            "transaction_code": null,
            "avs": "BAD",
            "batch": "55",
            "order_num": "519321833452",
            "verbiage": "APPROVED",
            "transaction_settlement_status": null,
            "effective_date": null,
            "routing": null,
            "return_date": null,
            "created_ts": 1436281763,
            "modified_ts": 1436281763,
            "transaction_api_id": null,
            "terms_agree": null,
            "notification_email_address": null,
            "notification_email_sent": false,
            "response_message": null,
            "auth_amount": "1.76",
            "auth_code": "017423",
            "status_id": 101,
            "type_id": 20,
            "location_id": "54bf4618-e41b-e5f6-dfe0-0efdcbc92917",
            "reason_code_id": null,
            "contact_id": "11e524ba1a381ef6bc510b38",
            "billing_zip": null,
            "billing_street": null,
            "settle_date": null,
            "charge_back_date": null,
            "void_date": null,
            "account_type": "mc",
            "is_recurring": false,
            "is_accountvault": true,
            "transaction_c1": null,
            "transaction_c2": null,
            "transaction_c3": null,
            "checkin_date": null,
            "checkout_date": null,
            "room_num": null,
            "room_rate": null,
            "advance_deposit": false,
            "no_show": false,
            "contact": {
                "id": "11e524ba1a381ef6bc510b38",
                "location_id": "54bf4618-e41b-e5f6-dfe0-0efdcbc92917",
                "account_number": "0123456789",
                "contact_api_id": "akprk3gOLU TEST",
                "company_name": "OLU test",
                "first_name": "Minnie",
                "last_name": "Mouser",
                "email": "test@test.com",
                "address": "41700 Garden brook",
                "city": "Novi",
                "zip": "452321",
                "home_phone": "1234567899",
                "cell_phone": "9862541789",
                "office_phone": "7895561120",
                "office_ext_phone": "1597536481",
                "email_trx_receipt": true,
                "created_ts": 1436281742,
                "modified_ts": 1436281742,
                "date_of_birth": "1990-05-15",
                "header_message": "Welcome",
                "header_message_type_id": 0,
                "contact_c1": null,
                "contact_c2": null,
                "contact_c3": null,
                "contact_balance": null,
                "_links": {
                    "self": {
                        "href": "https://develop.zeamster.com/v2/contacts/11e524ba1a381ef6bc510b38"
                    }
                }
            },
            "_links": {
                "self": {
                    "href": "https://develop.zeamster.com/v2/transactions/11e524ba26ba663e90bd08b9"
                }
            }
        }, 
        {
            "id": "11e524ba25084e28a3d0d6de",
            "payment_method": "cc",
            "account_vault_id": "11e524ba1d257faabcef2de8",
            "recurring_id": null,
            "first_six": "545454",
            "last_four": "5454",
            "account_holder_name": "Account Test",
            "transaction_amount": "1.76",
            "description": null,
            "transaction_code": null,
            "avs": "BAD",
            "batch": "55",
            "order_num": "450703071701",
            "verbiage": "APPROVED",
            "transaction_settlement_status": null,
            "effective_date": null,
            "routing": null,
            "return_date": null,
            "created_ts": 1436281760,
            "modified_ts": 1436281760,
            "transaction_api_id": null,
            "terms_agree": null,
            "notification_email_address": null,
            "notification_email_sent": false,
            "response_message": null,
            "auth_amount": "1.76",
            "auth_code": "288396",
            "status_id": 101,
            "type_id": 20,
            "location_id": "54bf4618-e41b-e5f6-dfe0-0efdcbc92917",
            "reason_code_id": null,
            "contact_id": "11e524ba1a381ef6bc510b38",
            "billing_zip": null,
            "billing_street": null,
            "settle_date": null,
            "charge_back_date": null,
            "void_date": null,
            "account_type": "mc",
            "is_recurring": false,
            "is_accountvault": true,
            "transaction_c1": null,
            "transaction_c2": null,
            "transaction_c3": null,
            "checkin_date": null,
            "checkout_date": null,
            "room_num": null,
            "room_rate": null,
            "advance_deposit": false,
            "no_show": false,
            "contact": {
                "id": "11e524ba1a381ef6bc510b38",
                "location_id": "54bf4618-e41b-e5f6-dfe0-0efdcbc92917",
                "account_number": "0123456789",
                "contact_api_id": "akprk3gOLU TEST",
                "company_name": "OLU test",
                "first_name": "Minnie",
                "last_name": "Mouser",
                "email": "test@test.com",
                "address": "41700 Garden brook",
                "city": "Novi",
                "zip": "452321",
                "home_phone": "1234567899",
                "cell_phone": "9862541789",
                "office_phone": "7895561120",
                "office_ext_phone": "1597536481",
                "email_trx_receipt": true,
                "created_ts": 1436281742,
                "modified_ts": 1436281742,
                "date_of_birth": "1990-05-15",
                "header_message": "Welcome",
                "header_message_type_id": 0,
                "contact_c1": null,
                "contact_c2": null,
                "contact_c3": null,
                "contact_balance": null,
                "_links": {
                    "self": {
                        "href": "https://develop.zeamster.com/v2/contacts/11e524ba1a381ef6bc510b38"
                    }
                }
            },
            "_links": {
                "self": {
                    "href": "https://develop.zeamster.com/v2/transactions/11e524ba25084e28a3d0d6de"
                    }
                }
            },
            {
                "surcharge": {
                "run_as_separate_transaction": false,
                "max_transaction_amount": "100",
                "min_fee_amount": "1",
                "max_fee_amount": "100",
                "surcharge_on_recurring": true,
                "refund_surcharges": false,
                "surcharge_label": "100",
                "title": "Zeamster",
                "surcharge_fee": "1",
                "surcharge_rate": "1",
                "apply_to_user_type_id": "100",
                "id": "11e524ba2db24f60b61bb5f8",
                "created_user_id": "54bfe8cd-6c79-2d76-dfe0-0eddae8fdb72",
                "modified_user_id": "54bfe8cd-6c79-2d76-dfe0-0eddae8fdb72",
                "created_ts": 1436281775,
                "modified_ts": 1436281775,
                "_links": {
                    "self": {
                        "href": "https://develop.zeamster.com/v2/surcharges/11e524ba2db24f60b61bb5f8"
                    }
                }
            }
        }
    }
}
```
 

## Type ID Details
The type_id field details what type of transaction was run. This is a read only field that is returned after the transaction has been processed.

| type_id | Indicates                                                                            |
|---------|--------------------------------------------------------------------------------------|
| 20      | Sale                                                                                 |
| 21      | AVS Only                                                                             |
| 22      | Settle (depracated - batches are now settled on the /v2/transactionbatches endpoint) |
| 30      | Refund                                                                               |
| 40      | Credit                                                                               |
| 50      | Debit                                                                                |
 

## Status ID Details
The status_id field details the current status of the transaction. This is a read only field that is returned after the transaction has been processed.

| Status Id | Transaction Type    | Description                                                                           |
|-----------|---------------------|---------------------------------------------------------------------------------------|
| 101       | Sale                | Approved                                                                              |
| 102       | Sale                | AuthOnly                                                                              |
| 111       | Refund              | Refunded                                                                              |
| 121       | Credit/Debit/Refund | AvsOnly                                                                               |
| 131       | Credit/Debit/Refund | Pending Origination                                                                   |
| 132       | Credit/Debit/Refund | Originating                                                                           |
| 133       | Credit/Debit/Refund | Originated                                                                            |
| 134       | Credit/Debit/Refund | Settled                                                                               |
| 191       | Settle              | Settled (depracated - batches are now settled on the /v2/transactionbatches endpoint) |
| 201       | All                 | Voided                                                                                |
| 301       | All                 | Declined                                                                              |
| 331       | Credit/Debit/Refund | Charged Back                                                                          |
 

## Transaction Source ID Details
The trx_source_id field details the way in which the transaction originated. This is a read only field that is returned when the transaction is processed. There are certain cases in which the field can be overwritten.

| Source Id | Source Type              | Description                                                                                                                                                                                              |
|-----------|--------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| 1         | Unknown                  | The orignation of this transaction could not be determined.                                                                                                                                              |
| 2         | Mobile                   | The origination of this transaction is through the mobile application. This is always a merchant submitted payment.                                                                                      |
| 3         | Web                      | The origination of this transaction is through a web browser. This is always a merchant submitted payment. Examples include Virtual Terminal, Contact Charge, and Transaction Details - Run Again pages. |
| 4         | IVR Transaction          | The origination of this transaction is over the phone. This payment is submitted by an automated system initiated by the cardholder.                                                                     |
| 5         | Contact Statement        | The orignation of this transaction is through a Vericle statement.                                                                                                                                       |
| 6         | Contact Payment Mobile   | The origination of this transaction is through the mobile application. This is always submitted by a contact user.                                                                                       |
| 7         | Contact Payment          | The origination of this transaction is through a web browser. This is always submitted by a contact user.                                                                                                |
| 8         | Quick Invoice            | The orignation of this transaction is through a Quick Invoice. This is typically submitted by a contact user, however the transaction can also be submitted by a merchant.                               |
| 9         | Payform                  | The origination of this transaction is through a Payform. This is typically a merchant submitted transaction, and is always from an internal developer.                                                  |
| 10        | Hosted Payment Page      | The orignation of this transaction is through a Hosted Payment Page. This is typically a cardholder submitted transaction.                                                                               |
| 11        | Emulator                 | The origination of this transaction is through Auth.Net emulator. This is typically submitted through an integration to a website or a shopping cart.                                                    |
| 12        | Integration              | The orignation of this transaction is through an integrated solution. This will always be from an external developer.                                                                                    |
| 13        | Recurring Billing        | The orignation of this transaction is through a scheduled recurring payment. This payment is system-initiated based on a payment schedule that has been configured.                                      |
| 14        | Recurring Secondary      | This feature has not been implented yet.                                                                                                                                                                 |
| 15        | Declined Recurring Email | The orignation of this transaction is through the email notification sent when a recurring payment has been declined. This is typically submitted by a cardholder.                                       |
 

## Entry Modes
Each transaction will contain an entry mode that details how the account number was acquired. The transaction response will contain an entry_mode_id that can be mapped using the following table.

| ID | Title                         |
|----|-------------------------------|
| B  | Bar Code (Future placeholder) |
| S  | Swiped                        |
| K  | Keyed                         |
| C  | Chip Card Read (ICC)          |
| P  | Proximity (Contactless)       |
| F  | Fallback (Invalid Chip Read)  |
 

## CVV Response Codes
Transactions will return a cvv_response field that may or may not always be populated, depending on whether or not CVV was checked for a transaction. If the cvv_response field is populated, it will contain one of the following values:

| CVV Response | Description                                             |
|--------------|---------------------------------------------------------|
|              | Blank value means CVV was not submitted for transaction |
| M            | Match                                                   |
| N            | No Match                                                |
| P            | Not Processed                                           |
| S            | Unreadable                                              |
| U            | Unknown, Issuer does not participate                    |
| X            | Service Provider did not respond                        |
 

## AVS Response Codes
### Basic AVS Response Codes

In the response above you will notice that there is an "avs" field.  This field will hold the Basic AVS result.  The possible values and their descriptions can be seen in the following table:

| Value  | Description                               |
|--------|-------------------------------------------|
| GOOD   | Street or zip are both good (if provided) |
| BAD    | Both street and zip do not match          |
| STREET | Street does not match                     |
| ZIP    | Zip does not match                        |
 

Enhanced AVS Response Codes

In the response above you will notice that there is an "avs_enhanced" field.  This field can be used to provide additional information about the AVS result.  The table below outlines the possible values and their descriptions:

| Code | Description                                                                                                      |
|------|------------------------------------------------------------------------------------------------------------------|
| A    | Street address matches, Zip does not.                                                                            |
| B    | Street addresses match. Postal code not verified due to incompatible formats (international issuer)              |
| C    | Street address and Postal code not verified due to incompatible formats.                                         |
| D    | Cardholder name incorrect, address and ZIP match (AMEX only).                                                    |
| E    | AVS error.                                                                                                       |
| F    | Street addresses and postal codes match (UK only).                                                               |
| G    | Card issued by a non-US issuer that does not participate in the AVS System.                                      |
| H    | Cardholder name incorrect, address match (AMEX only).                                                            |
| I    | Address information not verified (international issuer).                                                         |
| J    | Cardholder name incorrect, ZIP match (AMEX only).                                                                |
| K    | Cardholder name match (AMEX only).                                                                               |
| L    | Cardholder name and ZIP match (AMEX only).                                                                       |
| M    | Street Address and Postal code match (international issuer).                                                     |
| N    | No Match on Street address or Zip.                                                                               |
| O    | Cardholder name and address match (AMEX only).                                                                   |
| P    | Postal codes match, Street address not verified due to incompatible formats.                                     |
| Q    | Cardholder name, address, and ZIP match (AMEX only).                                                             |
| R    | Retry: System unavailable or Timed out.                                                                          |
| S    | Service not supported.                                                                                           |
| T    | Cardholder, all do not match (AMEX only).                                                                        |
| U    | Address information is unavailable.                                                                              |
| V    | Address verification was not requested.                                                                          |
| W    | Nine character numeric ZIP match only, Address (Street) does not match.                                          |
| X    | Exact: Address and 9-digit ZIP Match; For address outside the U.S., postal code matches, address does not match. |
| Y    | Exact match, five character numeric ZIP.                                                                         |
| Z    | Five character numeric ZIP match only, street address does not match or street address not included in request.  |
 

## Reason Code Details
For a full list of all the possible reason codes that can be returned from the transaction endpoint, please see the [Response Reason Codes]() page.

 

## Encryption Examples
The examples below show what some of the different types of enryption look like. The transactions endpoint accepts these different types of enryption as described in the e_format field when submitting a transaction.

| Format    | Example                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |
|-----------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Magnasafe | %*5428********0254^YOU/A GIFT FOR^*******************************?*;5428********0254=********************?*\|1\|41110C1670EC146DC3970151CE0BC0385CD59CA04D798B9D325A3638237240B35DA7309EEBF35CC9CAC92AB6B3CC5BBCB542CE2075094542393CA4A7EF1320E094EA5A1A1829D619\|208540237170186B1A2E0DC26CFA29B42CEE62DA313C6EFCD11227456599FBBAFAA8C64311B296D8\|1\|1\|1\|1\|1\|62994900730004200002                                                                                   |
| idtech    | 02BD01801F432800039B%*5428********0254^YOU/A GIFT FOR^*******************************?*;5428********0254=********************?*11B25549D1CCD691EC3061E18D673F06689B6A778B8EA8329B3D54C2AB9D7C13DCBBFA52C32BC677433B9FE645DFFCB75A5436DF46E45552EE60DDB582757C73CE6F20F262DE2B9D02AEF88E39C7C22FD64D97A76A82DA6E885AA58BCB11218675ECB88D7FA521258A72293D8C7521054EAA426941F43C98573456204A48E08B40853A0701F062422FE5656423AFA9F3011E17E8101FB9396299490073000420000232B603 |
| ksn       | %*5428********0254^YOU/A GIFT FOR^*******************************?*;5428********0254=********************?*\|11B25549D1CCD691EC3061E18D673F06689B6A778B8EA8329B3D54C2AB9D7C13DCBBFA52C32BC677433B9FE645DFFCB75A5436DF46E45552EE60DDB582757C73CE6F20F262DE2B9D\|02AEF88E39C7C22FD64D97A76A82DA6E885AA58BCB11218675ECB88D7FA521258A72293D8C752105                                                                                                                           |
| ksnpin    | %*5428********0254^YOU/A GIFT FOR^*******************************?*;5428********0254=********************?*\|41110C1670EC146DC3970151CE0BC0385CD59CA04D798B9D325A3638237240B35DA7309EEBF35CC9CAC92AB6B3CC5BBCB542CE2075094542393CA4A7EF1320E094EA5A1A1829D619\|208540237170186B1A2E0DC26CFA29B42CEE62DA313C6EFCD11227456599FBBAFAA8C64311B296D8                                                                                                                           |
 
