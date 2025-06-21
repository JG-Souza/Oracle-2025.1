<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oracle | Login</title>
    
    <link rel="stylesheet" href="/public/css/login.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Junge&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">

</head>

<body>
    <main>
        <div class="login-card">
            <div class="btn-home">
                <a href="/landing-page" class="home">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" id="icone-home">
                    <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            <div class="login-card-logo">
                <img width="100%" height="100%" src="/public/assets/medusa(1).png" alt="Logo">
            </div>
            <div>
                <form class="login-form" action="/login" method="POST">
                    <div class="login-card-conteudo">
                        <div id="" class="campo-text-input">
                            <span>E-mail</span>
                            <div class="email-input">
                                <input placeholder="seuemail@gmail.com" class="input-texto" type="text" name="email" id="email" autocomplete="off">
                            </div>
                        </div>
                        <div id="" class="campo-text-input">
                            <span>Senha</span>
                            <div class="senha-input">
                                <input placeholder="***********" class="input-texto" type="password" name="senha" id="senha" autocomplete="off">
                                <i class="bi bi-eye" id="btn-senha" onclick= "mostrarSenha('btn-senha', 'senha')"></i>
                            </div>
                            <div class="mensagem-erro">
                                <p>
                                <?php
                                    if(isset($_SESSION['mensagem-erro']))
                                    echo $_SESSION['mensagem-erro'];
                                    unset($_SESSION['mensagem-erro']);
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="campo-botao">
                            <button class="botao" type="submit">Log-in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
</body>
<script src="/public/js/login.js"></script>
</html>