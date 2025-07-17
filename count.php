<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to count rows with STATUS = 1, STATUS = 0, and total count
$sql = "SELECT 
            SUM(CASE WHEN STATUS = '1' THEN 1 ELSE 0 END) AS count_1,
            SUM(CASE WHEN STATUS = '0' THEN 1 ELSE 0 END) AS count_0,
            COUNT(*) AS total_count
        FROM images";

$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch the counts from the result set
    $row = $result->fetch_assoc();
    $count_1 = $row['count_1'];
    $count_0 = $row['count_0'];
    $total_count = $row['total_count'];

    // Use $count_1, $count_0, and $total_count as needed (e.g., echo or process them)

    // Free the result set
    $result->free();
} else {
    // Display an error message if the query fails
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>






<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to count rows with STATUS = 1, STATUS = 0, and total count
$sql = "SELECT 
            SUM(CASE WHEN STATUS = '1' THEN 1 ELSE 0 END) AS count_1,
            SUM(CASE WHEN STATUS = '0' THEN 1 ELSE 0 END) AS count_0,
            COUNT(*) AS total_count
        FROM po";

$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch the counts from the result set
    $row = $result->fetch_assoc();
    $count_1_po = $row['count_1'];
    $count_0_po = $row['count_0'];
    $total_count_po = $row['total_count'];
   

    // Use $count_1, $count_0, and $total_count as needed (e.g., echo or process them)

    // Free the result set
    $result->free();
} else {
    // Display an error message if the query fails
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>