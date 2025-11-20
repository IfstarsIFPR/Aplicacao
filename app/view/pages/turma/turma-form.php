<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">

<h3 class="text-center mt-5">
    <?php if ($dados['idTurma'] == 0) echo "Inserir";
    else echo "Alterar"; ?>
    Turmas
</h3>

<div class="row">
    <div class="container">
        <div class="form-container d-flex justify-content-center">

            <div class="form" style="border-radius: 20px">
                <form id="formTurma" method="POST"
                    action="<?= BASEURL ?>/controller/TurmaController.php?action=save">
                    <div class="mb-3">
                        <label class="form-label" for="numAno">Ano:</label>
                        <input class="form-control" type="number" id="numAno" name="anoTurma"
                            value="<?= isset($dados["turma"]) ? $dados["turma"]->getAnoTurma() : '' ?>" />

                        <?php if (isset($dados["erros"]["anoTurma"])): ?>
                            <small class="text-danger"><?= $dados["erros"]["anoTurma"] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="numCodigo">Código:</label>
                        <input class="form-control" type="number" id="numCodigo" name="codigoTurma"
                            value="<?= isset($dados["turma"]) ? $dados["turma"]->getCodigoTurma() : '' ?>" />

                        <?php if (isset($dados["erros"]["codigoTurma"])): ?>
                            <small class="text-danger"><?= $dados["erros"]["codigoTurma"] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="selTurno">Turno:</label>
                        <select class="form-select" name="turno" id="selTurno">
                            <option value="">Selecione o turno da turma</option>
                            <?php foreach ($dados["turno"] as $turno): ?>
                                <option value="<?= $turno ?>"
                                    <?= (isset($dados["turma"]) && $dados["turma"]->getTurno() == $turno) ? "selected" : "" ?>>
                                    <?= $turno ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <?php if (isset($dados["erros"]["turno"])): ?>
                            <small class="text-danger"><?= $dados["erros"]["turno"] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="selCurso">Curso:</label>
                        <select class="form-select" name="idCurso" id="selCurso">
                            <option value="">Selecione o curso</option>
                            <?php foreach ($dados["cursos"] as $curso): ?>
                                <option value="<?= $curso->getId() ?>"
                                    <?= (isset($dados["turma"]) &&
                                        $dados['turma']->getCurso() &&
                                        $dados['turma']->getCurso()->getId() == $curso->getId()) ? "selected" : "" ?>>
                                    <?= $curso->getNome() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <?php if (isset($dados["erros"]["idCurso"])): ?>
                            <small class="text-danger"><?= $dados["erros"]["idCurso"] ?></small>
                        <?php endif; ?>
                    </div>

                    <input type="hidden" id="hddId" name="idTurma"
                        value="<?= $dados['idTurma']; ?>" />

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Gravar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-6">
            <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../../include/footer.php");
?>