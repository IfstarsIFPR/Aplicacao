<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">
<h3 class="text-center mt-5">
    <?php if ($dados['idUsuario'] == 0) echo "Inserir";
    else echo "Verificar"; ?>
    Aluno
</h3>
<div class="row">
   
    <div class="container">
        <div class="form-container  d-flex justify-content-center">

            <div class="form" style="border-radius: 20px">
                <form id="frmUsuario" method="POST" action="<?= BASEURL ?>/controller/UsuarioController.php?action=ativar">

                    <div class="mb-3"> Nome do aluno:
                        <?php echo $dados["usuario"]->getNome() ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="txtdeclaracaoMatricula">Declaração de Matrícula:</label>

                        <a href="<?= BASEURL_ARQUIVOS . '/' . $dados["usuario"]->getdeclaracaoMatricula() ?>"> Declaração</a>

                        <!-- <input class="form-control" type="file" id="txtdeclaracaoMatricula" name="declaracaoMatricula"
                            maxlength="20" value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getdeclaracaoMatricula() : ''); ?>" /> -->

                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="selStatus">Status do Aluno:</label>
                        <select class="form-select" name="idStatus" id="selStatus">
                            <option value="">Selecione o staus</option>
                            <option value="pendente" <?= $dados["usuario"]->getStatus() == "pendente" ? "selected" : "" ?>>Pendente</option>
                            <option value="ativo" <?= $dados["usuario"]->getStatus() == "ativo" ? "selected" : "" ?>>Ativo</option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Atualizar Status</button>
                    </div>

                    <input type="hidden" id="hddId" name="idUsuario"
                        value="<?= $dados['idUsuario']; ?>" />

                </form>
            </div>
        </div>
        <div class="col-6">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>


    </div>
</div>


<?php
require_once(__DIR__ . "/../include/footer.php");
?>