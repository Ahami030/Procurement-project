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
                        <?php if (isset($_SESSION['role']) && $_SESSION['role']=='admin' ){ ?>
                        <li class="nav-item"><a class="nav-link" href="portfolio-item.php">หน้าดูใบเสนอราคา</a></li>
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
                                <?php if (isset($_SESSION['username'])){?>
                                <li><a class="dropdown-item" href="Profile.php">Profile</a></li>
                                <?php } ?>
                                <?php if (isset($_SESSION['role']) && $_SESSION['role']=='admin' ){ ?>
                                <li><a class="dropdown-item" href="registeradmin.php">Add Admin</a></li>
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

        <div class="container-sm">
            <div class="rounded-3 py-3 px-2 px-md-2 mb-2">
                <!-- upload Card -->
                <div class="card inner-card" id="openModalBtn" style="display: show;">
                    <div class="card-body">
                        <h5 class="card-title">เริ่มต้นการส่งใบเสนอราคา</h5>
                        <p class="card-text">Click this card to open a modal.</p>

                    </div>
                </div>
                <!-- End of upload Card -->







                <!-- Additional Cards (Initially Hidden) -->

                <div class="card" id="additionalCards" style="display: none;">
                    <div class="card-body shadow">
                        <div class="row">
                            <div class="col-md-4 mt-1">
                                <div class="card card1">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>อัปโหลด</b></h5>
                                        <div class="progress mb-2">
                                            <div class="progress-bar bar1" id="progressBar1" role="progressbar"
                                                style="animation-direction: reverse; width: 0%;" aria-valuenow="25"
                                                aria-valuemin="0" aria-valuemax="100"> </div>
                                        </div>
                                        <p class="card-text">This is additional card number 1.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-1">
                                <div class="card card2">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>กำลังตรวจสอบ</b></h5>
                                        <div class="progress mb-2">
                                            <div class="progress-bar bar2" id="progressBar2" role="progressbar"
                                                style="animation-direction: reverse; width: 0%;" aria-valuenow="50"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="card-text">This is additional card number 2.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-1">
                                <div class="card card3">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>เสร็จสิน</b></h5>
                                        <div class="progress mb-2">
                                            <div class="progress-bar bar3" id="progressBar3" role="progressbar"
                                                style="animation-direction: reverse; width: 0%;" aria-valuenow="75"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="card-text">This is additional card number 3.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- End of Additional Cards -->

                        <!-- List Group -->
                        <div class="mt-3">
                            <ul class="list-group list-group-flush" style="display: none;" id="outerCardList">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>Uploaded<span id="span1" class="badge mt-1"></span></b>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>Vertify<span id="span2" class="badge mt-1"></span></b>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>Finish<span id="span3" class="badge mt-1"></span></b>
                                </li>
                            </ul>
                        </div>
                        <!-- End of List Group -->


                        <div class="mt-3" style="display: none;" id="accordionList">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
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





                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="upload.php" method="POST" enctype="multipart/form-data"
                                    accept-charset="UTF-8">
                                    <input type="hidden" name="member" value="<?php echo $_SESSION['member_id'] ?>">
                                    <label for="email" class="form-label">Email address</label>
                                    <div class="col p-1">
                                        <input type="email" id="email" class="form-control" name="email"
                                            onkeyup="checkInputs()" required>
                                    </div>

                                    <label for="file">Upload file:</label>

                                    <div class="col">
                                        <div id="dropzone" ondrop="handleDrop(event)" ondragover="handleDragOver(event)"
                                            ondragleave="handleDragLeave(event)"
                                            onclick="document.getElementById('fileInput').click()">
                                            Drop file here or click to upload.
                                        </div>
                                    </div>
                                    <div class="col p-1">
                                        <input type="file" id="fileInput" name="file"
                                            onchange="fileSelected(event); previewPDF(); checkInputs();" accept=".pdf"
                                            style="display: none;">
                                    </div>

                                    <div class="col p-1">
                                        <div id="dropzone3" ondrop="handleDrop(event)"
                                            ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)"
                                            onclick="document.getElementById('fileInput').click()">
                                            <canvas id="pdfCanvas" style="display: none;"></canvas>
                                        </div>
                                    </div>
                                    <div class="col p-1">
                                        <button type="button" class="btn btn-primary" id="prevBtn" onclick="prevPage()" disabled>&lt;</button>
                                        <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPage()" disabled>&gt;</button>
                                    </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="submit" name="submit" value="Upload"
                                    disabled>Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End of Modal -->







                <!-- upload Card PO-->

                <div class="mt-4">
                    <div class="card inner-card " id="openModalBtn_PO" style="display: none;">
                        <div class="card-body shadow">
                            <h5 class="card-title">เริ่มต้นการส่งใบสั่งซื้อ</h5>
                            <p class="card-text">Click this card to open a modal.</p>

                        </div>
                    </div>
                </div>
                <!-- End of upload Card -->




                <!-- Modal po -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel2">Modal title 2</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Form for the second modal -->
                                <form action="upload_PO.php" method="POST" enctype="multipart/form-data"
                                    accept-charset="UTF-8">
                                    <input type="hidden" name="member" value="<?php echo $_SESSION['member_id'] ?>">
                                    <label for="email2" class="form-label">Email address 2</label>
                                    <div class="col p-1">
                                        <input type="email" id="email2" class="form-control" name="email2"
                                            onkeyup="checkInputs2()" required>
                                    </div>

                                    <label for="file2">Upload file 2:</label>

                                    <div class="col">
                                        <div id="dropzone2" ondrop="handleDrop2(event)"
                                            ondragover="handleDragOver2(event)" ondragleave="handleDragLeave2(event)"
                                            onclick="document.getElementById('fileInput2').click()">
                                            Drop file here or click to upload.
                                        </div>
                                    </div>
                                    <div class="col p-1">
                                        <input type="file" id="fileInput2" name="file2"
                                            onchange="fileSelected2(event); previewPDF2(); checkInputs2();"
                                            accept=".pdf" style="display: none;">
                                    </div>

                                    <div class="col p-1">
                                        <div id="dropzone22" ondrop="handleDrop2(event)"
                                            ondragover="handleDragOver2(event)" ondragleave="handleDragLeave2(event)"
                                            onclick="document.getElementById('fileInput2').click()">
                                            <canvas id="pdfCanvas2" style="display: none;"></canvas>
                                        </div>
                                    </div>
                                    <div class="col p-1">
                                        <button type="button" class="btn btn-primary" id="prevBtn2" onclick="prevPage2()" disabled>&lt;</button>
                                        <button type="button" class="btn btn-primary" id="nextBtn2" onclick="nextPage2()" disabled>&gt;</button>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="submit2" name="submit2" value="Upload"
                                    disabled>Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End of Modal -->




                <!-- Additional Cards po(Initially Hidden) -->

                <div class="card" id="additionalCards_po" style="display: none;">
                    <div class="card-body shadow">
                        <div class="row">
                            <div class="col-md-4 mt-1">
                                <div class="card card1_po">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>อัปโหลด</b></h5>
                                        <div class="progress mb-2">
                                            <div class="progress-bar bar1_po" id="progressBar1_po" role="progressbar"
                                                style="animation-direction: reverse; width: 0%;" aria-valuenow="25"
                                                aria-valuemin="0" aria-valuemax="100"> </div>
                                        </div>
                                        <p class="card-text">This is additional card number 1.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-1">
                                <div class="card card2_po">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>กำลังตรวจสอบ</b></h5>
                                        <div class="progress mb-2">
                                            <div class="progress-bar bar2_po" id="progressBar2_po" role="progressbar"
                                                style="animation-direction: reverse; width: 0%;" aria-valuenow="50"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="card-text">This is additional card number 2.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-1">
                                <div class="card card3_po">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>เสร็จสิน</b></h5>
                                        <div class="progress mb-2">
                                            <div class="progress-bar bar3_po" id="progressBar3_po" role="progressbar"
                                                style="animation-direction: reverse; width: 0%;" aria-valuenow="75"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="card-text">This is additional card number 3.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- End of Additional Cards -->

                        <!-- List Group -->
                        <div class="mt-3">
                            <ul class="list-group list-group-flush" style="display: none;" id="outerCardList_po">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>Uploaded<span id="span1_po" class="badge mt-1"></span></b>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>Vertify<span id="span2_po" class="badge mt-1"></span></b>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>Finish<span id="span3_po" class="badge mt-1"></span></b>
                                </li>
                            </ul>
                        </div>
                        <!-- End of List Group -->


                        <div class="mt-3" style="display: block;" id="accordionList_po">
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-secondary" id="openModalBtn_money" disabled
                                    type="button">ส่งหลักฐานการโอนเงิน</button>
                            </div>
                        </div>
                       
                        <?php include "client\money.php" ?>
                        
                    </div>
                </div>




                <!-- Modal money -->
                <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel3">Modal title 2</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form action="uploadimg.php" method="post" enctype="multipart/form-data"
                                    id="uploadForm">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Select Image:</label>
                                        <input type="file" class="form-control" name="image" id="image" accept="image/*"
                                            onchange="previewImage()" required>

                                    </div>
                                    <div class="col">
                                        <center>
                                            <div id="imagePreview" class="mt-2"></div>
                                        </center>
                                    </div>

                                    <div class="mb-3">
                                        <label for="ID_member" class="form-label">Member ID:</label>
                                        <input type="text" class="form-control" name="ID_member" id="ID_member"
                                            value="<?php echo $_SESSION['member_id'] ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone:</label>
                                        <input type="text" class="form-control" name="phone" id="phone" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Modal -->




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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>

    <!-- main function  -->
    <script src="js\testjs.js"></script>
    <!-- main function  -->

    <!-- Core theme JS-->


</body>

</html>

<?php include "client\statebill.php" ?>
<?php include "client\statepo.php" ?>











<style>
    #dropzone {
        border: 2px dashed #ccc;
        padding: 20px;
        text-align: center;
        cursor: pointer;
    }

    #dropzone.dragover {
        background-color: #f5f5f5;
    }

    #pdfCanvas {
        height: 100%;
        width: 100%;
    }



    #dropzone2 {
        border: 2px dashed #ccc;
        padding: 20px;
        text-align: center;
        cursor: pointer;
    }

    #dropzone2.dragover2 {
        background-color: #f5f5f5;
    }

    #pdfCanvas2 {
        height: 100%;
        width: 100%;
    }


    .bg-success-lighter {
        background-color: #479f76;
        /* กำหนดสีที่ต้องการ */
    }

    .progress.active .progress-bar {
        -webkit-animation: progress-bar-stripes 2s linear infinite;
        -moz-animation: progress-bar-stripes 2s linear infinite;
        -ms-animation: progress-bar-stripes 2s linear infinite;
        -o-animation: progress-bar-stripes 2s linear infinite;
        animation: progress-bar-stripes 2s linear infinite;
    }
</style>