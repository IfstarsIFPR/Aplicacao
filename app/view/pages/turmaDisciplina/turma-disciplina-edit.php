<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/TurmaDisciplina.css">


<div class="container">

    <h3 class="text-center">Turmas da Disciplina</h3>                  

    <div class="row">


        <div class="mb-3" style="color: antiquewhite;">
        <label>Turma:</label><br>
        <input type="text" class="form-control" disabled
               value="<?= $dados['turmaDisciplina']->getTurma()->getCurso()->getNome() . ' - ' . $dados['turmaDisciplina']->getTurma()->getAnoTurma() ?>">
    </div>

    <div class="mb-3" style="color: antiquewhite;">
        <label>Professor:</label>
        <select name="idProfessor" class="form-control">
            <?php foreach ($dados['usuario'] as $prof): ?>
                <option value="<?= $prof->getId() ?>"
                    <?= ($prof->getId() == $dados['turmaDisciplina']->getProfessor()->getId() ? 'selected' : '') ?>>
                    <?= $prof->getNome() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button class="btn btn-primary">Salvar</button>

</form>
            </div>
            <!-- ./col -->

    </div>
    <!-- /.row -->

</div>

<?php require_once(__DIR__ . "/../../include/footer.php"); ?>