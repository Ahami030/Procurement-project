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
                                        <div id="dropzone2" ondrop="handleDrop(event)"
                                            ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)"
                                            onclick="document.getElementById('fileInput').click()">
                                            <canvas id="pdfCanvas" style="display: none;"></canvas>
                                        </div>
                                    </div>
                                    <div class="col p-1">
                                        <button type="button" id="prevBtn" onclick="prevPage()" disabled>&lt;</button>
                                        <button type="button" id="nextBtn" onclick="nextPage()" disabled>&gt;</button>
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
                    <div class="card inner-card " id="openModalBtn_PO">
                        <div class="card-body shadow">
                            <h5 class="card-title">เริ่มต้นการส่งใบสั่งซื้อ</h5>
                            <p class="card-text">Click this card to open a modal.</p>

                        </div>
                    </div>
                </div>
                <!-- End of upload Card -->



                <!-- Modal2 -->
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
                                <form action="upload.php" method="POST" enctype="multipart/form-data"
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
                                        <button type="button" id="prevBtn2" onclick="prevPage2()" disabled>&lt;</button>
                                        <button type="button" id="nextBtn2" onclick="nextPage2()" disabled>&gt;</button>
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
    <script>
    // Add this line to specify the worker source file for PDF.js
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.worker.min.js';
    
    $(document).ready(function() {
        // Open modal when clicking on the card
        $('#openModalBtn').on('click', function() {
            $('#exampleModal').modal('show');
        });
    });


    $(document).ready(function() {
        // Open modal when clicking on the card
        $('#openModalBtn_PO').on('click', function() {
            $('#exampleModal2').modal('show');
        });
    });

    function submitForm() {
        document.getElementById("myForm").submit();
    }

    function fileSelected(event) {
        var dropzone = document.getElementById('dropzone');
        var pdfCanvas = document.getElementById('pdfCanvas');

        if (event.target.files.length > 0) {
            dropzone.style.display = 'none';
            pdfCanvas.style.display = 'block';
        } else {
            dropzone.style.display = 'block';
            pdfCanvas.style.display = 'none';
        }

    }

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
                    if (pdfSrc === fileInput.files[0].name && pageNum == page.pageNumber) {
                        canvas.getContext('2d').drawImage(canvas, 0, 0, canvas.width, canvas.height);
                        canvas.getContext('2d').drawImage(canvas, 0, 0, canvas.width, canvas.height, 0,
                            0,
                            canvas.width / 2, canvas.height / 2);
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
        var dropzone = document.getElementById('dropzone');
        dropzone.style.display = 'none';
        pdfCanvas.style.display = 'block';
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


    function submitForm() {
        document.getElementById("myForm").submit();
    }

    function fileSelected(event) {
        var dropzone = document.getElementById('dropzone');
        var pdfCanvas = document.getElementById('pdfCanvas');

        if (event.target.files.length > 0) {
            dropzone.style.display = 'none';
            pdfCanvas.style.display = 'block';
        } else {
            dropzone.style.display = 'block';
            pdfCanvas.style.display = 'none';
        }

    }

    let pdfDoc2 = null;
    let pageNum2 = 1;
    const scale2 = 1.5;
    const canvas2 = document.getElementById("pdfCanvas2");
    const prevBtn2 = document.getElementById("prevBtn2");
    const nextBtn2 = document.getElementById("nextBtn2");
    const submitBtn2 = document.getElementById("submit2");
    const dropzone2 = document.getElementById("dropzone2");
    const fileInput2 = document.getElementById("fileInput2");

    function checkInputs2() {
        const emailInput2 = document.getElementById("email2");

        if (emailInput2.value.includes("@") && pdfDoc2) {
            submitBtn2.disabled = false;
        } else {
            submitBtn2.disabled = true;
        }
    }

    function previewPDF2() {
        const file2 = fileInput2.files[0];
        const reader2 = new FileReader();

        reader2.addEventListener("load", function() {
            const pdfData2 = new Uint8Array(reader2.result);
            pdfjsLib.getDocument({
                data: pdfData2
            }).promise.then(function(pdf2) {
                pdfDoc2 = pdf2;
                pageNum2 = 1;
                renderPage2();
            });
        }, false);

        if (file2) {
            reader2.readAsArrayBuffer(file2);
        }
    }

    function fileSelected2(event) {
        var dropzone2 = document.getElementById('dropzone2');
        var pdfCanvas2 = document.getElementById('pdfCanvas2');

        if (event.target.files.length > 0) {
            dropzone2.style.display = 'none';
            pdfCanvas2.style.display = 'block';
        } else {
            dropzone2.style.display = 'block';
            pdfCanvas2.style.display = 'none';
        }

        // Add any additional logic you need for fileSelected2
    }

    function renderPage2() {
        pdfDoc2.getPage(pageNum2).then(function(page2) {
            const viewport2 = page2.getViewport({
                scale: scale2
            });

            const context2 = canvas2.getContext("2d");
            canvas2.height = viewport2.height;
            canvas2.width = viewport2.width;

            const renderContext2 = {
                canvasContext: context2,
                viewport: viewport2
            };

            page2.render(renderContext2).promise.then(function() {
                const canvasList2 = document.getElementsByClassName('pdf-canvas2');
                for (let i = 0; i < canvasList2.length; i++) {
                    const canvas2 = canvasList2[i];
                    const pdfSrc2 = canvas2.getAttribute('data-pdf-src');
                    const pageNum2 = canvas2.getAttribute('data-page-num');
                    if (pdfSrc2 === fileInput2.files[0].name && pageNum2 == page2.pageNumber) {
                        canvas2.getContext('2d').drawImage(canvas2, 0, 0, canvas2.width, canvas2
                            .height);
                        canvas2.getContext('2d').drawImage(canvas2, 0, 0, canvas2.width, canvas2.height,
                            0, 0,
                            canvas2.width / 2, canvas2.height / 2);
                        break;
                    }
                }

                prevBtn2.disabled = pageNum2 <= 1;
                nextBtn2.disabled = pageNum2 >= pdfDoc2.numPages;
                checkInputs2();
            });
        });
    }

    function prevPage2() {
        if (pageNum2 <= 1) {
            return;
        }
        pageNum2--;
        renderPage2();
    }

    function nextPage2() {
        if (pageNum2 >= pdfDoc2.numPages) {
            return;
        }
        pageNum2++;
        renderPage2();
    }

    function handleDrop2(event) {
        event.preventDefault();
        fileInput2.files = event.dataTransfer.files;
        previewPDF2();
        var dropzone2 = document.getElementById('dropzone2');
        dropzone2.style.display = 'none';
        pdfCanvas2.style.display = 'block';
    }

    function handleDragOver2(event) {
        event.preventDefault();
        dropzone2.classList.add("dragover");
    }

    function handleDragLeave2(event) {
        event.preventDefault();
        dropzone2.classList.remove("dragover");
    }

    dropzone2.addEventListener("click", function() {
        fileInput2.click
    });
    </script>


</body>

</html>



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

.bg-success-lighter {
    background-color: #479f76;
    /* กำหนดสีที่ต้องการ */
}
</style>