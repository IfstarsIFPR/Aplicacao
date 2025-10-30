<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>


<style>

.multiselect-dropdown {
    color: #333;
}

.multiselect-dropdown-list  div {
   display: flex;
   text-align: left;
    align-items: center;

}

.multiselect-dropdown-list  div input {

    width: 20px;

}

.multiselect-dropdown span.placeholder {
    color: #333;
    background: none !important;
}

.multiselect-dropdown span.optext {
    background-color: #2c87ddff;
    border-radius: 15px;
        color: #fff;

}

</style>


<link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">
<h3 class="text-center">
    <?php if (!isset($dados['idDisciplina']) || $dados['idDisciplina'] == 0)
        echo "Inserir";
    else echo "Alterar"; ?>
    Disciplinas
</h3>
<div class="row">
    <div class="col-12">
        <a class="btn btn-secondary"
            href="<?= BASEURL ?>/controller/DisciplinaController.php?action=list"> ← </a>
    </div>
</div>
<div class="container">
    <div class="col-12">
    <div class="form-container d-flex justify-content-center">

        <div class="form" style="border-radius: 20px">
            <form id="formDisciplina" method="POST"
                action="<?= BASEURL ?>/controller/DisciplinaController.php?action=save">
                <div class="mb-3">
                    <label class="form-label" for="textNome">Nome:</label>
                    <input class="form-control" type="text" id="textNome" name="nomeDisciplina"
                        maxlength="70" placeholder="Informe o nome da disciplina"
                        value="<?php echo (isset($dados["disciplina"]) ? $dados["disciplina"]->getNomeDisciplina() : ''); ?>" />
                </div>

                <?php
                // Garante que as variáveis existam para evitar erros
                $turmasAssociadas = $dados["turmasAssociadas"] ?? [];
                $idsAssociadas = array_map(fn($t) => $t->getId(), $turmasAssociadas);?>

                <div class="mb-4">
                    <label class="form-label" for="selectTurma">Turma:</label>

                    <?php $idsAssociadas = array_map(fn($t) => $t->getId(), $dados["turmasAssociadas"] ?? []); ?>

                    <select class="form-select" id="selectTurma" name="turmas[]" multiple  multiselect-search="true">
                        <?php foreach ($dados["turmas"] as $turma) : ?>
                            <option value="<?= $turma->getId() ?>">
                                <?= in_array($turma->getId(), $idsAssociadas) ? 'selected' : '' ?>>
                                <?= $turma->getCurso()->getNome() . " -> " . $turma->getAnoTurma() ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <!-- Campo hidden para o ID da disciplina -->
                <input type="hidden" name="idDisciplina"
                    value="<?= isset($dados['idDisciplina']) ? $dados['idDisciplina'] : 0 ?>">

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>

        <div class="col-6">
            <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
        </div>
    </div>
</div>

<script src="https://admirhodzic.github.io/multiselect-dropdown/multiselect-dropdown.js"></script>

<?php
require_once(__DIR__ . "/../../include/footer.php");
?>