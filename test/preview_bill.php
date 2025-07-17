<?php
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
.card-link {
    cursor: pointer;
}
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="../index.php">Phare Sanguan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>

                    <li class="nav-item"><a class="nav-link" href="../about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="../contact.php">Contact</a></li>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role']=='member' ){ ?>
                    <li class="nav-item"><a class="nav-link" href="../main.php">กรอกและดูข้อมูล</a></li>
                    <?php } ?>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role']=='admin' ){ ?>
                    <li class="nav-item"><a class="nav-link" href="../main.php">Work Station</a></li>
                    <?php } ?>

                    <li class="nav-item"><a class="nav-link" href="../faq.php">FAQ</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownBlog" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Blog</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownBlog">
                            <li><a class="dropdown-item" href="../blog-home.php">Blog Home</a></li>
                            <li><a class="dropdown-item" href="../blog-post.php">Blog Post</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <?php if (isset($_SESSION['username'])) { ?>
                        <a class="nav-link dropdown-toggle" id="navbarDropdownPortfolio" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Portfolio</a>
                        <?php } ?>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownPortfolio">
                            <?php if (isset($_SESSION['username'])){?>
                            <li><a class="dropdown-item" href="../Profile.php">Profile</a></li>
                            <?php } ?>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role']=='admin' ){ ?>
                            <li><a class="dropdown-item" href="../registeradmin2.php">Add Admin</a></li>
                            <?php } ?>
                            <?php if (isset($_SESSION['username'])){
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

            <h2>ข้อมูล Company Name จาก db_checker</h2>
            <div class="row">
                <?php
             $servername = "localhost";
             $username = "root";
             $password = "";
             $dbname = "user_registration";

            $conn = new mysqli($servername, $username, $password, $dbname);
            

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT company_name FROM bill_records GROUP BY company_name";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                <!-- แสดงแต่ละข้อมูลในรูปแบบของ Card -->
                <div class="col-md-4 mb-3 mt-3">
                    <div class="card">
                        <!-- เพิ่มกำหนดลิงค์ด้านนอกให้กับ Card -->
                        <a href="show_company_info.php?company_name=<?php echo urlencode($row["company_name"]); ?>"
                            class="card-link">
                            <div class="card-body">
                                <?php echo $row["company_name"]; ?>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
                }
            } else {
                echo "0 results";
            }

            $conn->close();
            ?>
            </div>
        </div>
    </header>
    <!-- About section one-->
    <section class="py-5" id="scroll-target">
        <div class="container px-5 my-5">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- Script สำหรับ redirect เมื่อ Card ถูกคลิก -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const cardLinks = document.querySelectorAll('.card-link');
        cardLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });
    });
    </script>
</body>

</html>