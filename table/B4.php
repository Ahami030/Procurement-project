<?php
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

// Select data from the table, grouping by created_at
$sql = "SELECT created_at FROM product_po GROUP BY created_at";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $createAt = $row["created_at"];
        $url = 'table/databill PO.php?created_at=' . urlencode($createAt); // New URL with created_at as a parameter
        $link = '<a href="' . $url . '" target="_blank">' . $createAt . '</a>'; // Open in a new tab/window
        $editUrl = 'table/edit_PO.php?created_at=' . urlencode($createAt); // URL for editing
        $editButton = '<a href="' . $editUrl . '">Edit</a>'; // Edit button
        echo "created_at: " . $link . " " . $editButton . "<br>"; // Display the link and edit button
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
