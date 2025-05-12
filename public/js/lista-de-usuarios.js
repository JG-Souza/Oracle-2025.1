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
        icone.classList.replace("fa-eye", "fa-eye-slash");
    }

    else{
        input.type = "password";
        icone.classList.replace("fa-eye-slash", "fa-eye");
    }
}

