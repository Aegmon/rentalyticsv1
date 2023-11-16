<?php
require_once('../vendor/autoload.php');

use GuzzleHttp\Client;

$client = new Client();

// Retrieve the monthlyPaymentId from the form
$application_id = $_POST['application_id'];
$amount = $_POST['amount']*1; // Replace with the actual amount

// Define other parameters
$currency = 'PHP'; // Replace with the appropriate currency code
$description = 'Monthly Subscription Payment'; // Replace with the actual description

$apiKey = 'sk_test_Td7GwHpGcyarL7M7bCq3xW3w'; // Replace with your actual PayMongo secret key
$success_url = "http://localhost/rentalytics/tenant/renter.php?application_id=" . $application_id;


try {
    $response = $client->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
        'body' => json_encode([
            'data' => [
                'attributes' => [
                    'send_email_receipt' => false,
                    'show_description' => true,
                    'show_line_items' => true,
                    'line_items' => [
                        [
                            'currency' => $currency,
                            'amount' => $amount,
                            'name' => 'name',
                            'quantity' => 1
                        ]
                    ],
                    'payment_method_types' => ['gcash'],
                    'reference_number' => $application_id,
                    'description' => $description,
                    'success_url' => $success_url
                ]
            ]
        ]),
        'headers' => [
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
            'authorization' => 'Basic ' . base64_encode($apiKey),
        ],
    ]);

    $responseData = json_decode($response->getBody(), true);
    $link = $responseData['data']['attributes']['checkout_url'];

    // Redirect the user to the generated link
    header("Location: $link");
    exit;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
