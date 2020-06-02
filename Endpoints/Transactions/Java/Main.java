///*----------------------------------------------
//Author: Thomas Hagan
//Company: Paya
//Contact: sdksupport@paya.com
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//!!! Samples intended for educational use only!!!
//!!!        Not intended for production       !!!
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//-----------------------------------------------*/

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.nio.file.Path;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.nio.charset.StandardCharsets;
import javax.crypto.Mac;
import javax.crypto.spec.SecretKeySpec;
import java.util.Base64;


public class Main {

	public static void main(String[] args) throws Exception {

	  try {

		//Set Variables
    //Sandbox IDs and Keys may be obtained by contacting sdksupport@paya.com
		String locationID = "[Location ID]";
		String userID = "[User ID]";
		String userAPIKey = "[User API Key]";
		String developerID = "[Developer ID]";
		String verb = "POST";
		String host = "https://api.sandbox.payaconnect.com";
		String query = "/v2/transactions";
    String endpoint = host + query;
		long epoch = System.currentTimeMillis()/1000;
		String timestamp = Long.toString(epoch);
		
		String body = new String(Files.readAllBytes(Paths.get("request.json")), StandardCharsets.UTF_8);
    System.out.println("Body:");
    System.out.println(body);
		
		URL url = new URL(endpoint);
		HttpURLConnection conn = (HttpURLConnection) url.openConnection();
		conn.setDoOutput(true);
		conn.setRequestMethod(verb);
		conn.setRequestProperty("developer-id", developerID);
		conn.setRequestProperty("user-api-key", userAPIKey);
    conn.setRequestProperty("user-id", userID);
		conn.setRequestProperty("cache-control", "no-cache");
		conn.setRequestProperty("Content-Type", "application/json");

		

		String input = body;

		OutputStream os = conn.getOutputStream();
		os.write(input.getBytes());
		os.flush();

		if (conn.getResponseCode() != HttpURLConnection.HTTP_CREATED) {
			throw new RuntimeException("Failed : HTTP error code : "
				+ conn.getResponseCode() + " Server Response: " + conn.getResponseMessage());
		}

		BufferedReader br = new BufferedReader(new InputStreamReader(
				(conn.getInputStream())));

		String output;
		System.out.println("Output from Server .... \n");
		while ((output = br.readLine()) != null) {
			System.out.println(output);
		}

		conn.disconnect();

	  } catch (MalformedURLException e) {

		e.printStackTrace();

	  } catch (IOException e) {

		e.printStackTrace();

	 }

	}

}