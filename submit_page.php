<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted username
    $submittedUsername = $_POST['username'];

    // Perform actions with the submitted username (for demonstration, just displaying it)
    echo "Submitted Username: " . $submittedUsername;

    // You can insert this username into a database, perform validation, or any other necessary processing here
} else {
    // If the form wasn't submitted via POST method, handle the situation accordingly
    echo "Form was not submitted!";
}
?>
