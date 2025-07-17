document.addEventListener("DOMContentLoaded", function () {
    var modal = new bootstrap.Modal(document.getElementById("imageModal"));
    var modalTitle = document.getElementById("imageModalLabel");
    var idMemberInput = document.getElementById("ID_member");
    var usernameElement = document.getElementById("username");
    var emailInput = document.getElementById("email");
    var viewer = document.getElementById("viewer");

    var openModalBtns = document.querySelectorAll(".open-modal-btn");
    openModalBtns.forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            e.preventDefault();

            var pdfURL = this.getAttribute("data-src");
            var fileName = this.getAttribute("data-name");
            var email = this.getAttribute("data-email");
            var idMember = this.getAttribute("data-id-member");
            var username = this.getAttribute("data-username");

            modalTitle.innerHTML = fileName;
            idMemberInput.value = idMember;
            usernameElement.innerHTML = username;
            emailInput.value = email;

            if (viewer.hasChildNodes()) {
                viewer.innerHTML = "";
            }

            var pdfViewerElement = createPDFViewer();
            viewer.appendChild(pdfViewerElement);

            WebViewer(
                {
                    path: "lib",
                    licenseKey: "zYoNB8peIpOfy4FHPNtS",
                    initialDoc: pdfURL,
                },
                pdfViewerElement
            ).then((instance) => {
                const { Core } = instance;
                Core.documentViewer.addEventListener("documentLoaded", () => {
                    console.log("document loaded");
                });
                Core.documentViewer.addEventListener("pageNumberUpdated", (pageNumber) => {
                    console.log(`Page number is: ${pageNumber}`);
                });
            });

            modal.show();
        });
    });

    var closeModalBtn = document.querySelector(".close");
    closeModalBtn.addEventListener("click", function () {
        modal.hide();
        viewer.innerHTML = "";
    });

    modal._element.addEventListener("click", function (e) {
        if (e.target === modal._element) {
            modal.hide();
            viewer.innerHTML = "";
        }
    });

    var myForm = document.getElementById("imageForm");
    myForm.addEventListener("submit", function (e) {
        e.preventDefault();
        var submittedIdMember = idMemberInput.value;
        alert("Submitted ID_member: " + submittedIdMember);
    });
});

function createPDFViewer() {
    var viewerContainer = document.createElement("div");
    viewerContainer.setAttribute("id", "pdfViewer");
    viewerContainer.style.width = "100%";
    viewerContainer.style.height = "500px";
    return viewerContainer;
}