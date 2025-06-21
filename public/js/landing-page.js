let labelArray = Array.from(document.getElementsByClassName("radio-label"));
if (labelArray.length > 0) {
    labelArray[0].style.backgroundColor = "white";
}

let cont = 0;
labelArray[0].style.backgroundColor = "white";

function atualizaSlide(i) {
    const div = document.querySelector(".carrossel-de-destaques");
    const title = document.querySelector(".texto-carrossel");
    const link = document.querySelector(".meio-do-carrossel a");

    div.style.backgroundImage = `url('${imgArray[i]}')`;
    title.textContent = titleArray[i];
    link.setAttribute('href', linkArray[i]);

    labelArray.forEach(l => l.style.backgroundColor = "transparent");
    labelArray[i].style.backgroundColor = "white";
}


function scrollParaPosts() {
    const section = document.getElementById("ultimos-posts");
    if (section) {
        section.scrollIntoView({ behavior: "smooth" });
    }
}


let intervalo;
function nextSlide() {
    clearInterval(intervalo); // Para o countdown
    cont = (cont + 1) % imgArray.length;
    atualizaSlide(cont);
    timerCarrossel(); // Reinicia
}

function backSlide() {
    clearInterval(intervalo);
    cont = (cont - 1 + imgArray.length) % imgArray.length;
    atualizaSlide(cont);
    timerCarrossel();
}

function timerCarrossel() {
    intervalo = setInterval(() => {
        nextSlide();
    }, 4000);
}

atualizaSlide(0);
timerCarrossel();