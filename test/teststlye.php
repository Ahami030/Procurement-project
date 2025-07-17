<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <title>Card with Modal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container-sm">
        <!-- upload Card -->
        <div class="card" id="openModalBtn" style="display: show;">
            <div class="card-body">
                <h5 class="card-title">เริ่มต้นการส่งใบเสนอราคา</h5>
                <p class="card-text">Click this card to open a modal.</p>

            </div>
        </div>
        <!-- End of upload Card -->




        <!-- Additional Cards (Initially Hidden) -->

        <div class="card" id="additionalCards" style="display: none;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card 1</h5>
                                <div class="progress mb-2">
                                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100">25%</div>
                                </div>
                                <p class="card-text">This is additional card number 1.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card 2</h5>
                                <div class="progress mb-2">
                                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="50"
                                        aria-valuemin="0" aria-valuemax="100">50%</div>
                                </div>
                                <p class="card-text">This is additional card number 2.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card 3</h5>
                                <div class="progress mb-2">
                                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="75"
                                        aria-valuemin="0" aria-valuemax="100">75%</div>
                                </div>
                                <p class="card-text">This is additional card number 3.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End of Additional Cards -->

                <!-- List Group -->
                <ul class="list-group list-group-flush" style="display: none;" id="outerCardList">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <!-- End of List Group -->




            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="upload.php" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                            <input type="hidden" name="member" value="<?php echo $_SESSION['member_id'] ?>">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" id="email" class="form-control" name="email" onkeyup="checkInputs()"
                                required>
                            <br><br>
                            <label for="file">Upload file:</label>
                            <div class="col">
                                <div id="dropzone" ondrop="handleDrop(event)" ondragover="handleDragOver(event)"
                                    ondragleave="handleDragLeave(event)"
                                    onclick="document.getElementById('fileInput').click()">
                                    Drop file here or click to upload.
                                </div>
                            </div>
                            <input type="file" id="fileInput" name="file"
                                onchange="fileSelected(event); previewPDF(); checkInputs();" accept=".pdf"
                                style="display: none;">
                            <br><br>
                            <div class="col">
                                <canvas id="pdfCanvas" style="display: none;"></canvas>
                            </div>
                            <br><br>
                            <button type="button" id="prevBtn" onclick="prevPage()" disabled>&lt;</button>
                            <button type="button" id="nextBtn" onclick="nextPage()" disabled>&gt;</button>

                            <br><br>

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


    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function() {
        // Open modal when clicking on the card
        $('#openModalBtn').on('click', function() {
            $('#exampleModal').modal('show');
        });

        // Show additional cards when "Save changes" is clicked
        $('#saveChanges').on('click', function() {
            $('#additionalCards').show();
            $('#openModalBtn').hide(); // Hide the outer card
            $('#outerCardList').show(); // Show additional list group
        });
    });
    </script>


</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>

<script>
function submitForm() {
    document.getElementById("myForm").submit();
}
</script>

<script>
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
</script>
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
                if (pdfSrc === fileInput.files[0].name && pageNum == page.pageNumber) {
                    canvas.getContext('2d').drawImage(canvas, 0, 0, canvas.width, canvas.height);
                    canvas.getContext('2d').drawImage(canvas, 0, 0, canvas.width, canvas.height, 0, 0,
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

#pdfCanvas {
    height: 100%;
    width: 100%;
}
</style>