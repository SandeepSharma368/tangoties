<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Check if the phone number parameter exists
if (isset($_GET['phone'])) {
    $phone = $_GET['phone'];

    // Check if OTP and its expiry time are stored in the session
    session_start();
    if (isset($_SESSION['otp']) && isset($_SESSION['otp_expiry'])) {
        $otp = $_SESSION['otp'];
        $otp_expiry = $_SESSION['otp_expiry'];

        // Check if the OTP has expired
        if (time() > $otp_expiry) {
            echo "OTP has expired. Please try again.";
            exit();
        }

        // Verify if the entered OTP is correct
        if (isset($_POST['otp'])) {
            $entered_otp = $_POST['otp'];

            if ($entered_otp == $otp) {
                echo "Phone number is verified successfully.";
                echo "<br>";
                echo "Help us with some more information:";
                echo "<br>";

                // Display the additional information form
                ?>
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Additional Information</title>
                    <link rel="stylesheet" type="text/css" href="nouislider.min.css">
                    <link rel="stylesheet" type="text/css" href="styles.css">
                    <style>
                        /* Add the CSS rule for submit button */
                        .nextButton {
                            font-size: 16px;
                            background-color: black;
                            color: white;
                            padding: 10px 20px;
                            border: none;
                            border-radius: 4px;
                            cursor: pointer;
                        }
                    </style>
                    <script src="nouislider.min.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var slider = document.getElementById('age_range');

                            noUiSlider.create(slider, {
                                start: [18, 65],
                                connect: true,
                                range: {
                                    'min': 18,
                                    'max': 65
                                },
                                format: {
                                    to: function (value) {
                                        return Math.round(value);
                                    },
                                    from: function (value) {
                                        return Math.round(value);
                                    }
                                }
                            });

                            var minage = document.getElementById('minage');
                            var maxage = document.getElementById('maxage');

                            slider.noUiSlider.on('update', function (values, handle) {
                                if (handle === 0) {
                                    minage.value = values[handle];
                                } else {
                                    maxage.value = values[handle];
                                }
                            });
                        });
                    </script>
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
                        <form method="POST" action="">
                            <div class="age_range">
                                <label for="age_range">Minimum Age:</label>
                                <div id="min_age_range"></div>
                            </div>
                            <div class="age_range">
                                <label for="age_range">Maximum Age:</label>
                                <div id="max_age_range"></div>
                            </div>
                            <div id="age_values">
                                <span id="minage_value"></span> - <span id="maxage_value"></span>
                            </div>
                            <input type="hidden" id="minage" name="minage" value="">
                            <input type="hidden" id="maxage" name="maxage" value="">
                            <br>
                            <input type="hidden" name="phone" value="<?php echo $phone; ?>">
                            <input type="submit" class="nextButton" value="Next">
                        </form>
                    </div>
                    <script>
                        var minSlider = document.getElementById('min_age_range');
                        var maxSlider = document.getElementById('max_age_range');
                        var minageValue = document.getElementById('minage_value');
                        var maxageValue = document.getElementById('maxage_value');
                        var minageInput = document.getElementById('minage');
                        var maxageInput = document.getElementById('maxage');

                        noUiSlider.create(minSlider, {
                            start: [18],
                            connect: [true, false],
                            range: {
                                'min': 18,
                                'max': 65
                            },
                            format: {
                                to: function (value) {
                                    return Math.round(value);
                                },
                                from: function (value) {
                                    return Math.round(value);
                                }
                            }
                        });

                        noUiSlider.create(maxSlider, {
                            start: [65],
                            connect: [true, false],
                            range: {
                                'min': 18,
                                'max': 65
                            },
                            format: {
                                to: function (value) {
                                    return Math.round(value);
                                },
                                from: function (value) {
                                    return Math.round(value);
                                }
                            }
                        });

                        minSlider.noUiSlider.on('update', function (values) {
                            minageValue.textContent = Math.round(values[0]);
                            minageInput.value = Math.round(values[0]);
                        });

                        maxSlider.noUiSlider.on('update', function (values) {
                            maxageValue.textContent = Math.round(values[0]);
                            maxageInput.value = Math.round(values[0]);
                        });
                    </script>
                </body>
                </html>
                <?php
                exit(); // Stop further execution after displaying the additional information form
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
                        <input type="text" id="otp" name="otp" required>
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

