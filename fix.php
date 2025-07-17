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

// Handle button click to update state
if (isset($_POST["updateState"])) {
    $imageIDToUpdate = mysqli_real_escape_string($con, $_POST["imageIDToUpdate"]);

    // Update the state to 'completed'
    $updateQuery = "UPDATE uploaded_images SET state = 'completed' WHERE id = $imageIDToUpdate";
    mysqli_query($con, $updateQuery);
}

// Fetch images from the database
$query = "SELECT * FROM uploaded_images";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2>Image Gallery</h2>

        <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $fileName = $row['filename'];
                $imageID = $row['id'];
                $state = $row['state'];
                $ID_member = $row['ID_member'];

                // Construct the full image path
                $filePath = "upload_image/" . $fileName;
                ?>
                 
                    <div class="card p-0 m-3" style="width: 18rem; height: 500px;">
                        <img src="<?php echo $filePath; ?>" class="card-img-top" alt="Image <?php echo $imageID; ?>"
                            style="height: 300px;">

                        <div class="card-body">
                            <div class="col mt-2">
                                <p class="card-text">ID_member:
                                    <?php echo $ID_member; ?>
                                </p>
                                <p class="card-text">State:
                                    <?php echo $state; ?>
                                </p>
                                <?php
                                // Display the button only if the state is 'pending'
                                if ($state == 'pending') {
                                    ?>
                                    <form method="post">
                                        <input type="hidden" name="imageIDToUpdate" value="<?php echo $imageID; ?>">
                                        <input type="submit" name="updateState" value="Mark as Completed"
                                            class="btn btn-primary">
                                    </form>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php
// Close the database connection
mysqli_close($con);
?>