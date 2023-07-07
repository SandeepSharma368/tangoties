o<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Check if the phone number parameter exists
if (isset($_GET['phone'])) {
    $phone = $_GET['phone'];

    // Check if OTP and its expiry time are stored in the session
    session_start();
    if (isset($_SESSION['otp']) && isset($_SESSION['otp_expiry'])) {
        // $otp = $_SESSION['otp'];
        // $otp_expiry = $_SESSION['otp_expiry'];

        // Check if the OTP has expired
        // if (time() > $otp_expiry) {
        //     echo "OTP has expired. Please try again.";
        //     exit();
        // }

        // Verify if the entered OTP is correct
        if (isset($_POST['otp'])) {
            $entered_otp = $_POST['otp'];

            if (strlen($entered_otp) === 6 && is_numeric($entered_otp)) {
                // Database connection configuration
                $host = 'database-1.c0mziqhjlyx3.ap-south-1.rds.amazonaws.com';
                $dbname = 'tt_usersdata';
                $username = 'admin';
                $password = 'master1234';

                // Create a PDO instance
                $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

                // Prepare the SQL statement with placeholders
                $stmt = $pdo->prepare("INSERT INTO Customers (c_name, c_phonenumber, c_email, c_gender, c_age) VALUES (:name, :phone, :email, :gender, :age)");

                // Set the values for the database insertion
                $name = isset($_SESSION['name']) ? $_SESSION['name'] : "";
                $email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
                $gender = isset($_SESSION['gender']) ? $_SESSION['gender'] : "";
                $age = isset($_SESSION['age']) ? $_SESSION['age'] : "";

                // Bind the values to the SQL statement parameters
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':age', $age);

                // Execute the SQL statement
                if ($stmt->execute()) {
                    echo "Data submitted successfully!";
                } else {
                    echo "Error occurred while submitting the form.";
                }
                exit(); // Stop further execution after successful data submission
            } else {
                echo "Invalid OTP. Please try again.";
                exit();
            }
        } else {
            // Display the OTP input form
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>OTP Verification</title>
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
                    <h2>OTP Verification</h2>
                    <p>The One-Time Password that has been sent to you remains valid for a duration of 5 minutes.</p>
                    <form method="POST" action="">
                        <label for="otp">Enter OTP:</label>
                        <input type="text" id="otp" name="otp" minlength="6" maxlength="6" pattern="[0-9]{6}" required>
                        <br>
                        <input type="hidden" name="phone" value="<?php echo $phone; ?>">
                        <input type="submit" class="submitButton" value="Verify OTP">
                    </form>
                </div>
            </body>
            </html>
            <?php
            exit(); // Stop further execution after displaying the OTP input form
        }
    } else {
        echo "Invalid request.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

