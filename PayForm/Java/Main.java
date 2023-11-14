// /*----------------------------------------------
// Author: SDK Support Group
// Company: Paya
// Contact: sdksupport@nuvei.com
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// !!! Samples intended for educational use only!!!
// !!!        Not intended for production       !!!
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// -----------------------------------------------*/       

import java.io.*;
import java.nio.file.Path;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.nio.charset.StandardCharsets;
import java.security.spec.KeySpec;
import javax.crypto.Mac;
import javax.crypto.spec.SecretKeySpec;
import javax.crypto.Cipher;
import javax.crypto.SecretKey;
import javax.crypto.SecretKeyFactory;
import javax.crypto.spec.IvParameterSpec;
import javax.crypto.spec.PBEKeySpec;
import java.io.UnsupportedEncodingException;
import java.math.BigInteger;
import java.util.Scanner;

class Main {
  public static void main(String[] args) throws Exception  {
    
    // Test credentials are provided when you register at
    // https://developer.sandbox.payaconnect.com/users/register
    // If you have any questions feel free to reach out
    // to us directly at sdksupport@nuvei.com 
    String developerID = "[Developer ID]";
    String userID = "[User ID]";
    String userHashKey = "[User Hash Key]";

    // The Location ID typically relates to a single merchant account
    String locationID = "[Location ID]";
    
    // The Product Transaction ID indicates a service/deposit account.
    // This is found within your developer account under the "Services"
    // tab.
    String productTransactionID = "[Product Transaction ID]";
    
    // The Contact ID is created when you create a contact record
    // Using eithe the Contacts Endpoint or within the Paya Connect
    // Sandbox UI. This value is optional.
    String contactID = "[Contact ID]";

    String host = "https://api.sandbox.payaconnect.com";
    String endpoint = "/v2/payform";

    // Create the epoch timestamp for use with generating
    // the Hash Key
    long epoch = System.currentTimeMillis()/1000;
    String timestamp = Long.toString(epoch);
    System.out.println("Timestamp: " + timestamp);

    // Generate the secure hash, making sure the variables
    // are in the proper sequence. The Hash Key is the encoded string
    // consisting of the User ID and timestamp.
    String data = userID + timestamp;
    String hashKey = encode(userHashKey, data);

    // The Transaction API ID is a integrator-generated value
    // that serves as an alternative to the Transaction ID returned
    // within the response.
    String transactionAPIID = "SDKTEST" + timestamp;
    String orderNumber = "SDKORDER" + timestamp;

    // Create the JSON request.
    String cRequest = new String(Files.readAllBytes(Paths.get("request.json")), StandardCharsets.UTF_8);
    String request = cRequest.replace("@locationID",locationID).replace("@productTransactionID",productTransactionID).replace("@contactID",contactID).replace("@transactionAPIID",transactionAPIID).replace("@orderNumber",orderNumber);
    
    System.out.println("Request:");
    System.out.println(request);

    // Hex convert the request
    String hexReq = toHexString(request.getBytes("UTF-8"));

    // Build the custom URL
    String link = host + endpoint + "?developer-id=" + developerID + "&hash-key=" + hashKey + "&user-id=" + userID + "&timestamp=" + timestamp + "&data=" + hexReq;

    // Typically you'll host the link within an iFrame
    System.out.println("Link:");
    System.out.println(link);
    



    

  }

  public static String encode(String key, String data) throws Exception {
  Mac sha256_HMAC = Mac.getInstance("HmacSHA256");
  SecretKeySpec secret_key = new SecretKeySpec(key.getBytes("UTF-8"), "HmacSHA256");
  sha256_HMAC.init(secret_key);

  return toHexString(sha256_HMAC.doFinal(data.getBytes("UTF-8")));
  }

  public static String toHexString(byte[] ba) {
    StringBuilder str = new StringBuilder();
    for(int i = 0; i < ba.length; i++)
        str.append(String.format("%02x", ba[i]));
    return str.toString();
  }



}
