function mostrarMissao(idTexto){
    const texto = document.getElementById(idTexto);
    if (texto.style.display === "none") {
        texto.style.display = "block";
    }
    else {
        texto.style.display = "none";
    }
}

function mostrarVisao(idTexto){
    const texto = document.getElementById(idTexto);
    if (texto.style.display === "none") {
        texto.style.display = "block";
    }
    else {
        texto.style.display = "none";
    }
}

function mostrarValores(idTexto){
    const texto = document.getElementById(idTexto);
    if (texto.style.display === "none") {
        texto.style.display = "block";
    }
    else {
        texto.style.display = "none";
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('.missao-visao-e-valores a');
    const logoImg = document.querySelector('.logo img');
    const spans = document.querySelectorAll('.logo span');
  
    links.forEach(link => {
      link.addEventListener('mouseenter', () => {
    
        logoImg.style.opacity = '0';
        logoImg.style.visibility = 'hidden';
  
        spans.forEach(span => {
          span.style.opacity = '0';
          span.style.visibility = 'hidden';
        });
  
        
        const id = link.id.replace('-link', '');
        const mostraTexto = document.getElementById(id);
        if (mostraTexto) {
            mostraTexto.style.opacity = '1';
            mostraTexto.style.visibility = 'visible';
        }
      });
  
      link.addEventListener('mouseleave', () => {
        
        logoImg.style.opacity = '1';
        logoImg.style.visibility = 'visible';
  
        
        spans.forEach(span => {
          span.style.opacity = '0';
          span.style.visibility = 'hidden';
        });
      });
    });
  });