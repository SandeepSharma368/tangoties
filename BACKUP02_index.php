<!DOCTYPE html>
<html>
<head>
  <title>Sign In / Sign Up</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <style>
    /* Add the CSS rule to apply the fancy font */
    #welcomeText {
      font-family: 'Your Fancy Font', cursive;
    }
  </style>
  <script>
    function showSignUpForm() {
      document.getElementById("signupButton").style.display = "none";
      document.getElementById("signInButton").style.display = "none";
      document.getElementById("welcomeText").innerHTML = ""; // Remove the welcome message
      document.getElementById("signinText").style.display = "block"; // Show the "Already have an account?" text
      document.getElementById("signupFormContainer").style.display = "block"; // Show the signup form
    }

    // Function to handle form submission using AJAX
    function submitForm(event) {
      event.preventDefault(); // Prevent default form submission behavior

      // Get the form data
      var formData = new FormData(document.getElementById('signupForm'));

      // Send the form data to submit.php using AJAX
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'submit.php', true);
      xhr.onload = function () {
        if (xhr.status === 200) {
          // Success
          console.log(xhr.responseText);
          alert('Data submitted successfully!');
          document.getElementById('signupForm').reset(); // Reset the form
        } else {
          // Error
          console.error(xhr.responseText);
          alert('Error occurred while submitting the form.');
        }
      };
      xhr.onerror = function () {
        console.error(xhr.responseText);
        alert('Error occurred while submitting the form.');
      };
      xhr.send(formData);
    }

    // Add event listener to the form submission
    document.getElementById('signupForm').addEventListener('submit', submitForm);
  </script>
</head>
<body>
  <div id="header">
    <ul id="tabs">
      <li onclick="location.reload();">Home</li> <!-- Updated onclick event -->
      <li>AboutUs</li>
      <li>Policy</li>
    </ul>
  </div>

  <div id="homeScreen" class="container">
    <h1 id="welcomeText">Welcome to tAnGO ties</h1>
    <!-- Contents of the home screen -->
    <button id="signupButton" onclick="showSignUpForm()">Sign Up</button>
    <button id="signInButton" onclick="window.location.href = 'signin.php'">Sign In</button>
    <div id="signupFormContainer" class="signupBox" style="display: none;">
      <h2>Sign Up</h2>
      <form id="signupForm" class="signupForm" onsubmit="submitForm(event)">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="others">Others</option>
        </select>

        <label for="age">Age:</label>
        <select id="age" name="age" required>
          <option value="">Select Age</option>
          <!-- Generate options from 18 to 65 -->
          <?php
            for ($i = 18; $i <= 65; $i++) {
              echo "<option value='$i'>$i</option>";
            }
          ?>
        </select>

        <input type="submit" class="submitButton" value="Submit">
        <div id="signinText" class="signinText" style="display: none;">
          Already have an account? <a href="signin.php">Sign In</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>

