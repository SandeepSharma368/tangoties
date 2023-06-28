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
      document.getElementById("signupForm").style.display = "block";
      document.getElementById("signupButton").style.display = "none";
      document.getElementById("signInButton").style.display = "none";
      document.getElementById("welcomeText").innerHTML = ""; // Remove the welcome message
      document.getElementById("signinText").style.display = "block"; // Show the "Already have an account?" text
    }
  </script>
</head>
<body>
  <div id="header">
    <ul id="tabs">
      <li onclick="location.reload();">Home</li> <!-- Updated onclick event -->
      <li>AboutUs</li>
      <li onclick="window.location.href = 'policy.php'">Policy</li> <!-- Added onclick event -->
    </ul>
  </div>

  <div id="homeScreen" class="container">
    <h1 id="welcomeText">Welcome to tAnGO ties</h1>
    <!-- Contents of the home screen -->
    <button id="signupButton" onclick="showSignUpForm()">Sign Up</button>
    <button id="signInButton" onclick="window.location.href = 'signin.php'">Sign In</button>
    <div id="signupForm" class="signupBox" style="display: none;">
      <h2>Sign Up</h2>
      <form action="submit.php" method="POST">
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

  <script>
    // Show the home screen by default
    document.getElementById("signupForm").style.display = "none";
  </script>
</body>
</html>

