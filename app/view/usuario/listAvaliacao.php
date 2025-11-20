<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/listAvaliacao.css">


<div class="container mt-4">
    <h3 class="text-center text-white mb-4 mt-5">
        <?= $dados["nomeDisciplina"] ?> —
        <span class="text-info">Professor(a) <?= $dados["nomeProfessor"] ?></span>
    </h3>


    <div class="row">

        <?php if (empty($dados["lista"])): ?>
            <p class="text-center text-light">
                Nenhuma avaliação encontrada para esta disciplina.
            </p>

        <?php else: ?>

            <?php foreach ($dados["lista"] as $avaliacao): ?>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-header bg-primary text-white text-center">
                            <strong><?= $avaliacao["bimestre"] ?></strong>
                        </div>

                        <div class="card-body">

                            <?php
                            $criterios = [
                                "Clareza" => "notaClareza",
                                "Didática" => "notaDidatica",
                                "Interação" => "notaInteracao",
                                "Motivação" => "notaMotivacao",
                                "Domínio do Conteúdo" => "notaDominioConteudo",
                                "Organização" => "notaOrganizacao",
                                "Recursos" => "notaRecursos",
                            ];
                            ?>

                            <?php foreach ($criterios as $titulo => $campo): ?>
                                <p>
                                    <strong><?= $titulo ?>:</strong><br>
                                    <?php for ($i = 1; $i <= $avaliacao[$campo]; $i++): ?>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    <?php endfor; ?>
                                </p>
                            <?php endforeach; ?>

                            <?php if (!empty($avaliacao["comentario"])): ?>
                                <div class="mt-3 p-2 bg-light border rounded">
                                    <strong>Seu comentário:</strong><br>
                                    <em><?= $avaliacao["comentario"] ?></em>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($avaliacao["respostaProfessor"])): ?>
                                <div class="mt-3 p-2 bg-primary-subtle border rounded">
                                    <strong>Resposta de <?= $dados["nomeProfessor"] ?> : </strong><br>
                                    <?= $avaliacao["respostaProfessor"] ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>

<?php require_once(__DIR__ . "/../include/footer.php"); ?>