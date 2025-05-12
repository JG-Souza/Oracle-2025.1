function abrirModal(idModal) {
    const modal = document.getElementById(idModal);
    modal.style.display = "flex";
}

function fecharModal(idModal, idInputNome, idInputEmail) {
    const modal = document.getElementById(idModal);
    modal.style.display = "none";
    const inputNome = document.getElementById(idInputNome);
    const inputEmail = document.getElementById(idInputEmail)
    inputNome.value = "";
    inputEmail.value = "";
}