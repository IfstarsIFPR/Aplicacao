<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../../include/header.php");
require_once(__DIR__ . "/../../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/listPrincipal.css">

<h3 class="text-center">Disciplinas da Turma</h3>

<div class="container">
    <div class="row" style="margin-top: 10px;">
        <div class="col-12">
            <table id="tabDisciplina" class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <?php foreach($dados['lista'] as $tur): ?>
                    <tr>
                        <td><?php echo $tur->getId(); ?></td>
                        <td><?= $tur->getNomeDisciplina(); ?></td>
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