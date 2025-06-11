# Test Data

## Transaction Amounts

Using the following amounts for credit card transactions will return the following error responses:
| Amount | Reason Code | Error Message                                                                                                                                                                                                                                                                                                                                   |
|--------|-------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| $2.01  | 1201        | PARTIAL_AUTH (will return a $1.00 partial approval when the Deposit Account has Allow Partial Authorization enabled - not in use at this time)                                                                                                                                                                                                  |
| $5.00  | 1500        | DENY                                                                                                                                                                                                                                                                                                                                            |
| $5.10  | 1510        | CALL                                                                                                                                                                                                                                                                                                                                            |
| $5.20  | 1520        | PKUP                                                                                                                                                                                                                                                                                                                                            |
| $5.30  | 1530        | RETRY                                                                                                                                                                                                                                                                                                                                           |
| $5.40  | 1540        | SETUP                                                                                                                                                                                                                                                                                                                                           |
| $6.01  | 1601        | GENERICFAIL                                                                                                                                                                                                                                                                                                                                     |
| $6.02  | 1602        | CALL                                                                                                                                                                                                                                                                                                                                            |
| $6.03  | 1603        | NOREPLY                                                                                                                                                                                                                                                                                                                                         |
| $6.04  | 1604        | PICKUP_NOFRAUD                                                                                                                                                                                                                                                                                                                                  |
| $6.05  | 1605        | PICKUP_FRAUD                                                                                                                                                                                                                                                                                                                                    |
| $6.06  | 1606        | PICKUP_LOST                                                                                                                                                                                                                                                                                                                                     |
| $6.07  | 1607        | PICKUP_STOLEN                                                                                                                                                                                                                                                                                                                                   |
| $6.08  | 1608        | ACCTERROR                                                                                                                                                                                                                                                                                                                                       |
| $6.09  | 1609        | ALREADY_REVERSED                                                                                                                                                                                                                                                                                                                                |
| $6.10  | 1610        | BAD_PIN                                                                                                                                                                                                                                                                                                                                         |
| $6.11  | 1611        | CASHBACK_EXCEEDED                                                                                                                                                                                                                                                                                                                               |
| $6.12  | 1612        | CASHBACK_NOAVAIL                                                                                                                                                                                                                                                                                                                                |
| $6.13  | 1613        | CID_ERROR                                                                                                                                                                                                                                                                                                                                       |
| $6.14  | 1614        | DATE_ERROR                                                                                                                                                                                                                                                                                                                                      |
| $6.15  | 1615        | DO NOT HONOR                                                                                                                                                                                                                                                                                                                                    |
| $6.16  | 1616        | INSUFFICIENT_FUNDS                                                                                                                                                                                                                                                                                                                              |
| $6.17  | 1617        | EXCEED_WITHDRAWAL_LIMIT                                                                                                                                                                                                                                                                                                                         |
| $6.18  | 1618        | INVALID_SERVICE_CODE                                                                                                                                                                                                                                                                                                                            |
| $6.19  | 1619        | EXCEED_ACTIVITY_LIMIT                                                                                                                                                                                                                                                                                                                           |
| $6.20  | 1620        | VIOLATION                                                                                                                                                                                                                                                                                                                                       |
| $6.21  | 1621        | ENCRYPTION_ERROR                                                                                                                                                                                                                                                                                                                                |
| $6.22  | 1622        | CARD_EXPIRED                                                                                                                                                                                                                                                                                                                                    |
| $6.23  | 1623        | REENTER                                                                                                                                                                                                                                                                                                                                         |
| $6.24  | 1624        | SECURITY_VIOLATION                                                                                                                                                                                                                                                                                                                              |
| $6.25  | 1625        | NOT_PERMITTED_CARD                                                                                                                                                                                                                                                                                                                              |
| $6.26  | 1626        | NOT_PERMITTED_TRAN                                                                                                                                                                                                                                                                                                                              |
| $6.27  | 1627        | SYSTEM_ERROR                                                                                                                                                                                                                                                                                                                                    |
| $6.28  | 1628        | BAD_MERCH_ID                                                                                                                                                                                                                                                                                                                                    |
| $6.29  | 1629        | DUPLICATE_BATCH                                                                                                                                                                                                                                                                                                                                 |
| $6.30  | 1630        | REJECTED_BATCH (First attempt at batch close will fail with a transaction in the batch for $6.30. The second batch close attempt will succeed.)                                                                                                                                                                                                 |
| $6.31  | 1631        | ACCOUNT_CLOSED                                                                                                                                                                                                                                                                                                                                  |
| $8.XX  | 1500        | Delayed Response - Any value in $8 range will simulate a custom delayed response using the number of cents as the number of seconds for the delay. (i.e. $8.05 will result in a 5 second delay). Note: the API has a default time-out period of 10000ms.  Any cents value greater than .09 will generate a time out decline for the transaction |

## AVS

**Valid AVS:**
* Street: 5800 NW 39th AVE
* Zip: 32606

**AVS which will cause a transaction denial:**
* Street: 2831 NW 41st St STE J
* Zip: 32615

Any other AVS will decline the AVS but not decline the transaction. Not sending AVS will decline the AVS but not decline the transaction.

## CVV

**Valid CV:**
* Visa/MC/DISC: 999
* Amex: 1234

**CV which will cause an N - No Match but NOT decline the transaction:**
* Visa/MC/DISC: 123
* Amex: 9999

**The following CV values will decline the transaction if auto_decline_cvv is enabled**

**CV which will cause a P - Not Processed:**
* Visa/MC/DISC: 124
* Amex: 9998

**CV which will cause an S - Not On Card/Illegible:**
* Visa/MC/DISC: 125
* Amex: 9997

**CV which will cause a U - Issuer Does Not Participate:**
* Visa/MC/DISC: 126
* Amex : 9996

**CV which will cause an X - No Response:**
* Visa/MC/DISC: 127
* Amex: 9995

**Any other CV will cause an N - No Match.**

**Not sending CV will decline the CV but not decline the transactions.**

## Card Numbers

When using CCs, feel free to use any future date for the month/expiration when testing. 

**Visa Personal:**

* **Keyed:**
4111111111111111 Exp: 12/25
  
    4012888888881881 Exp: 12/25
* **Swiped:**
%B4111111111111111^TEST CARD/VI^21121015432112345678?;4111111111111111=21121015432112345678?

**Visa Corporate/Purchase:**

* **Keyed:**
4005562231212149 Exp: 12/25
* **Swiped:**
%B4005562231212149^TEST CARD/VI^21121015432112345678?;4005562231212149=21121015432112345678?

**Visa Purchasing:**

* **Keyed:**
4485271031055802 Exp: 12/25
* **Swiped:**
%B4485271031055802^TEST CARD/VI^21121015432112345678?;4485271031055802=21121015432112345678?

**Visa Debit Classic:**

* **Keyed:**
4556773060150333 Exp: 12/25
* **Swiped:**
%B4556773060150333^TEST CARD/VI^21121015432112345678?;4556773060150333=21121015432112345678?

**Visa Credit:**

* **Keyed:**
4916065618219339 Exp: 12/25
* **Swiped:**
%B4916065618219339^TEST CARD/VI^21121015432112345678?;4916065618219339=21121015432112345678?

**Visa Fleet Purchasing:**

* **Keyed:**
4485420616463945 Exp: 12/25
* **Swiped:**
%B4485420616463945^TEST CARD/VI^21121015432112345678?;4485420616463945=21121015432112345678?

**Visa GSA Purchasing - CBA:**

* **Keyed:**
4716677219134014 Exp: 12/25
* **Swiped:**
%B4005562231212149^TEST CARD/VI^21121015432112345678?;4716677219134014=21121015432112345678?

**Visa GSA Purchasing - IBA:**

* **Keyed:**
4716917729443632 Exp: 12/25
* **Swiped:**
%B4716917729443632^TEST CARD/VI^21121015432112345678?;4716917729443632=21121015432112345678?

**Mastercard Personal:**

* **Keyed:**
5454545454545454 Exp: 12/25
* **Swiped:**
%B5454545454545454^TEST CARD/MC^21121015432112345678?;5454545454545454=21121015432112345678?

**Mastercard Corporate/Purchase:**

* **Keyed:**
5405222222222226 Exp: 12/25
* **Swiped:**
%B5405222222222226^TEST CARD/MC^21121015432112345678?

**Mastercard Credit:**

* **Keyed:**
5288071301680537 Exp: 12/25
* **Swiped:**
%B5288071301680537^TEST CARD/MC^21121015432112345678?

**Mastercard Business Debit Prepaid:**

* **Keyed:**
5435815271011988 Exp: 12/25
* **Swiped:**
%B5435815271011988^TEST CARD/MC^21121015432112345678?


**Mastercard Purchasing Card:**

* **Keyed:**
5470675332875417 Exp: 12/25
* **Swiped:**
%B5470675332875417^TEST CARD/MC^21121015432112345678?

**Mastercard Government Commercial - CBA:**

* **Keyed:**
5565061411468182 Exp: 12/25
* **Swiped:**
%B5565061411468182^TEST CARD/MC^21121015432112345678?

**Mastercard Government Commercial - IBA:**

* **Keyed:**
5568022953219547 Exp: 12/25
* **Swiped:**
%B5568022953219547^TEST CARD/MC^21121015432112345678?

**Mastercard Fleet Purchasing:**

* **Keyed:**
5560988568989757 Exp: 12/25
* **Swiped:**
%B5560988568989757^TEST CARD/MC^21121015432112345678?

**Mastercard Corporate Card:**

* **Keyed:**
5566806760567334 Exp: 12/25
* **Swiped:**
%B5566806760567334^TEST CARD/MC^21121015432112345678?

**Discover:**

* **Keyed:**
6011000995500000 Exp: 12/25
* **Swiped:**
%B6011000995500000^TEST CARD/DI^21121015432112345678?;6011000995500000=21121015432112345678?

**Amex:**

* **Keyed:**
371449635398431 Exp: 12/25
* **Swiped:**
%B371449635398431^TEST CARD/AX^21121015432112345678?;371449635398431=21121015432112345678?

## Virtual Device (Mock Terminal)

When using the virtual device (mock terminal) to run transactions, various dollar amounts can be used in the transactions to simulate the different ways transactions can be run through a credit card terminal. The following table shows the dollar amounts that can be used for this.
| **Amount** | **Error Message**                                                                                                                                                   |
|------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| $5.01      | CONNECT ERROR                                                                                                                                                       |
| $5.31      | TIMEOUT                                                                                                                                                             |
| $5.99      | ABORTED                                                                                                                                                             |
| $7.10      | Keyed (Random Card Type)                                                                                                                                            |
| $7.11      | Swiped - Debit - Pin (Random Card Type)                                                                                                                             |
| $7.12      | Swiped - Credit - Signature (Random Card Type)                                                                                                                      |
| $7.13      | Swiped - Credit - No Signature (Random Card Type)                                                                                                                   |
| $7.14      | EMV - Contact - Credit - No CVM (Random Card Type)                                                                                                                  |
| $7.15      | EMV - Contact - Credit - Signature CVM (Random Card Type)                                                                                                           |
| $7.16      | EMV - Contact - Credit - Pin CVM (Random Card Type)                                                                                                                 |
| $7.17      | EMV - Contact - Debit - Pin CVM (Random Card Type)                                                                                                                  |
| $7.18      | EMV - No Contact - Credit - No CVM (Random Card Type)                                                                                                               |
| $7.19      | EMV - No Contact - Credit - Signature CVM (Random Card Type)                                                                                                        |
| $7.20      | EMV - No Contact - Credit - Pin CVM (Random Card Type)                                                                                                              |
| $7.21      | EMV - No Contact - Debit - Pin CVM (Random Card Type)                                                                                                               |
| $7.50      | Visa Keyed                                                                                                                                                          |
| $7.51      | MC Keyed                                                                                                                                                            |
| $7.52      | Amex Keyed                                                                                                                                                          |
| $7.53      | Disc Keyed                                                                                                                                                          |
| $7.54      | Visa Swiped                                                                                                                                                         |
| $7.55      | MC Swiped                                                                                                                                                           |
| $7.56      | Amex Swiped                                                                                                                                                         |
| $7.57      | Disc Swiped                                                                                                                                                         |
| $7.70      | Transaction Timeout                                                                                                                                                 |
| $7.71      | Overall Request Timeout                                                                                                                                             |
| $7.72      | Card Entry Timeout                                                                                                                                                  |
| $7.73      | Pin Entry Timeout                                                                                                                                                   |
| $7.75      | Signature Input Timeout                                                                                                                                             |
| $7.76      | Signature Storage Timeout                                                                                                                                           |
| $8.XX      | Any value in $8 range will test a custom timeout using the number of cents as the number of seconds for the timeout. i.e. $8.30 will result in a 30 second timeout. |

## ACH Test Data

You can utilize any valid US Routing number (Chase Bank 072000326) and any account number between 4-17 digits.

With ACH services there is not a real time approval like what happens with Credit Cards. A transaction takes 1-4 business days to receive a response back with a failure. The best way to account for ACH “Chargebacks” is to run a report to find transactions that have a chargeback status.

ACH Testing Transaction Acceleration

### Paya ACH Terminal Info
| **Sec_code** | **Terminal_id** | **account_holder_name** | **billing_street** | **billing_city** | **billing_state** | **billing_zip** | **billing_phone** | **routing** | **account_number** | **account_type** | **check_number** | **track_data** | **driver_license** | **identity_verification** | **image_front** | **image_back** | **credit** | **debit** | **refund** | **void** | **avsonly** |
|--------------|-----------------|-------------------------|--------------------|------------------|-------------------|-----------------|-------------------|-------------|--------------------|------------------|------------------|----------------|--------------------|---------------------------|-----------------|----------------|------------|-----------|------------|----------|-------------|
| CCD          | 1710            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| CCD          | 1711            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| CCD          | 1712            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| CCD          | 1713            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| CCD          | 1714            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| CCD          | 1715            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| CCD          | 1716            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| CCD          | 1717            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
|              |                 |                         |                    |                  |                   |                 |                   |             |                    |                  |                  |                |                    |                           |                 |                |            |           |            |          |             |
| PPD          | 1010            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| PPD          | 1011            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| PPD          | 1012            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| PPD          | 1013            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| PPD          | 1014            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| PPD          | 1015            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| PPD          | 1016            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| PPD          | 1017            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
|              |                 |                         |                    |                  |                   |                 |                   |             |                    |                  |                  |                |                    |                           |                 |                |            |           |            |          |             |
| TEL          | 1210            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                | ✔                |                |                    |                           |                 |                |            |           |            |          |             |
| TEL          | 1211            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                | ✔                |                | ✔                  |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| TEL          | 1212            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                | ✔                |                |                    | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| TEL          | 1213            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                | ✔                |                | ✔                  | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| TEL          | 1214            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                | ✔                |                |                    |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| TEL          | 1215            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                | ✔                |                | ✔                  |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| TEL          | 1216            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                | ✔                |                |                    | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| TEL          | 1217            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                | ✔                |                | ✔                  | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
|              |                 |                         |                    |                  |                   |                 |                   |             |                    |                  |                  |                |                    |                           |                 |                |            |           |            |          |             |
| CCD          | 1910            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| CCD          | 1911            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| CCD          | 1912            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| CCD          | 1913            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| CCD          | 1914            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| CCD          | 1915            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| CCD          | 1916            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| CCD          | 1917            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                | ✔          | ✔         | ✔          | ✔        |             |
|              |                 |                         |                    |                  |                   |                 |                   |             |                    |                  |                  |                |                    |                           |                 |                |            |           |            |          |             |
| PPD          | 1810            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                |            |           |            |          |             |
| PPD          | 1811            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| PPD          | 1812            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| PPD          | 1813            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| PPD          | 1814            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| PPD          | 1815            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| PPD          | 1816            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| PPD          | 1817            | ✔                       | ✔                  | ✔                | ✔                 | ✔               | ✔                 | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                | ✔          | ✔         | ✔          | ✔        |             |
|              |                 |                         |                    |                  |                   |                 |                   |             |                    |                  |                  |                |                    |                           |                 |                |            |           |            |          |             |
| CCD          | 2710            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| CCD          | 2711            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| CCD          | 2712            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| CCD          | 2713            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| CCD          | 2714            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| CCD          | 2715            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| CCD          | 2716            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| CCD          | 2717            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
|              |                 |                         |                    |                  |                   |                 |                   |             |                    |                  |                  |                |                    |                           |                 |                |            |           |            |          |             |
| PPD          | 2010            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| PPD          | 2011            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| PPD          | 2012            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| PPD          | 2013            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| PPD          | 2014            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| PPD          | 2015            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| PPD          | 2016            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| PPD          | 2017            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
|              |                 |                         |                    |                  |                   |                 |                   |             |                    |                  |                  |                |                    |                           |                 |                |            |           |            |          |             |
| TEL          | 2210            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                | ✔                |                |                    |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| TEL          | 2211            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                | ✔                |                | ✔                  |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| TEL          | 2212            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                | ✔                |                |                    | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| TEL          | 2213            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                | ✔                |                | ✔                  | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| TEL          | 2214            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                | ✔                |                |                    |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| TEL          | 2215            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                | ✔                |                | ✔                  |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| TEL          | 2216            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                | ✔                |                |                    | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| TEL          | 2217            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                | ✔                |                | ✔                  | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
|              |                 |                         |                    |                  |                   |                 |                   |             |                    |                  |                  |                |                    |                           |                 |                |            |           |            |          |             |
| WEB          | 2310            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| WEB          | 2311            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| WEB          | 2312            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| WEB          | 2313            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| WEB          | 2314            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| WEB          | 2315            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                |            | ✔         | ✔          | ✔        |             |
| WEB          | 2316            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
| WEB          | 2317            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                |            | ✔         | ✔          | ✔        |             |
|              |                 |                         |                    |                  |                   |                 |                   |             |                    |                  |                  |                |                    |                           |                 |                |            |           |            |          |             |
| CCD          | 2910            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| CCD          | 2911            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| CCD          | 2912            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| CCD          | 2913            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| CCD          | 2914            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| CCD          | 2915            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| CCD          | 2916            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| CCD          | 2917            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                | ✔          | ✔         | ✔          | ✔        |             |
|              |                 |                         |                    |                  |                   |                 |                   |             |                    |                  |                  |                |                    |                           |                 |                |            |           |            |          |             |
| PPD          | 2810            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| PPD          | 2811            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| PPD          | 2812            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| PPD          | 2813            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| PPD          | 2814            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                |                    |                           |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| PPD          | 2815            | ✔                       |                    |                  |                   |                 |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  |                           |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| PPD          | 2816            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                |                    | ✔                         |                 |                | ✔          | ✔         | ✔          | ✔        |             |
| PPD          | 2817            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   | ✔           | ✔                  | ✔                |                  |                | ✔                  | ✔                         |                 |                | ✔          | ✔         | ✔          | ✔        |             |
|              |                 |                         |                    |                  |                   |                 |                   |             |                    |                  |                  |                |                    |                           |                 |                |            |           |            |          |             |
| POP          | 1110            |                         |                    |                  |                   |                 |                   |             |                    | ✔                |                  | ✔              |                    |                           |                 |                |            | ✔         | ✔          | ✔        | ✔           |
| POP          | 1111            |                         |                    |                  |                   |                 |                   |             |                    | ✔                |                  | ✔              | ✔                  |                           |                 |                |            | ✔         | ✔          | ✔        | ✔           |
| POP          | 1112            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   |             |                    | ✔                |                  | ✔              |                    | ✔                         |                 |                |            | ✔         | ✔          | ✔        | ✔           |
| POP          | 1113            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   |             |                    | ✔                |                  | ✔              | ✔                  | ✔                         |                 |                |            | ✔         | ✔          | ✔        | ✔           |
| POP          | 1114            |                         |                    |                  |                   |                 |                   |             |                    | ✔                |                  | ✔              |                    |                           |                 |                |            | ✔         | ✔          | ✔        | ✔           |
| POP          | 1115            |                         |                    |                  |                   |                 |                   |             |                    | ✔                |                  | ✔              | ✔                  |                           |                 |                |            | ✔         | ✔          | ✔        | ✔           |
| POP          | 1116            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   |             |                    | ✔                |                  | ✔              |                    | ✔                         |                 |                |            | ✔         | ✔          | ✔        | ✔           |
| POP          | 1117            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   |             |                    | ✔                |                  | ✔              | ✔                  | ✔                         |                 |                |            | ✔         | ✔          | ✔        | ✔           |
|              |                 |                         |                    |                  |                   |                 |                   |             |                    |                  |                  |                |                    |                           |                 |                |            |           |            |          |             |
| C21          | 1610            |                         |                    |                  |                   |                 |                   |             |                    | ✔                |                  | ✔              |                    |                           | ✔               | ✔              |            |           | ✔          | ✔        | ✔           |
| C21          | 1611            |                         |                    |                  |                   |                 |                   |             |                    | ✔                |                  | ✔              | ✔                  |                           | ✔               | ✔              |            |           | ✔          | ✔        | ✔           |
| C21          | 1612            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   |             |                    | ✔                |                  | ✔              |                    | ✔                         | ✔               | ✔              |            |           | ✔          | ✔        | ✔           |
| C21          | 1613            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   |             |                    | ✔                |                  | ✔              | ✔                  | ✔                         | ✔               | ✔              |            |           | ✔          | ✔        | ✔           |
| C21          | 1614            |                         |                    |                  |                   |                 |                   |             |                    | ✔                |                  | ✔              |                    |                           | ✔               | ✔              |            |           | ✔          | ✔        | ✔           |
| C21          | 1615            |                         |                    |                  |                   |                 |                   |             |                    | ✔                |                  | ✔              | ✔                  |                           | ✔               | ✔              |            |           | ✔          | ✔        | ✔           |
| C21          | 1616            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   |             |                    | ✔                |                  | ✔              |                    | ✔                         | ✔               | ✔              |            |           | ✔          | ✔        | ✔           |
| C21          | 1617            | ✔                       | ✔                  | ✔                | ✔                 | ✔               |                   |             |                    | ✔                |                  | ✔              | ✔                  | ✔                         | ✔               | ✔              |            |           | ✔          | ✔        | ✔           |

