document.addEventListener('DOMContentLoaded', () => {
  const criaturas = [
    {
      nome: "FÊNIX",
      imagem: "/public/assets/Gemini_Generated_Image_q9pb7sq9pb7sq9pb.jpg",
      descricao: "A Fênix é uma criatura mítica que renasce das cinzas, simbolizando a imortalidade e renovação."
    },
    {
      nome: "MEDUSA",
      imagem: "/public/assets/Gemini_Generated_Image_xtn1juxtn1juxtn1.jpg",
      descricao: "Medusa era uma górgona da mitologia grega com serpentes no lugar dos cabelos e olhar que petrificava."
    },
    {
      nome: "CURUPIRA",
      imagem: "/public/assets/WhatsApp Image 2025-03-25 at 15.23.49 copy.jpeg",
      descricao: "O Curupira é uma criatura do folclore brasileiro, conhecido por seus pés virados para trás e proteção das florestas."
    },
    {
      nome: "QUIMERA",
      imagem: "/public/assets/Gemini_Generated_Image_tj2jwtj2jwtj2jwt.jpg",
      descricao: "Quimera é um monstro mitológico com partes de leão, cabra e serpente, símbolo de perigo e caos."
    },
    {
      nome: "MINOTAURO",
      imagem: "/public/assets/Gemini_Generated_Image_phpd13phpd13phpd.jpg",
      descricao: "O Minotauro era um ser com corpo de homem e cabeça de touro, habitante do labirinto de Creta."
    }
  ];

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

    item.addEventListener('mouseover', () => {
      const criatura = criaturas.find(c => c.nome === item.dataset.nome);
      if (criatura) {
        item.dataset.originalImg = imgElement.src;
        item.dataset.originalNome = nomeSpan.textContent;

        imgElement.src = destaqueImg.src;
        nomeSpan.textContent = destaqueNome.textContent;

        atualizarDestaque(criatura);

        destaqueArea.style.paddingBottom = '30px';  
      }
    });

    item.addEventListener('mouseout', () => {
      const originalNome = item.dataset.originalNome;
      const originalImg = item.dataset.originalImg;

      if (originalNome && originalImg) {
        imgElement.src = originalImg;
        nomeSpan.textContent = originalNome;

        atualizarDestaque(destaqueOriginal);

        delete item.dataset.originalImg;
        delete item.dataset.originalNome;
      }
    });
  });

  searchInput.addEventListener('input', () => {
    const termo = searchInput.value.trim().toLowerCase();
    creatureItems.forEach(item => {
      const nome = item.dataset.nome.toLowerCase();
      item.style.display = nome.includes(termo) ? 'flex' : 'none';
    });
  });
});
