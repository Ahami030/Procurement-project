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

// Get created_at value from URL parameter
$createAt = $_GET['created_at'];

// Select data based on created_at
$sql = "SELECT * FROM product WHERE created_at = '$createAt'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the selected row
    $row = $result->fetch_assoc();
    echo "<h2>Data for created_at: " . $row["created_at"] . "</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Order</th><th>ID</th><th>Name</th><th>Price</th><th>ID_member</th><th>created_at</th></tr>";
    echo "<tr>";
    echo "<td>1</td>"; // เริ่มลำดับที่ 1 สำหรับแถวแรก
    echo "<td>" . $row["ID"] . "</td>";
    echo "<td>" . $row["Name"] . "</td>";
    echo "<td>" . $row["Price"] . "</td>";
    echo "<td>" . $row["ID_member"] . "</td>";
    echo "<td>" . $row["created_at"] . "</td>";
 

    // Check for other rows with the same created_at
    $similarRowsSql = "SELECT * FROM product WHERE created_at = '$createAt' AND ID != " . $row["ID"];
    $similarRowsResult = $conn->query($similarRowsSql);

    if ($similarRowsResult->num_rows > 0) {
        $order = 2; // เริ่มลำดับที่ 2 สำหรับแถวถัดไป
        while ($similarRow = $similarRowsResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $order . "</td>"; // แสดงลำดับของแถว
            echo "<td>" . $similarRow["ID"] . "</td>";
            echo "<td>" . $similarRow["Name"] . "</td>";
            echo "<td>" . $similarRow["Price"] . "</td>";
            echo "<td>" . $similarRow["ID_member"] . "</td>";
            echo "<td>" . $similarRow["created_at"] . "</td>";
          
            echo "</tr>";
            $order++; // เพิ่มลำดับสำหรับแถวถัดไป
        }
    }

    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
