<?php 
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/TurmDisc_adm.css">

<div class="container mt-5">

    <div class="row justify-content-center mb-4">
        <div class="col-12 text-center">
            <h3>Turmas da Disciplina: 
                <span class="disciplina-nome">
                    <?= $dados['disciplina']->getNomeDisciplina() ?>
                </span>
            </h3>
        </div>
    </div>
    
    <div class="row justify-content-start">

        <?php foreach ($dados['turmas'] as $turmaDisc): ?>
            <div class="col-md-6 col-lg-4 p-3">
                
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <?= $turmaDisc->getTurma()->getCurso()->getNome() ?> 
                        - <?= $turmaDisc->getTurma()->getAnoTurma() ?>
                    </h5>

                    <p class="card-text">
                        Professor(a): <?= $turmaDisc->getProfessor()->getNome() ?>
                    </p>

                    <div class="buttons ">
                        <a href="<?= BASEURL ?>/controller/TurmaDisciplinaController.php?action=edit&idTurmaDisciplina=<?= $turmaDisc->getId() ?>" 
                           class="btn btn-primary">
                           Editar
                        </a>

                        <a href="<?= BASEURL ?>/controller/TurmaDisciplinaController.php?action=excluir&idTurmaDisciplina=<?= $turmaDisc->getId() ?>" 
                           class="btn btn-secondary">
                           Excluir
                        </a>
                    </div>

                </div>

            </div>
        <?php endforeach; ?>

    </div>

</div> 

<?php require_once(__DIR__ . "/../../include/footer.php"); ?>
