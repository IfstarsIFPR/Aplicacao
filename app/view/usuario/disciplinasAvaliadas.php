<?php

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/TurmDisc_list.css">

<div class="container">

    <h3 class="text-center mt-5 section-title"> ⭐ Disciplinas Avaliadas</h3>

    <div class="row justify-content-center">

        <?php foreach ($dados['lista'] as $disc): ?>
            <div class="col-md-6 col-lg-4 p-3">
                <div class="card custom-card shadow-lg">

                    <div class="card-body text-center">
                        <h5 class="card-title"><?= ($disc['nomeDisciplina']) ?></h5>
                        <a href="<?= BASEURL ?>/controller/AvaliacaoController.php?action=listarAvaliacoesPorDisciplina&idDisciplina=<?= $disc["idDisciplina"] ?>" class="btn btn-primary btn-custom">Ver Avaliações</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once(__DIR__ . "/../include/footer.php"); ?>