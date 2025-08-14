<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>

<h3 class="text-center">Turmas</h3>

<div class="container">
    <div class="row">
        <div class="col-3">
            <a class="btn btn-success" 
                href="<?= BASEURL ?>/controller/TurmaController.php?action=create">
                Inserir</a>
        </div>

        <div class="col-9">
            <?php require_once(__DIR__ . "/../../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-12">
            <table id="tabTurmas" class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ano</th>
                        <th>Código</th>
                        <th>Turno</th>
                        <th>Disciplinas</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dados['lista'] as $tur): ?>
                        <tr>
                            <td><?php echo $tur->getId(); ?></td>
                            <td><?= $tur->getAnoTurma(); ?></td>
                            <td><?= $tur->getCodigoTurma(); ?></td>
                            <td><?= $tur->getTurno(); ?></td>
                            <td><a class="btn btn-warning" 
                                href="<?= BASEURL ?>/controller/TurmaController.php?action=edit&id=<?= $tur->getId() ?>">
                                Disciplinas</a> 
                            </td>
                            <td><a class="btn btn-primary" 
                                href="<?= BASEURL ?>/controller/TurmaController.php?action=edit&id=<?= $tur->getId() ?>">
                                Alterar</a> 
                            </td>
                            <td><a class="btn btn-danger" 
                                onclick="return confirm('Confirma a exclusão do usuário?');"
                                href="<?= BASEURL ?>/controller/TurmaController.php?action=delete&id=<?= $tur->getId() ?>">
                                Excluir</a> 
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php  
require_once(__DIR__ . "/../../include/footer.php");
?>
