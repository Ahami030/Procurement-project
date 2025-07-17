<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image with Preview</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Upload Image</h5>
        </div>
        <div class="card-body">
            <form action="uploadimg.php" method="post" enctype="multipart/form-data" id="uploadForm">
                <div class="mb-3">
                    <label for="image" class="form-label">Select Image:</label>
                    <input type="file" class="form-control" name="image" id="image" accept="image/*" onchange="previewImage()" required>
                    <div id="imagePreview" class="mt-2"></div>
                </div>

                <div class="mb-3">
                    <label for="ID_member" class="form-label">Member ID:</label>
                    <input type="text" class="form-control" name="ID_member" id="ID_member" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="text" class="form-control" name="phone" id="phone" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
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
    
</script>

</body>
</html>
