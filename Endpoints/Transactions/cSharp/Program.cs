//===========================================================
//Sample Paya Connect Transactions Endpoint Request - C#.net
//Thomas Hagan
//Integration Consultant Sr
//Paya, Inc.
//Pubilished: October 10th, 2019
//     ------------------IMPORTANT!-----------------
//Application is intended for instructional use only.
//If you have any questions, please feel free to email
//the Integration Support team at sdksupport@paya.com
//Also, please make sure to register for sandbox API credentials
//at our developer portal: https://developer.sandbox.payaconnect.com
//==========================================================

using System;
using System.IO;
using System.Net;
using System.Text;

namespace PayaConnect_Transactions_Sale
{
    class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("Paya Connect Transactions Endpoint Sale Sample");

            // Location, Developer, and User, variables
            string locationId = "[Location ID]";
            string userId = "[User ID]";
            string userAPIKey = "[User API Key]";
            string developerId = "[Developer ID]";

            // Connection variables
            string host = "https://api.sandbox.payaconnect.com";
            string endpoint = "/v2/transactions";
            string url = host + endpoint;
            string verb = "POST";
            string contentType = "application/json";

            // Display URL
            Console.WriteLine("URL: " + url);

            // Other variables
            TimeSpan t = DateTime.UtcNow - new DateTime(1970, 1, 1, 0, 0, 0);
            string timestamp = t.TotalSeconds.ToString();
            string nl = Environment.NewLine;

            // Build JSON Request
            var strRequest = "{	\"transaction\": {		\"action\": \"sale\",		\"payment_method\": \"cc\",		\"location_id\": \"" + locationId + "\",		\"transaction_amount\": \"1.00\",		\"account_number\": \"5454545454545454\",		\"exp_date\": \"1221\",		\"order_num\": \"Invoice " + timestamp + "\",		\"cvv\": \"123\",		\"description\": \"SDK Test CC Sale\",		\"save_account\": 1,		\"billing_street\": \"123 Main St\",		\"billing_zip\": \"31405\"	}}";

            // Display JSON Request
            Console.WriteLine("Request:");
            Console.WriteLine(strRequest);

            // Initiate Web Request
            var web_request = (HttpWebRequest)WebRequest.Create(url);

            // Set the headers and details
            var web_request_headers = web_request.Headers;
            Console.WriteLine("Configuring web_request to include headers for Paya Connect Direct API");
            web_request_headers["developer-id"] = developerId;
            web_request_headers["user-api-key"] = userAPIKey;
            web_request_headers["user-id"] = userId;
            web_request.Method = verb;

            // Format the request
            var byteArray = Encoding.ASCII.GetBytes(strRequest);

            // Send the data

            web_request.ContentType = contentType;
            web_request.ContentLength = byteArray.Length;
            var datastream = web_request.GetRequestStream();
            datastream.Write(byteArray, 0, byteArray.Length);
            datastream.Close();

            //TH - Get the Response and Catch any errors.
            try
            {
                var web_response = (HttpWebResponse)web_request.GetResponse();
                Console.WriteLine(web_response.StatusDescription);
                datastream = web_response.GetResponseStream();

                var reader = new StreamReader(datastream);
                string responseFromServer = reader.ReadToEnd();
                Console.WriteLine(responseFromServer);
                reader.Close();
                datastream.Close();
                web_response.Close();

                // Display response.
                // Added more detail to the displayed response.
                Console.WriteLine("Server Status Code: " + web_response.StatusCode + nl +
                    "Server Status: " + web_response.StatusDescription + nl +
                    "API Response: " + responseFromServer);

            }
            // Added WebExecption to allow code to gather added detail from the exception.
            catch (WebException exception)
            {
                // Added more detail regarding exception to gather the API response data.
                var sResponse = new StreamReader(exception.Response.GetResponseStream()).ReadToEnd();
                Console.WriteLine("Server Response: " + exception.Message + nl + nl +
                    "API Response: " + sResponse);
            }

            catch (Exception exception)
            {
                Console.WriteLine("Server Response: " + exception.Message);
            }
        }
    }
}
