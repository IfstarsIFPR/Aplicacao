<?php
#Nome do arquivo: perfil/perfil.php
#Objetivo: interface para perfil dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/perfil.css">

<div class="container">

    <h3 class="text-center mt-5">Perfil</h3>

    <div class="row mt-2">
        <div class="col-12 mb-2">
            <span class="fw-bold">Nome:</span>
            <span><?= $dados['usuario']->getNome() ?></span>
        </div>

        <div class="col-12 mb-2">
            <span class="fw-bold">Email:</span>
            <span><?= $dados['usuario']->getEmail() ?></span>
        </div>

        <div class="col-12 mb-2">
            <span class="fw-bold">Tipo:</span>
            <span><?= $dados['usuario']->getTipousuario() ?></span>
        </div>

    </div>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>