<?php
require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/homeProfessor.css">

<div class="container">

    <h3 class="text-center mt-5 section-title">📝 Minhas Disciplinas</h3>

    <div class="row justify-content-center">

        <?php foreach ($dados['disciplinas'] as $turmaDisc): ?>

            <div class="col-lg-6 col-xl-4 p-3">
                                <div class="card custom-card shadow-lg">

                <div class="card-body text-center">

                    <h5 class="card-title">
                        <?= $turmaDisc->getDisciplina()->getNomeDisciplina() ?>
                    </h5>
                    <p class="card-text">
                        <span class="grifado">Turma:</span><br>
                        <?= $turmaDisc->getTurma()->getCurso()->getNome() ?>
                        -
                        <?= $turmaDisc->getTurma()->getAnoTurma() ?>
                    </p><br>

                    <a href="<?= BASEURL ?>/controller/AvaliacaoController.php?action=grafico&idTurma=<?= $turmaDisc->getTurma()->getId() ?>&idDisciplina=<?= $turmaDisc->getDisciplina()->getId() ?>&bimestre=1º Bimestre"
                        class="btn btn-primary btn-custom">
                        Ver Avaliações
                    </a>

                </div>
            </div>
            </div>
        <?php endforeach; ?>

    </div>

</div>

<?php require_once(__DIR__ . "/../../include/footer.php"); ?>