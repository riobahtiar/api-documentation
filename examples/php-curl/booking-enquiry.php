<?php

// Load client
require_once 'helpers/autoload.php';

$uri = 'http://carltonsoftware.apiary.io/';
$secret = '';
$key = '';
$client = \tabs\api\client\ApiClient::factory($uri, $key, $secret);

// Request data
$data = array(
    'propertyRef' => 'mousecott',
    'brandCode' => 'SS',
    'fromDate' => '2012-07-01',
    'toDate' => '2012-07-08',
    'partySize' => 5,
    'pets' => 2
);

$response = $client->post(
    '/booking-enquiry', 
    array(
        'data' => json_encode($data)
    )
);

$bookingEnquiry = $response->response;

$extrasPrice = 0;
foreach ($bookingEnquiry->price->extras as $extra) {
    $extrasPrice += $extra->totalPrice;
}

?>

<h1>Your Holiday Price</h1>
<ul>
    <li>
        <label>Basic Price:</label>
        &pound;<?php echo $bookingEnquiry->price->basicPrice; ?>
    </li>
    <li>
        <label>Extras Price:</label>
        &pound;<?php echo $extrasPrice; ?>
    </li>
    <li style="font-weight: bold;">
        <label>Total Price:</label>
        &pound;<?php echo $bookingEnquiry->price->totalPrice; ?>
    </li>
</ul>
