<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<h3 class="text-center">Cursos</h3>

<div class="container">
    <div class="row">
        <div class="col-3">
            <a class="btn btn-success" 
                href="<?= BASEURL ?>/controller/CursoController.php?action=create">
                Inserir</a>
        </div>

        <div class="col-9">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-12">
            <table id="tabCursos" class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Nivel</th>
                        <th>Turma</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dados['lista'] as $curs): ?>
                        <tr>
                            <td><?php echo $curs->getId(); ?></td>
                            <td><?= $curs->getNome(); ?></td>
                            <td><?= $curs->getNivel(); ?></td>
                            <td><a class="btn btn-warning" 
                                href="<?= BASEURL ?>/controller/TurmaController.php?action=edit&id=<?= $curs->getId() ?>">
                                Turma</a> 
                            </td>
                            <td><a class="btn btn-primary" 
                                href="<?= BASEURL ?>/controller/CursoController.php?action=edit&id=<?= $curs->getId() ?>">
                                Alterar</a> 
                            </td>
                            <td><a class="btn btn-danger" 
                                onclick="return confirm('Confirma a exclusão do curso?');"
                                href="<?= BASEURL ?>/controller/CursoController.php?action=delete&id=<?= $curs->getId() ?>">
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
require_once(__DIR__ . "/../include/footer.php");
?>
