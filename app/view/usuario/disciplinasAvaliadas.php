<?php

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/DisciplinasAvaliadas.css">

<div class="container">

    <h3 class="text-center">Disciplinas Avaliadas</h3>

    <div class="row">

        <?php foreach ($dados['lista'] as $disc): ?>
            <div class="col-md-6 col-lg-3 p-4">

                <a href="<?= BASEURL ?>/controller/AvaliacaoController.php?action=listarAvaliacoesPorDisciplina&idDisciplina=<?= $disc["idDisciplina"] ?>">

                    <div class="card-body">
                        <h5 class="card-title text">
                            <?=($disc['nomeDisciplina']) ?>
                        </h5>
                    </div>

                </a>
            </div>
        <?php endforeach; ?>

    </div>

</div>

<?php require_once(__DIR__ . "/../include/footer.php"); ?>