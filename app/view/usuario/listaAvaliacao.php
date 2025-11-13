<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
<div class="container mt-5">
    <h3 class="text-center text-white mb-4 mt-5">Minhas Avaliações</h3>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/listaAvaliacao.css">

    <div class="row">
        <div class="col-12">
            <?php if (!empty($dados["lista"])): ?>
                <table class="table table-striped table-bordered bg-white">
                    <thead>
                        <tr>
                            <th>Bimestre</th>
                            <th>Disciplina</th>
                            <th>Clareza</th>
                            <th>Didática</th>
                            <th>Interação</th>
                            <th>Motivação</th>
                            <th>Domínio</th>
                            <th>Organização</th>
                            <th>Recursos</th>
                            <th>Comentário</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($dados["lista"] as $avaliacao): ?>
                            <tr>
                                <td><?= $avaliacao["bimestre"] ?></td>
                                <td><?= $avaliacao["idDisciplina"] ?></td>
                                <td><?= $avaliacao["notaClareza"] ?></td>
                                <td><?= $avaliacao["notaDidatica"] ?></td>
                                <td><?= $avaliacao["notaInteracao"] ?></td>
                                <td><?= $avaliacao["notaMotivacao"] ?></td>
                                <td><?= $avaliacao["notaDominioConteudo"] ?></td>
                                <td><?= $avaliacao["notaOrganizacao"] ?></td>
                                <td><?= $avaliacao["notaRecursos"] ?></td>
                                <td><?= $avaliacao["comentario"] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center text-light">Nenhuma avaliação encontrada.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
