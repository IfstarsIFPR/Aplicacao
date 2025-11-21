<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/semAvaliacao.css">

<div class="container">
    <div class="sem-avaliacao-box">

        <img src="<?= BASEURL ?>/view/img/pessoas_lupa.png" 
             class="sem-avaliacao-img" 
             alt="Sem Avaliações">

        <h2>Ainda não foram feitas avaliações nesta disciplina!</h2>

      
    </div>
    <div class="text-center mt-4">
    <a href="<?= BASEURL ?>/controller/TurmaDisciplinaController.php?action=minhasDisciplinasProfessor"
       class="btn-voltar">
       Voltar
    </a>
</div>

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
