function abrirModal(idModal) {
    const modal = document.getElementById(idModal);
    modal.style.display = "flex";
}

function fecharModal(idModal, idInputTitulo, idInputAutor, idInputDescricaco) {
    const modal = document.getElementById(idModal);
    modal.style.display = "none";
    const Titulo = document.getElementById(idInputTitulo);
    const Autor = document.getElementById(idInputAutor);
    const Descricaco = document.getElementById(idInputDescricaco);
    Titulo.value = "";
    Autor.value = "";
    Descricaco.value = "";
}


const image = document.getElementById('imagem-publicaco');
const inputImage = document.getElementById('input-imagem');

inputImage.onchange = function (){
    image.src = URL.createObjectURL(inputImage.files[0]);
    image.style.display = "block";
}