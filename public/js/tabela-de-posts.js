document.addEventListener("DOMContentLoaded", function () {
    window.abrirModal = function (idModal) {
        const modal = document.getElementById(idModal);
        modal.style.display = "flex";
    };

    window.fecharModal = function (idModal) {
        const modal = document.getElementById(idModal);
        modal.style.display = "none";

        // Limpa inputs e textareas dentro do modal
        const inputs = modal.querySelectorAll('input[type="text"], textarea');
        inputs.forEach(input => input.value = "");
    };

    document.querySelectorAll('input[type="file"][name="imagem"]').forEach(input => {
        input.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const container = event.target.closest('.modal-imagem');
                const img = container.querySelector('img.imagem-publicacao');
                if (img) {
                    img.src = URL.createObjectURL(file);
                    img.style.display = 'block';
                }
            }
        });
    });
});
