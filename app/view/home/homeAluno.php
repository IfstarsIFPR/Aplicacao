<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/homeAluno.css">

<h3 class="text-center">Turmas</h3>

<div class="container">

    <?php
    // echo '<pre>';
    // var_dump($dados['turmas'][0]->getCurso()->getNome());
    // echo '</pre>';
    // die;
    ?>

    <?php if (isset($dados['mensagem'])) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Alerta!</strong> <?= $dados['mensagem'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>


    <div class=""></div>
        <?php foreach ($dados['turmas'] as $turma) : ?>
        
                    <div class="card row flex-row gap-3 mt-2 text-center">
                        <h5 class="card-title"><?= $turma->getCurso()->getNome() ?></h5>
                        <p class="card-text"><?= $turma->getAnoTurma() ?></p>

                        <form action="<?= BASEURL ?>/controller/TurmaDisciplinaController.php?action=acessarTurma" method="POST">

                            <input type="hidden" name="idTurma" value="<?= $turma->getId() ?>">

                            <input type="text" name="codigoTurma" value="" class="form-control" placeholder="Digite o código da turma">

                            <button type="submit" href="#" class="btn btn-primary mt-3">Acessar</a>

                        </form>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>

<script src="<?= BASEURL ?>/view/js/home_ajax.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>