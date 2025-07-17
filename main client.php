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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

        <div class="container-sm">
            <div class="rounded-3 py-3 px-2 px-md-2 mb-2">
                <div class="row">
                    <div class="col-sm-6 mb-3 mb-sm-0 -sm">
                        <div class="card">
                            <div class="card-body">
                                <!-- Inner Row with Cards -->
                                <div class="p-1">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="portfolio-item.php" class="card inner-card">
                                                <div class="card-body">
                                                    <?php
                                                    // เชื่อมต่อกับฐานข้อมูล (MySQL)
                                                    $servername = "localhost";
                                                    $username = "root";
                                                    $password = "";
                                                    $dbname = "user_registration";

                                                    // สร้างการเชื่อมต่อ
                                                    $conn = new mysqli($servername, $username, $password, $dbname);

                                                    // ตรวจสอบการเชื่อมต่อ
                                                    if ($conn->connect_error) {
                                                        die("Connection failed: " . $conn->connect_error);
                                                    }

                                                    // คำสั่ง SQL เพื่อนับจำนวนแถวที่มี qt_seen เท่ากับ "unseen"
                                                    $sqlCount = "SELECT COUNT(*) AS unseen_count FROM notification WHERE qt_seen = 'unseen'";
                                                    $resultCount = $conn->query($sqlCount);

                                                    if ($resultCount && $resultCount->num_rows > 0) {
                                                        // ดึงข้อมูล
                                                        $row = $resultCount->fetch_assoc();
                                                        $unseenCount = $row["unseen_count"];
                                                        // แสดง badge ถ้า $unseenCount ไม่เท่ากับ 0
                                                        if ($unseenCount != 0) {
                                                            echo '<span class="badge badge-primary">' . $unseenCount . '</span>';
                                                        }
                                                    }

                                                    // ปิดการเชื่อมต่อ
                                                    $conn->close();
                                                    ?>
                                                    <h5 class="card-title">ใบเสนอราคา</h5>
                                                    <p class="card-text">This is card number 1.</p>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-md-4">
                                            <a href="#" class="card inner-card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Card 2</h5>
                                                    <p class="card-text">This is card number 2.</p>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-md-4">
                                            <a href="#" class="card inner-card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Card 3</h5>
                                                    <p class="card-text">This is card number 3.</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- End of Inner Row with Cards -->
                                </div>
                                <div class="p-1">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">An item</li>
                                        <li class="list-group-item">A second item</li>
                                        <li class="list-group-item">A third item</li>
                                    </ul>
                                </div>
                                <div class="p-1">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                                ประวัติใบเสนอราคา
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <?php include 'incude/history_1_client.php'; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.
                                </p>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">An item</li>
                                    <li class="list-group-item">A second item</li>
                                    <li class="list-group-item">A third item</li>
                                </ul>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                            aria-expanded="false" aria-controls="flush-collapseTwo">
                                            ประวัติใบสั่งซื้อ
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <?php include 'incude/history_2.php'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src=""></script>
   
</body>

</html>