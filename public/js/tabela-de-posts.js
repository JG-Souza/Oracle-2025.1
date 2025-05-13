function abrirModal(idModal) {
    const modal = document.getElementById(idModal);
    modal.style.display = "flex";
}

function fecharModal(idModal ,idInputTitulo ,idInputAutor ,idInputDescricaco ) {
    const modal = document.getElementById(idModal);
    modal.style.display = "none";
    const idInputTitulo = document.getElementById(idInputTitulo);
    const idInputAutor = document.getElementById(idInputAutor);
    const idInputDescricaco = document.getElementById(idInputDescricaco);
    idInputTitulo.value = "";
    idInputAutor.value = "";
    idInputDescricaco = "";
}