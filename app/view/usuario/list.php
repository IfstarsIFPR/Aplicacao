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

    .btn-alterar {
        background: #0a2d54ff;
        border-radius: 10px;
        padding: 6px 14px;
        color: #fff;
        text-decoration: none;
        transition: 0.25s;
    }

    .btn-alterar:hover {
        background: #4496c9ff;
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

    /* Estilo moderno para o select */
    #tipoUsuario {
        padding: 10px 15px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        background: rgba(255, 255, 255, 0.05);
        color: #000000ff;
        font-weight: 500;
        font-size: 0.95rem;
        transition: 0.3s ease;
        backdrop-filter: blur(6px);
        outline: none;
    }


    /* Botão ao lado do select */
    form button[type="submit"] {
        padding: 10px 18px;
        border-radius: 12px;
        border: none;
        background-color: #2c4d72ff;
        color: #fff;
        font-weight: 500;
        transition: 0.3s ease;
    }

    form button[type="submit"]:hover {
        background-color: #1f3a5a;
    }

    /* Responsividade do select */
    @media (max-width: 768px) {
        #tipoUsuario {
            width: 100%;
            margin-bottom: 10px;
        }

        form button[type="submit"] {
            width: 100%;
        }
    }
</style>

<div class="row justify-content-center align-items-start" style="margin-top: 50px;">

    <!-- Imagem à esquerda -->
    <div class="col-md-5 text-center d-none d-md-block">
        <img src="<?= BASEURL ?>/view/img/usuarios.png"
            alt="Usuários"
            class="img-fluid side-img">
    </div>

    <div class="col-md-6">
        <div class="container card-dashboard">
            <div class="titulo-dashboard">
                <h3>Usuários</h3>
            </div>


            <div class="row">

                <div class="col-12">
                    <?php require_once(__DIR__ . "/../include/msg.php"); ?>
                </div>
            </div>

            <form method="get" action="<?= BASEURL ?>/controller/UsuarioController.php">
                <input type="hidden" name="action" value="list">
                <label for="tipoUsuario">Filtrar por tipo:</label>
                <select name="tipoUsuario" id="tipoUsuario">
                    <option value="">Todos</option>
                    <?php foreach ($dados['tiposUsuario'] as $tipo): ?>
                        <option value="<?= $tipo ?>" <?= (isset($_GET['tipoUsuario']) && $_GET['tipoUsuario'] == $tipo) ? "selected" : "" ?>>
                            <?= ucfirst($tipo) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>

            <div class="table-responsive mt-4">
                <table id="tabUsuarios" class="tabela-custom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Tipo</th>
                            <th>Alterar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados['lista'] as $usu): ?>
                            <tr>
                                <td><?php echo $usu->getId(); ?></td>
                                <td><?= $usu->getNome(); ?></td>
                                <td><?= $usu->getEmail(); ?></td>
                                <td><?= $usu->getTipoUsuario(); ?></td>
                                <td><a class="btn-alterar"
                                        href="<?= BASEURL ?>/controller/UsuarioController.php?action=edit&id=<?= $usu->getId() ?>">
                                        Alterar</a>
                                </td>
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