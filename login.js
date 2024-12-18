document.addEventListener('DOMContentLoaded', function() {
    let logModal = document.getElementById("logModal");
    let signModal = document.getElementById("signModal");
    let sign_up = document.getElementById("sign_up");
    let sign_in = document.getElementById("sign_in");

    if (sign_up) {
        sign_up.addEventListener('click', function(e) {
            e.preventDefault();
            logModal.classList.add("hidden");
            signModal.classList.remove("hidden");
        });
    }

    if (sign_in) {
        sign_in.addEventListener('click', function(e) {
            e.preventDefault();
            logModal.classList.remove("hidden");
            signModal.classList.add("hidden");
        });
    }
});