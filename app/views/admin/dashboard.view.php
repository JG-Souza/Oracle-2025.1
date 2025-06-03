<?php
    session_start();
    
    if(!isset($_SESSION['id'])){
        header('Location: /login');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital...&family=Junge&display=optional" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=UnifrakturCook:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    
    <section class="secao">
        <div class="titulo">Bem-vindo à dashboard do Oracle!</div>
        <div class="conteudo">
            <button class="pagina-de-posts">
                <img id="icone-posts" src="/public/assets/icon-post.png">
                <span>Posts</span> 
            </button>
            <button class="pagina-de-usuarios">
                <img id="icone-usuarios" src="/public/assets/icon-usuario.png">
                <span>Usuários</span>
            </button>
            <div>
                <form action="/logout" method="POST">
                    <button type="submit" class="logout">
                        <img id="icone-logout" src="/public/assets/logout.png">
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </section>
    
</body>
</html>