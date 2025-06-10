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

// Preview da imagem de forma dinâmica para vários modais
document.querySelectorAll('input[type="file"][name="imagem"]').forEach(input => {
    input.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const container = event.target.closest('.modal-imagem') || event.target.closest('.modal-info-imagem');
            const img = container.querySelector('img');
            img.src = URL.createObjectURL(file);
            img.style.display = 'block';
        }
    });
});
