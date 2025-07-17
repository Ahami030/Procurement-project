<?php
// Check if session is not started yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Replace these variables with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_SESSION['member_id'])) {
    
} else {
    echo "Member ID not found in session.";
}

// Check if member_id exists in session before using it in the query
if (isset($_SESSION['member_id'])) {
    $member_id = $_SESSION['member_id'];

    // Select data from the table, filtering by member_id and ordering by created_at in descending order to get the latest entries first
    $sql = "SELECT product.ID_member, product.created_at, users.username
            FROM product
            INNER JOIN users ON product.ID_member = users.id
            WHERE product.ID_member = '$member_id'
            GROUP BY product.created_at
            ORDER BY product.created_at DESC
            LIMIT 5";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="table-responsive">';
        echo '<table class="table table-striped">';
        echo '<thead class="thead-dark">';
        echo '<tr>
        <th>Username</th>
        <th style="text-align:center;">Created At</th>
            </tr>';
        echo '</thead>';
        echo '<tbody>';
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $username = $row["username"];
            $createAt = strtotime($row["created_at"]); // Convert the created_at string to a timestamp
            $formattedTime = date("j M Y g.iA", $createAt); // Format the timestamp as desired (e.g., 5 Jan 2024 8.40AM)
            $url = 'table/databill.php?created_at=' . urlencode($row["created_at"]); // New URL with created_at as a parameter
            $link = '<a href="' . $url . '" target="_blank">' . $formattedTime . '</a>'; // Open in a new tab/window
            echo "<tr>";
            echo "<td>$username</td>";
            echo "<td style='text-align:center;'>$link</td>";
            echo "</tr>"; // Display the data in table rows
        }
        echo '</tbody>';
        echo '</table>';
        echo '<a href="history_client.php">ดูประวัติทั้งหมด</a>';
        echo '</div>';
    } else {
        echo "<br> 0 results </br>";
    }
}

// Close connection
$conn->close();
?>