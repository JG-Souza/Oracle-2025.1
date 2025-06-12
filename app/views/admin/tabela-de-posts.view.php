<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oracle | Tabela de Posts</title>

    <link rel="stylesheet" href="/public/css/tabela-de-posts.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Junge&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>
<body>
    <main>
        <div class="parte-cima">
            <div class="titulo">
                <span>Tabela de Posts</span>
            </div>
            <div>
                <button type="button" class="botao-criar" onclick="abrirModal('modal-criar-publicacao')">Criar Publicação</button>
            </div>
        </div>
        <div class="tabela-responsiva">
            <table class="tabela-posts">
                <thead class="tabela-head">
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Data</th>
                        <th>Botões</th>
                    </tr>
                </thead>
                <tbody class="tabela-body">
                    <?php foreach($posts as $post): ?>
                    <tr>
                        <td><?=$post->post_id ?></td>
                        <td><?=$post->title ?></td>
                        <td>Autor</td>
                        <td><?= (new DateTime($post->created_at))->format('d/m/Y') ?></td>
                        <td>
                            <button type="button" class="botao-visualizar" onclick="abrirModal('modal-visualizar-publicacao<?=$post->post_id ?>')" ><i class="bi bi-eye-fill"></i></button>
                            <button type="button" class="botao-editar" onclick="abrirModal('modal-editar-publicacao<?=$post->post_id ?>')"><i class="bi bi-pencil-square"></i></button>
                            <button type="button" class="botao-excluir" onclick="abrirModal('modal-excluir-publicacao<?=$post->post_id ?>')"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
            
                    <div class="modal" id="modal-visualizar-publicacao<?=$post->post_id ?>">
                    <div class="modal-container-vi">
                        <div class="modal-header">
                            <h2>Visualizar Publicação</h2>
                            <i id="btn-fechar" class="bi bi-x" onclick="fecharModal('modal-visualizar-publicacao<?=$post->post_id ?>')"></i>
                        </div>
                        <form class="form-publicacao">
                            <div class="modal-container-content-vi">
                                <div class="modal-side" id="modal-side-left">
                                    <div class="modal-info">
                                        <label for="titulo">Título:</label>
                                        <input type="text" value="<?=$post->title ?>" readonly>
                                    </div>
                                    <div class="modal-info">
                                        <label for="autor">Autor:</label>
                                        <input type="text" value="Autor" readonly>
                                    </div>
                                    <div class="modal-info">
                                        <label for="origem">Origem:</label>
                                        <input type="text" value="<?=$post->origin ?>" readonly>
                                    </div>
                                    <div class="modal-info">
                                        <label for="data">Data:</label>
                                        <input type="text" value="<?=$post->created_at ?>" readonly>
                                    </div>
                                    <div class="modal-info">
                                        <label for="referencias">Referências:</label>
                                        <input type="text" value="<?=$post->reference?>" readonly>
                                    </div>
                                    <div class="modal-imagem">
                                        <img src="/<?=$post->img_path ?>" alt="imagem post" class="imagem-publicacao">
                                    </div>
                                </div>
                                <div class="modal-side" id="modal-side-right">
                                    <div class="modal-info-2">
                                        <label for="historia">História:</label>
                                        <textarea readonly><?=$post->story ?></textarea>
                                    </div>
                                    <div class="modal-info-2" id="modal-curiosidades">
                                        <label for="curiosidades">Curiosidades:</label>
                                        <textarea readonly><?=$post->curiosity ?></textarea>
                                    </div>
                                    <div class="modal-info-2">
                                        <label for="licoes">Lições:</label>
                                        <textarea readonly><?=$post->lesson ?></textarea>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>

                    <div class="modal" id="modal-editar-publicacao<?=$post->post_id ?>">
                    <div class="modal-container-up">
                        <div class="modal-header">
                            <h2>Editar Publicação</h2>
                            <i id="btn-fechar" class="bi bi-x" onclick="fecharModal('modal-editar-publicacao<?=$post->post_id ?>')"></i>
                        </div>
                        <form action="/tabela-de-posts/update" method="POST" enctype="multipart/form-data" class="form-publicacao">
                            <input type="hidden" name="user_id" value="<?=$post->user_id ?>">
                            <input type="hidden" name="post_id" value="<?=$post->post_id ?>">
                            <div class="modal-container-content-up">
                                <div class="modal-container-sem-botao">
                                    <div class="modal-textos-up">
                                        <div class="modal-side" id="modal-side-left">
                                            <div class="modal-info">
                                                <label for="titulo">Título:</label>
                                                <input type="text" name="titulo" value="<?=$post->title ?>">
                                            </div>
                                            <div class="modal-info">
                                                <label for="autor">Autor:</label>
                                                <input type="text" name="autor" value="Autor">
                                            </div>
                                            <div class="modal-info">
                                                <label for="origem">Origem:</label>
                                                <input type="text" id="origem" name="origem" value="<?=$post->origin ?>">
                                            </div>
                                            <div class="modal-info">
                                                <label for="referencias">Referências:</label>
                                                <input type="text" name="referencias" value="<?=$post->reference?>">
                                            </div>
                                        </div>
                                        <div class="modal-side" id="modal-side-right">
                                            <div class="modal-info-2" id="modal-curiosidades">
                                                <label for="curiosidades">Curiosidades:</label>
                                                <textarea name="curiosidades"><?=$post->curiosity ?></textarea>
                                            </div>
                                            <div class="modal-info-2">
                                                <label for="licoes">Lições:</label>
                                                <textarea name="licoes"><?=$post->lesson ?></textarea>
                                            </div>
                                            <div class="modal-info-2">
                                                <label for="historia">História:</label>
                                                <textarea name="historia"><?=$post->story ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-imagem">
                                        <label for="imagem-editar-<?=$post->post_id?>" class="btn-imagem">Selecionar Imagem </label>
                                        <input id="imagem-editar-<?=$post->post_id?>" type="file" name="imagem" accept="image/*" class="input-imagem">

                                        <div>
                                            <img src="<?=$post->img_path ?>" alt="imagem atual" class="imagem-publicacao">
                                        </div>
                                    </div>
                                </div>
                                <div class="botoes-modal">
                                    <button type="submit" class="btn-criar">Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>

                    <div class="modal" id="modal-excluir-publicacao<?=$post->post_id ?>">
                        <div class="modal-container-ex" id="modal-container-excluir-publicacao">
                            <div class="modal-header">
                                <div class="modal-title" id="deletarModalLabel -<?= $post -> post_id ?>"> Deseja excluir o post? </div>
                                <i id="btn-fechar" class="bi bi-x" onclick="fecharModal('modal-excluir-publicacao<?=$post->post_id ?>')"></i>
                            </div>
                            <div class="modal-body">
                                <p>Você tem certeza que deseja excluir a publicação <strong><?= $post->title ?></strong>?</p>
                                <p>Essa ação não pode ser desfeita.</p>
                            </div>
                            <div class="modal-footer">
                                <div class= "botoes-modal" id="botoes-modal-excluir">   
                                    <form method="POST" action="/tabela-de-posts/delete">
                                        <input type="hidden" name="post_id" value="<?= $post->post_id ?>">
                                        
                                        <button type="submit" class="btn-criar"> Excluir </button>
                                    </form>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <?php endforeach ?>
                    <div class="modal" id="modal-criar-publicacao">
                        <div class="modal-container-create">
                            <div class="modal-header">
                                <h2>Criar Publicação</h2>
                                <i id="btn-fechar" class="bi bi-x" onclick="fecharModal('modal-criar-publicacao')"></i>
                            </div>
                            <form action="/tabela-de-posts/create" method="POST" enctype="multipart/form-data" class="form-publicacao">
                                <div class="modal-container-content-create">
                                    <div class="modal-textos-create">
                                        <div class="modal-side" id="modal-side-left">
                                            <div class="modal-info">
                                                <label for="titulo">Título:</label>
                                                <input type="text" id="titulo" name="titulo" required>
                                            </div>
                                            <div class="modal-info">
                                                <label for="autor">Autor:</label>
                                                <input type="text" id="autor" name="autor" required>
                                            </div>
                                            <div class="modal-info">
                                                <label for="origem">Origem:</label>
                                                <input type="text" id="origem" name="origem" required>
                                            </div>
                                            <div class="modal-info">
                                                <label for="referencias">Referências:</label>
                                                <input type="text" id="referencias" name="referencias" required>
                                            </div>
                                            <div class="modal-info-imagem">
                                                <label for="imagem" class="btn-imagem">Selecionar Imagem</label>
                                                <input type="file" name="imagem" accept="image/*" class="input-imagem" id="imagem" required>
                                            </div>
                                        </div>
                                        <div class="modal-side" id="modal-side-right">
                                            <div class="modal-info-2" id="modal-curiosidades">
                                                <label for="curiosidades">Curiosidades:</label>
                                                <textarea name="curiosidades" id="curiosidades"></textarea>
                                            </div>
                                            <div class="modal-info-2">
                                                <label for="licoes">Lições:</label>
                                                <textarea name="licoes" id="licoes"></textarea>
                                            </div>
                                            <div class="modal-info-2">
                                                <label for="historia">História:</label>
                                                <textarea name="historia" id="historia"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="botoes-modal">
                                        <button type="submit" class="btn-criar">Criar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </tbody>
            </table>
        </div>
        <div class="paginas<?= $total_pages <= 1 ? " none": "" ?>">
            <button class="anterior<?= $page <= 1 ? " disabled": "" ?>" onclick="location.href='?paginacaoNumero=<?= $page -1?>'"><i class="bi bi-arrow-left-short"></i>
            </button>
            
            <?php for($page_number = 1; $page_number <= $total_pages; $page_number++): ?>
                <button class="pag1<?= $page_number == $page ? " active" : "" ?>" onclick="location.href='?paginacaoNumero=<?= $page_number ?>'">
                    <?= $page_number ?>
                </button>
            <?php endfor; ?>

            <button class="proximo<?= $page >= $total_pages ? " disabled" : "" ?>" onclick="location.href='?paginacaoNumero=<?= $page +1?>'"><i class="bi bi-arrow-right-short"></i>
            </button>
        </div>
    </main>
    <script src="/public/js/tabela-de-posts.js"></script>
</body>
</html>