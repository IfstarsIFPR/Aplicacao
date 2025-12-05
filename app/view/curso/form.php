<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">

<h3 class="text-center mt-5">
    <?= $dados['idCurso'] == 0 ? "Inserir" : "Alterar" ?> Cursos
</h3>

<div class="row">
    <div class="container">
        <div class="form-container d-flex justify-content-center">

            <div class="form" style="border-radius: 20px">
                <form id="formCurso" method="POST"
                    action="<?= BASEURL ?>/controller/CursoController.php?action=save">

                    <div class="mb-3">
                        <label class="form-label" for="txtNome">Nome:</label>
                        <input class="form-control" type="text" id="txtNome" name="nomeCurso"
                            value="<?= isset($dados['curso']) ? $dados['curso']->getNome() : '' ?>">

                        <?php if (isset($dados['erros']['nomeCurso'])): ?>
                            <small class="text-danger"><?= $dados['erros']['nomeCurso'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="selNivel">Nível:</label>
                        <select class="form-select" name="nivel" id="selNivel">
                            <option value="">Selecione o nível do curso</option>
                            <?php foreach ($dados["nivel"] as $nivel): ?>
                                <option value="<?= $nivel ?>"
                                    <?= (isset($dados['curso']) && $dados['curso']->getNivel() == $nivel) ? 'selected' : '' ?>>
                                    <?= $nivel ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <?php if (isset($dados['erros']['nivel'])): ?>
                            <small class="text-danger"><?= $dados['erros']['nivel'] ?></small>
                        <?php endif; ?>
                    </div>

                    <input type="hidden" name="idCurso" value="<?= $dados['idCurso'] ?>">

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

<?php require_once(__DIR__ . "/../include/footer.php"); ?>