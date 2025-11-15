<?php
require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/TurmaDisciplina.css">

<div class="container">

    <h3 class="text-center">Minhas Disciplinas</h3>

    <div class="row">

        <?php foreach ($dados['disciplinas'] as $turmaDisc): ?>

            <div class="col-md-6 col-lg-3 p-4">
                <div class="card-body text-center">

                    <h5 class="card-title">
                        <?= $turmaDisc->getDisciplina()->getNomeDisciplina() ?>
                    </h5>

                    <p class="card-text">
                        Turma:
                        <?= $turmaDisc->getTurma()->getCurso()->getNome() ?>
                        -
                        <?= $turmaDisc->getTurma()->getAnoTurma() ?>
                        <br>
                        Turno: <?= $turmaDisc->getTurma()->getTurno() ?>
                    </p>

                    <a href="#"
                       class="btn btn-primary">
                        Ver Avaliações
                    </a>

                </div>
            </div>

        <?php endforeach; ?>

    </div>

</div>

<?php require_once(__DIR__ . "/../../include/footer.php"); ?>
