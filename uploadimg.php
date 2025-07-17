<?php
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

// Handle file uploads from Dropzone.js
if (!empty($_FILES["image"])) {
    $targetDir = "upload_image/";
    $file = $_FILES['image'];

    // Generate a unique ID as the new file name
    $uniqueID = uniqid();
    $newFileName = $uniqueID . '_' . $file['name'];
    $targetFilePath = $targetDir . $newFileName;

    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        // The file has been successfully uploaded

        // Insert relevant information into the database
        $ID_member = mysqli_real_escape_string($con, $_POST["ID_member"]);
        $phone = mysqli_real_escape_string($con, $_POST["phone"]);
        $state = 'pending';

        $query = "INSERT INTO uploaded_images (filename, ID_member, phone, state) VALUES ('$newFileName', '$ID_member', '$phone', '$state')";

        if (mysqli_query($con, $query)) {
            // The database entry has been successfully created
            echo json_encode(["status" => "success", "message" => "File uploaded successfully!"]);
            header("location: main clienttest.php");
        } else {
            // Error inserting into the database
            echo json_encode(["status" => "error", "message" => "Error inserting into database: " . mysqli_error($con)]);
        }
    } else {
        // Error uploading file
        echo json_encode(["status" => "error", "message" => "Error uploading file."]);
    }
} else {
    // No files uploaded
    echo json_encode(["status" => "error", "message" => "No files uploaded."]);
}

// Close the database connection
mysqli_close($con);
?>
