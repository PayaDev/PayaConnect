# Fee Details

Consumer Fees are compatible on Paya Connect with the following products:
*	PayForm
*	Direct API
*	Quick Invoice
*	Virtual Terminal
*	Hosted Payment Pages (HPP)

As part of card brand rules merchants are allowed to apply certain fees to a transaction. 

## Surcharge
A surcharge is an additional fee that merchants can tack onto a customer's transaction to cover the costs of credit card processing. Most merchants absorb these fees that are passed on to them from credit cards, but you, the Partner, can implement a surcharge where customers can pay for the convenience of using their credit card(s) (this is not to be confused with convenience fees).
Surcharges are defined as a merchant's solution in supplying a transaction amount to Paya's Gateway that already includes the surcharge as part of the total. A good example of this is when a customer sees a $100 + $2 (surcharge), but we charge the card $102; the merchant would receive a deposit of $102. Please keep in mind that the surcharge can be either a fixed rate or a percentage. 

>### Debit Cards
>Paya Connect reviews the BIN data for both new and tokenized payment cards to determine if the card type is Debit or Credit; if the BIN is returned as a debit card type then the transaction model will automatically remove the surcharge from the transaction request and update the transaction amount field to reflect the subtotal and any other qualified amounts.  

_*Note: This setting is managed by our SDKSupport team for Paya Connect Developer Portal and Sandbox.*_

_Please review the Do's and Don'ts of convenience fees noted below:_

*	For Visa (effective April 15, 2023), your merchants must advise your acquirer in writing within 30 days before starting to assess a surcharge fee. For any surcharges assessed prior to April 15, 2023, please follow the prior process by completing the form on their website. 
*	For all others, your merchants must notify card brands by submitting an online form 30 days before starting to assess a surcharge fee.
*	A surcharge acknowledgment form must be completed for Paya.
*	A surcharge must be submitted as one transaction that includes the sale and surcharge amount. 
*	A surcharge cannot be assessed on debit card transactions. 
*	The surcharge rate cannot exceed the merchants' discount rate.
*	A surcharge cannot be charged where state law will disallow it and must be tracked by the Partner/Merchant.
*	A surcharge cannot be used if charging a convenience fee (it must be one or the other and cannot be both). 

If you are interested in implementing surcharges with Visa or MasterCard (or both), please use the forms below:

[Visa Form](https://usa.visa.com/Forms/merchant-surcharge-notification-form.html)

[Master Card Form](https://www.mastercard.us/en-us/surcharge-disclosure-webform.html)

[Discover Form](https://www.pdffiller.com/453217869--merchant-surcharge-notification-form-Discover-Network-)

_Please note, American Express does not have a surcharge form at this time._ 
 
## Convenience

A convenience fee is a flat dollar amount, and this can be assessed for the "convenience" of using certain payment methods not standard to a typical merchant. You can think of a convenience fee as the convenience of purchasing something such as movie tickets online from the comfort of your couch, rather than standing in line in person. If you want to pay for your movie passes online and you can pick your seats ahead of time, that is the "convenience" of paying online and there may be a convenience fee associated with that purchase. 
In many cases, convenience fees are commonly applied to utility bills, rent, tuition, or vehicle registration fees. Many organizations can accept these types of payments in person by cash or check, which is why the convenience of paying by credit card with a fee is assessed. 

Please review the Do's and Don'ts of convenience fees noted below:
*	A convenience fee acknowledgment form must be completed for Paya.
*	A convenience fee cannot be used if you use surcharging (it must be one or the other and cannot be both).  
*	Customer's must-have online (Card Not Present (CNP)) and retail (Card Present) presence. 
*	Cannot be charged on recurring or installment transactions or CP (Card Present) environments. 
If you are interested in setting up convenience fees, please reach out to your assigned Partner Rep. If you do not know who your assigned Partner Rep is, please reach out to our Partner Support Team - PartnerSupport@paya.com
