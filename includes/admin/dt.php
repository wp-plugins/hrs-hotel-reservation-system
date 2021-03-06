<?php


require __DIR__  . '/PayPal-PHP-SDK/autoload.php';


 // After Step 1


$apiContext = new \PayPal\Rest\ApiContext(


    new \PayPal\Auth\OAuthTokenCredential(


        'ARey4RAgiqpI7uRUXxFDzaTY7Z4YjHTwqRyxSBfSbaOCIwWkI3wH4wM8tfYJ',     // ClientID


        'ENGZ6hBaS1jmDGygEPbsGyDU8bv_07nIu1uALcTDrQhgL2NvSm4jccOwWo9K'      // ClientSecret


    )
	/*new \PayPal\Auth\OAuthTokenCredential(


        'ARrVchD_f624Bc1ojod2idzcSpEgS5oeR-WQAgXsV0wDhVpL6Ca8qH91ew9T',     // ClientID


        'ECfTERCDXelYbfzErItbOTTs748DHlGazNSdQn3aLETRiqlBvSiRWSsxYu6Y'      // ClientSecret


    )*/


);





use PayPal\Api\Amount;


use PayPal\Api\Details;


use PayPal\Api\Item;


use PayPal\Api\ItemList;


use PayPal\Api\Payer;


use PayPal\Api\Payment;


use PayPal\Api\RedirectUrls;


use PayPal\Api\Transaction;





use PayPal\Api\ExecutePayment;


use PayPal\Api\PaymentExecution;





// ### Payer


// A resource representing a Payer that funds a payment


// For paypal account payments, set payment method


// to 'paypal'.


$payer = new Payer();


$payer->setPaymentMethod("paypal");





// ### Itemized information


// (Optional) Lets you specify item wise


// information


$item1 = new Item();


$item1->setName('Ground Coffee 40 oz')


    ->setCurrency('USD')


    ->setQuantity(1)


    ->setSku("123123") // Similar to `item_number` in Classic API


    ->setPrice(7.5);


$item2 = new Item();


$item2->setName('Granola bars')


    ->setCurrency('USD')


    ->setQuantity(5)


    ->setSku("321321") // Similar to `item_number` in Classic API


    ->setPrice(2);





$itemList = new ItemList();


$itemList->setItems(array($item1, $item2));





// ### Additional payment details


// Use this optional field to set additional


// payment information such as tax, shipping


// charges etc.


$details = new Details();


$details->setShipping(1.2)


    ->setTax(1.3)


    ->setSubtotal(17.50);





// ### Amount


// Lets you specify a payment amount.


// You can also specify additional details


// such as shipping, tax.


$amount = new Amount();


$amount->setCurrency("USD")


    ->setTotal(20)


    ->setDetails($details);





// ### Transaction


// A transaction defines the contract of a


// payment - what is the payment for and who


// is fulfilling it. 


$transaction = new Transaction();


$transaction->setAmount($amount)


    ->setItemList($itemList)


    ->setDescription("Payment description")


    ->setInvoiceNumber(uniqid());





// ### Redirect urls


// Set the urls that the buyer must be redirected to after 


// payment approval/ cancellation.





$redirectUrls = new RedirectUrls();


$redirectUrls->setReturnUrl("http://localhost/paypal-SDK/test2.php?success=true")


    ->setCancelUrl("http://localhost/paypal-SDK/test2.php?success=false");





// ### Payment


// A Payment Resource; create one using


// the above types and intent set to 'sale'


$payment = new Payment();


$payment->setIntent("sale")


    ->setPayer($payer)


    ->setRedirectUrls($redirectUrls)


    ->setTransactions(array($transaction));








// For Sample Purposes Only.


$request = clone $payment;





// ### Create Payment


// Create a payment by calling the 'create' method


// passing it a valid apiContext.


// (See bootstrap.php for more on `ApiContext`)


// The return object contains the state and the


// url to which the buyer must be redirected to


// for payment approval


try {


    $payment->create($apiContext);


	echo '<pre>';


	print_r($payment->getId());


	echo '</pre>';


} catch (Exception $ex) {


    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY


 	//ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);


	$cred_error = json_decode( $ex->getData() );


	echo '<pre>';


	echo $cred_error->error;


	echo '</pre>';


    exit(1);


}





// ### Get redirect url


// The API response provides the url that you must redirect


// the buyer to. Retrieve the url from the $payment->getApprovalLink()


// method


echo '<h1>ok__ '.$payment->getState().' __ok</h1><br />';


$approvalUrl = $payment->getApprovalLink();


echo '<hr />';


echo '<h1>url</h1>';


echo $approvalUrl;


echo '<pre>';


print_r($payment);


echo '</pre>';


