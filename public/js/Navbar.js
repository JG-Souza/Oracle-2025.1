const menu = document.querySelector(".menu");

const links = document.querySelector(".navbar-links");

menu.addEventListener("click", () => {
    links.classList.toggle("active");
})
