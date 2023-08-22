<?php
// Assuming you have a database connection established
// ...
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "main_db";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the charset to UTF-8 (optional, adjust as needed)
$conn->set_charset("utf8");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $fullname = $_POST['fullname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Perform password match validation
  if ($password !== $confirm_password) {
    echo "Password and confirm password do not match.";
    exit;
  }

  // Insert data into the database
  $sql = "INSERT INTO tb_row (fullname, username, email, password) VALUES ('$fullname', '$username', '$email', '$password')";

  if ($conn->query($sql) === TRUE) {
    // Redirect to home page after successful registration
    header("Location: userlogin.php");
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Close the database connection
  $conn->close();
}
?>
