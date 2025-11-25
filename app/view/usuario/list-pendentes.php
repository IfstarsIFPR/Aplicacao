<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/listPrincipal.css">

<style>
    /* Card container da tabela */
    .card-dashboard {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 18px;
        border: 1px solid rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(6px);
        padding: 25px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.35);
        margin-top: 40px;
    }

    /* Linha abaixo do título ocupando todo o container */
    .titulo-dashboard h3 {
        position: relative;
        padding-bottom: 10px;
        /* espaço entre o texto e a linha */
        text-align: center;
        /* garante que o título continue centralizado */
    }

    .titulo-dashboard h3::after {
        content: '';
        display: block;
        width: 100%;
        /* agora ocupa toda a largura do container */
        height: 3px;
        /* espessura da linha */
        background-color: #2c4d72ff;
        /* cor da linha */
        margin-top: 8px;
        /* espaço entre o título e a linha */
        border-radius: 2px;
        /* cantos levemente arredondados */
    }

    /* Tabela escura customizada */
    .tabela-custom {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.95rem;
    }

    .tabela-custom thead th {
        background-color: #0a2d54ff;
        color: #ffffff;
        font-weight: 700;
        padding: 12px 8px;
        text-align: center;
    }

    .tabela-custom tbody tr {
        background-color: rgba(255, 255, 255, 0.05);
        transition: 0.25s ease;
    }

    .tabela-custom tbody tr:nth-child(even) {
        background-color: rgba(255, 255, 255, 0.08);
    }

    .tabela-custom tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.15);
        transform: scale(1.01);
    }

    .tabela-custom td {
        padding: 12px 8px;
        color: #e8e8e8;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .btn-verificar {
        background: #21bc95ff;
        border: none;
        color: #fff;
        padding: 8px 12px;
        border-radius: 10px;
        transition: 0.25s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-verificar:hover {
        background: #225088;

    }


    .btn-excluir {
        background: #a83232;
        border-radius: 10px;
        padding: 6px 14px;
        color: #fff;
        text-decoration: none;
        transition: 0.25s;
    }

    .btn-excluir:hover {
        background: #c94444;
        transform: translateY(-2px);
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .card-dashboard {
            padding: 15px;
        }

        .titulo-dashboard h3 {
            font-size: 1.8rem;
        }

        .tabela-custom td,
        .tabela-custom th {
            padding: 8px 6px;
        }
    }
</style>
<div class="row justify-content-center align-items-start" style="margin-top: 50px;">

    <!-- Imagem à esquerda -->
    <div class="col-md-5 text-center d-none d-md-block">
        <img src="<?= BASEURL ?>/view/img/verificar.png"
            alt="Usuários Pendentes"
            class="img-fluid side-img">
    </div>

    <div class="col-md-6">
        <div class="container card-dashboard">
            <div class="titulo-dashboard">
                <h3>Alunos Pendentes</h3>
            </div>

            <div class="row">
                <div class="col-12">
                    <?php require_once(__DIR__ . "/../include/msg.php"); ?>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table id="tabUsuarios" class="tabela-custom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Tipo</th>
                            <th>Verificar</th>
                            <!--<th>Excluir</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados['lista'] as $usu): ?>
                            <tr>
                                <td><?= $usu->getId(); ?></td>
                                <td><?= $usu->getNome(); ?></td>
                                <td><?= $usu->getEmail(); ?></td>
                                <td><?= $usu->getTipoUsuario(); ?></td>
                                <td>
                                    <a class="btn-verificar"
                                        href="<?= BASEURL ?>/controller/UsuarioController.php?action=editPendentes&id=<?= $usu->getId() ?>">
                                        <i class="bi bi-check-circle"></i>
                                    </a>
                                </td>
                               <!-- <td>
                                    <a class="btn-excluir"
                                        onclick="return confirm('Confirma a exclusão do usuário?');"
                                        href="<?= BASEURL ?>/controller/UsuarioController.php?action=delete&id=<?= $usu->getId() ?>">
                                        Excluir
                                    </a>
                                </td> -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>