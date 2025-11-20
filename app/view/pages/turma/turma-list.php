<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/listPrincipal.css">
<div class="text-center mt-5">
    <h3 class="text-center mt-5">
        Turma(s) do Curso:
        <span class="curso-nome"><?= $dados['curso']->getNome() ?></span>
    </h3>
    <div class="text-center mt-2">
        <strong>Nível:</strong> <?= $dados['curso']->getNivel() ?>
    </div>

        <div class="container">

            <div class="row">
                <div class="col-3">
                    <a class="btn btn-secondary" style="margin-right: 110px;"
                        href="<?= BASEURL ?>/controller/TurmaController.php?action=create">
                        Inserir</a>
                </div>

                <div class="col-9">
                    <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
                </div>
            </div>

            <div class="row" style="margin-top: 10px;">
                <div class="col-12">
                    <table id="tabTurmas" class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ano</th>
                                <th>Curso</th>
                                <th>Turno</th>
                                <th>Disciplinas</th>
                                <th>Alterar</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dados['lista'] as $tur): ?>
                                <tr>
                                    <td><?php echo $tur->getId(); ?></td>
                                    <td><?= $tur->getAnoTurma(); ?></td>
                                    <td><?= $tur->getCurso()->getNome(); ?></td>
                                    <td><?= $tur->getTurno(); ?></td>
                                    <td><a class="btn btn-secondary"
                                            href="<?= BASEURL ?>/controller/TurmaDisciplinaController.php?action=list&idTurma=<?= $tur->getId() ?>">
                                            Disciplinas</a>
                                    </td>
                                    <td><a class="btn btn-secondary"
                                            href="<?= BASEURL ?>/controller/TurmaController.php?action=edit&id=<?= $tur->getId() ?>">
                                            Alterar</a>
                                    </td>
                                    <td><a class="btn btn-secondary"
                                            onclick="return confirm('Confirma a exclusão do usuário?');"
                                            href="<?= BASEURL ?>/controller/TurmaController.php?action=delete&id=<?= $tur->getId() ?>">
                                            Excluir</a>
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
    require_once(__DIR__ . "/../../include/footer.php");
    ?>