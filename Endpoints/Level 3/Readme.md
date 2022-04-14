# Level 3 Data Endpoint
The Level 3 Data endpoint (`/v2/transactionlevel3s`) is used to create/update/retrieve/delete Level 3 Data associated with a transaction.

For Locations\Merchants that have Level 3 Data enabled:

1. The Level 3 Data endpoint can be used to supply all the extra data necessary to help qualify the transactions. The Level 3 Data is submitted the same for every processor, but is submitted differently for Visa vs Mastercard transactions (see examples below).
2. The initial Level 3 Data is submitted by the API up front.
	1. Each transaction that is run with a commercial (or purchasing) card will have default Level 3 Data sent to the processor. This is helpful so that even if a merchant doesn't update the transaction with the necessary Level 3 Data, it will still contain a basic record of Level 3 Data to help with the qualifications.
3. If a merchant needs to update the Level 3 Data to supply more specific information, this is done by an additional POST request to the /v2/transactionlevel3s endpoint.
	1. Every POST will overwrite any previous Level 3 Data submitted for the transaction.
		1. Additional POSTs will need to contain ALL the Level 3 Data that needs to be submitted to the processor.
		2. Omitting a previously supplied value will clear that value from the transaction record.

If you are not sure if you can use the Level 3 Data endpoint, perform these steps to determine whether you are able:

1. Run a transaction.
2. Once the initial transaction is complete, submit a GET request to: `/v2/transactions/{{transaction_id}}?expand=transaction_level3`
3. You should get a response with typical transaction data, but you should also notice an extra field in the response called "transaction_level3".
4. If the transaction_level3 field has Level 3 Data then you can use the Level 3 Data endpoint.
5. If this field is null then you cannot use the Level 3 Data endpoint.

INDUSTRY SUPPORT BY PROCESSOR
| Industry         | TSYS | FirstData | Vantiv |
|------------------|------|-----------|--------|
| Retail           | ✔    | ✔         | ✔      |
| Ecommerce        | ✔    | ✔         | ✔      |
| Direct Marketing | ✔    | ✔         | ✔      |
| Lodging          |      | ✔         |        |

 

##Endpoint Details

| Method  | [Post](), [Get](), [Delete]()                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
|---------|:------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Filters** | --                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |
| **Expands** | --                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |
| **Fields**  | <table><thead><tr><th>Name</th><th>Min</th><th>Max</th><th>Format</th><th>POST Required</th><th>Description</th></tr></thead><tbody><tr><td>destination_country_code</td><td>3</td><td>3</td><td>string</td><td> </td><td>Code of the country where the goods are being shipped.</td></tr><tr><td>duty_amount</td><td>1</td><td>12</td><td>number</td><td> </td><td>Fee amount associated with the import of the purchased goods ,Can accept Two (2) decimal places</td></tr><tr><td>freight_amount</td><td>1</td><td>12</td><td>number</td><td> </td><td>Freight or shipping portion of the total transaction amount ,Can accept Two (2) decimal places.</td></tr><tr><td>id</td><td>24</td><td>36</td><td>string</td><td> </td><td>System generated Id</td></tr><tr><td>line_items[description]</td><td>1</td><td>26</td><td>string</td><td>✔</td><td>Description of the item.</td></tr><tr><td>line_items[discount_amount]</td><td>1</td><td>12</td><td>number</td><td> </td><td>Total discount amount applied against the line item total ,Can accept Two (2) decimal places.</td></tr><tr><td>line_items[product_code]</td><td>1</td><td>12</td><td>string</td><td>✔</td><td>Merchant-defined description code of the item.</td></tr><tr><td>line_items[quantity]</td><td>1</td><td>4</td><td>number</td><td> </td><td>Quantity of the item, can accept Four (4) decimal places.</td></tr><tr><td>line_items[tax_amount]</td><td>1</td><td>9</td><td>number</td><td> </td><td>Amount of any value added taxes, can accept Two (2) decimal places.</td></tr><tr><td>line_items[tax_rate]</td><td>1</td><td>2</td><td>number</td><td> </td><td>Tax rate used to calculate the sales tax amount, can accept 2 decimal places.</td></tr><tr><td>line_items[unit_code]</td><td>3</td><td>3</td><td>string</td><td>✔</td><td>Units of measurement as used in international trade. (See <a href="https://docs.payaconnect.com/developers/api/endpoints/level3data#codesforunitsofmeasurement">Codes for Units of Measurement</a> below for unit code abbreviations)</td></tr><tr><td>line_items[unit_cost]</td><td>1</td><td>12</td><td>number</td><td>✔</td><td>Unit cost of the item ,Can accept Four (4) decimal places.</td></tr><tr><td>national_tax</td><td>1</td><td>10</td><td>number</td><td> </td><td>National tax for the transaction ,Can accept Two (2) decimal places.</td></tr><tr><td>sales_tax</td><td>1</td><td>10</td><td>number</td><td> </td><td>Sales tax for the transaction ,Can accept Two (2) decimal places.</td></tr><tr><td>shipfrom_zip_code</td><td>1</td><td>10</td><td>string</td><td> </td><td>Postal/ZIP code of the address from where the purchased goods are being shipped.</td></tr><tr><td>shipto_zip_code</td><td>1</td><td>10</td><td>string</td><td> </td><td>Postal/ZIP code of the address where purchased goods will be delivered.</td></tr><tr><td>tax_amount</td><td>1</td><td>9</td><td>number</td><td> </td><td>Amount of any value added taxes ,Can accept Two (2) decimal places.</td></tr><tr><td>tax_exempt</td><td>1</td><td>1</td><td>string</td><td> </td><td>Sales Tax Exempt. Allowed values: “1”, “0”.</td></tr><tr><td>transaction_id</td><td>24</td><td>36</td><td>string</td><td>✔</td><td>A previously returned transaction_id that is used for Level 3 transactions.</td></tr></tbody></table><br>Visa Specific Fields<br><table><thead><tr><th>Name</th><th>Min</th><th>Max</th><th>Format</th><th>POST<br>Required</th><th>Comments</th></tr></thead><tbody><tr><td>customer_vat_registration</td><td>1</td><td>13</td><td>string</td><td> </td><td>Tax registration number supplied by the Commercial Card cardholder.</td></tr><tr><td>merchant_vat_registration</td><td>1</td><td>20</td><td>string</td><td> </td><td>Government assigned tax identification number of the Merchant.</td></tr><tr><td>order_date</td><td>6</td><td>6</td><td>string</td><td> </td><td>The purchase order date. Format: “YYMMDD”</td></tr><tr><td>summary_commodity_code</td><td>1</td><td>4</td><td>string</td><td> </td><td>International description code of the overall goods or services being supplied.</td></tr><tr><td>tax_rate</td><td>1</td><td>4</td><td>number</td><td> </td><td>Tax rate used to calculate the sales tax amount ,Can accept Two (2) decimal places.</td></tr><tr><td>unique_vat_ref_number</td><td>1</td><td>15</td><td>string</td><td> </td><td>Invoice number that is associated with the VAT invoice.</td></tr><tr><td>line_items[commodity_code]</td><td>1</td><td>12</td><td>string</td><td>✔</td><td>An international description code of the individual good or service being supplied.</td></tr><tr><td>line_items[other_tax_amount]</td><td>1</td><td>12</td><td>number</td><td> </td><td>Used if city or multiple county taxes need to be broken out separately ,Can accept Two (2) decimal places.</td></tr></tbody></table><br>Mastercard Specific Fields<br><table><thead><tr><th>Name</th><th>Min</th><th>Max</th><th>Format</th><th>POST<br>Required</th><th>Comments</th></tr></thead><tbody><tr><td>line_items[alternate_tax_id]</td><td>1</td><td>15</td><td>string</td><td> </td><td>Tax identification number of the merchant that reported the alternate tax amount.</td></tr><tr><td>line_items[debit_credit]</td><td>1</td><td>1</td><td>string</td><td> </td><td>Indicator used to reflect debit (D) or credit (C) transaction. Allowed values: “D”, “C”.</td></tr><tr><td>line_items[discount_rate]</td><td>1</td><td>5</td><td>number</td><td> </td><td>Discount rate for the line item ,Can accept Two (2) decimal places.</td></tr><tr><td>line_items[tax_type_applied]</td><td>1</td><td>4</td><td>string</td><td> </td><td>Type of value-added taxes that are being used (Conditional If tax amount is supplied)<br>This field is only required when Merchant is directed to include by Mastercard.</td></tr><tr><td>line_items[tax_type_id]</td><td>2</td><td>2</td><td>string</td><td> </td><td>Indicates the type of tax collected in relationship to a specific tax amount (Conditional If tax amount is supplied) See <a href="https://docs.payaconnect.com/developers/api/endpoints/level3data#taxtypeidentifier">Tax Type Identifier</a> below.</td></tr></tbody></table> |


## Endpoint Actions
### Create Record
`POST /v2/transactionlevel3s`

This method is used whenever there is the need to **create or update** Level 3 Data for a transaction.

- If there is a need to update the Level 3 Data for a transaction, this is done through an additional POST request to the endpoint.
- Every POST will overwrite any previous Level 3 Data submitted for the transaction.
	1. Additional POSTs will need to contain ALL the Level 3 Data that needs to be submitted to the processor.
	2. Omitting a previously supplied field will clear the value for that field from the transaction record.

Sample Request (Visa)
```json
{
    "transactionlevel3": {
        "transaction_id": "111111111111111111111111",
        "level3_data":{
            "tax_exempt": "0",
            "sales_tax":"200",
            "national_tax":"2",
            "merchant_vat_registration": "123456",
            "customer_vat_registration": "12345678",
            "summary_commodity_code": "C1K2",
            "freight_amount": "0.1",
            "duty_amount": "0",
            "shipto_zip_code": "FL1234",
            "shipfrom_zip_code": "AZ1234",
            "destination_country_code": "840",
            "unique_vat_ref_number": "vat1234",
            "order_date": "171006",
            "tax_amount": "0",
            "tax_rate": "0",
            "line_items": [
                {
                    "commodity_code": "cc123456",
                    "description": "cool drink",
                    "product_code": "coke12678",
                    "quantity": "5",
                    "unit_code": "gll",
                    "unit_cost": "4",
                    "tax_amount": "10",
                    "tax_rate": "0",
                    "discount_amount": "0",
                    "other_tax_amount": "0"
                },
                {
                    "commodity_code": "cc1234",
                    "description": "cool drink",
                    "product_code": "fanta123678",
                    "quantity": "12",
                    "unit_code": "gll",
                    "unit_cost": "3",
                    "tax_amount": "4",
                    "tax_rate": "0",
                    "discount_amount": "7",
                    "other_tax_amount": "0"
                }
            ]
        }
    }
}
```

Sample Request (Mastercard)
```json
{
    "transactionlevel3": {
        "transaction_id": "111111111111111111111111",
        "level3_data":{
            "national_tax":"2",
            "tax_exempt": "0",
            "sales_tax":"200",
            "freight_amount": "0",
            "duty_amount": "0",
            "shipto_zip_code": "MI48335",
            "shipfrom_zip_code": "AZ12345",
            "destination_country_code": "840",
            "tax_amount": "0",
            "line_items": [
                {
                    "description": "cool drink",
                    "product_code": "coke12345678",
                    "quantity": "5",
                    "unit_code": "gll",
                    "unit_cost": "10",
                    "alternate_tax_id": "1234",
                    "tax_rate": "0",
                    "tax_type_applied": "22",
                    "tax_amount": "3",
                    "debit_credit": "C",
                    "discount_amount": "0.11",
                    "discount_rate": "1",
                    "tax_type_id": "11"
                },
                {
                    "description": "water",
                    "product_code": "water123",
                    "quantity": "5",
                    "unit_code": "gll",
                    "unit_cost": "10",
                    "alternate_tax_id": "123456",
                    "tax_rate": "0",
                    "tax_type_applied": "22",
                    "tax_amount": "3",
                    "debit_credit": "C",
                    "discount_amount": "11",
                    "discount_rate": "1",
                    "tax_type_id": "11"
                }
            ]
        }
    }
}
```

### Update Record
Updates to Level 3 Data require a new POST to the endpoint with ALL of the data necessary (original data and any new data).  All fields will be overwritten on subsequent POSTs with a matching transaction_id.  Omitting a previously supplied value will clear that value from the transaction record.

For JSON Request body examples, see [Create Record]() above.

### View Single Record
`GET /v2/transactionlevel3s/{id}`

***Note:** id is required in the URL.*

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

Sample Response (Visa)
```json
{
    "transactionlevel3": {
        "id": "222222222222222222222222",
        "transaction_id": "111111111111111111111111",
        "level3_data":{
            "tax_exempt": "0",
            "sales_tax":"200",
            "national_tax":"2",
            "merchant_vat_registration": "123456",
            "customer_vat_registration": "12345678",
            "summary_commodity_code": "C1K2",
            "freight_amount": "0.1",
            "duty_amount": "0",
            "shipto_zip_code": "FL1234",
            "shipfrom_zip_code": "AZ1234",
            "destination_country_code": "840",
            "unique_vat_ref_number": "vat1234",
            "order_date": "171006",
            "tax_amount": "0",
            "tax_rate": "0",
            "line_items": [
                {
                    "commodity_code": "cc123456",
                    "description": "cool drink",
                    "product_code": "coke12678",
                    "quantity": "5",
                    "unit_code": "gll",
                    "unit_cost": "4",
                    "tax_amount": "10",
                    "tax_rate": "0",
                    "discount_amount": "0",
                    "other_tax_amount": "0"
                },
                {
                    "commodity_code": "cc1234",
                    "description": "cool drink",
                    "product_code": "fanta123678",
                    "quantity": "12",
                    "unit_code": "gll",
                    "unit_cost": "3",
                    "tax_amount": "4",
                    "tax_rate": "0",
                    "discount_amount": "7",
                    "other_tax_amount": "0"
                }
            ]
        }
    }
}
```

Sample Response (Mastercard)
```json
{
    "transactionlevel3": {
        "id": "222222222222222222222222",
        "transaction_id": "111111111111111111111111",
        "level3_data":{
            "national_tax":"2",
            "tax_exempt": "0",
            "sales_tax":"200",
            "freight_amount": "0",
            "duty_amount": "0",
            "shipto_zip_code": "MI48335",
            "shipfrom_zip_code": "AZ12345",
            "destination_country_code": "840",
            "tax_amount": "0",
            "line_items": [
                {
                    "description": "cool drink",
                    "product_code": "coke12345678",
                    "quantity": "5",
                    "unit_code": "gll",
                    "unit_cost": "10",
                    "alternate_tax_id": "1234",
                    "tax_rate": "0",
                    "tax_type_applied": "22",
                    "tax_amount": "3",
                    "debit_credit": "C",
                    "discount_amount": "0.11",
                    "discount_rate": "1",
                    "tax_type_id": "11"
                },
                {
                    "description": "water",
                    "product_code": "water123",
                    "quantity": "5",
                    "unit_code": "gll",
                    "unit_cost": "10",
                    "alternate_tax_id": "123456",
                    "tax_rate": "0",
                    "tax_type_applied": "22",
                    "tax_amount": "3",
                    "debit_credit": "C",
                    "discount_amount": "11",
                    "discount_rate": "1",
                    "tax_type_id": "11"
                }
            ]
        }
    }
}
```

### Delete Record
`DELETE /v2/transactionlevel3s/{id}`

***Note:** id is required in the URL.*

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

Response
```json
Conditional JSON response based on HTTP Response Code:

204 - Success, the Level3 Data was deleted.
422 - Fail, validation error in JSON response.
```

 

## Additional Information
### Tax Type Identifier
| Value | Description                  |
|-------|------------------------------|
| 00    | Unknown                      |
| 01    | Federal/National Sales Tax   |
| 02    | State Sales Tax              |
| 03    | City Sales Tax               |
| 04    | Local Sales Tax              |
| 05    | Municipal Sales Tax          |
| 06    | Other Tax                    |
| 10    | Value Added Tax (VAT)        |
| 11    | Goods and Services Tax (GST) |
| 12    | Provincial Sales Tax         |
| 13    | Harmonized Sales Tax (HST) * |
| 14    | Quebec Sales Tax (QST) *     |
| 20    | Room Tax                     |
| 21    | Occupancy Tax                |
| 22    | Energy Tax                   |
| Space | Not Supported                |
*Not supported by all processors.*

### Codes for Units of Measurement
| Field | Type   | Description                                                         |
|-------|--------|---------------------------------------------------------------------|
| EA    | String | Unknown unit of measure                                             |
| ACR   | String | Acre (4840 yd2)                                                     |
| AMH   | String | Ampere-hour (3.6 kC)                                                |
| AMP   | String | Ampere                                                              |
| ANN   | String | Year                                                                |
| APZ   | String | Ounce GB, US (31.10348 g) (tr oz.)                                  |
| ARE   | String | Are (100 m2)                                                        |
| ASM   | String | Alcoholic strength mass                                             |
| ASV   | String | Alcoholic strength by volume                                        |
| ATM   | String | Standard atmosphere (101325 Pa)                                     |
| ATT   | String | Technical atmosphere (98066.5 Pa)                                   |
| BAR   | String | Bar                                                                 |
| BFT   | String | Board foot                                                          |
| BG    | String | Unknown unit of measure                                             |
| BHP   | String | Brake horsepower (745.7 W)                                          |
| BHX   | String | Hundred boxes                                                       |
| BIL   | String | Billion Eur (trillion US)                                           |
| BLD   | String | Dry barrel (115.627 dm3)                                            |
| BLL   | String | Barrel                                                              |
| BQL   | String | Becquerel                                                           |
| BTU   | String | British thermal unit (1.055 Kilojoules)                             |
| BUA   | String | Bushel (35.2391 dm3)                                                |
| BUI   | String | Bushel (36.36874 dm3)                                               |
| BX    | String | Unknown unit of measure                                             |
| C     | String | Unknown unit of measure                                             |
| CA    | String | Unknown unit of measure                                             |
| CCT   | String | Carrying capacity in metric tons                                    |
| CD    | String | Unknown unit of measure                                             |
| CDL   | String | Candela                                                             |
| CEL   | String | Celsius degrees                                                     |
| CEN   | String | Hundred                                                             |
| CGM   | String | Centigram                                                           |
| CKG   | String | Coulomb per kg                                                      |
| CLF   | String | Hundred leaves                                                      |
| CLT   | String | Centiliter                                                          |
| CMK   | String | Square centimeter                                                   |
| CMT   | String | Centimeter                                                          |
| CNP   | String | Hundred packs                                                       |
| CNT   | String | Cental GB (45.359237 kg)                                            |
| COU   | String | Coulomb                                                             |
| CS    | String | Unknown unit of measure                                             |
| CTM   | String | Metric carat (200 Mg = 2.10-4 kg)                                   |
| CUR   | String | Curie                                                               |
| CWA   | String | Hundredweight US (45.3592 kg)                                       |
| D     | String | Unknown unit of measure                                             |
| DAA   | String | Decare                                                              |
| DAD   | String | Ten days                                                            |
| DAY   | String | Day                                                                 |
| DEC   | String | Decade (10 years)                                                   |
| DLT   | String | Deciliter                                                           |
| DMK   | String | Square decimeter                                                    |
| DMQ   | String | Cubic decimeter                                                     |
| DMT   | String | Decimeter                                                           |
| DPC   | String | Dozen pieces                                                        |
| DPT   | String | Displacement tonnage                                                |
| DRA   | String | Dram US (3.887935 g)                                                |
| DRI   | String | Dram GB (1.771745 g)                                                |
| DRL   | String | Dozen rolls                                                         |
| DRM   | String | Drachm gm (3.887935 g)                                              |
| DTH   | String | Hectokilogram                                                       |
| DTN   | String | Centner / Quintal, metric (100 kg) (decitonne)                      |
| DWT   | String | Pennyweight GB, US (1.555174 g)                                     |
| DZ    | String | Unknown unit of measure                                             |
| DZN   | String | Dozen                                                               |
| DZP   | String | Dozen packs                                                         |
| DZR   | String | Dozen pairs                                                         |
| EAC   | String | Each                                                                |
| FAH   | String | Fahrenheit degrees                                                  |
| FAR   | String | Farad                                                               |
| FOT   | String | Foot (.3048 m)                                                      |
| FT    | String | Unknown unit of measure                                             |
| FTK   | String | Square foot                                                         |
| FTQ   | String | Cubic foot                                                          |
| G     | String | Unknown unit of measure                                             |
| GAL   | String | Unknown unit of measure                                             |
| GBQ   | String | Gigabequerel                                                        |
| GFI   | String | Gram of fissile isotopes                                            |
| GGR   | String | Great gross (12 gross)                                              |
| GIA   | String | Gill (11.8294 cm3)                                                  |
| GII   | String | Gill (0.142065 dm3)                                                 |
| GLD   | String | Dry gallon (4.404884 dm3)                                           |
| GLI   | String | Gallon (4.546092 dm3)                                               |
| GLL   | String | Liquid gallon (3.78541 dm3)                                         |
| GRM   | String | Gram                                                                |
| GRN   | String | Grain GB, US (64.798910 mg)                                         |
| GRO   | String | Gross                                                               |
| GRT   | String | Gross (Register) ton                                                |
| GWH   | String | Gigawatt-hour (1 Million kWh                                        |
| HAR   | String | Hectare                                                             |
| HBA   | String | Hectobar                                                            |
| HGM   | String | Hectogram                                                           |
| HIU   | String | Hundred international units                                         |
| HLT   | String | Hectoliter                                                          |
| HMQ   | String | Million cubic meters                                                |
| HMT   | String | Hectometer                                                          |
| HPA   | String | Hectoliter of pure alcohol                                          |
| HTZ   | String | Hertz                                                               |
| HUR   | String | Hour                                                                |
| INH   | String | Inch (25.4 mm)                                                      |
| INK   | String | Square inch                                                         |
| INQ   | String | Cubic inch                                                          |
| ITM   | String | Item                                                                |
| JOU   | String | Joule                                                               |
| KBA   | String | Kilobar                                                             |
| KEL   | String | Kelvin                                                              |
| KGM   | String | Kilogram                                                            |
| KGS   | String | Kilogram per second                                                 |
| KHZ   | String | Kilohertz                                                           |
| KJO   | String | Kilojoule                                                           |
| KMH   | String | Kilometer per hour                                                  |
| KMK   | String | Square kilometer                                                    |
| KMQ   | String | Kilogram per cubic meter                                            |
| KMT   | String | Kilometer                                                           |
| KNI   | String | Kilogram of nitrogen                                                |
| KNS   | String | Kilogram of named substance                                         |
| KNT   | String | Knot (1 nautical mile per hour)                                     |
| KPA   | String | Kilopascal                                                          |
| KPH   | String | Kilogram of caustic potash (kilogram of potassium hydroxide)        |
| KPO   | String | Kilogram of potassium oxide                                         |
| KPP   | String | Kilogram of phosphoric anhydride (kilogram of phosphoric pentoxide) |
| KSD   | String | Kilogram of substance 90% dry                                       |
| KSH   | String | Kilogram of caustic soda                                            |
| KTN   | String | Kilotonne                                                           |
| KUR   | String | Kilogram of uranium                                                 |
| KVA   | String | Kilovolt-ampere                                                     |
| KVR   | String | Kilovar                                                             |
| KVT   | String | Kilovolt                                                            |
| KWH   | String | Kilowatt-hour                                                       |
| KWT   | String | Kilowatt                                                            |
| LBR   | String | Pound GB, US (0.45359237 kg)                                        |
| LBS   | String | Unknown unit of measure                                             |
| LBT   | String | Troy pound, US (373.242 g)                                          |
| LEF   | String | Leaf                                                                |
| LPA   | String | Liter of pure alcohol                                               |
| LTN   | String | Long ton GB, US (1.0160469 T)                                       |
| LTR   | String | Liter (1 dm3)                                                       |
| LUM   | String | Lumen                                                               |
| LUX   | String | Lux                                                                 |
| MAL   | String | Megaliter                                                           |
| MAM   | String | Megameter                                                           |
| MAW   | String | Megawatt                                                            |
| MBE   | String | Thousand standard brick equivalent                                  |
| MBF   | String | Thousand board-feet (2.36 m3)                                       |
| MBR   | String | Millibar                                                            |
| MCU   | String | Millicurie                                                          |
| MGM   | String | Milligram                                                           |
| MHZ   | String | Megahertz                                                           |
| MIK   | String | Square mile                                                         |
| MIL   | String | Thousand                                                            |
| MIN   | String | Minute                                                              |
| MIO   | String | Million                                                             |
| MIU   | String | Million international units                                         |
| MLD   | String | Billion US (milliard)                                               |
| MLT   | String | Milliliter                                                          |
| MMK   | String | Square millimeter                                                   |
| MMQ   | String | Cubic millimeter                                                    |
| MMT   | String | Millimeter                                                          |
| MON   | String | Month                                                               |
| MPA   | String | Megapascal                                                          |
| MQH   | String | Cubic meter per hour                                                |
| MQS   | String | Cubic meter per second                                              |
| MSK   | String | Meter per second squared                                            |
| MTK   | String | Square meter                                                        |
| MTQ   | String | Cubic meter                                                         |
| MTR   | String | Meter                                                               |
| MTS   | String | Meter per second                                                    |
| MVA   | String | Megavolt-ampere (1000 kva)                                          |
| MWH   | String | Megawatt-hour (1000 kWh)                                            |
| NAR   | String | Number of articles                                                  |
| NBB   | String | Number of bobbins                                                   |
| NCL   | String | Number of cells                                                     |
| NEW   | String | Newton                                                              |
| NIU   | String | Number of international units                                       |
| NMB   | String | Number                                                              |
| NMI   | String | Nautical mile (1852 m)                                              |
| NMP   | String | Number of packs                                                     |
| NMR   | String | Number of pairs                                                     |
| NPL   | String | Number of parcels                                                   |
| NPT   | String | Number of parts                                                     |
| NRL   | String | Number of rolls                                                     |
| NTT   | String | Net (register) ton                                                  |
| OHM   | String | Ohm                                                                 |
| ONZ   | String | Ounce GB, US (28.349523 g)                                          |
| OZA   | String | Fluid ounce (29.5735 cm3)                                           |
| OZI   | String | Fluid ounce (28.413 cm3)                                            |
| PAL   | String | Pascal                                                              |
| PCB   | String | Piece                                                               |
| PCE   | String | Unknown unit of measure                                             |
| PER   | String | Unknown unit of measure                                             |
| PGL   | String | Proof gallon                                                        |
| PK    | String | Unknown unit of measure                                             |
| PTD   | String | Dry pint (0.55061 dm3)                                              |
| PTI   | String | Pint (0.568262 dm3)                                                 |
| PTL   | String | Liquid pint (0.473176 dm3)                                          |
| QAN   | String | Quarter (of a year)                                                 |
| QTD   | String | Dry quart (1.101221 dm3)                                            |
| QTI   | String | Quart (1.136523 dm3)                                                |
| QTL   | String | Liquid quart (0.946353 dm3)                                         |
| QTR   | String | Quarter, GB (12.700586 kg)                                          |
| RL    | String | Unknown unit of measure                                             |
| RM    | String | Unknown unit of measure                                             |
| RPM   | String | Revolution per minute                                               |
| RPS   | String | Revolution per second                                               |
| SAN   | String | Half year (6 months)                                                |
| SCO   | String | Score                                                               |
| SCR   | String | Scruple GB, US (1.295982 g)                                         |
| SEC   | String | Second                                                              |
| SET   | String | Set                                                                 |
| SHT   | String | Shipping ton                                                        |
| SIE   | String | Siemens                                                             |
| SMI   | String | (Statute) mile (1609.344 m)                                         |
| SST   | String | Short Standard (7200 matches)                                       |
| ST    | String | Unknown unit of measure                                             |
| STI   | String | Stone GB (6.350293 kg)                                              |
| STN   | String | Short ton GB, US (0.90718474 T)                                     |
| TAH   | String | Thousand ampere-hour                                                |
| TNE   | String | Metric ton (1000 kg) (tonne (1000 kg))                              |
| TQD   | String | Thousand cubic meters per day                                       |
| TPR   | String | Ten pairs                                                           |
| TRL   | String | Trillion EUR                                                        |
| TSD   | String | Tonne of substance 90% dry                                          |
| TSH   | String | Ton of steam per hour                                               |
| VLT   | String | Volt                                                                |
| WCD   | String | Cord (3.63 m3)                                                      |
| WEB   | String | Weber                                                               |
| WEE   | String | Week                                                                |
| WHR   | String | Watt-hour                                                           |
| WSD   | String | Standard                                                            |
| WTT   | String | Watt                                                                |
| YDK   | String | Square yard                                                         |
| YDQ   | String | Cubic yard                                                          |
| YRD   | String | Yard (0.9144 m)                                                     |
