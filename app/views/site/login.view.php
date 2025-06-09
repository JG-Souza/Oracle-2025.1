<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oracle | Login</title>
    
    <link rel="stylesheet" href="/public/css/styleslogin.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Junge&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">

</head>

<body>
    <main>
        <div class="login-card">
            <div class="login-card-logo">
                <img width="100%" height="100%" src="/public/assets/medusa.png" alt="Logo">
            </div>
            <div class="login-card-conteudo">
                <div>
                    <form action="/login" method="POST">
                        <div>
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
                                    <i class="bi bi-eye" id="btn-senha" ></i>
                                </div>
                            </div>
                            <div class="mensagem-erro">
                                <p>
                                    <?php
                                    session_start();
                                    if(isset($_SESSION['mensagem-erro']))
                                    echo $_SESSION['mensagem-erro'];
                                unset($_SESSION['mensagem-erro']);
                                ?>
                                </p>
                            </div>
                            <div class="campo-botao">
                            <button class="botao" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
    </main>
    
</body>
</html>