function mostrarMissao(idTexto){
    const texto = document.getElementById(idTexto);
    if (texto.style.display === "none") {
        texto.style.display = "block";
    }
    else {
        texto.style.display = "none";
    }
}

function mostrarVisao(idTexto){
    const texto = document.getElementById(idTexto);
    if (texto.style.display === "none") {
        texto.style.display = "block";
    }
    else {
        texto.style.display = "none";
    }
}

function mostrarValores(idTexto){
    const texto = document.getElementById(idTexto);
    if (texto.style.display === "none") {
        texto.style.display = "block";
    }
    else {
        texto.style.display = "none";
    }
}

$('.missaohover').on('mouseenter', function () {

    $('#missao').stop(true, true).slideDown(300); // Exibe o texto suavemente
}).on('mouseleave', function () {

    $('#missao').stop(true, true).slideUp(300); // Oculta o texto suavemente
});

$('.visaohover').on('mouseenter', function () {
    $('#visao').stop(true, true).slideDown(300);
}).on('mouseleave', function () {
    $('#visao').stop(true, true).slideUp(300);
});

$('.valoreshover').on('mouseenter', function () {
    $('#valores').stop(true, true).slideDown(300);
}).on('mouseleave', function () {
    $('#valores').stop(true, true).slideUp(300);
});