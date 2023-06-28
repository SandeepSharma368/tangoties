<?php
// Database connection details
$servername = 'database-1.c0mziqhjlyx3.ap-south-1.rds.amazonaws.com';
$username = 'admin';
$password = 'master1234';
$dbname = 'tt_usersdata';

try {
    $conn = new PDO("sqlsrv:Server=$servername;Database=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO Customers (c_name, c_phonenumber, c_email, c_gender, c_age) VALUES (?, ?, ?, ?, ?)");

    // Bind the form inputs to the SQL statement parameters
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];

    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $phone);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $gender);
    $stmt->bindParam(5, $age);

    // Execute the SQL statement
    $stmt->execute();

    echo "Data submitted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

