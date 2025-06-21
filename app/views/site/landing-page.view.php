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
    <?php include 'navbar.view.php' ?>

    <section class="hero-section">
        <!-- TEXTO DA HEADLINE-->
        <a href="javascript:void(0);" onclick="scrollParaPosts()" class="headline" style="text-decoration:none; color:inherit;">
            <h2 id="headlineTitulo1">O ORACLE REVELA</h2>
            <h2 id="headlineTitulo2">TUDO SOBRE</h2>
            <h2 id="headlineTitulo3">MITOLOGIA</h2>
            <h3 id="headlineTitulo4">MITOS, DEUSES, RELÍQUIAS E HISTÓRIAS</h3>
        </a>
        <div class="destaques">
            <h3>DESTAQUES</h3>
            <!-- SLIDES / CARROSSEL -->
            <div class="carrossel-de-destaques"
            style="background-image:url('<?= $destaques[0]->img_path ?? '/public/assets/placeholder.jpg' ?>')">
                <!-- Botoes de Seta -->
                <button class="back" onclick="backSlide()"> &#x276E; </button>
                <div class="meio-do-carrossel">
                    <a href="post/<?= $destaques[0]->post_id ?>" style="text-decoration:none; color:inherit;">
                        <h3 class="texto-carrossel"><?= htmlspecialchars($destaques[0]->title ?? '') ?></h3>
                    </a>
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
        <section id="ultimos-posts" class="ultimosPosts">
            <h3 class="tituloUltimosPosts">ÚLTIMOS POSTS</h3>
            <section class="posts">
                <?php foreach ($ultimos as $i => $post): ?>
                    <?php if ($i === 0): ?>
                        <div class="postGrande">
                            <a href="post/<?= $post->post_id ?>" class="pgImgContainer" style="text-decoration:none; color:inherit;"> 
                                <img class="pgImg" src="<?= $post->img_path ?>" alt="<?= htmlspecialchars($post->title) ?>">
                            </a>
                            <div class="pgText">
                                <a href="post/<?= $post->post_id ?>" style="text-decoration:none; color:inherit;"> 
                                    <h4 class="pgTitulo"><?= htmlspecialchars($post->title) ?></h4>  
                                </a>
                                <div class="pgInfo">
                                    <p class="pgAutor">Por: <?= htmlspecialchars($post->author_name) ?></p>
                                    <p class="pgData">Publicado em: <?= date('d/m/Y', strtotime($post->created_at)) ?></p>
                                </div>
                            </div>
                        </div>
                <div class="postsPequenos">
                    <?php else: ?>
                        <div class="pp">
                            <a href="post/<?= $post->post_id ?>" class="ppImgContainer" style="text-decoration:none; color:inherit;"> 
                                <img class="ppImg" src="<?= $post->img_path ?>" alt="<?= htmlspecialchars($post->title) ?>"> 
                            </a>
                            <div class="ppText">
                                <a href="post/<?= $post->post_id ?>" style="text-decoration:none; color:inherit;"> 
                                    <h4 class="ppTitulo"><?= htmlspecialchars($post->title) ?></h4>
                                </a>
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
        <div class="verMaisContainer">
            <a href="/lista-posts" style="text-decoration:none; color:inherit;">
                <button class="verMais"> Ver Mais </button>
            </a>
        </div>
    </main>

    <?php include 'footer.view.php' ?>

    <!-- SCRIPT -->
     <script>
        let imgArray = <?= json_encode(array_map(fn($d) => $d->img_path, $destaques)) ?>;
        let titleArray = <?= json_encode(array_map(fn($d) => $d->title, $destaques)) ?>;
        let linkArray = <?= json_encode(array_map(fn($d) => "/post/" . $d->post_id, $destaques)) ?>;
     </script>
    <script src="/public/js/landing-page.js"></script>
    
</body>
</html>