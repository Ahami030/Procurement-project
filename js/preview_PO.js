// Get the modal and close button elements

var modal = document.getElementById("overlayy");
var closeBtn = document.getElementById("close-modal");

// Get the modal title element
var modalTitle = document.getElementById("modal-title");
var id_member = document.getElementById("ID_member");
var usernameElement = document.getElementById("username");


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

        // Get the ID_member from data attribute
      

        // Get the PDF URL and filename from the data attributes
        var pdfURL = this.getAttribute("data-src");
        var fileName = this.getAttribute("data-name");
        var email = this.getAttribute("data-email");
        var ID_member = this.getAttribute("data-id-member");
        var username = this.getAttribute("data-username")
      


        // Set the title of the modal to the filename
        modalTitle.innerHTML = fileName;
        id_member.value = ID_member;
        usernameElement.innerHTML = username;

       
        

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
var myForm = document.getElementById("myForm");
myForm.addEventListener("submit", function(e) {
    e.preventDefault(); // Prevent default form submission for demonstration purposes

    // Get the value of the hidden input field holding username
    var submittedID_member = document.getElementById("ID_member").value;

    // Display the submitted username for demonstration
    alert("Submitted ID_member: " + submittedID_member);

    // Perform any other actions here (e.g., AJAX request, form submission)
});