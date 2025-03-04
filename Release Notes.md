# Release Notes

 ## UI Version 23.30.165
 ## API Version 2.2.11
**Sandbox Release Date:** January 13<sup>th</sup> 2025

**Production Release Date:** March 5<sup>th</sup> 2025 Approximately 2am ET (includes release items from prior November 2024 and April 2024 Sandbox Releases, listed below)

- Updates to the code to ensure the “product_code”:”999999” is used correctly in the transaction to avoid the reject by TSYS.
- As part of the PCI 4.0 requirements, passwords must confirm to the following requirements:
 	1. A password must have a minimum of 12 characters.
 	2. Passwords must be alphanumeric in nature and be stored or transmitted with encryption.
 	3. Passwords must be changed every 90 days and must not be a repetition of the previous four passwords.
 	4. In scenarios where a password is generated for the user because the user is new or sometimes during a password reset, the generated password must be unique for every user and it must be changed after the first use.
- Alignment on all refunds to provide the original amount value for the total refund amount. This was not aligning consistently when selecting Refund form the Transaction Receipt
- Surcharge amount will zero out when processing a Debit Card from Paya Connect Virtual Terminal. This is a restoration of functionality.
- Surcharge amount will zero out when processing a Debit Card from PayForm. This is a restoration of functionality.
As part of the authOnly, authComplete with Surcharge functionality that has been released to sandbox the exact 422 error is now displayed in the UI advising of an issue.  If a user attempts to submit an invalid amount to refund such as 0, the expectation is to receive an error message of ‘ Transaction amount must be greater than zero for the following actions: [sale, authonly, authcomplete, authincrement, debit, credit, refund, tipadjust]


 ## Version 
**Sandbox Release Date:** November 19<sup>th</sup> 2024

**Production Release Date:** March 5<sup>th</sup> 2025 Approximately 2am ET
- Consumer Fee (Surcharge and Convenience Fee) Enhancement - The API will now support submitting transactions with a consumer fee using the actions AuthOnly and AuthComplete. **Important Note:** When performing an AuthComplete you are only required to submit the transaction_amount with the final total if it is the same as the original AuthOnly transaction. If the final transaction_amount is different, you must also submit the subtotal_amount, surcharge_amount, and tax fields as well, with all amounts updated. Otherwise you'll receive a 422 error response indicating the reason for the error.
- Consumer Fee (Surcharge and Convenience Fee) Enhancement - The API will return two additional fields, auth_aurcharge_rate and auth_surcharge_fee. These are only added to AuthOnly and AuthComplete API responses. Please disregard these fields as they are only being utilized for internal logging purposes.
- Postback Update - Previous Transaction ID - Some transaction responses via the postback service did not include a value for previous_transaction_id within the JSON data. It was simply populating as null. This has been resolved. If a transaction includes a value for previous_transaction_id the value will now be populated in the POST from the Postback service. **Note:** Postback must be configured for the Transaction resource in order to receive any postbacks for the Transactions Endpoint.
- Hosted Payment Page Enhancement - Required Fields - Hosted Payment Page (HPP) has been updated to reflect the field requirements setup within the merchant's location. If CVV is required, it will now be required for HPP. The same goes for Require Street and Require Zip. Merchants may need to educate their end users if they require those fields in the Paya Connect UI, but had not made them required within HPP previously.
- Enhancements to improve our Vault Migration Process.
- Enhancements Canadian L2/L3 Settlement Process.
- Restoration of Functionality - Cloud EMV Transaction Refunds - Attempting to perform a refund of these transactions caused "Error 0291" from our processor. Merchants have been forced to perform unreferenced refunds (blind refunds) for these transactions. This has now been resolved and merchants are now able to refund these transactions through the UI and API using the previous_transaction_id.
- API and UI Response Message Enhancement - When you receive a response for an authorization request (Sale, AuthOnly) the response will now include the exact code and response message from the processor for declines and "00" for approved transactions. This will be displayed within the response_message field within the JSON API response body as well as the reason field within the Paya Connect UI Transaction Detail page.
- API Enhancement Transaction Detail Record - subtotal_amount has been added to the transaction record when querying transaction records or a specific transaction_id from the Transactions Endpoint.
- Restoration of Functionality for QuickInvoices - Consumer Fee - When a consumer fee (Surcharge or Convenience Fee) is configured on a service utilized by a Quick Invoice (QI), the fee amounts will calculate properly when selecting between credit card and ACH payment methods within the QI user interface.
- Quick Invoice Update - Logic regarding single_payment_max_amount and allow_overpayment.
  - If allow_over_payment is set to false - the maximum payment amount (single_payment_max_amount) should equal the invoice amount.
  - If allow_over_payment is set to true - the maximum payment amount (single_payment_max_amount) is configurable through the UI under the payment max amount. The current default is "9999999.99".
- CC Transaction Summary Enhancement - The Paya Connect UI has been updated to include an export button on the bottom right to export the data to various file formats. This mirrors the functionality or other reports.
- CC Transaction Receipt Modal Update - When users attempted to click the "Refund" button within the modal it would fail to load the UI and the user would be unable to process a refund from this screen. This has been resolved. Users are now able to process a refund from the Transaction Receipt modal window.
- UI Enhancements to improve IAP configuration.
- Paya Connect UI - Transaction Details Screen - Resolved an issue where an end user was unable to use the option to "Run Again" due to the error "Subtotal amount cannot be empty or 0". End users are able now able to properly use the "Run Again" functionality.
- Quick Invoice (QI) Functionality Restored - 500 error when creating a QI, a QI would be created, but no email sent. This has been resolved. The QI is created, the email is sent, and there is no longer a 500 error.
- Maintenance Updates to improve Level 3 processing.
- UI and API Return to Functionality - Void Transactions - Attemps to void a transaction using either the Transaction Detail screen or via the API were failing for certain users. This has been resolved, and the functionality has been restored.
- Paya Connect Virtual Terminal (VT) - 400 Bad Request - When a user attempted to process an ACH transaction using the VT the transaction would fail with the error "400 bad request - Bin number not found" if the ACH account number was not within our credit card BIN table. This logic has been removed for ACH processing and transaction functionality within the VT has been restored.
- Account Vault UI Error - Console Error - When a user attempted to update a vault record within the Paya Connect UI and used Actions Button on the right side of the screen (Actions>Edit) they would encounter a console error when trying to save the changes. This functionality has been restored. Users should now be able to complete a successful update.
- Additional Maintenance and Service performed.

 ## Version 
**Sandbox Release Date:** April 17<sup>th</sup> 2024

**Production Release Date:** March 5<sup>th</sup> 2025 Approximately 2am ET (Originally scheduled for Early May 2024)
- UI updates to support Canadian Processing and configuration.
- UI enhancement - Transaction Details screen will display all linked refunds. This will be listed as **Refund History**.
- API enhancement - **response_message** API response field returned from a transaction request will include the value provided by the payment processor. This value is provided to Paya Connect by the payment processor in their **status_message** field. This will help to provide more details on decline and error transactions to the end user.
- Surcharge Compliance Enhancement - Due to a change in card brand rules, new surcharge configuration will be limited to a maximum of 3% on any surcharge transaction. Additionally, it can only be a percentage rate.
- Internal API logging updates.
- UI issue resolved - 500 error when attempting to resend batch close emails.
- API issue resolved - Queries against the Transactions Endpoint utilizing **modified_ts** set to **custom** would return zero results.
- UI issue resolved - ACH refunds from the **Refund** button on the transaction receipt modal failing with a 422 error due to a missing **ach_sec_code**.
- UI issue resolved - ACH refunds from the **Refund** button on the transaction details screen failing with a 422 error due to a **subtotal_amount** being submitted as "NaN".
- API issue resolved - ACH requests missing the **ach_sec_code*, a required field, were returning with the error "failure while communicating with processor". This has been changed to the error **422: ach_sec_code cannot be blank**.
- Require ACH SEC Code feature flag - The ACH SEC Code (ach_sec_code) will be a mandatory field for all ACH transactions by the end of Q1 2025. Because not all existing integrations are prepared to support this field, we have created a feature flag within production with this October 2nd 2024 release. It will default to false until the implementation period is over at the end of Q1 2025. At that time we will default the flag to on and no ACH debit request using PayForm or the Transactions Endpoint will be permitted without the ach_sec_code field with the appropriate value (ex. WEB, PPD, CCD, or TEL).
- API issue resolved - Using the terminal **isOnline** request would result in a **422** error due to a communication failure if the device is offline or not plugged in. In order to remain consistent with RESTful standards, this error code has been changed to **503**.
- Sandbox Postback service issue resolved - Within the sandbox environment some postback requests were stuck in the **new** status. A cleanup function was updated to make sure this is no longer the case.
- Sandbox User permission enhancement - An update to user permissions will allow our suport team to be more effective in the sandbox environment.
- Additional security and compliance enhancements.
 
 ## Version 
**Sandbox Release Date:** November 2<sup>nd</sup> 2023

**Production Release Date:** **Production Release Date:** March 5<sup>th</sup> 2025 Approximately 2am ET (Originally Scheduled for November 15<sup>th</sup> 2023)
- Minor UI issue resolved for "Refund Transaction">"Available to Refund" not displaying correctly.
- Corrected API response for non-Level 3 Transaction IDs to the TransactionLevel3s Endpoint. Now returns proper 422 error response.
- Corrected AVS responses using address within Test Data
- Corrected issue with blind bankcard refunds causing 500 error response. These should now process the refund as expected.
- Updates to the SSL certificates.

 ## Version 
**Sandbox Release Date:** September 25<sup>th</sup> 2023

**Production Release Date:** October 18<sup>th</sup> 2023
- Hosted Form Enhancements
  - reCAPTCHA Token Invalidation
    - The reCAPTCHA validation process has been enhanced to combat fraud activity on the Paya Connect Hosted Payment Pages
    - After a token is utilized for an HPP request, it becomes unusable and invalid. The end-user must pass a new reCAPTCHA test to acquire a fresh new token.
  - Parse rejected reCAPTCHA responses
    - If an end-user does not pass a reCAPTCHA verification, the HPP used to decline the transaction, would previously display an error message stating "CVV cannot be blank." A revised message now appears stating "Transaction failed: Suspected fraud activity."  
- Vault Record Updates
  -  To address card account updater accuracy, we identified an invalid certificate that caused inaccurate response messages
  -  New certificates have been uploaded for the card account updater function. If a certificate becomes invalid, Paya Teams will receive an alert.
  -  Recent updates have been implemented to maintain stability in account vault records and prevent paper trail errors in the card account updater service.
