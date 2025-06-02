<?php
    session_start();

    if(!isset($_SESSION['id'])){
        header(header: 'Location: /login');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/dashboard.css">
    <title>Oracle | Dashboard</title>
</head>
<body>
    
    <section class="secao">
        <div class="titulo"><h1>Bem-vindo à dashboard do Oracle!</h1></div>
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