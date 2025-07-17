<?php

// Start a session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
$username = isset($_GET['username']) ? urldecode($_GET['username']) : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php include 'connect.php'; ?>


    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <link href="styleme.css" rel="stylesheet" />
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
    <link href="styleme.css" rel="stylesheet" />

</head>
<style>
body {
    font-family: Arial, sans-serif;
}

table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 20px;
}

th,
td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
}

button {
    margin-top: 10px;
}

<?php include 'table_connect.php';


?>
</style>

<body class="d-flex flex-column">
    <input type="hidden" name="role" value="<?php echo $_SESSION['role'] ?>">
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
                        <li class="nav-item"><a class="nav-link" href="main.php">กรอกและดูข้อมูล</a></li>
                        <?php } ?>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role']=='admin' ){ ?>
                        <li class="nav-item"><a class="nav-link" href="main.php">Work Station</a></li>
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
                        <?php if (isset($_SESSION['username'])) { ?>
                            <a class="nav-link dropdown-toggle" id="navbarDropdownPortfolio" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Portfolio</a>
                                <?php } ?>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownPortfolio">
                                <?php if (isset($_SESSION['username'])){?>
                                <li><a class="dropdown-item" href="Profile.php">Profile</a></li>
                                <?php } ?>
                                <?php if (isset($_SESSION['role']) && $_SESSION['role']=='admin' ){ ?>
                                <li><a class="dropdown-item" href="registeradmin2.php">Add Admin</a></li>
                                <?php } ?>
                                <?php if (isset($_SESSION['username'])) {
                                    ?>
                                    <li><a class="dropdown-item" href="index.php?logout">Logout</a></li>
                                <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Pricing section-->
        <section class="bg-light py-5">
            <div class="container px-5 my-5">
                <div class="col">
                    <?php
                    // Check if the form was submitted
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Retrieve the submitted ID_member
                        if (isset($_POST['ID_member'])) {
                            $submittedID_member = $_POST['ID_member'];

                            // Perform actions with the submitted ID_member
                            echo "Submitted ID_member: " . $submittedID_member;

                            // Database connection parameters
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "user_registration";

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Prepare and execute the SQL query
                            $sql = "SELECT * FROM po WHERE ID_member = $submittedID_member";

                            $result = $conn->query($sql);

                            // Check if the query was successful
                            if ($result) {
                                // Fetch and display the data
                                while ($row = $result->fetch_assoc()) {
                                    $imageURL = 'upload_PO/' . $row['file_name'];
                                    // Display the retrieved data (change this according to your table structure)
                                    echo "<br>file_name: " . $row['file_name'];
                                    echo "<br>Email: " . $row['email'];
                                    // Add more fields as needed
                                }
                            } else {
                                echo "Error in query: " . $conn->error;
                            }

                            // Close the database connection
                            $conn->close();
                        } else {
                            echo "ID_member was not submitted!";
                        }
                    }
                    ?>
                </div>
                <div class="row g-2">
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-body shadow">
                                <form action="table/insert_PO.php" method="post">
                                    <div id='viewer' style="width: 100%; height: 500px;"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <!---here-->
                        <div class="mb-3 position-relative">

                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "user_registration";

                            // เชื่อมต่อกับ MySQL
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            if (isset($_POST["save"])) {
                                $company_name = $_POST['company_name'];
                                $price = $_POST['price'];
                                $bill_No = $_POST['billNo'];

                                $check_company_query = "SELECT * FROM db_checker WHERE company_name = '$company_name'";
                                $result = $conn->query($check_company_query);

                                if ($result && $result->num_rows > 0) {
                                    // มีชื่อบริษัทที่ตรงกันใน my_table_name ให้ดึงข้อมูล date_start, date_end, id จาก my_table_name และทำการ insert ลงใน bill_records
                                    $row = $result->fetch_assoc();
                                    $date_start = $row['date_start'];
                                    $date_end = $row['date_end'];
                                    $id_from_my_table = $row['id'];
                                    $dateNow = date('Y-m-d H:i:s');

                                    $date_combined = $date_start . ' - ' . $date_end;

                                    $insert_query = "INSERT INTO bill_records (company_name, price, date, date_upload, id_bill, bill_No) VALUES ('$company_name', '$price', '$date_combined', '$dateNow', '$id_from_my_table', '$bill_No')";
                                    if ($conn->query($insert_query) === TRUE) {
                                        echo '<div class="alert alert-success" role="alert">บิลถูกเพิ่มเรียบร้อยแล้ว</div>';
                                    } else {
                                        echo "Error: " . $insert_query . "<br>" . $conn->error;
                                    }
                                } else {
                                    echo '
                                    <div class="row">
                                    <div class="col">
                                    <div class="alert alert-danger" role="alert">กรุณาสร้างใบวางบิล</div>
                                    </div>
                                    <div class="col">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    เพิ่มใบวางบิล
                                    </button>
                                    </div>
                                    </div>';

                                }
                            }

                            $conn->close();
                            ?>
                            <div class="card">
                                <div class="card-body shadow">
                                    <form action="" method="post" onsubmit="return submitForm()">
                                        <input type="hidden" id="ID_member" name="ID_member"
                                            value="<?php echo $submittedID_member ?>">
                                        <label for="company_name" class="form-label">ชื่อบริษัท:</label>
                                        <input type="text" class="form-control" id="company_name" name="company_name">
                                        <ul class="list-group" id="searchResults"></ul>
                                        <label for="company_name" class="form-label">จำนวนเงิน:</label>
                                        <input type="text" class="form-control" id="price" name="price"
                                            placeholder="จำนวนเงิน">
                                        <label for="company_name" class="form-label">เลขที่บิล:</label>
                                        <input type="text" class="form-control" id="billNo" name="billNo"
                                            placeholder="เลขที่บิล">
                                        <div class="col mt-3">
                                            <input type="submit" name="save" class="btn btn-primary" value="เพิ่มบิล">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!---end here-->
                            </form>
                        </div>
                        <form action="table/insert_PO.php" method="post" onsubmit="return submitForm()">
                            <input type="hidden" id="ID_member" name="ID_member"
                                value="<?php echo $submittedID_member ?>">
                            <div class="d-grid gap-2">
                                <button type="submit5" class="btn btn-success">ดำเนินการ</button>
                            </div>
                        </form>
                    </div>



                    <!-- Modal add db_checker -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
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
                                            echo '<div class="alert alert-success" role="alert">บิลถูกเพิ่มเรียบร้อยแล้ว</div>';
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
                                            <input type="text" id="company_name2" class="form-control"
                                                name="company_name2">
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
                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"
                                                name="save2">
                                                submit
                                            </button>
                                            <!-- Additional modal buttons can be added here -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
    <script src='lib/webviewer.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
    // ฟังก์ชันสำหรับตั้งค่าวันที่ใน input date_start เป็นวันปัจจุบัน
    function setStartDate() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('date_start').value = today;
    }

    // ฟังก์ชันสำหรับตั้งค่าวันที่ใน input date_end เป็นวันปัจจุบัน + 30 วัน
    function setEndDate() {
        var today = new Date();
        today.setDate(today.getDate() + 30);
        var endDate = today.toISOString().split('T')[0];
        document.getElementById('date_end').value = endDate;
    }
    </script>


    <script>
    $(document).ready(function() {
        // Function to update search results
        function updateResults(query) {
            const resultsContainer = $("#searchResults");
            resultsContainer.empty();

            // ใช้ Ajax เพื่อดึงข้อมูลจากฐานข้อมูล MySQL
            $.ajax({
                url: "js/fetch_data.php",
                method: "POST",
                dataType: "json",
                success: function(data) {
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
                error: function(error) {
                    console.error("Error fetching data:", error);
                }
            });
        }

        // Event listener for input change
        $("#company_name").on("input", function() {
            const searchTerm = $(this).val();
            updateResults(searchTerm);
        });

        // Update the form input when a result is clicked
        $("#searchResults").on("click", "li", function() {
            const selectedValue = $(this).text();
            $("#company_name").val(selectedValue);
            $("#searchResults").hide(); // ซ่อน UI เมื่อเลือกค่า
        });
    });
    </script>

    <script>
    WebViewer({
            path: 'lib', // path to the PDF.js Express'lib' folder on your server
            licenseKey: '	zYoNB8peIpOfy4FHPNtS',
            initialDoc: '<?php echo $imageURL; ?>',
            // initialDoc: '/path/to/my/file.pdf',  // You can also use documents on your server
        }, document.getElementById('viewer'))
        .then(instance => {
            // now you can access APIs through the WebViewer instance
            const {
                Core,
                UI
            } = instance;

            // adding an event listener for when a document is loaded
            Core.documentViewer.addEventListener('documentLoaded', () => {
                console.log('document loaded');
            });

            // adding an event listener for when the page number has changed
            Core.documentViewer.addEventListener('pageNumberUpdated', (pageNumber) => {
                console.log(`Page number is: ${pageNumber}`);
            });
        });
    </script>
</body>

</html>