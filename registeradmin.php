<?php


// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $company_name = $_POST['company_name'];

    // Check if the username already exists
    $check_query = $conn->prepare("SELECT * FROM users WHERE username=?");
    $check_query->bind_param("s", $username);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Username already exists!',
            });
          </script>";
    } else {
        // Check if the passwords match
        if ($password !== $confirm_password) {
          
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert data into the database with hashed password and role "admin"
            $insert_query = $conn->prepare("INSERT INTO users (username, password, email, phone, address, company_name, role)
                             VALUES (?, ?, ?, ?, ?, ?, 'admin')");
            $insert_query->bind_param("ssssss", $username, $hashed_password, $email, $phone, $address, $company_name);

            if ($insert_query->execute()) {
                echo "Registered successfully";
            } else {
                echo "Error: " . $insert_query->error;
            }
        }
    }
}

$conn->close();

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="exampleFormControlInput1" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" required>

        <label for="exampleFormControlInput1" class="form-label mt-2">Password</label>
        <div class="row">
            <div class="col">

                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="col">

                <input type="password" class="form-control" name="confirm_password" placeholder="confirm password"
                    required>
            </div>
        </div>





        <label for="exampleFormControlInput1" class="form-label mt-2">Email address</label>
        <input type="email" class="form-control" name="email" required>

        <label for="exampleFormControlInput1" class="form-label">Phone</label>
        <input type="text" class="form-control" name="phone" required>

        <label for="exampleFormControlInput1" class="form-label">Address</label>
        <textarea class="form-control" name="address" required></textarea>

        <label for="exampleFormControlInput1" class="form-label">Company Name</label>
        <input type="text" class="form-control" name="company_name">

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" value="Register">Register</button>
        </div>

            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
