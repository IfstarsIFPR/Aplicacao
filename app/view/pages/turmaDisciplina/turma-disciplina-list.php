<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/TurmaDisciplina.css">

<h3 class="text-center">Disciplinas da Turma</h3>

<div class="container">

    <?php foreach ($dados['lista'] as $tur): ?>
        <div class="card-body col-md-4 text-center">

            <h5 class="card-title"><?= $tur->getNomeDisciplina(); ?></h5>
            <p class="card-text">Professor(a) Fulano de Tal</p>
            <a href="#" class="btn btn-primary">avaliar!</a>

        </div>
    <?php endforeach; ?>

</div>

<?php require_once(__DIR__ . "/../../include/footer.php"); ?>
