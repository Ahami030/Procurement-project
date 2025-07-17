<!DOCTYPE html>
<html>

<head>
    <?php include 'connect.php';?>

    <title>Modal Pop-up Form Example with Image Preview</title>
    <style>
    /* Style for the overlay */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 999;
    }

    /* Style for the modal */
    .modal {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        max-width: 800px;
        width: 100%;
        max-height: 90%;
        overflow: auto;
        position: relative;
    }

    /* Style for the close button */
    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        color: #000;
        cursor: pointer;
    }

    /* Style for the image preview */
    .image-preview {
        margin: 20px 0;
        max-width: 100%;
        height: auto;
        border: 1px solid #ccc;
        padding: 10px;
        box-sizing: border-box;
    }
    </style>
</head>

<body>
  
<?php
    // Connect to the database
    
    // Fetch the images from the database
    $query = $db->query("SELECT id, file_name, email FROM images");

    if ($query->rowCount() > 0) {
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            // Get the image URL and filename from the database
            $imageURL = 'upload/' . $row['file_name'];
            $fileName = $row['file_name'];
?>
            <!-- Display a thumbnail of the image and a button to open the modal -->
            <div class="image-thumb">
                <a href="#" class="open-modal-btn" data-src="<?php echo $imageURL; ?>" data-name="<?php echo $fileName; ?>"
                    data-email="<?php echo $row['email']; ?>">
                    <?php echo $fileName; ?>
                </a>
            </div>
<?php
        }
    }
?>
<!-- Modal HTML -->
<div class="overlay" id="overlay">
    <div class="modal">
        <span class="close" id="close-modal">&times;</span>
        <h2 id="modal-title"></h2>
        <div class="pdf-preview-container" id="pdf-preview-container">
            <div id='viewer'></div>
        </div>

        <form>
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="" required><br>
            <label for="message">Message:</label><br>
            <textarea id="message" name="message"></textarea><br>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>

</body>
<script src='lib/webviewer.min.js'></script>

<script>
// Get the modal and close button elements
var modal = document.getElementById("overlay");
var closeBtn = document.getElementById("close-modal");

// Get the modal title element
var modalTitle = document.getElementById("modal-title");

// Get the open modal buttons
var openModalBtns = document.querySelectorAll(".open-modal-btn");

// Get the email input element
var emailInput = document.getElementById("email");

// Create a new PDF viewer element dynamically
function createPDFViewer() {
    var viewerContainer = document.createElement("div");
    viewerContainer.setAttribute("id", "pdfViewer");
    viewerContainer.style.width = "100%";
    viewerContainer.style.height = "500px";
    return viewerContainer;
}

// Loop through each open modal button and add a click event listener
openModalBtns.forEach(function(btn) {
    btn.addEventListener("click", function(e) {
        // Prevent the default link behavior
        e.preventDefault();

        // Get the PDF URL and filename from the data attributes
        var pdfURL = this.getAttribute("data-src");
        var fileName = this.getAttribute("data-name");
        var email = this.getAttribute("data-email");

        // Set the title of the modal to the filename
        modalTitle.innerHTML = fileName;

        // Get the email input element
        emailInput.value = email;

        // Clear the existing PDF viewer content
        var existingViewer = document.getElementById("pdfViewer");
        if (existingViewer) {
            existingViewer.remove();
        }

        // Create a new PDF viewer
        var pdfViewerElement = createPDFViewer();
        document.querySelector(".pdf-preview-container").appendChild(pdfViewerElement);

        WebViewer({
                path: 'lib', // path to the PDF.js Express'lib' folder on your server
                licenseKey: 'zYoNB8peIpOfy4FHPNtS',
                initialDoc: pdfURL
            },
            pdfViewerElement
        ).then(instance => {
            // now you can access APIs through the WebViewer instance
            const {
                Core,
                UI
            } = instance;

            // adding an event listener for when a document is loaded
            Core.documentViewer.addEventListener('documentLoaded', () => {
                console.log('document loaded');
            });

            // adding an event listener for when the page number has changed
            Core.documentViewer.addEventListener('pageNumberUpdated', (pageNumber) => {
                console.log(`Page number is: ${pageNumber}`);
            });
        });

        // Show the modal
        modal.style.display = "flex";
    });
});


// Add a click event listener to the close button
closeBtn.addEventListener("click", function() {
    // Hide the modal
    modal.style.display = "none";

    // Clear the PDF viewer content
    viewer.innerHTML = "";
});

// Add a click event listener to the overlay
modal.addEventListener("click", function(e) {
    // If the user clicks outside of the modal content, close the modal
    if (e.target === modal) {
        // Hide the modal
        modal.style.display = "none";

        // Clear the PDF viewer content
        viewer.innerHTML = "";
    }
});
</script>