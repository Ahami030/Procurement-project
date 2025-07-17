<?php
// Check if session is not started yet
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
if (isset($_POST['register'])) {
    // Get data from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $company_name = $_POST['company_name'];

    // Check if the username already exists
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'This username already exists',
            text: 'กรุณากรอกชื่อใหม่',
        });
      </script>";
        echo '<script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("openModal").click();
        });
      </script>';
    } else {
        // Check if the passwords match
        if ($password !== $confirm_password) {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'รหัสไม่ตรงกัน',
                text: 'กรุณากรอกรหัสผ่านให้ตรงกัน',
            });
          </script>";
            echo '<script>
            document.addEventListener("DOMContentLoaded", function () {
                document.getElementById("openModal").click();
            });
          </script>';
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert data into the database with hashed password and role "member"
            $insert_query = "INSERT INTO users (username, password, email, phone, address, company_name, role)
                             VALUES ('$username', '$hashed_password', '$email', '$phone', '$address', '$company_name', 'member')";

            if ($conn->query($insert_query) === TRUE) {
                echo "Registered successfully";
            } else {
                echo "Error: " . $insert_query . "<br>" . $conn->error;
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
<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body class="d-flex flex-column">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="exampleFormControlInput1" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" required>

        <label for="exampleFormControlInput1" class="form-label mt-2">Password</label>
        <div class="row">
            <div class="col">

                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="col">

                <input type="password" class="form-control" name="confirm_password"
                    placeholder="confirm password" required>
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
            <button type="submit" name="register" class="btn btn-primary" value="Register">Register</button>
        </div>

    </form>
    

</body>

