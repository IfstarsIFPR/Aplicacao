<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/listPrincipal.css">

<h3 class="text-center">Disciplinas da Turma</h3>

<div class="container">

<?php print_r($dados['turma']) ?>

</div>

<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>
