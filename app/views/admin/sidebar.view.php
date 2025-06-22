<?php
    $usuarioAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    $curentPage = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/public/css/sidebar.css">
    <title>Sidebar</title>
</head>
<body>
    <div id="overlay"></div>
    <aside>
        <nav id="sidebar">
            <div id="sidebar-content">
                <div id="user">
                <img src="/<?=$usuarioLogado->img_path?>" id="user_avatar" alt="Avatar do usuário">
                <p id="user_infos">
                    <span class="item-description"><?=$usuarioLogado->name?></span>
                </p>
            </div>
            <ul id="side-items">
                <li class="side-item">
                    <a href="/dashboard">
                        <i class="fa-solid fa-square-poll-horizontal"></i>
                        <span class="item-description">Dashboard</span>
                    </a>
                </li>
                <?php if ($usuarioAdmin): ?>
                <li class="side-item  <?= $curentPage == 'crud-usuarios' ? 'active' : '' ?>">
                    <a href="/crud-usuarios">
                        <i class="fa-solid fa-user"></i>
                        <span class="item-description">Lista de Usuários</span>
                    </a>
                </li>
                <?php endif; ?>
                <li class="side-item   <?= $curentPage == 'tabela-de-posts' ? 'active' : '' ?>">
                    <a href="/tabela-de-posts">
                        <i class="fa-solid fa-box"></i>
                        <span class="item-description">Lista de Posts</span>
                    </a>
                </li>
            </ul>
            <button id="open-btn">
                <i id="open-btn-icon" class="fa-solid fa-chevron-right"></i>
            </button>
            </div>
            <form action="/logout" method="POST">
                <div id="logout">
                    <button type="submit" id="logout-btn">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="item-description">Logout</span>
                    </button>
                </div>
            </form>
        </nav>
    </aside>
    <script src="/public/js/sidebar.js"></script>
</body>
</html>
