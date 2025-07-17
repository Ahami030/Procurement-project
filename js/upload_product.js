$(document).ready(function() {
    // Open modal when clicking on the card
    $('#openModalBtn_PO').on('click', function() {
        $('#exampleModal_PO').modal('show');
    });
});


$(document).ready(function() {
    // Open modal when clicking on the card
    $('#openModalBtn').on('click', function() {
        $('#exampleModal').modal('show');
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
