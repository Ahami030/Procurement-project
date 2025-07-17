$(document).ready(function() {
    // Open modal when clicking on the card
    $('#openModalBtn').on('click', function() {
        $('#exampleModal').modal('show');
    });

    // Open PO modal when clicking on the PO card
    $('#openModalBtn_PO').on('click', function() {
        $('#exampleModal2').modal('show');
    });

    $('#openModalBtn_money').on('click', function() {
        $('#exampleModal3').modal('show');
    });

    // Other common code can go here
});


function previewImage() {
    var preview = document.getElementById("imagePreview");
    var fileInput = document.getElementById("image");

    // Clear previous preview
    preview.innerHTML = '';

    // Ensure that a file is selected
    if (fileInput.files.length > 0) {
        var file = fileInput.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            // Create an image element
            var img = document.createElement("img");
            img.src = e.target.result;
            img.style.maxWidth = "200px"; // Set the maximum width for the preview image

            // Append the image to the preview container
            preview.appendChild(img);
        };

        // Read the image file as a data URL
        reader.readAsDataURL(file);
    }
}

function submitForm() {
    document.getElementById("myForm").submit();
}


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

function handleDrop(event, fileInput, previewFunction) {
    event.preventDefault();
    fileInput.files = event.dataTransfer.files;
    previewFunction();
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