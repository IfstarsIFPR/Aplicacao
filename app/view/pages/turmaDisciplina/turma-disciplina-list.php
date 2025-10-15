<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>

<style>
    .badge  {
    position: absolute;
    right: 8px;
    top: 19px;
}

.card-title {
    min-height: 50px;
}
</style>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/listPrincipal.css">

<h3 class="text-center">Disciplinas da Turma</h3>

<div class="container">
<<<<<<< Updated upstream
<<<<<<< Updated upstream

<?php print_r($dados['turma']) ?>

</div>

<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>
=======
=======
>>>>>>> Stashed changes
    <div class="row flex-row gap-3 mt-2">
            <!-- <table id="tabDisciplina" class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <?php foreach ($dados['lista'] as $tur): ?>
                    <tr>
                        <td><?php echo $tur->getId(); ?></td>
                        <td><?= $tur->getNomeDisciplina(); ?></td>
                     </tr>
                    <?php endforeach; ?>
                </tbody>
            </table> -->


            <?php foreach ($dados['lista'] as $tur): ?>
                <div class="card col-md-4" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $tur->getNomeDisciplina(); ?></h5>
                        <span class="badge rounded-pill text-bg-warning"><?php echo $tur->getId(); ?></span>

                        <p class="card-text">Professor(a) Fulano de Tal</p>
                        <a href="#" class="btn btn-primary">avaliar!</a>
                    </div>
                </div>
            <?php endforeach; ?>



    </div>
</div>

<?php
require_once(__DIR__ . "/../../include/footer.php");
<<<<<<< Updated upstream
?>
>>>>>>> Stashed changes
=======
?>
>>>>>>> Stashed changes
