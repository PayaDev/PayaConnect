/*----------------------------------------------
Author: SDK Support Group
Company: Paya
Contact: sdksupport@nuvei.com
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
!!! Samples intended for educational use only!!!
!!!        Not intended for production       !!!
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
-----------------------------------------------*/

// For more information on this request and Quick Invoice in general please
// go to https://docs.payaconnect.com/developers/api/endpoints/quickinvoices
// If you do not have your sandbox credentials please register with the 
// Paya Connect Developer Portal at https://developer.sandbox.payaconnect.com/

	require('dotenv').config({ path: './shared.env' })
	var developerId = process.env.developer_id;
	var userId = process.env.user_id;
	var userAPIKey = process.env.user_api_key;
	var locationId = process.env.location_id;
	var timestamp = Math.floor(new Date().getTime()/1000.0);

	const fs = require('fs');
	const request = require('request');

	const jar = request.jar();

	const options = {
	  method: 'POST',
	  url: 'https://api.sandbox.payaconnect.com/v2/quickinvoices',
	  headers: {
		'Content-Type': 'multipart/form-data; boundary=---011000010111000001101001',
		'user-id': userId,
		'user-api-key': userAPIKey,
		'developer-id': developerId
	  },
	  formData: {
		'quickinvoice[title]': 'Quick Invoice Creation',
		'quickinvoice[due_date]': '2022-02-27',
		'quickinvoice[allow_partial_pay]': '0',
		'quickinvoice[send_email]': '1',
		'quickinvoice[email]': '[Email Address]',
		'quickinvoice[invoice_number]': timestamp,
		'quickinvoice[item_list][SDK Samples]': '1000.00',
		'quickinvoice[location_id]': locationId,
		'quickinvoice[contact_id]': '[Contact ID]',
		'quickinvoice[attach_files_to_email]': '1',
		'quickinvoice[files][0]': {
		  value: fs.createReadStream('sample_invoice.pdf'),
		  options: {filename: 'sample_invoice.pdf', contentType: null}
		}
	  },
	  jar: 'JAR'
	};

	request(options, function (error, response, body) {
	  if (error) throw new Error(error);

	  const jBody = JSON.parse(body);
	  console.log(jBody);
	});
