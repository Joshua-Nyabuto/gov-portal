<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "main_db";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["topic"])) {
        $topic = $_POST["topic"];
        $sql = "INSERT INTO messages (topic) VALUES ('$topic')";

        if ($conn->query($sql) === TRUE) {
            echo "Topic created successfully";
        } else {
            echo "Error creating topic: " . $conn->error;
        }
    }
}

// Closing the database connection
$conn->close();
?>
