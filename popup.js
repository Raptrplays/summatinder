function openPopup() {
    var popup = document.getElementById("popup");
    popup.classList.add("open");
}

window.addEventListener("click", function(event) {
    var popup = document.getElementById("popup");
    var closeBtn = document.querySelector(".close-btn");

    if (event.target === popup || event.target === closeBtn) {
        popup.classList.remove("open");
    }
});