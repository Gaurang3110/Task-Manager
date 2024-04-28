<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "form"; 

// Connect to database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $uname = $_POST["uname"];
    $password = $_POST["password"];

    // SQL query to check login credentials
    $sql = "SELECT * FROM login WHERE username = '$uname' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result) {
        // Check if there is any matching row
        if ($result->num_rows > 0) {
            // Redirect to homefinal.html if login is successful
            header("Location: homefinal.html");
            exit();
        } else {
            $error_msg = "Invalid username or password!";
        }
    } else {
        $error_msg = "Query failed: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login page</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <form id="loginForm" action="" method="post">
    <div class="main" id="mii">
      <div class="login">Login</div>
        <div class="image-container">
          <img src="logo.png" alt="User Image"><br>
        </div>
      <div class="icon-container">
        <img src="user.png" height="40">
        <input type="text" name="uname" placeholder="Enter Username" class="round"><br>
      </div>
      <div class="icon-container">
        <img src="password.png" height="40">
        <input type="password" name="password" placeholder="Enter Password" class="round"><br>
      </div>
      <?php
      // Display error message if exists
      if (isset($error_msg)) {
          echo '<div class="error">' . $error_msg . '</div>';
      }
      ?>
      <div class="remfor">
        <label><input type="checkbox" name="remember">Remember me</label><br>
        <div><a href="forgot_pass.html" id="forgot">Forget Password?</a><br>
        <a href="createacc.php" id="createAccount">Create Account</a></div>
      </div>
    
      <center><input type="submit" value="Login" class="btn" id="loginButton"></center>
    </div>
    
  </form>    
</body>
</html>
