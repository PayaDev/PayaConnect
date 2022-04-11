# Using window.postMessage()
Using postMessage with PayForm, AccountForm, or Hosted Payment Page is easy! You just need to add some code within your application to make use of our postMessage call.

### Enabling postMessage
Below you will see a code example in Node on how you would build your data packet and construct the url for the form.  Notice that we are adding a field "parent_send_message" with a value of 1 to enable postMessage functionality.

```javascript
// Your custom ticket hash key
var encryption_key = 'my_ticket_hash_key';

// Sample JSON of the base data:
var data = JSON.stringify({
    "id": "xxxxxxxxxxxxxxxxxxxxxxxx",
    "parent_send_message": 1 // Adding/setting this field to 1 will enable postMessage
});

// Encrypt the JSON object using the encryption_key
var encrypted_data = CryptoJS.AES.encrypt(data, encryption_key).toString();
 
// URL encode the encrypted data so it can be sent in the URL
var encoded_data = encodeURIComponent(encrypted_data);

// The endpoint you are using.  Could also be "accountform" or "payform"
var endpoint = "hostedpaymentpage";

// Put together the final URL: for displaying in your page
var url = 'https://{sandbox_url}/' + endpoint + '?id={id}&data=' + encoded_data;

// Here is the final URL
console.log(url);
```

### Receiving the Message
In the code sample below, you will see some JavaScript adding an event listener that will log the event object and data that was received from the postMessage() call. This logging is just for testing purposes to allow you to see the structure of the data being received. The console.log calls can be removed when your testing is complete (should be replaced with your actual business logic to process the message or respond to it).

```html
<html>
    <head>
    </head>
    <body>
      <!-- Other HTML Here -->

      <!-- Add this script tag prior to embedding the iFrame -->
      <script>
        window.addEventListener("message", receiveMessage, false);

        function receiveMessage(event) {
          // Make sure the value for allowed matches the domain of the iFrame you are embedding.
          var allowed = "https://api.sandbox.domain.com";
          
          // Verify sender's identity
          if (event.origin !== allowed) return;

          // Add logic here for doing something in response to the message
          console.log(event); // for example only, log event object
          console.log(JSON.parse(event.data)); // for example only, log JSON data
        }
      </script>

    <!-- include the iframe after the script tag for the event listener -->
    <iframe src="https://{sandbox_url}/{payform|accountform|hostedpaymentpage}?id={id}&data={data}"></iframe>
  </body>
</html>
```
Once a successful payment is made inside the iFrame, the iFrame will fire postMessage using the JSON response from the form post as the value of the message.

## Security concerns
**If you do not expect to receive messages from other sites, do not add any event listeners for message events. This is a completely foolproof way to avoid security problems.**

**If you do expect to receive messages from other sites, always verify the sender's identity** using the origin and possibly source properties. Any window (including, for example, http://evil.example.com) can send a message to any other window, and you have no guarantees that an unknown sender will not send malicious messages. Having verified identity, however, you still should always verify the syntax of the received message. Otherwise, a security hole in the site you trusted to send only trusted messages could then open a cross-site scripting hole in your site.

### Additional Information

See [https://developer.mozilla.org/en-US/docs/Web/API/Window/postMessage](https://developer.mozilla.org/en-US/docs/Web/API/Window/postMessage) for more info on postMessage.
