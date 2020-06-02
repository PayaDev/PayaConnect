# Originally provided by CORETECHS
# Sample Updated By: SDK Support, Tech Ops
# Company: Paya, Inc.
# For use with Paya Connect (will not work with Paya Gateway (formerly Sage Exchange))!
# Sample for educational use only - not intended for production.
# If you have any questions regarding the sample or our APIs
# please contact us at sdksupport@paya.com
import time
import json
import requests
import logging

# These two lines enable debugging at httplib level (requests->urllib3->http.client)
# You will see the REQUEST, including HEADERS and DATA, and RESPONSE with HEADERS but without DATA.
# The only thing missing will be the response.body which is not logged.
try:
    import http.client as http_client
except ImportError:
    # Python 2
    import httplib as http_client
http_client.HTTPConnection.debuglevel = 1

# You must initialize logging, otherwise you'll not see debug output.
logging.basicConfig()
logging.getLogger().setLevel(logging.DEBUG)
requests_log = logging.getLogger("requests.packages.urllib3")
requests_log.setLevel(logging.DEBUG)
requests_log.propagate = True

# The Location ID is the primary account ID for Paya Connect. Please check with
# sdksupport@paya.com for registration and test account information. The Terminal
# ID will be found under the Terminals tab within your developer portal account project
PAYA_LOCATION_ID = '[Location ID]'
PAYA_TERMINAL_ID = '[Terminal ID]'


# These are the Developer/API Credentials, once you register 
# with the developer portal at https://developer.sandbox.payaconnect.com You
# will have a Developer ID along with the other required information below.
DEVELOPER_ID = '[Developer ID]'
USER_API_KEY = b"[User API Key]"
USER_ID = '[User ID]'
PAYA_API_HOST = 'https://api.sandbox.payaconnect.com'
PAYA_API_ENDPOINT = '/v2/routertransactions'

# a standard unix timestamp. This sample is simply using the timestamp
# to create a unique invoice number.
timestamp = int(time.time())

# setting up the request data itself
verb = "POST"
url = PAYA_API_HOST + PAYA_API_ENDPOINT

requestData = {
    # this is a pretty minimalistic example...
    # complete reference material is available on the dev portal.
    # A more detailed set of requests can be viewed 
    # at https://docs.payaconnect.com/developers/api/endpoints/transactions
    "routertransaction": {
        "action": "sale",
        "account_type": "mc",
        "payment_method": "cc",
        "location_id": PAYA_LOCATION_ID,
        "terminal_id": PAYA_TERMINAL_ID,
        "transaction_amount": "1.00",
        "order_num": "Invoice " + str (timestamp),
        "description": "SDK Test CC Terminal Sale",
        "save_account": 1,
        "billing_street": "123 Main St",
        "billing_zip": "31405"
    }
}

# convert to json for transport
payload = json.dumps(requestData)

# submit the POST with the appropriate headers.
r = requests.post(
    url,
    headers={
        'content-type': 'application/json',
        'developer-id': DEVELOPER_ID,
        'user-api-key': USER_API_KEY,
        'user-id': USER_ID,
    },
    data=payload
)

print("\n")
print("Response String:")
print(r.text)

# 20190508 - Pretty Print JSON Results
parsed = json.loads(r.text)
print("\n")
print("Parsed Transaction Response:")
print(json.dumps(parsed, indent=4))

# 20190530 - Print parsed JSON fields
print("\n")
print("Transaction Results")
print("Transaction ID: ", parsed['routertransaction']['id'])
print("Auth Code: ", parsed['routertransaction']['auth_code'])
print("Verbiage: ", parsed['routertransaction']['verbiage'])
print("Response Message: ", parsed['routertransaction']['response_message'])
print("Status ID: ", parsed['routertransaction']['status_id'])
print("Reason Code: ", parsed['routertransaction']['reason_code_id'])
print("Authorized Amount: ", parsed['routertransaction']['auth_amount'])
print("Order Number: ", parsed['routertransaction']['order_num'])
print("Masked Account: ", parsed['routertransaction']['first_six'] + "******" + parsed['routertransaction']['last_four'])