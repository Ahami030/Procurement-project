<!-- preview.php -->
<?php
include 'table_connect.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch data from the database based on the given ID
    $sql = "SELECT * FROM product WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Display the data as needed
        echo "Name: " . $row['Name'] . "<br>";
        echo "Price: " . $row['Price'] . "<br>";
        echo "ID_member: " . $row['ID_member'] . "<br>";
        echo "Created at: " . $row['created_at'] . "<br>";
    } else {
        echo "No data found.";
    }
} else {
    echo "Invalid request. Please provide an ID.";
}
?>
