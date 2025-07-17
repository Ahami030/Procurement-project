<?php
// Start a session
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user data
$userID = $_SESSION['member_id'];
$sql = "SELECT * FROM users WHERE id = '$userID'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found.";
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];
    $newEmail = $_POST['Email'];
    $newphone = $_POST['phone'];
    $newaddress = $_POST['address'];
    $newgender = $_POST['gender'];
    $newcompany_name = $_POST['company_name'];
    
    // Check if a new password is provided
    if (!empty($newPassword)) {
        // Encrypt the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update user information in the database with new password
        $updateQuery = "UPDATE users SET username = '$newUsername', password = '$hashedPassword', Email = '$newEmail', phone = '$newphone', address = '$newaddress',
    gender = '$newgender',company_name = '$newcompany_name' WHERE id = '$userID'";
    } else {
        // Keep the old password unchanged
        $updateQuery = "UPDATE users SET username = '$newUsername', Email = '$newEmail', phone = '$newphone', address = '$newaddress',
    gender = '$newgender',company_name = '$newcompany_name' WHERE id = '$userID'";
    }

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Profile updated successfully');</script>";
        // Refresh user data after update
        $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$userID'");
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Modern Business - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="stylesme.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="d-flex flex-column">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand" href="index.php">Phare Sanguan</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>

                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role']=='member' ){ ?>
                        <li class="nav-item"><a class="nav-link" href="main clienttest.php">กรอกและดูข้อมูล</a></li>
                        <?php } ?>
                        <li class="nav-item"><a class="nav-link" href="faq.php">FAQ</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownBlog" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Blog</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownBlog">
                                <li><a class="dropdown-item" href="blog-home.php">Blog Home</a></li>
                                <li><a class="dropdown-item" href="blog-post.php">Blog Post</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownPortfolio" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Portfolio</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownPortfolio">

                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                                <li><a class="dropdown-item" href="registeradmin2.php">Register Admin</a></li>
                                <?php } ?>

                                <?php if (isset($_SESSION['username'])) {
                                    ?>
                                <li><a class="dropdown-item" href="index.php?logout">Logout</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="py-5">
            <div class="container px-5">

                <div class="col pb-3">
                    <div class="col">
                        <h2>Profile</h>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                            <span class="badge rounded-pill bg-dark">
                                <i class="fa-solid fa-crown me-2 text-warning rounded-2"></i>Admin</span>
                            <?php } ?>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee') { ?>
                            <span class="badge rounded-pill bg-dark">
                                <i class="fa-solid fa-crown me-2 text-warning rounded-2"></i>employee</span>
                            <?php } ?>
                    </div>
                </div>


                <div class="col">
                    <div class="card">
                        <div class="card-body m-1">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <label for="new_username" class="form-label">New Username:</label>
                                <input type="text" class="form-control" id="new_username" name="new_username"
                                    value="<?php echo $user['username']; ?>">

                                <label for="Email" class="form-label">Email:</label>
                                <input type="text" class="form-control" id="Email" name="Email"
                                    value="<?php echo $user['Email']; ?>">

                                <label for="phone" class="form-label">phone:</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="<?php echo $user['phone']; ?>">

                                <label for="address" class="form-label">address:</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="<?php echo $user['address']; ?>">

                                <label for="gender" class="form-label">gender:</label>
                                <input type="text" class="form-control" id="gender" name="gender"
                                    value="<?php echo $user['gender']; ?>">

                                <label for="company_name" class="form-label">company name:</label>
                                <input type="text" class="form-control" id="company_name" name="company_name"
                                    value="<?php echo $user['company_name']; ?>">

                                <label for="new_password" class="form-label">New Password:</label>
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    value="">
                                <div class="col mt-3">
                                    <input type="submit" class="btn btn-primary" value="Update Profile">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- About section one-->

    </main>


    <!-- Footer-->
    <footer class="bg-dark py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0 text-white">Copyright &copy; Your Website 2022</div>
                </div>
                <div class="col-auto">
                    <a class="link-light small" href="#!">Privacy</a>
                    <span class="text-white mx-1">&middot;</span>
                    <a class="link-light small" href="#!">Terms</a>
                    <span class="text-white mx-1">&middot;</span>
                    <a class="link-light small" href="#!">Contact</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>