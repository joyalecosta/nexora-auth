const menuToggle = document.querySelector(".menu-toggle");
const nav = document.querySelector(".nav");
const navLinks = document.querySelectorAll(".nav a");


menuToggle.addEventListener("click", function () {

    nav.classList.toggle("active");
    menuToggle.classList.toggle("active");

    // isOpen é um booleano: true ou false
    const isOpen = nav.classList.contains("active");

    menuToggle.setAttribute("aria-expanded", isOpen);

    menuToggle.setAttribute(
        "aria-label",
        isOpen ? "Fechar menu" : "Abrir menu"
    );

});


navLinks.forEach(function (link) {

    link.addEventListener("click", function () {

        nav.classList.remove("active");
        menuToggle.classList.remove("active");

        menuToggle.setAttribute("aria-expanded", "false");
        menuToggle.setAttribute("aria-label", "Abrir menu");

    });

});