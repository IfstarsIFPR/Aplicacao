<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/TurmDisc_edit.css">

<div class="row">

    <h3 class="text-center mt-5">Turmas da Disciplina</h3>

    <div class="container">

        <div class="form-container  d-flex justify-content-center">

            <div class="form" style="border-radius: 20px">
                <form id="formTurma" method="POST"
                    action="<?= BASEURL ?>/controller/TurmaDisciplinaController.php?action=save">

                    <div class="mb-3">
                        <label>Turma:</label><br>
                        <input type="text" class="form-control" disabled
                            value="<?= $dados['turmaDisciplina']->getTurma()->getCurso()->getNome() . ' - ' . $dados['turmaDisciplina']->getTurma()->getAnoTurma() ?>">
                    </div>

                    <div class="mb-3">
                        <label>Professor:</label>
                        <select name="idProfessor" class="form-control">
                            <?php foreach ($dados['professores'] as $professor): ?>
                                <option value="<?= $professor->getId() ?>"
                                    <?php
                                    if (
                                        isset($dados["turmaDisciplina"]) &&
                                        $dados["turmaDisciplina"]->getProfessor() != null &&
                                        $dados["turmaDisciplina"]->getProfessor()->getId() == $professor->getId()
                                    )
                                        echo "selected";
                                    ?>>
                                    <?= $professor->getNome() ?>
                                </option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" id="hddId" name="idTurmaDisciplina"
                        value="<?= $dados['idTurmaDisciplina']; ?>" />

                    <button type="submit" class="btn btn-primary">Salvar</button>

                </form>
            </div>
        </div>

    </div>
</div>
<?php require_once(__DIR__ . "/../../include/footer.php"); ?>