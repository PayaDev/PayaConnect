# Release Notes

 ## Version 
**Sandbox Release Date:** April 17<sup>th</sup> 2024

**Production Release Date:** October 7th 2024 (Originally scheduled for Early May 2024)
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

**Production Release Date:** November 15<sup>th</sup> 2023
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
