<?php
#Nome do arquivo: perfil/perfil.php
#Objetivo: interface para perfil dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/perfil.css">


<div class="container mt-5">

    <h3 class="text-center mb-4">Perfil</h3>

    <div class="card shadow-lg perfil-card mx-auto p-3">

        <!-- FOTO DO PERFIL -->
        <div class="text-center mb-3">
            <?php
            $foto = $dados['usuario']->getFotoPerfil();
            $fotoPerfil = $foto
                ? BASEURL_ARQUIVOS . '/' . $foto
                : BASEURL . '/view/img/default_profile.png';
            ?>
            <img src="<?= $fotoPerfil ?>" class="foto-perfil">
<br>
            <h4><strong><?= $dados['usuario']->getNome() ?></h4>

        </div>

        <!-- INFORMAÇÕES DO USUÁRIO -->
        <div class="info-mini-card shadow-sm mt-3 p-1 my-3">

            <div class="row">
                <div class="col-6 text-center">
                    <p class="titulo-pequeno">Email</p>
                    <p class="valor-pequeno"><?= $dados['usuario']->getEmail() ?></p>
                </div>

                <div class="col-6 text-center">
                    <p class="titulo-pequeno">Tipo</p>
                    <p class="valor-pequeno"><?= $dados['usuario']->getTipousuario() ?></p>
                </div>
            </div>
        </div>

        <!-- UPLOAD FOTO -->
        <form id="frmUsuario" method="POST"
            action="<?= BASEURL ?>/controller/PerfilController.php?action=save"
            enctype="multipart/form-data">

            <label class="form-label fw-bold" for="txtFoto">Alterar foto de perfil:</label>
            <input class="form-control mb-3" type="file" id="txtFoto" name="foto">
            <input type="hidden" name="fotoAnterior" value="<?= $dados['usuario']->getFotoPerfil() ?>">

            <button type="submit" class="btn btn-primary w-100 mt-2">Salvar</button>
        </form>

    </div>

</div>


<?php
require_once(__DIR__ . "/../include/footer.php");
?>