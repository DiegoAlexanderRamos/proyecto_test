document.addEventListener("DOMContentLoaded", function() {
    var logoutBtn = document.getElementById("logoutBtn");
    var modal = document.getElementById("logoutModal");
    var closeModal = modal.querySelector(".close");

    logoutBtn.onclick = function() {
        modal.style.display = "block";
    }

    closeModal.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});
