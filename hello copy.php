<?php include 'connect.php';
session_start();
echo $_SESSION['member_id']
?>

<form action="upload.php" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
    <input type="hidden" name ="member" value="<?php echo $_SESSION['member_id'] ?>">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" onkeyup="checkInputs()" required>
    <br><br>
    <label for="file">Upload file:</label>
    <div id="dropzone" ondrop="handleDrop(event)" ondragover="handleDragOver(event)"
        ondragleave="handleDragLeave(event)" onclick="document.getElementById('fileInput').click()">
        Drop file here or click to upload.
    </div>
    <input type="file" id="fileInput" name="file" onchange="previewPDF(); checkInputs();" accept=".pdf"
        style="display: none;">
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
  pdfDoc.getPage(pageNum).then(function (page) {
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

    page.render(renderContext).promise.then(function () {
      const canvasList = document.getElementsByClassName('pdf-canvas');
      for (let i = 0; i < canvasList.length; i++) {
        const canvas = canvasList[i];
        const pdfSrc = canvas.getAttribute('data-pdf-src');
        const pageNum = canvas.getAttribute('data-page-num');
        if (pdfSrc === fileInput.files[0].name && pageNum == page.pageNumber) {
          canvas.getContext('2d').drawImage(canvas, 0, 0, canvas.width, canvas.height);
          canvas.getContext('2d').drawImage(canvas, 0, 0, canvas.width, canvas.height, 0, 0, canvas.width / 2, canvas.height / 2);
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