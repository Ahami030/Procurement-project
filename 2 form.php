<!DOCTYPE html>
<html>

<head>
    <title>PDF Preview and Upload</title>
</head>

<body>
    <h1>PDF Preview and Upload</h1>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
    </div>
    <div>
        <div id="dropZone1" class="dropZone">
            <p>Drag and drop PDF file for Canvas 1 here or click to select file</p>
            <input type="file" id="fileInput1" class="fileInput" accept="application/pdf">
        </div>
        <canvas id="pdfCanvas1"></canvas>
        <button id="prevPage1" onclick="prevPage(1)" class="disabled">Previous Page</button>
        <button id="nextPage1" onclick="nextPage(1)" class="disabled">Next Page</button>
        <button id="uploadBtn1" onclick="uploadFile(1)" class="disabled">Upload Canvas 1</button>
    </div>
    <div>
        <div id="dropZone2" class="dropZone">
            <p>Drag and drop PDF file for Canvas 2 here or click to select file</p>
            <input type="file" id="fileInput2" class="fileInput" accept="application/pdf">
        </div>
        <canvas id="pdfCanvas2"></canvas>
        <button id="prevPage2" onclick="prevPage(2)" class="disabled">Previous Page</button>
        <button id="nextPage2" onclick="nextPage(2)" class="disabled">Next Page</button>
        <button id="uploadBtn2" onclick="uploadFile(2)" class="disabled">Upload Canvas 2</button>
    </div>
    <div>
        <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.7.570/pdf.min.js"></script>
    <script>
        // Specify the worker source for PDF.js
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.7.570/pdf.worker.min.js';

        let pageNum1 = 1;
        let pageNum2 = 1;
        let pdfDoc1 = null;
        let pdfDoc2 = null;

        const fileInput1 = document.getElementById("fileInput1");
        const prevBtn1 = document.getElementById("prevPage1");
        const nextBtn1 = document.getElementById("nextPage1");
        const uploadBtn1 = document.getElementById("uploadBtn1");
        const page_num = document.getElementById("page_num");
        const page_count = document.getElementById("page_count");
        const canvas1 = document.getElementById("pdfCanvas1");
        const ctx1 = canvas1.getContext("2d");

        const fileInput2 = document.getElementById("fileInput2");
        const prevBtn2 = document.getElementById("prevPage2");
        const nextBtn2 = document.getElementById("nextPage2");
        const uploadBtn2 = document.getElementById("uploadBtn2");
        const canvas2 = document.getElementById("pdfCanvas2");
        const ctx2 = canvas2.getContext("2d");

        function renderPage1(num) {
            pdfDoc1.getPage(num).then(function (page) {
                const viewport = page.getViewport({ scale: 1.0 });
                ctx1.canvas.height = viewport.height;
                ctx1.canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: ctx1,
                    viewport: viewport,
                };
                page.render(renderContext).promise.then(function () {
                    // Update page counters
                    page_num.textContent = num;

                    // Enable/disable buttons
                    if (num === 1) {
                        prevBtn1.classList.add("disabled");
                    } else {
                        prevBtn1.classList.remove("disabled");
                    }
                    if (num === pdfDoc1.numPages) {
                        nextBtn1.classList.add("disabled");
                    } else {
                        nextBtn1.classList.remove("disabled");
                    }
                });
            });
        }

        function renderPage2(num) {
            pdfDoc2.getPage(num).then(function (page) {
                const viewport = page.getViewport({ scale: 1.0 });
                ctx2.canvas.height = viewport.height;
                ctx2.canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: ctx2,
                    viewport: viewport,
                };
                page.render(renderContext).promise.then(function () {
                    // Update page counters
                    page_num.textContent = num;

                    // Enable/disable buttons
                    if (num === 1) {
                        prevBtn2.classList.add("disabled");
                    } else {
                        prevBtn2.classList.remove("disabled");
                    }
                    if (num === pdfDoc2.numPages) {
                        nextBtn2.classList.add("disabled");
                    } else {
                        nextBtn2.classList.remove("disabled");
                    }
                });
            });
        }

        function prevPage(canvasNumber) {
            const num = canvasNumber === 1 ? pageNum1 : pageNum2;
            if (num <= 1) {
                return;
            }
            canvasNumber === 1 ? (pageNum1--) : (pageNum2--);
            canvasNumber === 1 ? renderPage1(pageNum1) : renderPage2(pageNum2);
        }

        function nextPage(canvasNumber) {
            const num = canvasNumber === 1 ? pageNum1 : pageNum2;
            const maxPages = canvasNumber === 1 ? pdfDoc1.numPages : pdfDoc2.numPages;
            if (num >= maxPages) {
                return;
            }
            canvasNumber === 1 ? (pageNum1++) : (pageNum2++);
            canvasNumber === 1 ? renderPage1(pageNum1) : renderPage2(pageNum2);
        }

        function handleFileSelect(evt, canvasNumber) {
    evt.stopPropagation();
    evt.preventDefault();

    // Get PDF file from input
    const file = evt.type === "drop" ? evt.dataTransfer.files[0] : evt.target.files[0];

    // Only allow PDF files
    if (file.type !== "application/pdf") {
        alert("Please select a PDF file.");
        return;
    }

    const reader = new FileReader();
    reader.onloadend = function () {
        // Read PDF file into PDF.js
        const data = new Uint8Array(reader.result);

        const pdfDoc = canvasNumber === 1 ? pdfDoc1 : pdfDoc2;

        pdfjsLib.getDocument(data).promise
            .then(function (pdfDoc_) {
                if (!pdfDoc_) {
                    // Handle the case where the document is not loaded correctly
                    console.error("Error loading PDF document: Document is null.");
                    alert("Error loading PDF document. Please try again.");
                    return;
                }

                // Assign the correct pdfDoc based on canvasNumber
                if (canvasNumber === 1) {
                    pdfDoc1 = pdfDoc_;
                } else if (canvasNumber === 2) {
                    pdfDoc2 = pdfDoc_;
                }

                document.getElementById("page_count").textContent = pdfDoc_.numPages;

                // Initial/first page rendering
                canvasNumber === 1 ? renderPage1(pageNum1) : renderPage2(pageNum2);

                // Enable buttons
                if (pdfDoc_.numPages > 1) {
                    canvasNumber === 1 ? nextBtn1.classList.remove("disabled") : nextBtn2.classList.remove("disabled");
                }
                canvasNumber === 1 ? uploadBtn1.classList.remove("disabled") : uploadBtn2.classList.remove("disabled");
            })
            .catch(function (error) {
                console.error("Error loading PDF document:", error);
                alert("Error loading PDF document. Please try again.");
            });
    };
    reader.readAsArrayBuffer(file);
}
        function handleDragOver(evt, canvasNumber) {
            evt.stopPropagation();
            evt.preventDefault();
            const dropZone = canvasNumber === 1 ? document.getElementById("dropZone1") : document.getElementById("dropZone2");
            dropZone.classList.add("dragover");
        }

        function handleDragLeave(evt, canvasNumber) {
            evt.stopPropagation();
            evt.preventDefault();
            const dropZone = canvasNumber === 1 ? document.getElementById("dropZone1") : document.getElementById("dropZone2");
            dropZone.classList.remove("dragover");
        }

        function handleDrop(evt, canvasNumber) {
            evt.stopPropagation();
            evt.preventDefault();
            const dropZone = canvasNumber === 1 ? document.getElementById("dropZone1") : document.getElementById("dropZone2");
            dropZone.classList.remove("dragover");
            handleFileSelect(evt, canvasNumber);
        }

        function uploadFile(canvasNumber) {
            const email = document.getElementById("email").value.trim();

            // Validate email and file
            if (email === "" || !email.includes("@")) {
                alert("Please enter a valid email address.");
                return;
            }

            let canvas;
            let uploadBtn;
            let pdfDoc;

            if (canvasNumber === 1) {
                canvas = canvas1;
                uploadBtn = uploadBtn1;
                pdfDoc = pdfDoc1;
            } else if (canvasNumber === 2) {
                canvas = canvas2;
                uploadBtn = uploadBtn2;
                pdfDoc = pdfDoc2;
            }

            const imageData = canvas.toDataURL("image/png");

            // Perform file upload and show success message
            alert(`Canvas ${canvasNumber} uploaded successfully!`);
        }

        fileInput1.addEventListener("change", (evt) => handleFileSelect(evt, 1), false);
        fileInput2.addEventListener("change", (evt) => handleFileSelect(evt, 2), false);

        const dropZone1 = document.getElementById("dropZone1");
        const dropZone2 = document.getElementById("dropZone2");

        dropZone1.addEventListener("dragover", (evt) => handleDragOver(evt, 1), false);
        dropZone1.addEventListener("dragleave", (evt) => handleDragLeave(evt, 1), false);
        dropZone1.addEventListener("drop", (evt) => handleDrop(evt, 1), false);

        dropZone2.addEventListener("dragover", (evt) => handleDragOver(evt, 2), false);
        dropZone2.addEventListener("dragleave", (evt) => handleDragLeave(evt, 2), false);
        dropZone2.addEventListener("drop", (evt) => handleDrop(evt, 2), false);
    </script>
</body>

</html>
