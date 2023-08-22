


<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f5f5f5;
        }

        form {
            margin-bottom: 0;
        }

        input[type="text"] {
            width: 100%;
            padding: 5px;
            margin-top: 5px;
            border: 1px solid #ddd;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .success {
            color: #4CAF50;
        }

        .error {
            color: #f44336;
        }

        .no-topics {
            margin-top: 20px;
            font-style: italic;
        }
    </style>
     <script>
        function populateTextBox() {
            var topic = prompt("Enter the topic:");
            if (topic) {
                var textBox = document.getElementById("topicTextBox");
                textBox.value = topic;
            }
        }
    </script>
</head>
<body>
   <button onclick="populateTextBox()">Create New Topic</button>
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



 // Handling forum topic creation and replies
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["topic"])) {
            $topic = $_POST["topic"];
            $sql = "INSERT INTO messages (topic, likes, views, updated) VALUES ('$topic', 0, 0, NOW())";

            if ($conn->query($sql) === TRUE) {
                echo "Topic created successfully";
            } else {
                echo "Error creating topic: " . $conn->error;
            }
        } elseif (isset($_POST["reply"]) && isset($_POST["topic_id"])) {
            $reply = $_POST["reply"];
            $topic_id = $_POST["topic_id"];
            $sql = "INSERT INTO replies (reply, topic_id) VALUES ('$reply', '$topic_id')";

            if ($conn->query($sql) === TRUE) {
                echo "Reply added successfully";
            } else {
                echo "Error adding reply: " . $conn->error;
            }
        }
    }

// Handling forum likes
if (isset($_POST["like"]) && isset($_POST["topic_id"])) {
    $topic_id = $_POST["topic_id"];
    $sql = "UPDATE messages SET likes = likes + 1 WHERE topic_id = '$topic_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Like added successfully";
    } else {
        echo "Error adding like: " . $conn->error;
    }
}

// Handling forum views
if (isset($_GET["topic_id"])) {
    $topic_id = $_GET["topic_id"];
    $sql = "UPDATE messages SET views = views + 1 WHERE topic_id = '$topic_id'";

    if ($conn->query($sql) === TRUE) {
        // View count updated successfully
    } else {
        echo "Error updating view count: " . $conn->error;
    }
}

// Retrieving and displaying forum topics with replies, likes, views, and sorting
$sql = "SELECT t.topic_id, t.topic, COUNT(r.id) AS reply_count, t.likes, t.views, t.updated
        FROM messages AS t
        LEFT JOIN replies AS r ON t.topic_id = r.topic_id
        GROUP BY t.topic_id
        ORDER BY ";


if (isset($_GET["sort"])) {
    $sort = $_GET["sort"];
    switch ($sort) {
        case "date_asc":
            $sql .= "t.updated ASC";
            break;
        case "date_desc":
            $sql .= "t.updated DESC";
            break;
        case "update_desc":
            $sql .= "t.updated DESC";
            break;
        case "views_desc":
            $sql .= "t.views DESC";
            break;
        case "replies_desc":
            $sql .= "reply_count DESC";
            break;
        case "likes_desc":
            $sql .= "t.likes DESC";
            break;
        default:
            $sql .= "t.updated DESC";
            break;
    }
} else {
    $sql .= "t.updated DESC";
}

$result = $conn->query($sql);

// ...
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>Topic</th>";
    echo "<th>Replies</th>";
    echo "<th>Likes</th>";
    echo "<th>Views</th>";
    echo "<th>Last Updated</th>";
    echo "<th>Reply</th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["topic"] . "</td>";
        echo "<td>" . $row["reply_count"] . "</td>";
        echo "<td>" . $row["likes"] . "</td>";
        echo "<td>";
        echo "<a href='?topic_id=" . $row["topic_id"] . "'>View</a>";
        echo "</td>";
        echo "<td>" . $row["updated"] . "</td>";
        echo "<td>";
        echo "<form method='POST' action=''>";
        echo "<input type='hidden' name='topic_id' value='" . $row["topic_id"] . "'>";
        echo "<input type='text' name='reply' placeholder='Enter Comment on the topic'>";
        echo "<input type='submit' value='Reply'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td>";
        echo "<form method='POST' action=''>";
        echo "<input type='hidden' name='topic_id' value='" . $row["topic_id"] . "'>";
        echo "<input type='hidden' name='like' value='1'>";
        echo "<input type='submit' value='Like'>";
        echo "</form>";
        echo "</td>";
        echo "<td>" . $row["views"] . "</td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "</tr>";
    }

        

        echo "</table>";
    } else {
        echo "<div class='no-topics'>No topics found</div>";
    }

    // ...

    // Closing the database connection
    $conn->close();
    ?>
    <form method="POST" action="">
        <input type="text" id="topicTextBox" name="topic" placeholder="Enter Topic" value="">
        <input type="submit" value="Submit">
    </form>
</body>
</html>
