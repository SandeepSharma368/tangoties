<?php
session_start();

// Database connection details
$servername = 'database-1.c0mziqhjlyx3.ap-south-1.rds.amazonaws.com';
$username = 'admin';
$password = 'master1234';
$dbname = 'tt_usersdata';

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Remove the "+" sign from the phone number
    $phone = ltrim($_POST['phone'], '+');

    // Check if the phone number or email already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM Customers WHERE REPLACE(c_phonenumber, '+', '') = :phone OR c_email = :email");
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo "This phone number or email is already registered. Please <a href='signin.php'>sign in</a>.";
    } else {
        // Add the "+" sign back to the phone number
        $phone = '+' . $phone;

        // Store the form data in session variables
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['age'] = $_POST['age'];

        // Redirect to the additional_info.php page with the modified phone number and form data
        $query = http_build_query(array(
            'phone' => $phone,
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'gender' => $_POST['gender'],
            'age' => $_POST['age']
        ));
        header("Location: additional_info.php?" . $query);
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

