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
</head>

<body class="d-flex flex-column h-100">
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
                        <?php if (isset($_SESSION['username'])){
                                    ?>
                        <li class="nav-item"><a class="nav-link" href="pricing.php">ดูคะแนน</a></li>
                        <?php } ?>
                        <?php if (isset($_SESSION['username']) && $_SESSION['username']=='admin' ){ ?>
                        <li class="nav-item"><a class="nav-link" href="admin.php">admin</a></li>
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
                            <?php if (isset($_SESSION['role']) && $_SESSION['role']=='admin' ){ ?>
                                <li><a class="dropdown-item" href="registeradmin.php">Add Admin</a></li>
                                <?php } ?>

                                <li><a class="dropdown-item" href="portfolio-overview.php">Portfolio Overview</a></li>
                                <li><a class="dropdown-item" href="portfolio-item.php">Portfolio Item</a></li>
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
        <!-- Page Content-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder">Our Work</h1>
                    <p class="lead fw-normal text-muted mb-0">Company portfolio</p>
                </div>
                <div class="row gx-5">
                    <div class="col-lg-6">
                        <div class="position-relative mb-5">
                            <img class="img-fluid rounded-3 mb-3" src="https://scontent.fcnx4-1.fna.fbcdn.net/v/t39.30808-6/291908479_5218533958222870_952559289418161903_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=8bfeb9&_nc_ohc=rvIeJGAXNfAAX_YW37A&_nc_zt=23&_nc_ht=scontent.fcnx4-1.fna&oh=00_AfACRxVCD_vo2uTXQ2e6nggejz0MlDHBD2cG_7PYIZEoyw&oe=63EFFBD6"
                            style="width:600px;height: 390px; border-radius: 5px;" alt="..." />
                            <a class="h3 fw-bolder text-decoration-none link-dark stretched-link" href="#!">Project
                                name</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mb-5">
                            <img class="img-fluid rounded-3 mb-3" src="https://scontent.fcnx4-1.fna.fbcdn.net/v/t39.30808-6/291808681_5218533694889563_7446310293257418427_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=8bfeb9&_nc_ohc=kXRg133T-PMAX_6DzcI&_nc_zt=23&_nc_ht=scontent.fcnx4-1.fna&oh=00_AfAu9BydATRwWCRyEpXgBqAqusHQLrt_vIZxlD-wb3SfTw&oe=63EFE6D9"
                            style="width:600px;height: 390px; border-radius: 5px;"   alt="..." />
                            <a class="h3 fw-bolder text-decoration-none link-dark stretched-link" href="#!">Project
                                name</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mb-5 mb-lg-0">
                            <img class="img-fluid rounded-3 mb-3" src="https://dummyimage.com/600x400/343a40/6c757d"
                                alt="..." />
                            <a class="h3 fw-bolder text-decoration-none link-dark stretched-link" href="#!">Project
                                name</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative">
                            <img class="img-fluid rounded-3 mb-3" src="https://dummyimage.com/600x400/343a40/6c757d"
                                alt="..." />
                            <a class="h3 fw-bolder text-decoration-none link-dark stretched-link" href="#!">Project
                                name</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5 bg-light">
            <div class="container px-5 my-5">
                <h2 class="display-4 fw-bolder mb-4">Let's build something together</h2>
                <a class="btn btn-lg btn-primary" href="#!">Contact us</a>
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