document.addEventListener('DOMContentLoaded', () => {
  

  const creatureItems = document.querySelectorAll('.creature-list li');
  const destaqueImg = document.querySelector('.highlight img');
  const destaqueNome = document.querySelector('.highlight .creature-button');
  const destaqueTexto = document.querySelector('.highlight p');
  const destaqueBotao = document.querySelector('.highlight .botao-ler-mais');
  const searchInput = document.querySelector('.search-container input');
  const destaqueArea = document.querySelector('.highlight')

  const destaqueOriginal = {
    nome: destaqueNome.textContent.trim(),
    imagem: destaqueImg.src,
    descricao: destaqueTexto.textContent.trim()
  };

  function atualizarDestaque(criatura) {
    destaqueImg.src = criatura.imagem;
    destaqueNome.textContent = criatura.nome;
    destaqueTexto.textContent = criatura.descricao;
  }

  creatureItems.forEach(item => {
    const imgElement = item.querySelector('img');
    const nomeSpan = item.querySelector('.creature-name');

    item.dataset.nome = nomeSpan.textContent.trim();
    item.dataset.id = item.getAttribute('data-id');


    function isTouchDevice() {
      return 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    }

    function adicionarEventosHover() {
      creatureItems.forEach(item => {
      if (item.dataset.hoverAtivado === 'true') return;
        const imgElement = item.querySelector('img');
        const nomeSpan = item.querySelector('.creature-name');

        item.dataset.nome = nomeSpan.textContent.trim();

      function mouseOverHandler() {
        const criatura = criaturas.find(c => c.id == item.dataset.id);
        if (criatura) {
          item.dataset.originalImg = imgElement.src;
          item.dataset.originalNome = nomeSpan.textContent;

          imgElement.src = destaqueImg.src;
          nomeSpan.textContent = destaqueNome.textContent;

          atualizarDestaque(criatura);
          item.classList.add('blur-hover');
        }
      }

      function mouseOutHandler() {
        const originalNome = item.dataset.originalNome;
        const originalImg = item.dataset.originalImg;

        if (originalNome && originalImg) {
          imgElement.src = originalImg;
          nomeSpan.textContent = originalNome;

          atualizarDestaque(destaqueOriginal);

          delete item.dataset.originalImg;
          delete item.dataset.originalNome;
        }

        item.classList.remove('blur-hover');
      }

      item.__mouseOverHandler = mouseOverHandler;
      item.__mouseOutHandler = mouseOutHandler;

      item.addEventListener('mouseover', mouseOverHandler);
      item.addEventListener('mouseout', mouseOutHandler);

      item.dataset.hoverAtivado = 'true';
    });
  }

  function removerEventosHover() {
    creatureItems.forEach(item => {
      if (item.dataset.hoverAtivado !== 'true') return;

        item.removeEventListener('mouseover', item.__mouseOverHandler);
        item.removeEventListener('mouseout', item.__mouseOutHandler);

        delete item.__mouseOverHandler;
        delete item.__mouseOutHandler;
        item.dataset.hoverAtivado = 'false';
    });
  }

  function atualizarModoDeInteracao() {
    if (isTouchDevice() || window.innerWidth <= 768) {
      removerEventosHover();
    } else {
      adicionarEventosHover();
    }
  }

  window.addEventListener('resize', atualizarModoDeInteracao);
  atualizarModoDeInteracao();

  });

  searchInput.addEventListener('input', () => {
    const termo = searchInput.value.trim().toLowerCase();
    creatureItems.forEach(item => {
      const nome = item.dataset.nome.toLowerCase();
      item.style.display = nome.includes(termo) ? 'flex' : 'none';
    });
  });
});
