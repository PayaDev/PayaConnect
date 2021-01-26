//===========================================================
// Sample Paya Connect Transactions Endpoint Request - C#
// Thomas Hagan
// Integration Consultant Sr
// Paya, Inc.
// Pubilished: January 26th, 2021
//     ------------------IMPORTANT!-----------------
// Application is intended for instructional use only.
// If you have any questions, please feel free to email
// the Integration Support team at sdksupport@paya.com
// Also, please make sure to register for sandbox API credentials
// at our developer portal: https://developer.sandbox.payaconnect.com
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
            // Details on performing requests against the Router Transactions
            // Endpoint can be found at
            // https://docs.payaconnect.com/developers/api/endpoints/routertransactions
            
            Console.WriteLine("Paya Connect Transactions Endpoint Sale Sample");

            // Location, Developer, and User, variables
            string locationId = "[Location ID]";
            string userId = "[User ID]";
            string userAPIKey = "[User API Key]";
            string developerId = "[Developer ID]";
            string terminalId = "[Terminal ID]";

            // Connection variables
            string host = "https://api.sandbox.payaconnect.com";
            string endpoint = "/v2/routertransactions";
            string url = host + endpoint;
            string verb = "POST";
            string contentType = "application/json";

            // Display URL
            Console.WriteLine("URL: " + url);

            // Other variables
            TimeSpan t = DateTime.UtcNow - new DateTime(1970, 1, 1, 0, 0, 0);
            string timestamp = t.TotalSeconds.ToString();
            string nl = Environment.NewLine;

            // Use JSON request from file.
            StreamReader sr = new StreamReader("sale.json");
            string jsonReq = sr.ReadToEnd();
            // Replace "@" placeholders in the JSON file with variables.
            string request = jsonReq.Replace("@locationId", locationId)
                .Replace("@timestamp", timestamp)
                .Replace("@terminalId", terminalId);
            sr.Close();

            // Display JSON Request
            Console.WriteLine("Request:");
            Console.WriteLine(request + nl + nl);

            // Initiate Web Request
            var web_request = (HttpWebRequest)WebRequest.Create(url);

            // Set the headers and details
            var web_request_headers = web_request.Headers;
            Console.WriteLine("Configuring web_request to include headers for Paya Connect Direct API" + nl);
            web_request_headers["developer-id"] = developerId;
            web_request_headers["user-api-key"] = userAPIKey;
            web_request_headers["user-id"] = userId;
            web_request.Method = verb;

            // Format the request
            var byteArray = Encoding.ASCII.GetBytes(request);

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
                Console.WriteLine(web_response.StatusDescription + nl);
                datastream = web_response.GetResponseStream();

                var reader = new StreamReader(datastream);
                string responseFromServer = reader.ReadToEnd();
                Console.WriteLine("Respnse From Server:" + nl + responseFromServer + nl + nl);
                reader.Close();
                datastream.Close();
                web_response.Close();

                // Display response.
                // Added more detail to the displayed response.
                Console.WriteLine("Server Status Code: " + web_response.StatusCode + nl + nl +
                    "Server Status: " + web_response.StatusDescription + nl + nl +
                    "API Response: " + nl + responseFromServer);

            }
            // Added WebExecption to allow code to gather added detail from the exception.
            catch (WebException exception)
            {
                // Added more detail regarding exception to gather the API response data.
                var sResponse = new StreamReader(exception.Response.GetResponseStream()).ReadToEnd();
                Console.WriteLine("WebException Response: " + exception.Message + nl + nl +
                    "API Response: " + sResponse);
            }

            catch (Exception exception)
            {
                Console.WriteLine("Exception Response: " + exception.Message);
            }
        }
    }
}
