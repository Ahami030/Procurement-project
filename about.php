<?php
session_start();
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
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xxl-6">
                        <div class="text-center my-5">
                            <h1 class="fw-bolder mb-3">Our mission is to make building websites easier for everyone.
                            </h1>
                            <p class="lead fw-normal text-muted mb-4">Start Bootstrap was built on the idea that
                                quality, functional website templates and themes should be available to everyone. Use
                                our open source, free products, or support us by purchasing one of our premium products
                                or services.</p>
                            <a class="btn btn-primary btn-lg" href="#scroll-target">Read our story</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- About section one-->
        <section class="py-5 bg-light" id="scroll-target">
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="row gx-5">
                        <div class="col-lg-4 mb-5">
                            <div class="card h-100 shadow border-0">
                                <img class="card-img-top" src="https://scontent.fcnx4-1.fna.fbcdn.net/v/t39.30808-6/301132376_450026193808660_8593723696120840247_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=730e14&_nc_ohc=8f9GrtCioZgAX8q380p&_nc_zt=23&_nc_ht=scontent.fcnx4-1.fna&oh=00_AfALxV2fbs1M5fgumbMhCuhY9Q6M-UA0uMVVTC-kFZbxZA&oe=63EF3AA9"
                                style="width:100%;height:100%; border-radius: 5px;" alt="..." />
                                <a class="text-decoration-none link-dark stretched-link" href="pricing.php"></a>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-5">
                            <div class="card h-100 shadow border-0">
                                <img class="card-img-top" src="https://scontent.fcnx4-1.fna.fbcdn.net/v/t39.30808-6/301235559_450026080475338_5885998206877117596_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=730e14&_nc_ohc=fEkN3thxJJ8AX-jMvQt&_nc_zt=23&_nc_ht=scontent.fcnx4-1.fna&oh=00_AfAHFDJHlwC6hYHBSSHVpTL0-3UFCsMADbOArGScpj0rwg&oe=63F12C50"
                                style="width:100%;height:100%; border-radius: 5px;"  alt="..." />
                                <a class="text-decoration-none link-dark stretched-link" href="pricing.php"></a>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-5">
                            <div class="card h-100 shadow border-0">
                                <img class="card-img-top" src="https://scontent.fcnx4-1.fna.fbcdn.net/v/t39.30808-6/300952097_450013103809969_2390128211336221809_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=730e14&_nc_ohc=3lJfawItJ48AX9wEdMk&_nc_zt=23&_nc_ht=scontent.fcnx4-1.fna&oh=00_AfCp2Tc6Ku1bYsDQM23U5VqmqLWlnqby0dVAej5FCicH2w&oe=63F0F26E"
                                style="width:100%;height:100%; border-radius: 5px;"   alt="..." />
                                <a class="text-decoration-none link-dark stretched-link" href="pricing.php"></a>
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
</body>

</html>