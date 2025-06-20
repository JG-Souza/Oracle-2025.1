<!-- views/lista-posts.view.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Oracle - Criaturas Mitológicas</title>
  <link rel="stylesheet" href="/public/css/lista-posts.css">
  <script>
    const criaturas = <?= json_encode(array_map(function ($post) {
      return [
        'id' => $post['post_id'],
        'nome' => $post['title'],
        'imagem' => $post['img_path'],
        'descricao' => mb_substr($post['story'], 0, 150) . '...'
      ];
    }, $posts)) ?>;
  </script>
  <script src="/public/js/lista-posts.js" defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Jost&family=Junge&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body>
  <header></header>
  <?php include 'app\views\site\navbar.view.php'; ?>
  <section class="content">
    <div class="top-container">
      <h2>Últimos Posts</h2>
      <div class="search-container">
        <form method="GET" class="search-container">
          <input type="text" name="q" placeholder="Pesquisar" value="<?= $_GET['q'] ?? '' ?>">
        </form>
        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
       viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
        </svg>
      </div>
    </div>

    <aside class="sidebar">
      <ul class="creature-list">
        <?php foreach ($posts as $index => $post): ?>
          <?php if($index === 0) continue; ?>

          <li data-id="<?= $post['post_id'] ?>" data-nome="<?= htmlspecialchars($post['title']) ?>">
            <div class="top-card-sidebar">
              <img src="<?= $post['img_path'] ?>" alt="<?= htmlspecialchars($post['title']) ?>">
              <span class="creature-name"><?= htmlspecialchars($post['title']) ?></span>
            </div>
            <div class="text">
              <p><?= substr($post['story'], 0, 550) ?> ... </p>
              <a href="/post.php?id=<?= $post['post_id'] ?>" class="botao-ler-mais">Ler mais</a>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>

      <div class="main-area">
        <?php if (!empty($posts)): ?>
        <article class="highlight">
          <div class="top-card">
            <img src="<?= $posts[0]['img_path'] ?>" alt="<?= $posts[0]['title'] ?>">
            <button class="creature-button"><?= $posts[0]['title'] ?></button>
          </div>
          
          <div class="text">
            <p><?= substr($posts[0]['story'], 0, 600) ?>...</p>
          </div>

          <div class="ler-mais">
            <a href="/post.php?id=<?= $posts[0]['post_id'] ?>" class="botao-ler-mais">Ler mais</a>
          </div>
        </article>
        <?php endif; ?>

        <div class="paginas<?= $total_pages <= 1 ? " none": "" ?>">
          <button class="anterior<?= $page <= 1 ? " none": "" ?>" onclick="location.href='?paginacaoNumero=<?= $page -1?><?= $query ? '&q='.urlencode($query) : '' ?>'">
            <i class="bi bi-arrow-left-short"></i>
          </button>

          <?php for($page_number = 1; $page_number <= $total_pages; $page_number++): ?>
              <button class="pag1<?= $page_number == $page ? " active" : "" ?>" onclick="location.href='?paginacaoNumero=<?= $page_number ?><?= $query ? '&q='.urlencode($query) : '' ?>'">
                  <?= $page_number ?>
              </button>
          <?php endfor; ?>

          <button class="proximo<?= $page >= $total_pages ? " none" : "" ?>" onclick="location.href='?paginacaoNumero=<?= $page +1?><?= $query ? '&q='.urlencode($query) : '' ?>'">
            <i class="bi bi-arrow-right-short"></i>
          </button>
        </div>
    </aside>
  </section>
  <?php include'app\views\site\footer.view.php'?>
</body>
</html>
