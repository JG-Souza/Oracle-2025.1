<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oracle | Landing Page</title>
    <link rel="stylesheet" href="/public/css/landing-page.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital...&family=Junge&display=optional" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=UnifrakturCook:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <section class="hero-section">
        <!-- TEXTO DA HEADLINE-->
        <div class="headline">
            <h2 id="headlineTitulo1">O ORACLE REVELA</h2>
            <h2 id="headlineTitulo2">TUDO SOBRE</h2>
            <h2 id="headlineTitulo3">MITOLOGIA</h2>
            <h3 id="headlineTitulo4">MITOS, DEUSES, RELÍQUIAS E HISTÓRIAS</h3>
        </div>
        <div class="destaques">
            <h3>DESTAQUES</h3>
            <!-- SLIDES / CARROSSEL -->
            <div class="carrossel-de-destaques"
            style="background-image:url('<?= $destaques[0]->img_path ?? '/public/assets/placeholder.jpg' ?>')">
                <!-- Botoes de Seta -->
                <button class="back" onclick="backSlide()"> &#x276E; </button>
                <div class="meio-do-carrossel">
                    <h3 class="texto-carrossel"><?= htmlspecialchars($destaques[0]->title ?? '') ?></h3>
                    <!-- Label dos botoes -->
                     <div class="radio-auto">
                        <label class="radio-label"></label>
                        <label class="radio-label"></label>
                        <label class="radio-label"></label>
                        <label class="radio-label"></label>
                        <label class="radio-label"></label>
                    </div>
                    <!---->
                </div>
                <button class="next" onclick="nextSlide()"> &#x276F; </button>
            </div>
        </div>
    </section>

    <!--CONTEÚDO-->
    <main class="conteudo">
        <section class="ultimosPosts">
            <h3 class="tituloUltimosPosts">ÚLTIMOS POSTS</h3>
            <section class="posts">
                <?php foreach ($ultimos as $i => $post): ?>
                    <?php if ($i === 0): ?>
                        <div class="postGrande">
                            <img class="pgImg" src="<?= $post->img_path ?>" alt="<?= htmlspecialchars($post->title) ?>">
                            <div class="pgText">
                                <h4 class="pgTitulo"><?= htmlspecialchars($post->title) ?></h4>
                                <div class="pgInfo">
                                    <p class="pgAutor">Por: <?= htmlspecialchars($post->author_name) ?></p>
                                    <p class="pgData">Publicado em: <?= date('d/m/Y', strtotime($post->created_at)) ?></p>
                                </div>
                            </div>
                        </div>
                <div class="postsPequenos">
                    <?php else: ?>
                        <div class="pp">
                            <img class="ppImg" src="<?= $post->img_path ?>" alt="<?= htmlspecialchars($post->title) ?>">
                            <div class="ppText">
                                <h4 class="ppTitulo"><?= htmlspecialchars($post->title) ?></h4>
                                <div class="ppInfo">
                                    <p class="ppAutor">Por: <?= htmlspecialchars($post->author_name) ?></p>
                                    <p class="ppData">Publicado em: <?= date('d/m/Y', strtotime($post->created_at)) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                </div>
            </section>
        </section>
    </main>

    <!-- SCRIPT -->
     <script>
        const imgArray   = <?= json_encode(array_column($destaques, 'img_path')); ?>;
        const titleArray = <?= json_encode(array_column($destaques, 'title')); ?>;
     </script>
    <script src="/public/js/landing-page.js"></script>
    
</body>
</html>