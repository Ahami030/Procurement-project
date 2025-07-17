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
        <!-- Page Content-->
        <section class="py-5">
            <div class="container px-5">
                <h1 class="fw-bolder fs-5 mb-4">Company Blog</h1>
                <div class="card border-0 shadow rounded-3 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="row gx-0">
                            <div class="col-lg-6 col-xl-5 py-lg-5">
                                <div class="p-4 p-md-5">
                                    <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>
                                    <div class="h2 fw-bolder">Article heading goes here</div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique delectus ab
                                        doloremque, qui doloribus ea officiis...</p>
                                    <a class="stretched-link text-decoration-none" href="#!">
                                        Read more
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-7">
                                <div class="bg-featured-blog"
                                    style="background-image: url('https://scontent.fcnx4-1.fna.fbcdn.net/v/t39.30808-6/329070872_748547103430569_3929107230737096274_n.jpg?stp=cp6_dst-jpg&_nc_cat=104&ccb=1-7&_nc_sid=8bfeb9&_nc_ohc=o_Wglv-jhH4AX8SbOFv&_nc_zt=23&_nc_ht=scontent.fcnx4-1.fna&oh=00_AfACgKz6DJO7BgKIKUQzOLGFWkBCCjvx-tlS9Y-BmPmeaQ&oe=63F0C98B')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5 bg-light">
            <div class="container px-5">
                <div class="row gx-5">
                    <div class="col-xl-8">
                        <h2 class="fw-bolder fs-5 mb-4">News</h2>
                        <!-- News item-->
                        <div class="mb-4">
                            <div class="small text-muted">May 12, 2022</div>
                            <a class="link-dark" href="#!">
                                <h3>Start Bootstrap releases Bootstrap 5 updates for templates and themes</h3>
                            </a>
                        </div>
                        <!-- News item-->
                        <div class="mb-5">
                            <div class="small text-muted">May 5, 2022</div>
                            <a class="link-dark" href="#!">
                                <h3>Bootstrap 5 has officially landed</h3>
                            </a>
                        </div>
                        <!-- News item-->
                        <div class="mb-5">
                            <div class="small text-muted">Apr 21, 2022</div>
                            <a class="link-dark" href="#!">
                                <h3>This is another news article headline, but this one is a little bit longer</h3>
                            </a>
                        </div>
                        <div class="text-end mb-5 mb-xl-0">
                            <a class="text-decoration-none" href="#!">
                                More news
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card border-0 h-100">
                            <div class="card-body p-4">
                                <div class="d-flex h-100 align-items-center justify-content-center">
                                    <div class="text-center">
                                        <div class="h6 fw-bolder">Contact</div>
                                        <p class="text-muted mb-4">
                                            For press inquiries, email us at
                                            <br />
                                            <a href="#!">press@domain.com</a>
                                        </p>
                                        <div class="h6 fw-bolder">Follow us</div>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-twitter"></i></a>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-facebook"></i></a>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-linkedin"></i></a>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog preview section-->
        <section class="py-5">
            <div class="container px-5">
                <h2 class="fw-bolder fs-5 mb-4">Featured Stories</h2>
                <div class="row gx-5">
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top"
                                src="http://www.ctnphrae.com/assets/uploads/img_news/ea7cc-img_0528.jpg" alt="..." />
                            <div class="card-body p-4">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>
                                <a class="text-decoration-none link-dark stretched-link" href="#!">
                                    <div class="h5 card-title mb-3">Blog post title</div>
                                </a>
                                <p class="card-text mb-0">Some quick example text to build on the card title and make up
                                    the bulk of the card's content.</p>
                            </div>
                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle me-3"
                                            src="http://www.ctnphrae.com/ckfinder/userfiles/images/%E0%B8%84%E0%B8%93%E0%B8%B0%E0%B8%84%E0%B8%A3%E0%B8%B9_190312_0008.jpg"
                                            style="width:40px;height:40px;" alt="..." />
                                        <div class="small">
                                            <div class="fw-bold">Kelly Rowan</div>
                                            <div class="text-muted">March 12, 2022 &middot; 6 min read</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top"
                                src="http://www.ctnphrae.com/assets/uploads/img_news/e7945-img_0522.jpg " alt="..." />
                            <div class="card-body p-4">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">Media</div>
                                <a class="text-decoration-none link-dark stretched-link" href="#!">
                                    <div class="h5 card-title mb-3">Another blog post title</div>
                                </a>
                                <p class="card-text mb-0">This text is a bit longer to illustrate the adaptive height of
                                    each card. Some quick example text to build on the card title and make up the bulk
                                    of the card's content.</p>
                            </div>
                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle me-3"
                                            src="http://www.ctnphrae.com/ckfinder/userfiles/images/%E0%B8%84%E0%B8%93%E0%B8%B0%E0%B8%84%E0%B8%A3%E0%B8%B9_190312_0008.jpg"
                                            style="width:40px;height:40px;" alt="..." />
                                        <div class="small">
                                            <div class="fw-bold">Josiah Barclay</div>
                                            <div class="text-muted">March 23, 2022 &middot; 4 min read</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top"
                                src="http://www.ctnphrae.com/assets/uploads/img_news/e5a9d-img_3044.jpg" alt="..." />
                            <div class="card-body p-4">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>
                                <a class="text-decoration-none link-dark stretched-link" href="#!">
                                    <div class="h5 card-title mb-3">The last blog post title is a little bit longer than
                                        the others</div>
                                </a>
                                <p class="card-text mb-0">Some more quick example text to build on the card title and
                                    make up the bulk of the card's content.</p>
                            </div>
                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle me-3"
                                            src="http://www.ctnphrae.com/ckfinder/userfiles/images/%E0%B8%84%E0%B8%93%E0%B8%B0%E0%B8%84%E0%B8%A3%E0%B8%B9_190312_0005.jpg"
                                            style="width:40px;height:40px; " alt="..." />
                                        <div class="small">
                                            <div class="fw-bold">Evelyn Martinez</div>
                                            <div class="text-muted">April 2, 2022 &middot; 10 min read</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end mb-5 mb-xl-0">
                    <a class="text-decoration-none" href="#!">
                        More stories
                        <i class="bi bi-arrow-right"></i>
                    </a>
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