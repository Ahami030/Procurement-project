
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <title>Modern Business - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>



<body class="d-flex flex-column">
<?php
// Start a session
session_start();

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user has submitted the login form
if (isset($_POST['submit'])) {

    // Retrieve the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind SQL statement using prepared statements
    $query = "SELECT * FROM users WHERE username = ?"; // Updated query to fetch user by username
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password using password_verify function
        if (password_verify($password, $user['password'])) {
            // Store the user information in the session
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['member_id'] = $user['id'];

            if ($_SESSION['role'] == 'admin') {
                $query = "DELETE FROM db_checker WHERE date_end <= DATE(NOW())";
                $conn->prepare($query);
                // Redirect the user to the protected page for admin
                header("Location: main.php");
                exit;
            }
            else if ($_SESSION['role'] == 'employee') {
                $query = "DELETE FROM db_checker WHERE date_end <= DATE(NOW())";
                $conn->prepare($query);
                // Redirect the user to the protected page for admin
                header("Location: main employee.php");
                exit;
            } else {
                // Redirect other users to a different page
                header("Location: main clienttest.php");
                exit;
            }
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Invalid username or password',
                text: 'กรุณากรอกชื่อหรือรหัสผ่านให้ถูกต้อง',
            });
          </script>";
        }
    } else {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Invalid username or password',
            text: 'กรุณากรอกชื่อหรือรหัสผ่านให้ถูกต้อง',
        });
      </script>";
    }
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand" href="index.php">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        <?php if (isset($_SESSION['username'])) {
                            ?>
                        <li class="nav-item"><a class="nav-link" href="pricing.php">ดูคะแนน</a></li>
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
                            <?php if (isset($_SESSION['username'])) { ?>
                        <li><a class="dropdown-item" href="Profile.php">Profile</a></li>
                        <?php } ?>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownPortfolio">
                            <li><a class="dropdown-item" href="portfolio-overview.php">Portfolio Overview</a></li>
                            <li><a class="dropdown-item" href="portfolio-item.php">Portfolio Item</a></li>
                        </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <section class="py-5">
            <div class="container px-5">
                <!-- Contact form-->
                <div class="rounded-3 py-5 px-4 px-md-5 mb-5">
                    <div class="text-center mb-5">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i
                                class="bi bi-envelope"></i></div>
                        <h1 class="fw-bolder">Login Procurement</h1>
                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">
                            <!-- * * * * * * * * * * * * * * *-->
                            <!-- * * SB Forms Contact Form * *-->
                            <!-- * * * * * * * * * * * * * * *-->
                            <!-- This form is pre-integrated with SB Forms.-->
                            <!-- To make this form functional, sign up at-->
                            <!-- https://startbootstrap.com/solution/contact-forms-->
                            <!-- to get an API token!-->
                            <form id="contactForm" action="" method="post" data-sb-form-api-token="API_TOKEN">
                                <!-- Name input-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="username" type="text"
                                        placeholder="Enter your username..." name="username"
                                        data-sb-validations="required" />
                                    <label for="username">Username</label>
                                    <div class="invalid-feedback" data-sb-feedback="username:required">Required a
                                        Username.
                                    </div>
                                </div>
                                <!-- Email address input-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="password" type="password"
                                        placeholder="Enter your Password..." name="password"
                                        data-sb-validations="required" />
                                    <label for="password">password</label>
                                    <div class="invalid-feedback" data-sb-feedback="password:required">Required a
                                        Password.
                                    </div>
                                </div>

                                <div class="d-none">

                                </div>
                                <!-- Submit Button-->
                                <div class="d-grid mb-3"><button class="btn btn-primary btn-lg " type="submit"
                                        name="submit" value="Login">Login</button>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Register</a>
                                </div>
                                <div class="text-center">
                                    <a id="icon40" class="fs-5 px-2 link-dark" href="#!"><img class="rounded-circle"
                                            src="https://cdn.iconscout.com/icon/free/png-256/google-2981831-2476479.png"
                                            width="40px" height="40px"></i></a>
                                    <a class="fs-5 px-2 link-dark" href="#!"><img class="rounded-circle"
                                            src="https://play-lh.googleusercontent.com/9N5WyhIgseJWfmtPCvJwik1rumF1jeTMqhV1Rxu_zU88duWQK9btrxVr4-Sn10HbcqCs"
                                            width="40px" height="40px"></i></a>
                                    <a class="fs-5 px-2 link-dark" href="#!"><img class="rounded-circle"
                                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/1200px-Facebook_Logo_%282019%29.png"
                                            width="40px" height="40px"></i></a>
                                    <a class="fs-5 px-2 link-dark" href="#!"><img class="rounded-circle"
                                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/LINE_logo.svg/800px-LINE_logo.svg.png"
                                            width="40px" height="40px"></i></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Register</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php include ('register.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>



                <a href="" id="openModal" class="card inner-card" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display: none;"></a>

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
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>



</body>

</html>