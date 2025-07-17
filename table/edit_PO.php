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

// Check if the form is submitted for update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if fields are submitted
    if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['id_member'])) {
        $names = $_POST['name'];
        $prices = $_POST['price'];
        $id_members = $_POST['id_member'];

        // Loop through the submitted data and update each record
        foreach ($names as $id => $name) {
            $price = $prices[$id];
            $id_member = $id_members[$id];
            $sql = "UPDATE product_po SET Name = '$name', Price = '$price', ID_member = '$id_member' WHERE ID = $id";
            $conn->query($sql);
        }

        // Redirect to pricing.php?g=B4
        header("Location: /pj%20main/pricing.php?g=B4");
        exit(); // Ensure that code stops execution after redirection
    } else {
        echo "Failed to update records";
    }
}

// Retrieve data for editing
if (isset($_GET['created_at'])) {
    $createAt = $_GET['created_at'];

    // Retrieve data based on the provided created_at value
    $sql = "SELECT * FROM product_po WHERE created_at = '$createAt'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Edit Data</title>
        </head>
        <body>
            <h2>Edit Data</h2>
            <form action="" method="POST">
                <table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>ID_member</th>
                    </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['ID']; ?></td>
                            <td><input type="text" name="name[<?php echo $row['ID']; ?>]" value="<?php echo $row['Name']; ?>"></td>
                            <td><input type="text" name="price[<?php echo $row['ID']; ?>]" value="<?php echo $row['Price']; ?>"></td>
                            <td><input type="text" name="id_member[<?php echo $row['ID']; ?>]" value="<?php echo $row['ID_member']; ?>"></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <input type="submit" value="Update">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "No records found with the provided created_at value.";
    }
} else {
    echo "No created_at parameter found in the URL.";
}

// Close connection
$conn->close();
?>
