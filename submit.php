<?php
// Database connection details
$servername = 'your_rds_mysql_host';
$username = 'your_mysql_username';
$password = 'your_mysql_password';
$dbname = 'your_database_name';

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement
    $stmt = $pdo->prepare("INSERT INTO contacts (name, phone) VALUES (:name, :phone)");

    // Bind the form inputs to the SQL statement parameters
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':phone', $_POST['phone']);

    // Execute the SQL statement
    $stmt->execute();

    echo "Data submitted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

