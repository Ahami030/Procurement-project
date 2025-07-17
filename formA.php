<?php
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}?>
<!DOCTYPE html>
<html lang="en">
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
</style>

<head>
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
                        <?php if (isset($_SESSION['username'])){?>
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
        <!-- Page content-->
        <section class="py-5">
            <div class="container px-5">
                <!-- Contact form-->
                <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                    <?php include 'connect.php';?>
                    <form action="upload.php" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" onkeyup="checkInputs()" required>
                        <br><br>
                        <label for="file">Upload file:</label>
                        <div id="dropzone" ondrop="handleDrop(event)" ondragover="handleDragOver(event)"
                            ondragleave="handleDragLeave(event)" onclick="document.getElementById('fileInput').click()">
                            Drop file here or click to upload.
                        </div>
                        <input type="file" id="fileInput" name="file" onchange="previewPDF(); checkInputs();"
                            accept=".pdf" style="display: none;">
                        <br><br>
                        <canvas id="pdfCanvas"></canvas>
                        <br><br>
                        <button type="button" id="prevBtn" onclick="prevPage()" disabled>&lt;</button>
                        <button type="button" id="nextBtn" onclick="nextPage()" disabled>&gt;</button>
                        <br><br>
                        <button type="submit" id="submit" name="submit" value="Upload" disabled>Submit</button>
                    </form>

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>

                    <script>
                    let pdfDoc = null;
                    let pageNum = 1;
                    const scale = 1.5;
                    const canvas = document.getElementById("pdfCanvas");
                    const prevBtn = document.getElementById("prevBtn");
                    const nextBtn = document.getElementById("nextBtn");
                    const submitBtn = document.getElementById("submit");
                    const dropzone = document.getElementById("dropzone");
                    const fileInput = document.getElementById("fileInput");

                    function checkInputs() {
                        const emailInput = document.getElementById("email");

                        if (emailInput.value.includes("@") && pdfDoc) {
                            submitBtn.disabled = false;
                        } else {
                            submitBtn.disabled = true;
                        }
                    }

                    function previewPDF() {
                        const file = fileInput.files[0];
                        const reader = new FileReader();

                        reader.addEventListener("load", function() {
                            const pdfData = new Uint8Array(reader.result);
                            pdfjsLib.getDocument({
                                data: pdfData
                            }).promise.then(function(pdf) {
                                pdfDoc = pdf;
                                pageNum = 1;
                                renderPage();
                            });
                        }, false);

                        if (file) {
                            reader.readAsArrayBuffer(file);
                        }
                    }

                    function renderPage() {
                        pdfDoc.getPage(pageNum).then(function(page) {
                            const viewport = page.getViewport({
                                scale: scale
                            });
                            const context = canvas.getContext("2d");
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            const renderContext = {
                                canvasContext: context,
                                viewport: viewport
                            };

                            page.render(renderContext).promise.then(function() {
                                const canvasList = document.getElementsByClassName('pdf-canvas');
                                for (let i = 0; i < canvasList.length; i++) {
                                    const canvas = canvasList[i];
                                    const pdfSrc = canvas.getAttribute('data-pdf-src');
                                    const pageNum = canvas.getAttribute('data-page-num');
                                    if (pdfSrc === fileInput.files[0].name && pageNum == page
                                        .pageNumber) {
                                        canvas.getContext('2d').drawImage(canvas, 0, 0, canvas.width,
                                            canvas.height);
                                        canvas.getContext('2d').drawImage(canvas, 0, 0, canvas.width,
                                            canvas.height, 0, 0, canvas.width / 2, canvas.height / 2
                                            );
                                        break;
                                    }
                                }

                                prevBtn.disabled = pageNum <= 1;
                                nextBtn.disabled = pageNum >= pdfDoc.numPages;
                                checkInputs();
                            });
                        });
                    }

                    function prevPage() {
                        if (pageNum <= 1) {
                            return;
                        }
                        pageNum--;
                        renderPage();
                    }

                    function nextPage() {
                        if (pageNum >= pdfDoc.numPages) {
                            return;
                        }
                        pageNum++;
                        renderPage();
                    }

                    function handleDrop(event) {
                        event.preventDefault();
                        fileInput.files = event.dataTransfer.files;
                        previewPDF();
                    }

                    function handleDragOver(event) {
                        event.preventDefault();
                        dropzone.classList.add("dragover");
                    }

                    function handleDragLeave(event) {
                        event.preventDefault();
                        dropzone.classList.remove("dragover");
                    }

                    dropzone.addEventListener("click", function() {
                        fileInput.click
                    });
                    </script>
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
                    </style>








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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>
    <script src="script/formA.js"></script>
</body>

</html>