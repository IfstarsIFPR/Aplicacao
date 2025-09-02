<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">
<h3 class="text-center">
    <?php if (!isset($dados['idDisciplina']) || $dados['idDisciplina'] == 0) 
        echo "Inserir";
    else echo "Alterar"; ?>
    Disciplinas
</h3>

<div class="container">

    <div class="row" style="margin-top: 10px;">

        <div class="col-6">
            <form id="formDisciplina" method="POST"
                action="<?= BASEURL ?>/controller/DisciplinaController.php?action=save">
                <div class="mb-3">
                    <label class="form-label" for="textNome">Nome:</label>
                    <input class="form-control" type="text" id="textNome" name="nomeDisciplina"
                        maxlength="70" placeholder="Informe o nome da disciplina"
                        value="<?php echo (isset($dados["disciplina"]) ? $dados["disciplina"]->getNomeDisciplina() : ''); ?>" />
                </div>

                    
                <!-- Campo hidden para o ID da disciplina -->
                <input type="hidden" name="idDisciplina" 
                    value="<?= isset($dados['idDisciplina']) ? $dados['idDisciplina'] : 0 ?>">

                <div class="mt-3">
                    <button type="submit" class="btn btn-secondary">Gravar</button>
                </div>
            </form>
        </div>

        <div class="col-6">
            <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 30px;">
        <div class="col-12">
            <a class="btn btn-secondary"
                href="<?= BASEURL ?>/controller/DisciplinaController.php?action=list">Voltar</a>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../../include/footer.php");
?>