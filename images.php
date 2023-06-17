<!DOCTYPE html>
<html>
<head>
    <title>Uploaded Images</title>
    <style>
        .image-list {
            text-align: center;
            margin-top: 20px;
        }

        .image-list img {
            max-width: 400px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Uploaded Images</h1>

    <div class="image-list">
        <?php
        // Path to the uploads directory
        $uploadsDir = 'uploads/';

        // Get the list of files in the uploads directory
        $files = glob($uploadsDir . '*');

        if ($files) {
            // Loop through the files and display the images
            foreach ($files as $file) {
                if (is_file($file)) {
                    echo '<img src="' . $file . '" alt="Uploaded Image"><br>';
                }
            }
        } else {
            echo 'No images uploaded yet.';
        }
        ?>
    </div>
</body>
</html>

