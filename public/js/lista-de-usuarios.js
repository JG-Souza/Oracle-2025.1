function abrirVisualizarModal(button) {
    document.getElementById('visualizar-id').value = button.getAttribute('data-id');
    document.getElementById('visualizar-nome').value = button.getAttribute('data-nome');
    document.getElementById('visualizar-email').value = button.getAttribute('data-email');
    document.getElementById('senhav').value = button.getAttribute('data-password');
    abrirModal('modal-visualizar-usuario');
}

function abrirEditarModal(button) {
    document.getElementById('editar-id').value = button.getAttribute('data-id');
    document.getElementById('editar-nome').value = button.getAttribute('data-nome');
    document.getElementById('editar-email').value = button.getAttribute('data-email');
    document.getElementById('senhae').value = button.getAttribute('data-password');
    abrirModal('modal-editar-usuario');
}

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

function mostrarSenha(idInput, idIcone){
    const icone = document.getElementById(idIcone);
    const input = document.getElementById(idInput);

    if(input.type === "password"){
        input.type = "text";
        icone.classList.replace("bi-eye", "bi-eye-slash");
    }

    else{
        input.type = "password";
        icone.classList.replace("bi-eye-slash", "bi-eye");
    }
}