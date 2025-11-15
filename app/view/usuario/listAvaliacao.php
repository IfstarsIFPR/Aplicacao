<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/listaAvaliacao.css">

<div class="container mt-4">
    <h3 class="text-center text-white mb-4 mt-5">
        Avaliações da Disciplina
    </h3>

    <div class="row">

        <?php if (empty($dados["lista"])): ?>
            <p class="text-center text-light">
                Nenhuma avaliação encontrada para esta disciplina.
            </p>

        <?php else: ?>

            <?php foreach ($dados["lista"] as $avaliacao): ?>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card shadow-lg h-100">
                        <div class="card-body">

                            <h5 class="card-title text-primary text-center">
                             <?= htmlspecialchars($avaliacao["bimestre"]) ?>
                            </h5>
                            <hr>
                            <p><strong>Clareza:</strong> <?= htmlspecialchars($avaliacao["notaClareza"]) ?></p>
                            <p><strong>Didática:</strong> <?= htmlspecialchars($avaliacao["notaDidatica"]) ?></p>
                            <p><strong>Interação:</strong> <?= htmlspecialchars($avaliacao["notaInteracao"]) ?></p>
                            <p><strong>Motivação:</strong> <?= htmlspecialchars($avaliacao["notaMotivacao"]) ?></p>
                            <p><strong>Domínio do Conteúdo:</strong> <?= htmlspecialchars($avaliacao["notaDominioConteudo"]) ?></p>
                            <p><strong>Organização:</strong> <?= htmlspecialchars($avaliacao["notaOrganizacao"]) ?></p>
                            <p><strong>Recursos:</strong> <?= htmlspecialchars($avaliacao["notaRecursos"]) ?></p>

                            <?php if (!empty($avaliacao["comentario"])): ?>
                                <p><strong>Comentário:</strong><br>
                                    <?= nl2br(htmlspecialchars($avaliacao["comentario"])) ?>
                                </p>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>

<?php require_once(__DIR__ . "/../include/footer.php"); ?>
