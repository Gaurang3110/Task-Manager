<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account</title>
  <link rel="stylesheet" href="createacc1.css">
</head>
<body>
  <form id="createForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="main" id="mii">
      <div class="login">Create Account</div>
        <div class="image-container">
          <img src="logo.png" alt="User Image"><br>
        </div>
      <div class="icon-container">
        <img src="user.png" height="30">
        <input type="text" name="username" placeholder="Enter Username" class="round"><br>
      </div>
      <div class="icon-container">
        <img src="password.png" height="30">
        <input type="password" name="password" placeholder="Enter Password" class="round"><br>
      </div>
    
      <center><input type="submit" value="Create Account" class="btn"></center>
    </div>
    
  </form>

<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "form"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
// Check if form is submitted and fields are not empty
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if username and password are empty
  if(empty($_POST['username']) || empty($_POST['password'])) {
      echo '<script>alert("Please fill in all fields.");</script>';
  } else {
      // Get form data
      $uname = $_POST['username'];
      $pwd = $_POST['password'];

      // Check if username already exists
      $sql_check = "SELECT * FROM login WHERE username='$uname'";
      $result = $conn->query($sql_check);
      if ($result->num_rows > 0) {
        echo '<script>alert("User Already Exists");</script>';
      } else {
          // Hash the password for security
          $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

          $sql = "INSERT INTO login (username, password) VALUES ('$uname', '$pwd')";

          if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Account created successfully"); window.location.href = "login.php";</script>';
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }
      }
  }
}


// Close connection
$conn->close();
?>
</body>
</html>
