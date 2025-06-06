function abrirVisualizarModal(button) {
    document.getElementById('visualizar-id').value = button.getAttribute('data-id');
    document.getElementById('visualizar-nome').value = button.getAttribute('data-nome');
    document.getElementById('visualizar-email').value = button.getAttribute('data-email');
    document.getElementById('senhav').value = button.getAttribute('data-password');
    document.getElementById('img-preview-visualizar').src = button.getAttribute('data-img');
    abrirModal('modal-visualizar-usuario');
}

function abrirEditarModal(button) {
    document.getElementById('editar-id').value = button.getAttribute('data-id');
    document.getElementById('editar-nome').value = button.getAttribute('data-nome');
    document.getElementById('editar-email').value = button.getAttribute('data-email');
    document.getElementById('senhae').value = button.getAttribute('data-password');
    document.getElementById('imagem-antiga').value = button.getAttribute('data-img');
    document.getElementById('img-preview-editar').src = button.getAttribute('data-img');
    abrirModal('modal-editar-usuario');
}

function abrirExcluirModal(button) {
    document.getElementById('usuario-excluir-nome').textContent = button.getAttribute('data-nome');
    document.getElementById('usuario-excluir-id').value = button.getAttribute('data-id');
    document.getElementById('img-preview-excluir').src = button.getAttribute('data-img');
    abrirModal('modal-excluir-usuario');
}

function abrirModal(idModal) {
    const modal = document.getElementById(idModal);
    modal.style.display = "flex";
}

function fecharModal(idModal, idInputNome, idInputEmail, idInputSenha) {
    const modal = document.getElementById(idModal);
    modal.style.display = "none";
    const inputNome = document.getElementById(idInputNome);
    const inputEmail = document.getElementById(idInputEmail);
    const inputSenha = document.getElementById(idInputSenha);
    const image = document.getElementById('img-preview');
    image.style.display = "none";
    inputNome.value = "";
    inputEmail.value = "";
    inputSenha.value = "";

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

const image = document.getElementById('img-preview');
const inputImg = document.getElementById('input-imagem');

inputImg.onchange = function(){
    image.src = URL.createObjectURL(inputImg.files[0]);
    image.style.display = "block";
}

const imageEditar = document.getElementById('img-preview-editar');
const inputImgEditar = document.getElementById('input-imagem-editar');

inputImgEditar.onchange = function(){
    imageEditar.src = URL.createObjectURL(inputImgEditar.files[0]);
    imageEditar.style.display = "block";
}