let labelArray = Array.from(document.getElementsByClassName("radio-label"));
if (labelArray.length > 0) {
    labelArray[0].style.backgroundColor = "white";
}

let cont = 0;
labelArray[0].style.backgroundColor = "white";

function atualizaSlide (i) {
    const div   = document.querySelector(".carrossel-de-destaques");
    const title = document.querySelector(".texto-carrossel");
    div.style.backgroundImage = `url('${imgArray[i]}')`;
    title.textContent = titleArray[i];
    labelArray.forEach(l => l.style.backgroundColor = "transparent");
    labelArray[i].style.backgroundColor = "white";
}

function nextSlide () {
    cont = (cont + 1) % imgArray.length;
    atualizaSlide(cont);
}

function backSlide () {
    cont = (cont - 1 + imgArray.length) % imgArray.length;
    atualizaSlide(cont);
}

// function nextSlide() {
//     clearInterval(intervalo);
//     if (cont >= 4)
//     {
//         cont = -1;
//     }
//     let div = document.querySelector(".carrossel-de-destaques");
//     div.style.backgroundImage = `url('${imgArray[cont+1]}')`;
//     labelArray.forEach(label => label.style.backgroundColor = "transparent");
//     labelArray[cont+1].style.backgroundColor = "white";
//     cont++;
//     timerCarrossel();
// }

// function backSlide() {
//     clearInterval(intervalo);
//     if (cont <= 0)
//     {
//         cont = 5;
//     }
//     let div = document.querySelector(".carrossel-de-destaques");
//     div.style.backgroundImage = `url('${imgArray[cont-1]}')`;
//     labelArray.forEach(label => label.style.backgroundColor = "transparent");
//     labelArray[cont-1].style.backgroundColor = "white";
//     cont--;
//     timerCarrossel();
// }

function timerCarrossel (){
    intervalo = setInterval ( ()=> {
        nextSlide();
    }, 4000)
}

atualizaSlide(0);
timerCarrossel();