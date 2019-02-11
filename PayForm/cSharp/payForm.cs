using System;
using System.IO;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Security.Cryptography;
using System.Text;
using System.Threading.Tasks;
using System.Diagnostics;
using System.Web;

/*----------------------------------------------
Author: SDK Support Group
Company: Paya
Contact: sdksupport@paya.com
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
!!! Samples intended for educational use only!!!
!!!        Not intended for production       !!!
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
-----------------------------------------------*/

class MainClass
{
    public static void Main(string[] args)
    {
        Trans().Wait();
    }

    static async Task Trans()
    {


        // TH - 20170304 - Added the equivalent of vbCrLf in vb.net
        var nl = Environment.NewLine;

        // TH - Test Data is provided when you register at
        // https://developer.sandbox.payaconnect.com/applicationrequest
        // If you have any questions feel free to reach out
        // to us directly at sdksupport@paya.com 
        var locationID = "Insert Location ID";
        var contactID = "Insert Contact ID";
        var transAPIID = "SDK19";
        var prodTransID = "Insert Product Transaction ID";

        // TH - The Developer ID is assigned when registering with the
        // Paya Connect developer portal listed above.
        var developerID = "Insert Developer ID";

        // TH - User credentials
        var userID = "Insert Developer ID";
        var user_hash_key = "Insert User Hash Key";

        // Build Timestamp for the Hash Key
        Int32 timestamp = (Int32)(DateTime.UtcNow.Subtract(new DateTime(1970, 1, 1))).TotalSeconds;

        // Use JSON request from file.
        StreamReader sr = new StreamReader("payment.json");
        string jsonReq = sr.ReadToEnd();
        // Replace "@" placeholders in the JSON file with variables.
        string request = jsonReq.Replace("@locationID", locationID)
            .Replace("@contactID", contactID)
            .Replace("@transAPIID", transAPIID)
            .Replace("@prodTransID", prodTransID);
        sr.Close();

        // Generate the secure hash, making sure the variables
        // are in the proper sequence.
        var data = userID + timestamp;

        byte[] hash_data = new HMACSHA256(Encoding.UTF8.GetBytes(user_hash_key)).ComputeHash(Encoding.UTF8.GetBytes(data));
        string hash_key = BitConverter.ToString(hash_data).ToLower().Replace("-", string.Empty);

        // Convert request from json string to bytes to hex for transport
        byte[] bytes = Encoding.Default.GetBytes(request);
        string hexReq = BitConverter.ToString(bytes).ToLower().Replace("-", string.Empty);

        // Build URL
        var endpoint = "/v2/payform?";
        var url = "https://api.sandbox.payaconnect.com" + endpoint;

        // Build link
        var link = url + "developer-id=" + developerID + "&hash-key=" + hash_key + "&user-id=" + userID + "&timestamp=" + timestamp + "&data=" + hexReq;

        // Console output for debugging.
        Console.WriteLine("EXECUTING THE FOLLOWING:");
        Console.WriteLine(nl);
        Console.WriteLine("Request:");
        Console.WriteLine(request);
        Console.WriteLine(nl);
        Console.WriteLine("Data for Hash Key:" + data);
        Console.WriteLine(nl);
        Console.WriteLine("Timestamp: " + timestamp);
        Console.WriteLine(nl);
        Console.WriteLine("WebLink:");
        Console.WriteLine(link);
        Console.WriteLine(nl);


        // Location of the executable for the browser differs based on system. May not
        // need to enter the location if you have IE as your default.
        var browserExecutable = "C:\\Program Files (x86)\\Google\\Chrome\\Application\\chrome.exe";
        Process.Start(browserExecutable, link);


        Console.WriteLine("Press Enter to exit:");
        Console.ReadLine();
    }

}
