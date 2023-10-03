# Release Notes
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
