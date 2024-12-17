let logModal = document.getElementById("logModal");
let signModal = document.getElementById("signModal");
let sign_up = document.getElementById("sign_up");
let sign_in = document.getElementById("sign_in");

sign_up.onclick = function(){
    logModal.classList.add("hidden");
    signModal.classList.remove("hidden");
}

sign_in.onclick = function(){
    logModal.classList.remove("hidden");
    signModal.classList.add("hidden");
}
