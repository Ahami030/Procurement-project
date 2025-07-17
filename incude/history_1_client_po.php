<?php
// Check if session is not started yet
if(session_status() == PHP_SESSION_NONE) {
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
if(isset($_SESSION['member_id'])) {
    echo "Member ID: " . $_SESSION['member_id'];
} else {
    echo "Member ID not found in session.";
}

// Check if member_id exists in session before using it in the query
if(isset($_SESSION['member_id'])) {
    $member_id = $_SESSION['member_id'];

    // Select data from the table, filtering by member_id and ordering by created_at in descending order to get the latest entries first
    $sql = "SELECT product_po.ID_member, product_po.created_at, users.username
            FROM product_po
            INNER JOIN users ON product_po.ID_member = users.id
            WHERE product_po.ID_member = '$member_id'
            GROUP BY product_po.created_at
            ORDER BY product_po.created_at DESC
            LIMIT 5";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="table-responsive">';
    echo '<table class="table table-striped">';
    echo '<thead class="thead-dark">';
    echo '<tr>
                                                        <th>Username</th>
                                                        <th>Created At</th>
                                                        <th>Edit</th>
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
        $editUrl = 'table/edit.php?created_at=' . urlencode($row["created_at"]); // URL for editing
        $editButton = '<a href="' . $editUrl . '"><i class="fa-solid fa-file-pen"></i></a>'; // Edit button with icon
        echo "<tr><td>$username</td><td>$link</td><td>$editButton</td></tr>"; // Display the data in table rows
    }
    echo '</tbody>';
    echo '</table>';
    echo'<a href="history_client.php">ดูประวัติทั้งหมด</a>';
    echo '</div>';
} else {
    echo "<br> 0 results </br>";
}
}

// Close connection
$conn->close();
?>
