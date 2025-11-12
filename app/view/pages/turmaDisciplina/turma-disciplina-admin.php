<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/TurmaDisciplina.css">


<div class="container">

    <h3 class="text-center">Turmas da Disciplina</h3>

    <span>Disciplina:</span><span><?= $dados['disciplina']->getNomeDisciplina() ?></span>

    <a href="<?= BASEURL ?>/controller/TurmaDisciplinaController.php?action=create&idDisciplina=<?= $dados['disciplina']->getId() ?>" class="btn btn-primary">Inserir</a>                    

    <div class="row">


        <?php foreach ($dados['turmas'] as $turmaDisc): ?>

            <div class="col-md-6 col-lg-3 p-4">
                <div class="card-body text-center">

                    <h5 class="card-title"><?= $turmaDisc->getTurma()->getCurso()->getNome() . " -> " . $turmaDisc->getTurma()->getAnoTurma() ?></h5>
                    <p class="card-text">Professor(a) <?= $turmaDisc->getProfessor()->getNome() ?></p>
                    
                    <a href="<?= BASEURL ?>/controller/TurmaDisciplinaController.php?action=editar&id_turma_disc=<?= $turmaDisc->getId() ?>" class="btn btn-primary">Editar</a>
                    <a href="<?= BASEURL ?>/controller/TurmaDisciplinaController.php?action=excluir&id_turma_disc=<?= $turmaDisc->getId() ?>" class="btn btn-primary">Excluir</a>


                </div>
            </div>
            <!-- ./col -->

        <?php endforeach; ?>

    </div>
    <!-- /.row -->

</div>

<?php require_once(__DIR__ . "/../../include/footer.php"); ?>