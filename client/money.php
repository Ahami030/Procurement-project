<?php
// Check if a session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if a user is logged in and has a valid session variable
if (isset($_SESSION['member_id'])) {
    $ID_member = $_SESSION['member_id'];

    // Fetch images from the database for the logged-in user
    $query = "SELECT filename, state FROM uploaded_images WHERE ID_member = $ID_member";
    $result = mysqli_query($con, $query);

    echo '<script>
    document.getElementById("accordionList_po").style.display = "none";
        document.getElementById("preview_bill").style.display = "block";
    </script>';

    // Check if there is data for the given ID_member
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="col mt-2 p-0" id="preview_bill">';
        echo '<table class="table">';
        echo '<thead class="table-dark">';
        echo '<tr>';
        echo '<th>Filename</th>';
        echo '<th>State</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['filename'] . "</td>";
            echo "<td>" . $row['state'] . "</td>";
            echo "</tr>";
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        // No data for the given ID_member
        echo '<script>
        document.getElementById("accordionList_po").style.display = "block";
            document.getElementById("preview_bill").style.display = "none";
        </script>';
        echo "No data available for the current user.";
    }
} else {
    // If no user is logged in or no valid session, you can handle it accordingly
    echo '<script>
        document.getElementById("preview_bill").style.display = "none";
    </script>';
    echo "Please log in to view images.";
    exit(); // Stop further execution
}

// Close the database connection
mysqli_close($con);
?>
