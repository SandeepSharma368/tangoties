<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require 'vendor/autoload.php'; // Assuming you have the AWS SDK installed via Composer

use Aws\Sns\SnsClient;
use Aws\Exception\AwsException;

// Check if the phone number parameter exists
if (isset($_GET['phone'])) {
    $phone = $_GET['phone'];

    // Generate a random 6-digit OTP
    $otp = mt_rand(100000, 999999);

    // Set up your AWS credentials and region
    $credentials = [
        'key' => 'AKIA4FOKPGVTACC5RFVN',
        'secret' => 'riuOUSaMgLyLz1SxmApxyBzOVPDr/GwZv7rlh+iz',
        'region' => 'ap-south-1' // Replace with your desired AWS region
    ];

    // Set your SNS topic ARN
    // $topicArn = 'arn:aws:sns:ap-south-1:836332631398:tAngoties-OTP'; // Replace with your actual SNS topic ARN

    // Create an instance of the SNS client
    $snsClient = new SnsClient([
        'version' => 'latest',
        'credentials' => $credentials,
        'region' => $credentials['region']
    ]);

    // Specify the message to be sent via SMS
    $message = "Your tAnGO ties OTP is: $otp This is valid for 5 minutes. Please use it within this time frame for authentication.";

    // Set the SMS attributes
    $smsAttributes = [
        'AWS.SNS.SMS.SMSType' => [
            'DataType' => 'String',
            'StringValue' => 'Transactional' // Change this to 'Promotional' if needed
        ]
    ];

    try {
        // Send the SMS via AWS SNS
        $result = $snsClient->publish([
            'Message' => $message,
            'PhoneNumber' => $phone,
            'MessageAttributes' => $smsAttributes,
           // 'TopicArn' => $topicArn
        ]);

        // Store the OTP and its expiry time in a session
        session_start();
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_expiry'] = time() + (5 * 60); // OTP expires in 5 minutes

        // Redirect to the OTP verification page
        header("Location: otp_verification.php?phone=" . $phone);
        exit();
    } catch (AwsException $e) {
        echo "Error sending OTP: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>

