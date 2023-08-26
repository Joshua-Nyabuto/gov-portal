<?php
// Establish a database connection
$servername = "localhost";  // Replace with your server name
$username = "root";        // Replace with your username
$password = "mysql";    // Replace with your password
$dbname = "main_db";    // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["username"];
  $message = $_POST["message"];

  // Insert the new message into the database
  $sql = "INSERT INTO chat_messages (username, message) VALUES ('$username', '$message')";
  if ($conn->query($sql) === TRUE) {
    echo "Message posted successfully.";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>
