<?php
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
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
</head>

<body class="d-flex flex-column h-100">
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
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'member') { ?>
                            <li class="nav-item"><a class="nav-link" href="main.php">กรอกและดูข้อมูล</a></li>
                        <?php } ?>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                            <li class="nav-item"><a class="nav-link" href="main.php">Work Station</a></li>
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
                            <?php if (isset($_SESSION['username'])) { ?>
                                <a class="nav-link dropdown-toggle" id="navbarDropdownPortfolio" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Portfolio</a>
                            <?php } ?>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownPortfolio">
                                <?php if (isset($_SESSION['username'])) { ?>
                                    <li><a class="dropdown-item" href="Profile.php">Profile</a></li>
                                <?php } ?>
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                                    <li><a class="dropdown-item" href="registeradmin2.php">Add Admin</a></li>
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
        <!-- Page Content-->
        <section class="py-5">
            <div class="container">
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
        </section>
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
