# /*----------------------------------------------
# Author: SDK Support Group
# Company: Paya
# Contact: sdksupport@nuvei.com
# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
# !!! Samples intended for educational use only!!!
# !!!        Not intended for production       !!!
# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
# -----------------------------------------------*/


require 'json'
require 'openssl'


host = "https://api.sandbox.payaconnect.com"
path = "/v2/accountform?"
url = host + path

# You'll receive sandbox credentials when you register with
# https://https://developer.sandbox.payaconnect.com/ and click SignUp.
locationID = "[Location ID]"
developerID = "[Developer ID]"
userID = "[User ID]"
userHashKey = "[User Hash Key]"

# A Contact ID is created when you create a contact withing
# the Contacts Endpoint. You can also use a contact_api_id
contactID = "[Contact ID]"

time = Time.now.to_i
timestamp = time.to_s
puts "Timestamp: " + timestamp

# Create the hash key by creating a SHA256 HMAC of
# the User ID and an epoch timestamp.
data = userID + timestamp
hashKey = OpenSSL::HMAC.hexdigest("SHA256", userHashKey, data)
puts "Hash Key: " + hashKey

# Built custom JSON request allowing the solution to pre-fill from
# existing client data. Additional details on AccountForm can be found
# at https://docs.payaconnect.com/developers/quick-start/payform-accountform
reqJson = {accountvault: {
  payment_method: 'cc',
  location_id: locationID,
  contact_id: contactID,
  # account_vault_api_id is an integrator-defined value that may be
  # used in place of the account_vault_id returned within the response.
  account_vault_api_id: 'SDKVault' + timestamp,
  title: 'SDKAccountVault',
  account_holder_name: 'Jim Smith',
  entry_method: 'manual',
  }
}.to_json

puts "Request Body:"
puts reqJson

preHexReq = reqJson.unpack("H*")
hexReq = preHexReq[0].to_s

puts "Hex Request:"
puts hexReq

link = host + path + "developer-id=" + developerID + "&hash-key=" + hashKey + "&user-id=" + userID + "&timestamp=" + timestamp + "&data=" + hexReq

# output encoded link. This can be output within an iFrame on your site
puts "Encoded Link:"
puts link
