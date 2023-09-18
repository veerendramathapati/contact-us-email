<?php
require 'vendor/autoload.php'; // Include the Mailchimp PHP library

use MailchimpMarketing\ApiClient;

$apiKey = '3839c057bc9d4701244545c2afe355da-us21'; // Replace with your Mailchimp API key
$listId = '1955407f33'; // Replace with the ID of your audience list

$mailchimp = new ApiClient();
$mailchimp->setConfig([
    'apiKey' => $apiKey,
    'server' => 'us21', // Example: us7
]);

$subscriberHash = md5(strtolower('veerumathapati7@gmail.com')); // Hash the email address

// Create a campaign
$response[] = $mailchimp->campaigns->create([
    'type' => 'regular',
    'recipients' => ['list_id' => $listId],
    'settings' => [
        'subject_line' => 'Contact US',
        'from_name' => 'test veer',
        'reply_to' => 'support-akash@gmail.com',
    ],
]);
$array = json_decode(json_encode($response), true);
$response = $array[0];
// Set the content of the email
$mailchimp->campaigns->setContent($response['id'], [
    'html' => '<p>Your HTML email content here.</p>',
]);

// Send the campaign
$mailchimp->campaigns->send($response['id']);

echo 'Email campaign sent successfully.';
?>
