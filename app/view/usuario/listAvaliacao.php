<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/listAvaliacao.css">

<div class="container">
    <h3 class="text-center text-white mb-4 mt-5">
        <!-- <a href="/controller/TurmaDisciplinaController.php?action=list&idTurma=2" class="btn-voltar position-relative"><i class="bi bi-arrow-left-circle"></i></a>-->
  
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
                    <div class="avaliacao-card shadow-lg h-100">
                        <div class="cabecalho-bimestre">
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
                                <div class="criterio-linha">
                                    <span class="criterio-nome"><?= $titulo ?></span>
                                    <span>
                                        <?php for ($i = 1; $i <= $avaliacao[$campo]; $i++): ?>
                                            <i class="bi bi-star-fill estrela"></i>
                                        <?php endfor; ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>

                            <?php if (!empty($avaliacao["comentario"])): ?>
                                <div class="comentario-bloco aluno-comentario">
                                    <strong>Seu comentário:</strong><br>
                                    <em><?= $avaliacao["comentario"] ?></em>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($avaliacao["respostaProfessor"])): ?>
                                <div class="comentario-bloco resposta-prof">
                                    <strong>Resposta de <?= $dados["nomeProfessor"] ?>:</strong><br>
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
<!--<script src="/view/js/botaovoltar.js"></script>-->

<?php require_once(__DIR__ . "/../include/footer.php"); ?>