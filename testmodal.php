<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

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
                            <canvas id="pdfCanvas"style="display: none;"></canvas>
                        </div>
                        <br><br>
                        <button type="button" id="prevBtn" onclick="prevPage()" disabled>&lt;</button>
                        <button type="button" id="nextBtn" onclick="nextPage()" disabled>&gt;</button>
                        
                        <br><br>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit" name="submit" value="Upload"disabled>Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
  
</body>

</html>
