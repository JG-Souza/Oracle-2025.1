<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/lista-de-usuarios.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Junge&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Oracle | Lista de Usuarios</title>
</head>


<body>
    <div class="container">
        <div class="cabecalho">
            <h1>Lista de Usuários</h1>
            <button id="adicionar-usuario"  onclick="abrirModal('modal-criar-usuario')"  onclick="abrirModal('modal-criar-usuario')">Adicionar Usuário</button>
            <button id="adicionar-usuario-mais"  onclick="abrirModal('modal-criar-usuario')"  onclick="abrirModal('modal-criar-usuario')">+</button>
        </div>
        <div class="tabela-responsiva">
        <table class="tabela-usuarios">
            <thead>
                <tr class="cabecalho-tabela">
                    <th>ID</th>
                    <th>Foto de perfil</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
                <!-- Tabela dinâmica de usuários -->
                <?php foreach($usuarios as $usuario): ?>
                <tr class="usuario">
                    <td class="id-usuario"> <?= $usuario->user_id ?> </td>
                    <td class="foto-usuario"> <img src="<?= $usuario->img_path ?>" alt="Foto do Usuário"> </td>
                    <td class="nome-usuario"> <?= $usuario->name ?> </td>
                    <td class="email-usuario"> <?= $usuario->email ?> </td>
                    <td class="acoes-usuario">
                        <!-- botao de visualizar -->
                        <button class="btn-visualizar"
                            onclick="abrirVisualizarModal(this)"
                            data-id="<?= $usuario->user_id ?>"
                            data-nome="<?= $usuario->name ?>"
                            data-email="<?= $usuario->email ?>"
                            data-password="<?= $usuario->password ?>"
                            data-img="<?= $usuario->img_path ?>">
                            <i class="bi bi-eye-fill"></i> 
                        </button>
                        <!-- botao de editar -->
                        <button class="btn-editar" 
                            onclick="abrirEditarModal(this)"
                            data-id="<?= $usuario->user_id ?>"
                            data-nome="<?= $usuario->name ?>"
                            data-email="<?= $usuario->email ?>"
                            data-password="<?= $usuario->password ?>"
                            data-img="<?= $usuario->img_path ?>">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <!-- botao de excluir -->
                        <button class="btn-excluir"
                        onclick="abrirExcluirModal(this)"
                        data-id="<?= $usuario->user_id ?>"
                        data-nome="<?= $usuario->name ?>"
                        data-img="<?= $usuario->img_path ?>">
                        <i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <?php endforeach ?>
            </thead>
        </table>
        </div>
        <!-- paginacao -->
        <div class="paginacao <?= $total_pages <= 1 ? 'disable' : '' ?>">
            <a class="btn-pagina <?= $page <=1 ? 'none' : '' ?>" onclick="location.href='?page=<?= $page-1 ?>'"><i class="bi bi-arrow-left-short"></i></a>
            <?php
            for ($page_number = 1; $page_number <= $total_pages; $page_number++): ?>
                <a href="?page=<?= $page_number ?>" class="numero-pagina <?= $page == $page_number ? 'active' : '' ?>"><?= $page_number ?></a>
            <?php endfor ?>
           <a  class="btn-pagina <?= $page >= $total_pages ? 'none' : ''?>" onclick="location.href='?page=<?= $page+1 ?>'"><i class="bi bi-arrow-right-short"></i></a>
    </div>

    <!-- MODAL CRIAR -->
    <div class="modal" id="modal-criar-usuario">
        <div class="modal-container">
            <div class="modal-header">
                <h2>Adicionar Usuário</h2>
                <i class="bi bi-x" onclick="fecharModal('modal-criar-usuario', 'nome', 'email', 'senhac')"></i>
            </div>
            <form action="crud-usuarios/create" method="POST" class="form-usuario" enctype="multipart/form-data">
                <div class="modal-info">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="modal-info">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="modal-info">
                    <label for="senha">Senha:</label>
                    <div class="senha-olho">
                        <input type="password" id="senhac" name="senha" required>
                        <i class="bi bi-eye" id="olhoc" onclick="mostrarSenha('senhac', 'olhoc')"></i>
                    </div>
                </div>
                <div class="modal-info" id="foto-usuario">
                    <input type="file" accept="image/jpeg, image/jpg, image/png" id="input-imagem" name="foto">
                    <button type="button" class="btn-imagem" id="btn-input-imagem-criar" onclick="document.getElementById('input-imagem').click()">Selecionar Imagemㅤ|ㅤ<i class="bi bi-upload" class="icone-upload"></i></button>
                    <img src="" class="img-preview" id="img-preview">
                </div>
                <div class="botoes-modal">
                    <button type="submit" class="btn-criar">Criar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DE VISUALIZAR -->
    <div class="modal" id="modal-visualizar-usuario">
        <div class="modal-container">
            <div class="modal-header">
                <h2>Visualizar Usuário</h2>
                <i class="bi bi-x" onclick="fecharModal('modal-visualizar-usuario', 'nome', 'email', 'senha')"></i>
            </div>
            <form action="" method="POST" class="form-usuario">

                <div class="modal-info">
                    <label for="id">ID:</label>
                    <input type="text" id="visualizar-id" name="id" readonly>
                </div>

                <div class="modal-info">
                    <label for="nome">Nome:</label>
                    <input type="text" id="visualizar-nome" name="nome" readonly>
                </div>
                <div class="modal-info">
                    <label for="email">Email:</label>
                    <input type="email" id="visualizar-email" name="email" readonly>
                </div>
                <div class="modal-info">
                    <label for="senha">Senha:</label>
                    <div class="senha-olho">
                        <input type="password" id="senhav" name="senha" readonly>
                        <i class="bi bi-eye" id="olhov" onclick="mostrarSenha('senhav', 'olhov')"></i>
                    </div>
                </div>
                <div class="modal-info" id="foto-usuario">
                    <img alt="" id="img-preview-visualizar" class="img-visualizar">
                </div>

            </form>
        </div>
    </div>

    <!-- MODAL DE EDITAR -->
    <div class="modal" id="modal-editar-usuario">
        <div class="modal-container">
            <div class="modal-header">
                <h2>Editar Usuário</h2>
                <i class="bi bi-x" onclick="fecharModal('modal-editar-usuario', 'nome', 'email', 'senha')"></i>
            </div>
            <form action="/crud-usuarios/edit" method="POST" class="form-usuario" enctype="multipart/form-data">
                
                <input type="hidden" id="editar-id" name="user_id">
                <input type="hidden" id="imagem-antiga" name="imagem-antiga">

                <div class="modal-info">
                    <label for="nome">Nome:</label>
                    <input type="text" id="editar-nome" name="nome" required>
                </div>
                <div class="modal-info">
                    <label for="email">Email:</label>
                    <input type="email" id="editar-email" name="email" required>
                </div>
                <div class="modal-info">
                    <label for="senha">Senha:</label>
                    <div class="senha-olho">
                        <input type="password" id="senhae" name="senha" required>
                        <i class="bi bi-eye" id="olhoe" onclick="mostrarSenha('senhae', 'olhoe')"></i>
                    </div>
                </div>
                <div class="modal-info" id="foto-usuario">
                    <input type="file" accept="image/jpeg, image/jpg, image/png" id="input-imagem-editar" name="foto">
    
                    <button type="button" class="btn-imagem" id="btn-input-imagem-criar" onclick="document.getElementById('input-imagem-editar').click()">Selecionar Imagemㅤ|ㅤ<i class="bi bi-upload" class="icone-upload"></i></button>
                    <img src="" class="img-preview" id="img-preview-editar">
                </div>
                <div class="botoes-modal">
                    <button type="submit" class="btn-criar">Salvar</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- MODAL DE DELETAR -->
    <div class="modal" id="modal-excluir-usuario">
        <div class="modal-container">
            <form action="/crud-usuarios/delete" method="POST" class="form-usuario">
            
            <input type="hidden" name="user_id" id="usuario-excluir-id">

            <div class="modal-header">
                <h2>Deseja excluir o Usuário?</h2>
                <i class="bi bi-x" onclick="fecharModal('modal-excluir-usuario', 'nome', 'email')"></i>
            </div>
                <div class="usuario-excluir">
                    <div class="modal-info" id="foto-usuario">
                    <img alt="" id="img-preview-excluir" class="img-visualizar">
                    </div>
                    <p>Você tem certeza que deseja excluir o usuário <span id="usuario-excluir-nome"></span>?</p>
                    <p>Essa ação não pode ser desfeita.</p>
                </div>
                <div class="botoes-modal">
                    <button type="submit" class="btn-criar">Excluir</button>
                </div>
            </form>
        </div>
    </div>
    
</body>
<script src="../../../public/js/lista-de-usuarios.js"></script>
</html>