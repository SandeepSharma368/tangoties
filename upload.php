<?php
if (isset($_FILES['image'])) {
    $file = $_FILES['image'];

    // File details
    $name = $file['name'];
    $tmp_name = $file['tmp_name'];

    // Move the uploaded file to a specific directory
    move_uploaded_file($tmp_name, 'uploads/' . $name);

    echo "File uploaded successfully!";
}
?>

