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
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Verify login credentials
  $sql = "SELECT * FROM tb_row WHERE username = '$username' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    // Login successful, redirect to home page
    header("Location: home.php");
    exit;
  } else {
    echo "Invalid username or password.";
  }
}
?>
