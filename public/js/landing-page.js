let imgArray = ["/public/assets/imgslide1.png","/public/assets/imgslide2.png","/public/assets/imgslide3.png","/public/assets/imgslide4.png","/public/assets/imgslide5.png"]
let labelArray = Array.from(document.getElementsByClassName("radio-label"));

let cont = 0;
labelArray[0].style.backgroundColor = "white";

function nextSlide() {
    if (cont >= 4)
    {
        cont = -1;
    }
    let div = document.querySelector(".carrossel-de-destaques");
    div.style.backgroundImage = `url('${imgArray[cont+1]}')`;
    labelArray.forEach(label => label.style.backgroundColor = "transparent");
    labelArray[cont+1].style.backgroundColor = "white";
    cont++;
}

function backSlide() {
    if (cont <= 0)
    {
        cont = 5;
    }
    let div = document.querySelector(".carrossel-de-destaques");
    div.style.backgroundImage = `url('${imgArray[cont-1]}')`;
    labelArray.forEach(label => label.style.backgroundColor = "transparent");
    labelArray[cont-1].style.backgroundColor = "white";
    cont--;
}

