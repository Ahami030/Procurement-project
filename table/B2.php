<div class="text-center mb-5">
    <h1 class="fw-bolder">รายละเอียดใบตอบรับ</h1>
    <!-- <p class="lead fw-normal text-muted mb-0">With our no hassle pricing plans</p> -->
</div>
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
    $sql = "SELECT product.ID_member, product.created_at, users.username
    FROM product
    INNER JOIN users ON product.ID_member = users.id
    GROUP BY product.created_at
    ORDER BY product.created_at DESC
    ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table  class='table table-striped table-hover'>";
        echo '<thead class="table-dark">';
        echo "<tr><th>Created At</th><th>Edit</th></tr>";
        echo '</thead>';
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $createAt = $row["created_at"];
            $url = 'table/databill.php?created_at=' . urlencode($createAt); // New URL with created_at as a parameter
            $link = '<a href="' . $url . '" target="_blank">' . $createAt . '</a>'; // Open in a new tab/window
            $editUrl = 'table/edit.php?created_at=' . urlencode($createAt); // URL for editing
            $editButton = '<a href="' . $editUrl . '">Edit</a>'; // Edit button
            echo "<tr>";
            echo "<td>" . $link . "</td>";
            echo "<td>" . $editButton . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    // Close connection
    $conn->close();
?>
