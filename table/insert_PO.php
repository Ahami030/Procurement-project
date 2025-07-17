<?php
// update.php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Assuming you have a database connection established, replace 'your_db_connection' with your actual connection variable
    $conn = new mysqli("localhost", "root", "", "user_registration");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the submitted ID_member
    $submittedID_member = $_POST['ID_member'];

    // Update the state_po table
    $stmt = $conn->prepare("UPDATE state_po SET state_1 = '2', state_2 = '2', state_3 = '2' WHERE ID_member = ?");
    $stmt->bind_param("s", $submittedID_member);

    if ($stmt->execute()) {
        header('Location: /pj%20main/main.php');
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $updateStatus1 = mysqli_query($conn, "UPDATE po SET STATUS = '1' WHERE ID_member = '$submittedID_member'");

    // Correct the variable name in the if condition
    if (!$updateStatus1) {
        echo "Error updating state: " . mysqli_error($conn);
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted, show an error or redirect
    echo "Form not submitted!";
}
?>
