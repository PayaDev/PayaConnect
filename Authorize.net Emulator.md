# Authorize.net Emulator
In order to use any of the authorize.net features, you will be required to configure your client software to point at our API instead of Authorize.net. This is a very simple process, and is detailed in the appropriate section below depending on your required communication method.

Note: The Authorize.net emulator can only be used for credit card transactions. ACH transactions are not supported.

### AIM XML Support
If your Authorize.net plugin supports AIM XML you can use this method. In order to use this method you will have to configure the following parameters in your plugin:

- Testing Host URL: https://api.sandbox.payaconnect.com/gateway/request.api?developer={developer_id}
- Production Host URL: https://api.payaconnect.com/gateway/request.api?developer={developer_id}
- Name: API user-id
- Transaction Key: API user-api-key

We provide support for running transactions as well as “Automated Recurring Billing” (ARB).

At the present time ARB Trial occurrences and Trial Amount are not supported. If you need this feature please contact us for additional ways to accommodate.

### AIM 3.0/3.1 Support
If your Authorize.net plugin supports AIM 3.0/3.1 you can use this method. In order to use this method you will have to configure the following parameters in your plugin:

- Testing Host URL: https://api.sandbox.payaconnect.com/gateway/transact.dll?developer={developer_id}
- Production Host URL: https://api.payaconnect.com/gateway/transact.dll?developer={developer_id}
- Login: API user-id
- Transaction Key: API user-api-key
