<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Decode the JSON POST data
$post = json_decode($_POST['trackDetails'], true);

// Prepare response data
$response = [
  'status' => 'ERROR', // Default status
  'transactionId' => isset($post['details']['tezResponse']['transactionId']) ? $post['details']['tezResponse']['transactionId'] : 'N/A',
  'amount' => isset($post['details']['tezResponse']['amount']) ? $post['details']['tezResponse']['amount'] : 'N/A',
  'message' => 'Payment Failed. Please try again.' // Default message
];

// Modify response based on the payment status
if (isset($post['details']['tezResponse']['status']) && $post['details']['tezResponse']['status'] === 'SUCCESS') {
  $response['status'] = 'SUCCESS';
  $response['message'] = 'Payment succeeded.';
}

// Send the response as JSON
echo json_encode($response);
?>
