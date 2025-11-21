<?php
#Nome do arquivo: perfil/perfil.php
#Objetivo: interface para perfil dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/perfil.css">



<div class="container">

    <h3 class="text-center mt-2">Perfil</h3>

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

        <div class="col-12 mb-2">
            <div class="fw-bold">Foto:</div>
            <?php if($dados['usuario']->getFotoPerfil()): ?>
                <img src="<?= BASEURL_ARQUIVOS . '/' . $dados['usuario']->getFotoPerfil() ?>"
                    height="300">
            <?php endif; ?>
        </div>

    </div>
    
    <div class="row mb-3 mt-3">
        
        <div class="col-12">
            <form id="frmUsuario" method="POST" 
                action="<?= BASEURL ?>/controller/PerfilController.php?action=save"
                enctype="multipart/form-data" >
                    <label class="form-label" for="txtFoto">Foto de perfil: </label>
                    <input class="form-control" type="file" 
                        id="txtFoto" name="foto" />
                </div>

                <input type="hidden" name="fotoAnterior" value="<?= $dados['usuario']->getFotoPerfil() ?>">
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Gravar</button>
                </div>
            </form>            

    </div>
</div>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>