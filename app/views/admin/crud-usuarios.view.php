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
    <title>Oracle - Lista de Usuarios</title>
</head>


<body>
    <div class="container">
        <div class="cabecalho">
            <h1>Lista de Usuários</h1>
            <button id="adicionar-usuario"  onclick="abrirModal('modal-criar-usuario')"  onclick="abrirModal('modal-criar-usuario')">Adicionar Usuário</button>
        </div>
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
                    <td class="id-usuario"> <?= $usuario->id ?> </td>
                    <td class="foto-usuario"> <img src="<?= $usuario->img_path ?>" alt="Foto do Usuário"> </td>
                    <td class="nome-usuario"> <?= $usuario->name ?> </td>
                    <td class="email-usuario"> <?= $usuario->email ?> </td>
                    <td class="acoes-usuario">
                        <!-- botao de visualizar -->
                        <button class="btn-visualizar"
                            onclick="abrirVisualizarModal(this)"
                            data-id="<?= $usuario->id ?>"
                            data-nome="<?= $usuario->name ?>"
                            data-email="<?= $usuario->email ?>"
                            data-password="<?= $usuario->password ?>">
                            <i class="bi bi-eye-fill"></i> 
                        </button>
                        <!-- botao de editar -->
                        <button class="btn-editar" 
                            onclick="abrirEditarModal(this)"
                            data-id="<?= $usuario->id ?>"
                            data-nome="<?= $usuario->name ?>"
                            data-email="<?= $usuario->email ?>"
                            data-password="<?= $usuario->password ?>">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <!-- botao de excluir -->
                        <button class="btn-excluir" onclick="abrirModal('modal-excluir-usuario')"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <?php endforeach ?>
            </thead>
        </table>
        <!-- paginacao -->
        <div class="paginacao">
            <a href="" class="btn-pagina" class="pagina-anterior"><i class="bi bi-arrow-left-short"></i></a>
            <a href="" class="numero-pagina">1</a>
            <a href="" class="numero-pagina">2</a>
            <a href="" class="numero-pagina">3</a>
            <a href="" class="btn-pagina" class="pagina-proxima"><i class="bi bi-arrow-right-short"></i></a>
    </div>

    <!-- MODAL CRIAR -->
    <div class="modal" id="modal-criar-usuario">
        <div class="modal-container">
            <div class="modal-header">
                <h2>Adicionar Usuário</h2>
            </div>
            <form action="crud-usuarios/create" method="POST" class="form-usuario">
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
                    <input type="file" id="foto" name="foto" accept="image/*">
                    </div>
                <div class="botoes-modal">
                    <button type="submit" class="btn-criar">Criar</button>
                    <button type="button" class="btn-cancelar" onclick="fecharModal('modal-criar-usuario', 'nome', 'email')">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DE VISUALIZAR -->
    <div class="modal" id="modal-visualizar-usuario">
        <div class="modal-container">
            <div class="modal-header">
                <h2>Visualizar Usuário</h2>
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
                <div class="botoes-modal">
                    <button type="button" class="btn-cancelar" onclick="fecharModal('modal-visualizar-usuario', 'nome', 'email')">Fechar</button>
                </div>

            </form>
        </div>
    </div>

    <!-- MODAL DE EDITAR -->
    <div class="modal" id="modal-editar-usuario">
        <div class="modal-container">
            <div class="modal-header">
                <h2>Editar Usuário</h2>
            </div>
            <form action="/crud-usuarios/edit" method="POST" class="form-usuario">
                
                <input type="hidden" id="editar-id" name="id">

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
                    <input type="file" id="foto" name="foto" accept="image/*">
                    </div>
                <div class="botoes-modal">
                    <button type="submit" class="btn-criar">Salvar</button>
                    <button type="button" class="btn-cancelar" onclick="fecharModal('modal-editar-usuario', 'nome', 'email')">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- MODAL DE DELETAR -->
    <div class="modal" id="modal-excluir-usuario">
        <div class="modal-container">
            <form action="/crud-usuarios/delete" method="POST" class="form-usuario">
            
            <input type="hidden" name="id" value='<?= $usuario->id ?>'>

            <div class="modal-header">
                <h2>Deseja excluir o Usuário?</h2>
            </div>
                <div class="botoes-modal">
                    <button type="submit" class="btn-criar">Excluir</button>
                    <button type="button" class="btn-cancelar" onclick="fecharModal('modal-excluir-usuario', 'nome', 'email')">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    
</body>
<script src="../../../public/js/lista-de-usuarios.js"></script>
</html>