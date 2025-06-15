function abrirModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.style.display = 'flex';
        if (id === 'modal-criar-publicacao') {
            const preview = modal.querySelector('.imagem-preview');
            if (preview) preview.remove();
        }
        if (id.startsWith('modal-editar-publicacao')) {
            const inputFile = modal.querySelector('input[type="file"]');
            const imagemAtual = modal.querySelector('.imagem-publicacao');
            inputFile?.addEventListener('change', () => {
                if (imagemAtual) {
                    imagemAtual.style.display = 'none';
                }
                const file = inputFile.files[0];
                if (file) {
                    let preview = modal.querySelector('.imagem-preview');
                    if (!preview) {
                        preview = document.createElement('img');
                        preview.classList.add('imagem-preview');
                        preview.style.maxWidth = '100%';
                        preview.style.marginTop = '10px';
                        imagemAtual.parentNode.appendChild(preview);
                    }
                    preview.src = URL.createObjectURL(file);
                }
            });
        }

        if (id === 'modal-criar-publicacao') {
            const inputFileCreate = modal.querySelector('input[type="file"]');

            inputFileCreate?.addEventListener('change', () => {
                const file = inputFileCreate.files[0];
                if (file) {
                    let preview = modal.querySelector('.imagem-preview');
                    if (!preview) {
                        preview = document.createElement('img');
                        preview.classList.add('imagem-preview');
                        preview.style.maxWidth = '100%';
                        preview.style.marginTop = '10px';
                        inputFileCreate.parentNode.appendChild(preview);
                    }
                    preview.src = URL.createObjectURL(file);
                }
            });
        }
    }
}

function fecharModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.style.display = 'none';
        const preview = modal.querySelector('.imagem-preview');
        if (preview) preview.remove();
        const imagemAtual = modal.querySelector('.imagem-publicacao');
        if (imagemAtual) imagemAtual.style.display = 'block';
        const inputFile = modal.querySelector('input[type="file"]');
        if (inputFile) inputFile.value = '';
    }
}
