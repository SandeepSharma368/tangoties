<!DOCTYPE html>
<html>
<head>
    <title>Additional Information</title>
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

        /* Adjust the width and font size of the slider */
        #age_range {
            width: 95%;
        }

        .slider-value {
            font-size: 16px;
        }

        /* Increase font size of labels */
        label {
            font-size: 18px;
        }

        /* Add spacing between labels */
        label {
            margin-bottom: 10px;
        }

        /* Add spacing between sections */
        .section {
            margin-bottom: 20px;
        }

        /* Apply the desired font to labels */
        .section label {
            font-family: 'Your Fancy Font', cursive;
        }

        /* Increase font size of age range values */
        #age_values {
            font-size: 30px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="nouislider.min.css">
    <script src="nouislider.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ageRangeSlider = document.getElementById('age_range');
            var minAgeValue = document.getElementById('min_age_value');
            var maxAgeValue = document.getElementById('max_age_value');
            var minAgeInput = document.getElementById('min_age');
            var maxAgeInput = document.getElementById('max_age');

            noUiSlider.create(ageRangeSlider, {
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

            ageRangeSlider.noUiSlider.on('update', function (values, handle) {
                if (handle === 0) {
                    minAgeValue.textContent = Math.round(values[handle]);
                    minAgeInput.value = Math.round(values[handle]);
                } else {
                    maxAgeValue.textContent = Math.round(values[handle]);
                    maxAgeInput.value = Math.round(values[handle]);
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
        <form method="GET" action="photoUpload.php">
            <div class="section">
                <label for="interested_in">Interested In:</label>
                <select id="interested_in" name="interested_in" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Both">Both</option>
                </select>
            </div>
            <div class="section">
                <label for="age_range">Age Range:</label>
                <div id="age_range"></div>
            </div>
            <div id="age_values">
                <span class="slider-value" id="min_age_value"></span> - <span class="slider-value" id="max_age_value"></span>
            </div>
            <input type="hidden" id="min_age" name="min_age" value="">
            <input type="hidden" id="max_age" name="max_age" value="">
            <br>
            <input type="hidden" name="phone" value="<?php echo $_GET['phone']; ?>">
            <input type="hidden" name="name" value="<?php echo $_GET['name']; ?>">
            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
            <input type="hidden" name="gender" value="<?php echo $_GET['gender']; ?>">
            <input type="submit" class="nextButton" value="Next">
        </form>
    </div>
</body>
</html>

