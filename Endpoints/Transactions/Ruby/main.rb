# /*----------------------------------------------
# Author: SDK Support Group
# Company: Paya
# Contact: sdksupport@nuvei.com
# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
# !!! Samples intended for educational use only!!!
# !!!        Not intended for production       !!!
# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
# -----------------------------------------------*/


require 'net/http'
require 'uri'
require 'json'
require 'openssl'


host = "https://api.sandbox.payaconnect.com"
path = "/v2/transactions"
url = host + path

# You'll receive sandbox credentials when you register with
# https://https://developer.sandbox.payaconnect.com/ and click SignUp.
locationID = "[Location ID]"
developerID = "[Developer ID]"
userID = "[User ID]"
userAPIKey = "[User API Key]"

uri = URI.parse(url)

time = Time.now.to_i
timestamp = time.to_s
puts "Timestamp: " + timestamp

header = {
  'Content-Type'=> 'application/json',
  'developer-id'=> developerID,
  'user-api-key'=> userAPIKey,
  'user-id'=> userID,
}

reqJson = {transaction: {
  action: 'sale',
  account_type: 'mc',
  payment_method: 'cc',
  location_id: locationID,
  transaction_amount: '1.00',
  account_number: '5454545454545454',
  exp_date: '1221',
  cvv: '123',
  order_num: 'Invoice ' + timestamp,
  description: 'SDK Test CC Sale Ruby'
  }
}.to_json

puts "Request Body:"
puts reqJson

# Create the HTTP objects
http = Net::HTTP.new(uri.host, uri.port)
http.use_ssl = true
http.verify_mode = OpenSSL::SSL::VERIFY_NONE


request = Net::HTTP::Post.new(uri.request_uri, header)
request.body = reqJson

# Send the request
response = http.request(request)
puts "Response Code:"
puts response.code
puts "Response Body:"
puts response.body
