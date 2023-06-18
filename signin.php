<!DOCTYPE html>
<html>
<head>
  <title>Sign In</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <style>
    /* Apply the font style to the tabs and the text */
    #tabs li,
    h2 {
      font-family: 'Your Fancy Font', cursive;
    }

    .signinBox {
      background-color: #0074D9;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      padding: 20px;
      max-width: 400px;
      margin: 0 auto;
      text-align: center;
    }

    .signinBox h2 {
      color: white;
      margin-bottom: 20px;
    }

    .signinBox input {
      width: 100%;
      padding: 8px;
      border: none;
      border-radius: 4px;
      margin-bottom: 10px;
    }

    .signinBox button {
      background-color: #FF6F61; /* Change the background color to match Signup button */
      color: white;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
      font-size: 16px;
      border-radius: 4px;
    }
  </style>
  <script>
    function validatePhoneNumber() {
      var phoneNumber = document.getElementById("phoneNumber").value;
      if (phoneNumber.length !== 10 || isNaN(phoneNumber)) {
        alert("Invalid phone number. Please enter a 10-digit numeric value.");
        return false;
      }
      return true;
    }
  </script>
</head>
<body>
  <div id="header">
    <ul id="tabs">
      <li onclick="window.location.href = 'index.php'">Home</li>
      <li>AboutUs</li>
      <li>Policy</li>
    </ul>
  </div>

  <div class="container">
    <div class="signinBox">
      <h2>Enter your phone number</h2>
      <input type="text" id="phoneNumber" placeholder="Phone number">
      <br>
      <button onclick="if (!validatePhoneNumber()) { return false; }">Get OTP</button>
    </div>
  </div>
</body>
</html>

