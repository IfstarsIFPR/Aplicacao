<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/TurmaDisciplina.css">


<div class="container">

    <h3 class="text-center">Disciplinas da Turma</h3>

    <div class="row">


        <?php foreach ($dados['lista'] as $tur): ?>

            <div class="col-md-6 col-lg-3 p-4">
                <div class="card-body text-center">

                    <h5 class="card-title"><?= $tur->getNomeDisciplina(); ?></h5>
                    <p class="card-text">Professor(a) Fulano de Tal</p>
                    <a href="<?= BASEURL ?>/controller/AvaliacaoController.php?action=create&id_disicplina=<?= $tur->getId() ?>" class="btn btn-primary">avaliar!</a>

                </div>
            </div>
            <!-- ./col -->

        <?php endforeach; ?>

    </div>
    <!-- /.row -->

</div>

<?php require_once(__DIR__ . "/../../include/footer.php"); ?>