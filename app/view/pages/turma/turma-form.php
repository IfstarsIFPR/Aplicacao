<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">
<h3 class="text-center">
    <?php if ($dados['idTurma'] == 0) echo "Inserir";
    else echo "Alterar"; ?>
    Turmas
</h3>
<div class="row">
       <div class="col-12">
        <a class="btn btn-secondary"
            href="<?= BASEURL ?>/controller/TurmaController.php?action=list"> ← </a>
    </div>

<div class="form-container  d-flex justify-content-center" >

        <div class="form" style="border-radius: 20px">
            <form id="formTurma" method="POST"
                action="<?= BASEURL ?>/controller/TurmaController.php?action=save">
                <div class="mb-3">
                    <label class="form-label" for="numAno">Ano:</label>
                    <input class="form-control" type="number" id="numAno" name="anoTurma"
                        maxlength="70" placeholder="Informe o ano que a turma entrou"
                        value="<?php echo (isset($dados["turma"]) ? $dados["turma"]->getAnoTurma() : ''); ?>" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="numCodigo">Código:</label>
                    <input class="form-control" type="number" id="numCodigo" name="codigoTurma"
                        maxlength="70" placeholder="Informe o código da turma"
                        value="<?php echo (isset($dados["turma"]) ? $dados["turma"]->getCodigoTurma() : ''); ?>" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="selTurno">Turno:</label>
                    <select class="form-select" name="turno" id="selTurno">
                        <option value="">Selecione o turno da turma</option>
                        <?php foreach ($dados["turno"] as $turno): ?>
                            <option value="<?= $turno ?>"
                                <?php
                                if (isset($dados["turma"]) && $dados["turma"]->getTurno() == $turno)
                                    echo "selected";
                                ?>>
                                <?= $turno ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                 <div class="mb-3">
                    <label class="form-label" for="selCurso">Curso:</label>
                    <select class="form-select" name="idCurso" id="selCurso">
                        <option value="">Selecione o curso</option>
                        <?php foreach($dados["cursos"] as $curso): ?>
                            <option value="<?= $curso->getId() ?>" 
                                <?php 
                                    if(isset($dados["turma"]) && $dados['turma']->getCurso() != null && 
                                        $dados["turma"]->getCurso()->getId() == $curso->getId()) 
                                        echo "selected";

                                ?>    
                            >
                                <?= $curso->getNome() ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <input type="hidden" id="hddId" name="idTurma"
                    value="<?= $dados['idTurma']; ?>" />

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Gravar</button>
                </div>
            </form>
        </div>
</div>


        <div class="col-6">
            <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
        </div>
</div>
</div>

<?php
require_once(__DIR__ . "/../../include/footer.php");
?>