
function mostrarSenha(idIcon, idInput){

    const icon = document.getElementById(idIcon);
    const input = document.getElementById(idInput);

    if(input.type === 'password'){
        input.setAttribute('type', 'text');
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    }else{
        input.setAttribute('type', 'password');
        icon.classList.replace('bi-eye-slash','bi-eye');
    }
}