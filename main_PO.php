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
    <link rel="stylesheet" href="css/mainstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <?php include 'connect.php'; ?>
</head>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlUpdate = "UPDATE notification_po SET qt_seen = 'seen' WHERE qt_seen = 'unseen'";
if ($conn->query($sqlUpdate) === TRUE) {
    // ไม่ต้องมีการแสดงผลหรือ echo ใด ๆ ที่นี่
} else {
    // หรือสามารถเพิ่มการจัดการข้อผิดพลาดได้ตามที่ต้องการ
}

$conn->close();
?>


<body class="d-flex flex-column h-100">
    <input type="hidden" name="member" value="<?php echo $_SESSION['member_id'] ?>">

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
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'member') { ?>
                            <li class="nav-item"><a class="nav-link" href="hello.php">กรอกแบบฟอร์มใบเสนอราคา</a></li>
                        <?php } ?>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                            <li class="nav-item"><a class="nav-link" href="pricing.php?g=B1">กรอกข้อมูล</a></li>

                        <?php } ?>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role']=='employee' ){ ?>
                        <li class="nav-item"><a class="nav-link" href="main employee.php">Work Station</a></li>
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
                                    <li><a class="dropdown-item" href="registeradmin.php">Add Admin</a></li>
                                <?php } ?>

                                <li><a class="dropdown-item" href="portfolio-overview.php">Portfolio Overview</a></li>
                                <li><a class="dropdown-item" href="portfolio-item.php">Portfolio Item</a></li>
                                <?php if (isset($_SESSION['username'])) { ?>
                                    <li><a class="dropdown-item" href="index.php?logout">Logout</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container px-5">
            <div class="rounded-3 py-5 px-4 px-md-5 mb-5">
                <div class="col mb-4">
                    <h2>รายละเอียดใบสั่งซื้อ</h2>
                </div>
            <?php
    // Connect to the database
    
    // Fetch the images from the database
    $query = $db->query("SELECT users.username, po.file_name, po.email, po.ID_member
    FROM po
    INNER JOIN users ON po.ID_member = users.id
    ORDER BY po.ID_member DESC"); // Sort by ID_member in descending order

    if ($query->rowCount() > 0) {
        echo '<div class="table-responsive">';
        echo "<table class='table table-striped table-hover'>";
        echo '<thead class="table-dark">';
        echo "<tr><th>Username</th><th>File Name</th><th></th><th></th><th></th><th></th><th>Email</th></tr>";
        echo '</thead>';
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            // Get the image URL and filename from the database
            $imageURL = 'upload_PO/' . $row['file_name'];
            $fileName = $row['file_name'];
            $ID_member = $row['ID_member']; // Retrieve ID_member
            $username = $row['username']; // Retrieve username
            
            // Output each image as a row in the table
            echo "<tr>";
            echo "<td>" . $username . "</td>";
            echo "<td colspan='5'><a href='#' class='open-modal-btn' data-src='" . $imageURL . "' data-name='" . $fileName . "' data-email='" . $row['email'] . "' data-id-member='" . $ID_member . "' data-username='" . $username . "'>" . $fileName . "</a></td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>

                <!-- Modal HTML -->
                <div class="overlayy" id="overlayy">
                    <div class="modaly">
                        <span class="close" id="close-modal">&times;</span>
                        <h2 id="modal-title"></h2>
                        <div class="pdf-preview-container" id="pdf-preview-container">
                            <div id='viewer'></div>
                        </div>

                        <form id="imageForm" method="post" action="/pj%20main/fill_po.php">
                            
                       
                            <input type="hidden" id="ID_member" name="ID_member" value="">
                            <h2 id="username"></h2>
                            </p>
                            <label for="email" class="form-label">Email</label><br>
                            <input type="email" id="email" class="form-control" name="email" value="" required><br>
                            <label for="message" class="form-label">Message</label><br>
                            <textarea id="message" name="message" class="form-control" ></textarea><br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>












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
    <script src="js/preview_PO.js"></script>
    <script src='lib/webviewer.min.js'></script>

</body>

</html>