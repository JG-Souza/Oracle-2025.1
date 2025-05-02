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
    const searchInput = document.querySelector('.search-container input');
  
    function atualizarDestaque(criatura) {
      destaqueImg.src = criatura.imagem;
      destaqueNome.textContent = criatura.nome;
      destaqueTexto.textContent = criatura.descricao;
    }
  
    creatureItems.forEach(item => {
      const imgElement = item.querySelector('img');
      const nomeSpan = item.querySelector('.creature-name');
  
      item.dataset.nome = nomeSpan.textContent.trim();
  
      item.addEventListener('click', () => {
        const nomeClicado = item.dataset.nome;
        const criaturaClicada = criaturas.find(c => c.nome === nomeClicado);
      
        if (criaturaClicada) {
          const criaturaDestaqueAtual = {
            nome: destaqueNome.textContent.trim(),
            imagem: destaqueImg.src,
            descricao: destaqueTexto.textContent.trim()
          };
      
          atualizarDestaque(criaturaClicada);
      
          imgElement.src = criaturaDestaqueAtual.imagem;
          imgElement.alt = criaturaDestaqueAtual.nome;
      
          nomeSpan.textContent = criaturaDestaqueAtual.nome;
          item.dataset.nome = criaturaDestaqueAtual.nome;
        }
      });
      
  
      item.addEventListener('mouseover', () => {
        const criatura = criaturas.find(c => c.nome === item.dataset.nome);
        if (criatura) {
          imgElement.style.display = 'none';
          item.dataset.originalText = nomeSpan.textContent;
          nomeSpan.textContent = criatura.descricao;
        }
      });
  
      item.addEventListener('mouseout', () => {
        imgElement.style.display = 'block';
        if (item.dataset.originalText) {
          nomeSpan.textContent = item.dataset.originalText;
          delete item.dataset.originalText;
        } else {
          nomeSpan.textContent = item.dataset.nome;
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
  