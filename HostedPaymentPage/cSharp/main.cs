using System;
using System.IO;
using System.Net.Http;
using System.Security.Cryptography;
using System.Text;
using System.Threading.Tasks;
using System.Diagnostics;
using System.Web;
using System.Net;
using System.Linq;

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

        // TH - Added the equivalent of vbCrLf in vb.net
        var nl = Environment.NewLine;

        // Build Timestamp for the Hash Key
        Int32 timestamp = (Int32)(DateTime.UtcNow.Subtract(new DateTime(1970, 1, 1))).TotalSeconds;

        // TH - Test Data is provided when you register at
        // https://developer.sandbox.payaconnect.com
        // If you have any questions feel free to reach out
        // to us directly at sdksupport@paya.com 
        var hppID = "[Hosted Payment Page ID]";
        var hpp_hash_key = "[Hosted Payment Page Hash Key]";
        var transAPIID = "SDK" + timestamp;
        
        // TH - The Developer ID is assigned when registering with the
        // Paya Connect developer portal listed above. It is not
        // required for HPP, but will allow your requests to record
        // to the request logs within the developer portal and allow
        // Paya to track requests from your solution in production.
        var developerID = "[Developer ID]";

        // Use JSON request from file.
        StreamReader sr = new StreamReader("sale.json");
        string jsonReq = sr.ReadToEnd();
        // Replace "@" placeholders in the JSON file with variables.
        string request = jsonReq.Replace("@hppID", hppID)
            .Replace("@transAPIID", transAPIID);
        sr.Close();

        var data = AESEncrypt(hpp_hash_key, request);


        // Build URL
        var endpoint = "/hostedpaymentpage?";
        var url = "https://api.sandbox.payaconnect.com" + endpoint;

        // Build link
        var link = url + "id=" + hppID + "&developer-id=" + developerID + "&data=" + data;

        // Console output for debugging.
        Console.WriteLine("EXECUTING THE FOLLOWING:");
        Console.WriteLine(nl);
        Console.WriteLine("Request:");
        Console.WriteLine(request);
        Console.WriteLine(nl);
        Console.WriteLine("Timestamp: " + timestamp);
        Console.WriteLine(nl);
        Console.WriteLine("WebLink:");
        Console.WriteLine(link);
        Console.WriteLine(nl);

    }

//Encryption
public static string AESEncrypt(string password, string fieldConfig)
        {
            byte[] saltPrefix = Encoding.UTF8.GetBytes("Salted__");
            Aes alg = Aes.Create();

            // Generate salt
            byte[] salt = new byte[8];
            RandomNumberGenerator.Fill(salt);

            MD5 md5 = MD5.Create();
            byte[] keyMaterial = new byte[0];
            byte[] dx = new byte[0];
            byte[] passwordBytes = Encoding.UTF8.GetBytes(password);

            // need total length of 48 bytes, Key = 32 bytes, Initialization Vector = 16 bytes
            while (keyMaterial.Length < 48)
            {
                byte[] hashing = dx.Concat(passwordBytes)
                    .Concat(salt)
                    .ToArray();

                dx = md5.ComputeHash(hashing);
                keyMaterial = keyMaterial.Concat(dx).ToArray();
            }

            // Take first 32 bytes for key
            alg.Key = keyMaterial.Take(32).ToArray();

            // Take the last 16 bytes for IV
            alg.IV = keyMaterial.Skip(32)
                .Take(16)
                .ToArray();

            byte[] payload = Encoding.UTF8.GetBytes(fieldConfig);

            using (MemoryStream memoryStream = new MemoryStream())
            {
                using (CryptoStream cryptoStream = new CryptoStream(memoryStream, alg.CreateEncryptor(), CryptoStreamMode.Write))
                {
                    cryptoStream.Write(payload, 0, payload.Length);
                }

                byte[] fromMemStream = memoryStream.ToArray();

                // The final data consists if the 'Salted__' prefix, plus the salt, plus the encrypted data
                byte[] finalData = saltPrefix.Concat(salt)
                    .Concat(fromMemStream)
                    .ToArray();

                string result = WebUtility.UrlEncode(Convert.ToBase64String(finalData));

                return result;
            }
        }

}
        
