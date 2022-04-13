# BIN Info
BIN Info is available on both the Account Vaults and Transactions API Endpoints.  The information below describes all of the fields, possible values, and requirements.

## Fields

| Field                       | Size                                                                                     | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
|-----------------------------|------------------------------------------------------------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| issuer_bank_name            | 60                                                                                       | The Issuer Bank name for the BIN                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |
| country_code                | 3                                                                                        | <table> <thead> <tr><th>Issuer</th> <th>Value Description</th></tr></thead> <tbody> <tr><td>VISA</td> <td>Three character alpha country code</td></tr> <tr><td>MC</td> <td>Three character alpha country code</td></tr> <tr> <td>Maestro</td> <td>Three character alpha country code</td></tr> <tr><td> Amex</td><td> Space Filled</td></tr> <tr><td>Discover</td> <td>Three character alpha country code or spaces when Discover doesn't share issuer country.</td></tr> </table>                                                                                                                                                                                                                                                                                                |
| detail_card_product         | 1                                                                                        | <table> <thead> <tr><th>Value</th><th>Description</th></tr></thead><trbody> <tr><td>V </td><td>Visa</td></tr> <tr><td>M</td><td> MasterCard </td></tr><tr><td>A</td><td> American Express </td></tr><tr><td>D</td><td> Discover</td></tr> <tr><td>N</td><td> PIN Only (Non-Visa/MasterCard/AMEX/Discover)</td> </tr> </table>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| detail_card_indicator       | 2                                                                                        | Left justified, Space filled. <table> <thead><tr><th>Indicator</th><th>Card Type</th> <th>Description</th> <th>PIN/Sig/Both</th></tr></thead><trbody> <tr><td>C </td><td>Credit</td><td> Credit Hybrid (has PIN capability also). </td><td>Both</td></tr><tr><td> E </td><td>Debit</td><td> Debit – PIN Only with EBT. </td><td>PIN</td></tr><tr><td> H </td><td>Debit </td><td>Debit Hybrid (PIN and Signature).</td><td> Both</td></tr> <tr><td>J</td><td> Debit </td><td>USA Commercial Debit – Signature Only – Not PIN Capable. </td><td> Sig</td></tr> <tr><td>K </td><td>Debit</td><td> USA Commercial Debit – PIN Capable.</td><td> Both</td></tr> <tr><td>L </td><td>Debit</td><td> NON USA Consumer Debit – Not PIN Capable.</td><td> Sig</td></tr> <tr><td>M </td><td>Debit</td><td> NON USA Commercial Debit – Not PIN Capable.</td><td> Sig</td></tr> <tr><td>N</td><td> Debit</td><td> NON USA Consumer Debit – PIN Capable</td><td> Both</td></tr> <tr><td>O</td><td> Debit</td><td> NON USA Commercial Debit – PIN Capable</td><td> Both</td></tr> <tr><td>P</td><td> Debit </td><td>Debit – PIN Only without EBT.</td><td>  PIN</td></tr><tr><td> R</td><td> Credit </td><td>Private Label (MasterCard)</td><td> Sig</td></tr><tr><td> S </td><td>Debit</td><td> Signature only (not PIN capable).</td><td> Sig</td></tr><tr><td> X </td><td>Credit </td><td>True credit (– Not PIN Capable/ No Signature capability).</td><td> Sig</td> </tr> </table>       |
| fsa_indicator               | 1                                                                                        | F = FSA <br> Default: Space filled                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
| prepaid_indicator           | 1                                                                                        | P = Prepaid Card <br> Default: Space filled                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
| product_id                  | 3                                                                                        | These values indicate card product sub categories (Purchase Card, Business Card, etc.) for Visa, MasterCard, and Discover. Values are subject to change at any time. <br> See [BIN Info Product IDs]() for more details.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
| regulator_indicator         | 1                                                                                        | Applies to US issued cards only (Visa, MasterCard, and Discover). <table> <thead><tr><th>Value</th> <th>Description</th></tr></thead><trbody><tr><td> B</td><td> ISS REGULATED (regulated issuer)</td></tr> <tr><td>N (default)</td><td> ISS NONREGULATED (unregulated issuer OR Non US issued card)</td></tr> <tr><td>1</td><td>ISS REGULATED FRAUD (regulated issuer with fraud)</td> </tr> </table>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
| visa_product_sub_type       | 2                                                                                        | This is used to identify product sub-types, i.e. further classification of product.  <table> <thead><th>Value</th><th>Descriptor</th></thead><trbody><tr><td> AC </td><td> Brazil Agriculture Maintenance Account / Custeio </td></tr><tr><td>AE </td><td>Brazil Agriculture Debit Account / Electron </td></tr><tr><td>AG </td><td>Brazil Agriculture</td></tr><tr><td> AI </td><td>Brazil Agriculture Investment Loan / Investimento </td></tr><tr><td>CG </td><td>Brazil Cargo </td></tr><tr><td> CS </td><td>Construction </td></tr><tr><td> DS </td><td>Distribution</td></tr><tr><td> EN </td><td>Large Market Enterprise</td></tr><tr><td> EX </td><td>Small Market Expenses</td></tr><tr><td> HC</td><td> Healthcare</td></tr><tr><td>  LP </td><td>Visa Large-Purchase Advantage (VLPA) </td></tr><tr><td> MA</td><td> Visa Mobile Agent  </td></tr><tr><td> MB </td><td>Interoperable Mobile Branchless Banking </td></tr><tr><td> MG </td><td>Visa Mobile General </td></tr><tr><td> MX </td><td>Merchant Agent and Merchant Payment </td></tr><tr><td> VA</td><td> Brazil Food or Supermarket / Alimentacao Visa Vale </td></tr><tr><td> VF</td><td> Brazil Fuel/Flex Visa Vale </td></tr><tr><td> VM</td><td> Visa Vale Meal Voucher </td></tr><tr><td> VN</td><td> Visa Vale Food Voucher </td></tr><tr><td>VR </td><td>Brazil Food or Restaurant / Refeicao Visa Vale</tr> </td> </table>  |
| visa_large_ticket_indicator | 1                                                                                        | L = Visa Large Ticket  <br>   Default: Space filled                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
| account_fund_source         | 1                                                                                        | For Visa, MasterCard, and Discover.  Identifies the source of the funds associated with the primary account for the card. <table> <thead><th>Value</th> <th>Description</th></thead><trbody><tr><td> C</td><td> Credit</td></tr><tr><td> D </td><td>Debit </td></tr><tr><td>P</td><td> Prepaid</td></tr><tr><td> H</td><td> Charge</td></tr><tr><td> R </td><td>Deferred Debit (Visa ONLY).</td></tr><tr><td> Space Filled </td><td>Network only ranges</td> </tr> </table>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
| card_class                  | 1                                                                                        | Categorizes the BIN as a Business card, Corporate T&E card, Purchase card or Consumer card. Assists the POS device with prompting decisions – to collect addenda or not.  Visa, MasterCard and Discover only. <table> <thead><th>Value</th> <th>Description</th></thead><trbody><tr><td>B</td><td> Business </td></tr><tr><td>C</td><td> Consumer</td></tr><tr><td> P </td><td>Purchase</td></tr><tr><td> T </td><td>Corporate </tr> </td> </table>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      |
| token_ind                   | 1                                                                                        | Token Indicator values: <br> Y = Token BIN <br> Default: Space filled <br> VISA, MC, and Discover Only.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
| issuing_network             | 2                                                                                        | For Discover card types <table> <thead><th>Value</th><th>Description</th></thead> <trbody><tr><td>00</td> <td>Discover</td> </tr><tr> <td>01 <td>Diners</td> </tr><tr> <td>02 <td>JCB (Japanese Credit Bank) </td> </tr><tr><td>03 <td>CUP (China Union Pay)</td> </tr><tr> <td>04 <td>PayPal</td> </tr> </table>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |

## Product IDs

Visa
| Product ID | Product Name                                                                       |
|------------|------------------------------------------------------------------------------------|
| A^         | Visa Traditional                                                                   |
| B^         | Visa Traditional Rewards                                                           |
| C^         | Visa Signature                                                                     |
| D^         | Visa Signature Preferred                                                           |
| E^         | Proprietary ATM                                                                    |
| F^         | Visa Classic                                                                       |
| G^         | Visa Business (non-US)                                                             |
| G^         | Visa Business Tier 1 (US)                                                          |
| G1         | Visa Signature Business (non-US)                                                   |
| G1         | Visa Business Tier 3 (US)                                                          |
| G3         | Visa Business Enhanced (non-US)                                                    |
| G3         | Visa Business Tier 2 (US)                                                          |
| G4         | Visa Infinite Business (non-US)                                                    |
| G4         | Visa Business Tier 4 (US)                                                          |
| G5         | Visa Business Rewards                                                              |
| I^         | Visa Infinite                                                                      |
| I1         | Visa Infinite Privilege                                                            |
| I2         | Visa Ultra High Net Worth                                                          |
| J3         | Visa Healthcare                                                                    |
| K^         | Visa Corporate T&E                                                                 |
| K1         | Visa GSA Corporate T&E (US) Visa Government Corporate T&E (global)                 |
| L^         | Visa Electron                                                                      |
| N^         | Visa Platinum                                                                      |
| N1         | Visa Rewards                                                                       |
| N2         | Visa Select                                                                        |
| P^         | Visa Gold                                                                          |
| Q^         | Private Label                                                                      |
| Q2         | Private Label Basic                                                                |
| Q3         | Private Label Standard                                                             |
| Q4         | Private Label Enhanced                                                             |
| Q5         | Private Label Specialized                                                          |
| Q6         | Private Label Premium                                                              |
| R^         | Proprietary                                                                        |
| S^         | Visa Purchasing                                                                    |
| S1         | Visa Purchasing with Fleet                                                         |
| S2         | Visa GSA Purchasing (US) Visa Government Purchasing (Global)                       |
| S3         | Visa GSA Purchasing with Fleet (US) Visa Government Purchasing With Fleet (global) |
| S4         | Government Services Loan                                                           |
| S5         | Visa Commercial Transport (EBT)                                                    |
| S6         | Business Loan                                                                      |
| U^         | Visa Travel Money                                                                  |
| V^         | V Pay                                                                              |
| X^         | Visa B2B Virtual Payments                                                          |

MasterCard
| Product ID | Product Name                                                         |
|------------|----------------------------------------------------------------------|
| ACS        | Digital Debit                                                        |
| BPD        | Business Premium Debit                                               |
| DAG        | Gold Debit MasterCard Salary                                         |
| DAP        | Platinum Debit MasterCard Salary                                     |
| DAS        | Standard Debit MasterCard Salary                                     |
| DLG        | Debit MasterCard Gold Delayed Debit                                  |
| DLH        | Debit MasterCard World Embossed Delayed Debit                        |
| DLP        | Debit MasterCard Platinum Delayed Debit                              |
| DLS        | Debit MasterCard Card Delayed Debit                                  |
| DOS        | Standard Debit MasterCard Social                                     |
| DWF        | Debit MasterCard Humanitarian Prepaid                                |
| MAB        | World Elite MasterCard for Business Card                             |
| MAC        | MasterCard World Elite Corporate Card                                |
| MAP        | MAP MasterCard Commercial Payments Account                           |
| MAQ        | MasterCard Prepaid Commercial Payments Account                       |
| MBB        | MasterCard Prepaid Consumer                                          |
| MBC        | MasterCard Prepaid Voucher                                           |
| MBD        | MasterCard Professional Debit BusinessCard Card                      |
| MBE        | MasterCard Electronic Business Card                                  |
| MBF        | Prepaid MC Food                                                      |
| MBK        | MasterCard Black Card                                                |
| MBM        | Prepaid MC Meal                                                      |
| MBP        | MasterCard Corporate Prepaid                                         |
| MBS        | MasterCard B2B Product                                               |
| MBT        | MasterCard Corporate Prepaid Travel                                  |
| MBW        | World MasterCard Black Edition Debit                                 |
| MCB        | MasterCard Business Card Card                                        |
| MCC        | MasterCard Credit Card (mixed BIN)                                   |
| MCD        | Debit MasterCard Card                                                |
| MCE        | MasterCard Electronic Card                                           |
| MCF        | MasterCard Fleet Card                                                |
| MCG        | Gold MasterCard Card                                                 |
| MCH        | MasterCard Premium Charge                                            |
| MCO        | MasterCard Corporate Card                                            |
| MCP        | MasterCard Purchasing Card                                           |
| MCS        | Standard MasterCard Card                                             |
| MCT        | Titanium MasterCard Card                                             |
| MCV        | Merchant-Branded Program                                             |
| MCW        | World MasterCard Card                                                |
| MDB        | Debit MasterCard BusinessCard Card                                   |
| MDG        | Gold Debit MasterCard Card                                           |
| MDH        | Debit Other Embossed MasterCard Card                                 |
| MDJ        | Debit MasterCard Enhanced                                            |
| MDL        | Business Debit Other Embossed                                        |
| MDO        | Debit Other                                                          |
| MDP        | Platinum Debit MasterCard Card                                       |
| MDR        | Debit Brokerage 1                                                    |
| MDS        | Debit MasterCard Card                                                |
| MDT        | Commercial Debit MasterCard Card                                     |
| MDW        | World Black Debit (LAC region excluding Mexico)                      |
| MEB        | MasterCard Executive BusinessCard Card                               |
| MEC        | MasterCard Electronic Commercial                                     |
| MEF        | MasterCard Electronic Payment Account                                |
| MEO        | MasterCard Corporate Executive Card                                  |
| MET        | Titanium Debit MasterCard Card                                       |
| MFB        | Flex World Elite                                                     |
| MFD        | Flex Platinum                                                        |
| MFE        | Flex Charge World Elite                                              |
| MFH        | Flex World                                                           |
| MFL        | Flex Charge Platinum                                                 |
| MFW        | Flex Charge World                                                    |
| MGF        | MasterCard Government Commercial Card                                |
| MHA        | MasterCard Healthcare Prepaid Non-Tax                                |
| MHB        | MasterCard HSA Substantiated                                         |
| MHD        | HELOC Debit Standard                                                 |
| MHH        | MasterCard HSA Non-Substantiated                                     |
| MHK        | Magna Health Access Card                                             |
| MHL        | HELOC Debit Gold                                                     |
| MHM        | HELOC Debit Platinum                                                 |
| MHN        | HELOC Debit Premium                                                  |
| MIA        | Prepaid MasterCard Unembossed Student Card                           |
| MIP        | MasterCard Prepaid Student Card                                      |
| MIU        | Debit MasterCard Unembossed (Non-US)                                 |
| MLA        | MasterCard Central Travel Solutions Air Card                         |
| MLB        | MasterCard Brazil Benefit for Home Improvement                       |
| MLD        | MasterCard Distribution Card                                         |
| MLE        | MasterCard Brazil General Benefits                                   |
| MLF        | MasterCard Agro                                                      |
| MLL        | MasterCard Central Travel Solutions Land Card                        |
| MNF        | MasterCard Public Sector Commercial Card                             |
| MNW        | MasterCard World Card                                                |
| MOC        | Standard Maestro Social                                              |
| MOG        | Maestro Gold Card                                                    |
| MOP        | Maestro Platinum                                                     |
| MOW        | World Maestro                                                        |
| MPA        | MasterCard Prepaid Debit Standard Payroll                            |
| MPB        | MasterCard Preferred Business Card                                   |
| MPD        | MasterCard Flex Prepaid                                              |
| MPF        | MasterCard Prepaid Debit Standard Gift                               |
| MPG        | Debit MasterCard Standard Prepaid General Spend                      |
| MPH        | MasterCard Cash                                                      |
| MPJ        | Prepaid MasterCard Debit Voucher Meal/Food Card                      |
| MPK        | MasterCard Prepaid Government Commercial Card                        |
| MPL        | Platinum MasterCard Card                                             |
| MPM        | MasterCard Prepaid Debit Standard Consumer Incentive                 |
| MPN        | MasterCard Prepaid Debit Standard Insurance                          |
| MPO        | MasterCard Prepaid Debit Standard Other                              |
| MPP        | MasterCard Prepaid Card                                              |
| MPR        | MasterCard Prepaid Debit Standard Travel                             |
| MPT        | MasterCard Prepaid Debit Standard Teen                               |
| MPV        | MasterCard Prepaid Debit Standard Government                         |
| MPW        | Debit MasterCard BusinessCard Prepaid Workplace Business to Business |
| MPX        | MasterCard Prepaid Debit Standard Flex Benefit                       |
| MPY        | MasterCard Prepaid Debit Standard Employee Incentive                 |
| MPZ        | MasterCard Prepaid Debit Standard Government Consumer                |
| MRC        | Prepaid MasterCard Electronic Card (Non-US)                          |
| MRF        | European Regulated Individual Pay                                    |
| MRG        | MasterCard Prepaid Card (Non-US)                                     |
| MRH        | MasterCard Platinum Prepaid Travel Card                              |
| MRJ        | Prepaid MasterCard Voucher Meal/Food Card                            |
| MRK        | Prepaid MasterCard Public Sector Commercial Card                     |
| MRO        | MasterCard Rewards Only                                              |
| MRL        | MasterCard Prepaid Business Preferred                                |
| MRP        | Standard Retailer Centric Payments                                   |
| MRW        | Prepaid MasterCard Business Card (Non-US)                            |
| MSA        | Prepaid Maestro Payroll Card                                         |
| MSB        | Maestro Small Business Card                                          |
| MSF        | Prepaid Maestro Gift Card                                            |
| MSG        | Prepaid Maestro Consumer Reloadable Card                             |
| MSI        | Maestro Card                                                         |
| MSJ        | Maestro Prepaid Voucher Meal and Food Card                           |
| MSM        | Maestro Prepaid Consumer Promotion Card                              |
| MSN        | Maestro Prepaid Insurance Card                                       |
| MSO        | Maestro Prepaid Other Card                                           |
| MSQ        | Reserved for Future Use                                              |
| MSR        | Prepaid Maestro Travel Card                                          |
| MST        | Prepaid Maestro Teen Card                                            |
| MSV        | Prepaid Maestro Government Benefit Card                              |
| MSW        | Prepaid Maestro Corporate Card                                       |
| MSX        | Prepaid Maestro Flex Benefit Card                                    |
| MSY        | Prepaid Maestro Employee Incentive Card                              |
| MSZ        | Prepaid Maestro Emergency Assistance Card                            |
| MTP        | MasterCard Platinum Prepaid Travel Card                              |
| MUW        | MasterCard World Domestic Affluent                                   |
| MWB        | World MasterCard for Business Card                                   |
| MWD        | World Deferred                                                       |
| MWE        | World Elite MasterCard Card                                          |
| MWF        | MasterCard Humanitarian Prepaid                                      |
| MWO        | World Elite MasterCard Corporate Card                                |
| MWP        | MasterCard World Prepaid                                             |
| MWR        | World Retailer Centric Payments                                      |
| OLB        | Maestro Small Business Delayed Debit                                 |
| OLG        | Maestro Gold Delayed Debit                                           |
| OLP        | Maestro Platinum Delayed Debit                                       |
| OLS        | MaestroDelayed Debit                                                 |
| OLW        | World Maestro Delayed Debit                                          |
| PMC        | Proprietary Credit Card (Sweden domestic)                            |
| PMD        | Proprietary Debit Card (Sweden domestic)                             |
| PSC        | Common Proprietary Swedish Credit Card                               |
| PSD        | Common Proprietary Swedish Debit Card                                |
| PVA        | Private Label A                                                      |
| PVB        | Private Label B                                                      |
| PVC        | Private Label C                                                      |
| PVD        | Private Label D                                                      |
| PVE        | Private Label E                                                      |
| PVF        | Private Label F                                                      |
| PVG        | Private Label G                                                      |
| PVH        | Private Label H                                                      |
| PVI        | Private Label I                                                      |
| PVJ        | Private Label J                                                      |
| PVL        | Private Label L                                                      |
| PVT        | Private Label Trade Program                                          |
| SAG        | Gold MasterCard Salary Immediate Debit                               |
| SAL        | Standard Maestro Salary                                              |
| SAP        | Platinum MasterCard Salary Immediate Debit                           |
| SAS        | Standard MasterCard Salary Immediate Debit                           |
| SOS        | Standard MasterCard Social Immediate Debit                           |
| SUR        | Prepaid Unembossed MasterCard Card (Non-US)                          |
| TBE        | MasterCard Electronic Business Immediate Debit                       |
| TCB        | MasterCard Corporate Executive Business Card Immediate Debit         |
| TCC        | MasterCard (mixed BIN) Immediate Debit                               |
| TCE        | MasterCard Electronic Immediate Debit                                |
| TCF        | MasterCard Fleet Card Immediate Debit                                |
| TCG        | Gold MasterCard Card Immediate Debit                                 |
| TCO        | MasterCard Corporate Immediate Debit                                 |
| TCP        | MasterCard Purchasing Card Immediate Debit                           |
| TCS        | MasterCard Standard Card Immediate Debit                             |
| TCW        | World Signia MasterCard Card Immediate Debit                         |
| TEB        | MasterCard Executive BusinessCard Card                               |
| TEC        | MasterCard Electronic Commercial Immediate Debit                     |
| TEO        | MasterCard Corporate Executive Card Immediate Debit                  |
| TNF        | MasterCard Public Sector Commercial Card Immediate Debit             |
| TNW        | MasterCard New World Immediate Debit                                 |
| TPB        | MasterCard Preferred Business Card Immediate Debit                   |
| TPL        | Platinum MasterCard Immediate Debit                                  |
| TWB        | World MasterCard Black Edition Immediate Debit                       |
| WBE        | World MasterCard Black Edition                                       |
| WPD        | World Prepaid Debit                                                  |

Discover
| Product ID | Product Name                           |
|------------|----------------------------------------|
| 001        | Consumer Credit – Rewards              |
| 002        | Commercial Credit                      |
| 003        | Consumer Debit                         |
| 004        | Commercial Debit                       |
| 005        | Prepaid Gift                           |
| 006        | Prepaid ID known                       |
| 007        | Consumer Credit - Premium              |
| 008        | Consumer Credit – Core                 |
| 009        | Private Label Credit                   |
| 010        | Commercial Credit – Executive Business |
| 011        | Consumer Credit – Premium Plus         |
| 012        | Commercial Prepaid – Non-Reloadable    |
| 013        | PayPal                                 |
| 014        | PayPal Mobile                          |
