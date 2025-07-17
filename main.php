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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<style>
    a {
        text-decoration: none;
    }
</style>

<?php include 'count.php'; ?>

<body class="d-flex flex-column h-100">
    <input type="hidden" name="member" value="<?php echo $_SESSION['member_id'] ?>">

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
                                <?php if (isset($_SESSION['username'])) { ?>
                                    <li><a class="dropdown-item" href="Profile.php">Profile</a></li>
                                <?php } ?>
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

        <div class="container px-5">
            <div class="rounded-3 mt-3 px-md-5 ">
                <div class="row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <div class="card">
                            <div class="card-body shadow">
                                <!-- Inner Row with Cards -->
                                <div class="p-1">
                                    <div class="row">
                                        <div class="col">
                                            <div class="p-1">
                                                <a href="product.php" class="card inner-card" id="card1">
                                                    <div class="card-body shadow">
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
                                                        <p class="card-text">Quotation</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- End of Inner Row with Cards -->
                                </div>
                                <div class="p-1">
                                    <div class="alert alert-primary  d-flex align-items-center m-1" role="alert">
                                        <i class="fa-solid fa-file-lines mr-2"></i>
                                        <div>
                                            งานทั้งหมด <span class="badge bg-primary ">
                                                <?php echo $total_count ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="alert alert-warning d-flex align-items-center m-1" role="alert">
                                        <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                                        <div>
                                            งานยังไม่เสร็จ <span class="badge bg-warning ">
                                                <?php echo $count_0 ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="alert alert-success d-flex align-items-center m-1" role="alert">
                                        <i class="fa-solid fa-circle-check mr-2"></i>
                                        <div>
                                            งานเสร็จแล้ว <span class="badge bg-success ">
                                                <?php echo $count_1 ?>
                                            </span>
                                        </div>
                                    </div>
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
                                                <?php include 'incude/history_1.php'; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>






                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body shadow">
                                <!-- Inner Row with Cards -->
                                <div class="p-1">
                                    <div class="row">
                                        <div class="col">
                                            <div class="p-1">
                                                <a href="main_PO.php" class="card inner-card" id="card1">
                                                    <div class="card-body shadow">
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
                                                        $sqlCount = "SELECT COUNT(*) AS unseen_count FROM notification_po WHERE qt_seen = 'unseen'";
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
                                                        <h5 class="card-title">ใบสั่งซื้อ</h5>
                                                        <p class="card-text">Purchase order</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- End of Inner Row with Cards -->

                                    <div class="p-1">
                                        <div class="alert alert-primary  d-flex align-items-center m-1" role="alert">
                                            <i class="fa-solid fa-file-lines mr-2"></i>
                                            <div>
                                                งานทั้งหมด <span class="badge bg-primary ">
                                                    <?php echo $total_count_po ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="alert alert-warning d-flex align-items-center m-1" role="alert">
                                            <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                                            <div>
                                                งานยังไม่เสร็จ <span class="badge bg-warning ">
                                                    <?php echo $count_0_po ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="alert alert-success d-flex align-items-center m-1" role="alert">
                                            <i class="fa-solid fa-circle-check mr-2"></i>
                                            <div>
                                                งานเสร็จแล้ว <span class="badge bg-success ">
                                                    <?php echo $count_1_po ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-1">
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















                <div class="card mt-4 mb-5">
                    <div class="card-body shadow">
                        <!-- Inner Row with Cards -->
                        <div class="p-1">
                            <div class="row">
                                <div class="col">
                                    <div class="list-group shadow">

                                        <a href="#" class="list-group-item list-group-item-action bg-dark text-white"
                                            style="--bs-bg-opacity: .85;" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">เพิ่มใบวางบิล</a>

                                        <a href="test/preview_bill.php" style="--bs-bg-opacity: .85;"
                                            class="list-group-item list-group-item-action bg-dark text-white">รายการใบวางบิล</a>

                                        <a href="test/preview.php"
                                            class="list-group-item list-group-item-action  bg-dark text-white"
                                            style="--bs-bg-opacity: .85;">ใบวางบิล</a>

                                    </div>
                                </div>


                                <div class="col">
                                    <a href="previewimg.php" class="card inner-card p-3 shadow" id="card1">
                                        <div class="card-body">

                                            <h5 class="card-title">หลักฐานการโอนเงิน</h5>
                                            <p class="card-text">Evidence of money transfer</p>
                                        </div>
                                    </a>
                                </div>

                            </div>
                            <!-- End of Inner Row with Cards -->
                        </div>
                        <div class="p-1">
                            <ul class="list-group list-group-flush ">
                                <li class="list-group-item">An item</li>
                                <li class="list-group-item">A second item</li>
                                <li class="list-group-item">A third item</li>
                            </ul>
                        </div>
                        <div class="p-1">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThree" aria-expanded="false"
                                        aria-controls="flush-collapseThree">
                                        ประวัติใบเสนอราคา
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <?php include 'incude/history_1.php'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>








        <!-- Modal add bill-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" onload="setStartDate(); setEndDate();">
                        <?php include 'modal_add_bill.php'; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal create bill -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Modal Title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" onload="setStartDate(); setEndDate();">

                        <?php
                        // เชื่อมต่อกับ MySQL Database
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "user_registration";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // ตรวจสอบการเชื่อมต่อ
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        if (isset($_POST["save2"])) {

                            // รับข้อมูลจากฟอร์ม
                            $name = $_POST['name'];
                            $date_start = date('Y-m-d'); // ตั้งค่า date_start เป็นวันที่ปัจจุบัน
                        
                            // คำนวณวันที่ date_end โดยเพิ่ม 30 วันจากวันปัจจุบัน
                            $date_end = date('Y-m-d', strtotime('+30 days'));

                            $company_name = $_POST['company_name2'];

                            // เตรียมคำสั่ง SQL เพื่อเพิ่มข้อมูล
                            $sql = "INSERT INTO db_checker (name, date_start, date_end, company_name) VALUES ('$name', '$date_start', '$date_end', '$company_name')";

                            if ($conn->query($sql) === TRUE) {
                                echo "<script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'ใบบิลถูกเพิ่มเรียบร้อยแล้ว',
                                   
                                });
                              </script>";
                            } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                        }
                        $conn->close();
                        ?>

                        <!-- Modal content goes here -->
                        <form action="" method="post">
                            <input type="hidden" id="ID_member" name="ID_member"
                                value="<?php echo $submittedID_member ?>">

                            <div class="col mt-2 mb-2">
                                <label for="company_name2">ชื่อบริษัท</label>
                                <input type="text" id="company_name2" class="form-control" name="company_name2">
                            </div>

                            <div class="col mt-2 mb-2">
                                <label for="date_start">วันที่เริ่มต้น</label>
                                <input type="date" id="date_start" class="form-control" name="date_start">
                            </div>
                            <div class="col mt-2 mb-2">
                                <label for="date_end">วันที่สิ้นสุด</label>
                                <input type="date" id="date_end" class="form-control" name="date_end">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    กรอกข้อมูลเพิ่มใบวางบิล
                                </button>
                                <button type="submit" class="btn btn-success" data-bs-dismiss="modal" name="save2">
                                    submit
                                </button>
                                <!-- Additional modal buttons can be added here -->
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>


       



        <a href="" id="openModal" class="card inner-card" data-bs-toggle="modal" data-bs-target="#exampleModal2"  style="display: none;"></a>




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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Core theme JS-->
    <script src=""></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>


    <script>
        $(document).ready(function () {
            // Function to update search results
            function updateResults(query) {
                const resultsContainer = $("#searchResults");
                resultsContainer.empty();

                // ใช้ Ajax เพื่อดึงข้อมูลจากฐานข้อมูล MySQL
                $.ajax({
                    url: "js/fetch_data.php",
                    method: "POST",
                    dataType: "json",
                    success: function (data) {
                        const filteredData = data.filter(item => item.toLowerCase().includes(query
                            .toLowerCase()));

                        if (filteredData.length === 0) {
                            resultsContainer.append(
                                '<li class="list-group-item">No results found</li>');
                        } else {
                            filteredData.forEach(item => {
                                resultsContainer.append(
                                    `<li class="list-group-item">${item}</li>`);
                            });
                        }

                        // ซ่อนหรือแสดงผลลัพธ์ขึ้นอยู่กับการมีข้อความใน input
                        if (query.trim() === "") {
                            resultsContainer.hide();
                        } else {
                            resultsContainer.show();
                        }
                    },
                    error: function (error) {
                        console.error("Error fetching data:", error);
                    }
                });
            }

            // Event listener for input change
            $("#company_name").on("input", function () {
                const searchTerm = $(this).val();
                updateResults(searchTerm);
            });

            // Update the form input when a result is clicked
            $("#searchResults").on("click", "li", function () {
                const selectedValue = $(this).text();
                $("#company_name").val(selectedValue);
                $("#searchResults").hide(); // ซ่อน UI เมื่อเลือกค่า
            });
        });
    </script>
</body>

</html>