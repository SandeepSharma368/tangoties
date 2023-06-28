<?php
// Database connection details
$servername = 'database-1.c0mziqhjlyx3.ap-south-1.rds.amazonaws.com';
$username = 'admin';
$password = 'master1234';
$dbname = 'tt_usersdata';

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the phone number or email already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM Customers WHERE c_phonenumber = :phone OR c_email = :email");
    $stmt->bindParam(':phone', $_POST['phone']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo "This phone number or email is already registered. Please <a href='signin.php'>sign in</a>.";
    } else {
        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO Customers (c_name, c_phonenumber, c_email, c_gender, c_age) VALUES (:name, :phone, :email, :gender, :age)");

        // Bind the form inputs to the SQL statement parameters
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':phone', $_POST['phone']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':gender', $_POST['gender']);
        $stmt->bindParam(':age', $_POST['age']);

        // Execute the SQL statement
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Data submitted successfully!";
        } else {
            echo "Error occurred while submitting the form.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

