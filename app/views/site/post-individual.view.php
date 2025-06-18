<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oracle | Post individual</title>
    <link rel="stylesheet" href="/public/css/post-individual.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Junge&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="/public/assets/medusa (1).png" />
    <link rel="shortcut icon" href="/public/assets/medusa (1).png" type="image/x-icon">
    
</head>
<body>

    <div class="background">
        <div class="container">
            <div class="cabecalho">
                <div class="usuario">
                    <img src="/public/assets/medusa.png" alt="Foto do usuario">
                    <h3 class="nome-do-usuario">Autor</h3>
                </div>
                <div class="origem"><button id="botao">Mitologia Grega</button></div>
            </div>
            <div class="post">
                
                <div class="coracao">
                    <img src= "/<?= $post->img_path ?>" alt="Queda.png" class="icaro">
                    <h1 class="titulo"><?= $post->title ?></h1>
                </div>
                <div class="conteudo-do-post">
                    <div class="topicos">
                        <h5>Historia:</h5>
                        <span><?= $post->story ?></span>
                    </div>
                    <div class="topicos">
                        <h5>Curiosidades:</h5>
                        <span><?= $post->curiosity ?></span>
                    </div>
                    <div class="topicos">
                        <h5>Lições e ensinamentos:</h5>
                        <span><?= $post->lesson ?></span>
                    </div>
                    <div class="topicos">
                        <span id="fonte">Fonte: <?= $post->reference ?></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
</body>
</html>