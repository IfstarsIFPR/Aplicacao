<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">
<h3 class="text-center">
    <?php if ($dados['idCurso'] == 0) echo "Inserir";
    else echo "Alterar"; ?>
    Cursos
</h3>
<div class="row">
<div class="container">
<div class="form-container  d-flex justify-content-center" >

         <div class="form" style="border-radius: 20px">
            <form id="formCurso" method="POST"
                action="<?= BASEURL ?>/controller/CursoController.php?action=save">
                <div class="mb-3">
                    <label class="form-label" for="txtNome">Nome:</label>
                    <input class="form-control" type="text" id="txtNome" name="nomeCurso"
                        maxlength="70" placeholder="Informe o nome"
                        value="<?php echo (isset($dados["curso"]) ? $dados["curso"]->getNome() : ''); ?>" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="selNivel">Nível:</label>
                    <select class="form-select" name="nivel" id="selNivel">
                        <option value="">Selecione o nível do curso</option>
                        <?php foreach ($dados["nivel"] as $nivel): ?>
                            <option value="<?= $nivel ?>"
                                <?php
                                if (isset($dados["curso"]) && $dados["curso"]->getNivel() == $nivel)
                                    echo "selected";
                                ?>>
                                <?= $nivel ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <input type="hidden" id="hddId" name="idCurso"
                    value="<?= $dados['idCurso']; ?>" />

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Gravar</button>
                </div>
            </form>
        </div>
</div>


        <div class="col-6">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
</div>
</div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>