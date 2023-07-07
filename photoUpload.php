<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// AWS credentials
$bucketName = 'tangoties'; // Replace with your bucket name
$accessKey = 'AKIA4FOKPGVTBBJDX535';
$secretKey = 'E2lGSh6KhQtlIcJngWmqfipiIlWUI3Zavfrqm+P1';

// Create an S3 client
$s3Client = new S3Client([
    'region' => 'as-south-1', // Replace with your desired region
    'version' => 'latest',
    'credentials' => [
        'key' => $accessKey,
        'secret' => $secretKey
    ]
]);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $interestedIn = $_POST['interested_in'];
    $minAge = $_POST['min_age'];
    $maxAge = $_POST['max_age'];

    // Check if a file is uploaded
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        // Get the uploaded file details
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileName = $_FILES['photo']['name'];
        $fileSize = $_FILES['photo']['size'];
        $fileType = $_FILES['photo']['type'];

        // Generate a unique filename
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . '.' . $fileExtension;

        // Specify the S3 bucket path
        $s3Key = $phone . '/' . $uniqueFileName;

        // Upload the file to S3
        try {
            $result = $s3Client->putObject([
                'Bucket' => $bucketName,
                'Key' => $s3Key,
                'SourceFile' => $fileTmpPath,
                'ACL' => 'public-read'
            ]);

            // Get the public URL of the uploaded file
            $fileUrl = $result['ObjectURL'];

            // Store the file URL and other form data in the database or perform any other actions
            // ...

            // Display a success message
            echo "Photo uploaded successfully!";
        } catch (AwsException $e) {
            // Display an error message
            echo "Error uploading photo: " . $e->getMessage();
        }
    } else {
        // Display an error message if no file is uploaded
        echo "No file uploaded.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Photo Upload</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        /* Add the CSS rule for submit button */
        .submitButton {
            font-size: 16px;
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="header">
        <ul id="tabs">
            <li onclick="location.reload();">Home</li>
            <li>AboutUs</li>
            <li onclick="window.location.href = 'policy.php'">Policy</li>
        </ul>
    </div>

    <div class="container">
        <h2>Upload Your Photo</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="photo">Choose a photo:</label>
            <input type="file" id="photo" name="photo" accept="image/*" required>
            <br>
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="phone" value="<?php echo $phone; ?>">
            <input type="hidden" name="gender" value="<?php echo $gender; ?>">
            <input type="hidden" name="age" value="<?php echo $age; ?>">
            <input type="hidden" name="interested_in" value="<?php echo $interestedIn; ?>">
            <input type="hidden" name="min_age" value="<?php echo $minAge; ?>">
            <input type="hidden" name="max_age" value="<?php echo $maxAge; ?>">
            <input type="submit" class="submitButton" value="Upload Photo">
        </form>
    </div>
</body>
</html>

