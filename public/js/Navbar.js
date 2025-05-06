const botao = document.querySelector(".navbar-botao");
const header = document.querySelector("header")
const links = document.querySelector(".navbar-links");
const body = document.querySelector("body");

botao.addEventListener("click", () => {
    botao.classList.toggle("active");
    links.classList.toggle("active");
    header.classList.toggle("active");
    body.classList.toggle("active");
})
