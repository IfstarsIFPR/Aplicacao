<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/TurmDisc_list.css">

<div class="container">

    <h3 class="text-center mt-5 section-title">  📝  Disciplinas da Turma</h3>

    <div class="row justify-content-center">

        <?php foreach ($dados['lista'] as $disc): ?>

            <div class="col-md-6 col-lg-4 p-3">
                <div class="card custom-card shadow-lg">

                                    <div class="card-body text-center">

                    <h5 class="card-title"><?= $disc->getNomeDisciplina(); ?></h5>
                    <p class="card-text">Professor(a): <?= $disc->getNomeProfessor(); ?></p>
                    <a href="<?= BASEURL ?>/controller/AvaliacaoController.php?action=create&id_disicplina=<?= $disc->getId() ?>" class="btn btn-primary btn-custom">Avaliar</a>

                </div>
            </div>
            <!-- ./col -->
            </div>
        <?php endforeach; ?>
    </div>
    <!-- /.row -->
</div>
<?php require_once(__DIR__ . "/../../include/footer.php"); ?>