<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/graficoAvaliacao.css"> 

<div class="container container-grafico mt-5">
   <div class="top-bar d-flex justify-content-between align-items-center mb-4">
    
    <div class="titulo-dashboard">
        <h2>Média das Avaliações</h2>
        <p>
            <strong>Turma:</strong> <?= $dados["nomeTurma"] ?> • 
            <strong>Disciplina:</strong> <?= $dados["nomeDisciplina"] ?>
        </p>
    </div>

    <div>
        <select class="form-select select-bimestre" id="bimestreSelect">
            <option value="1º Bimestre">1º Bimestre</option>
            <option value="2º Bimestre">2º Bimestre</option>
            <option value="3º Bimestre">3º Bimestre</option>
            <option value="4º Bimestre">4º Bimestre</option>
        </select>
    </div>

</div>


    <canvas id="graficoAvaliacoes" style="max-height: 400px;"></canvas>

    <!-- COMENTÁRIOS -->
  <div class="row">
    <h4 class="titulo-comentarios mt-5 mb-4">Comentários</h4>

    <section class="comentarios mt-3 d-flex flex-wrap gap-3">
            <?php foreach ($dados["comentarios"] as $comentario): ?>
                <div class="card card-comentario">
                    <div class="card-body">
                        <p class="card-text"><strong>Anônimo:</strong> <?= $comentario['comentario'] ?></p>

                        <!-- Formulário para responder -->
                       <form method="post" action="<?= BASEURL ?>/controller/AvaliacaoController.php?action=responder" class="mt-2">

    <input type="hidden" name="idAvaliacao" value="<?= $comentario['idAvaliacao'] ?>">

    <textarea name="resposta" class="form-control mb-2" placeholder="Responder comentário" required><?= $comentario['respostaProfessor'] ?></textarea>

    <div class="acoes-comentario mt-3">
        <button type="submit" class="btn btn-primary btn-sm me-3">Responder</button>
        <a href="#" class="card-link">denunciar</a>
    </div>

</form>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dados = <?= json_encode($dados["avaliacoes"]) ?>;
</script>
<script src="<?= BASEURL ?>/view/js/graficoAvaliacao.js"></script>

<script>
    let select = document.querySelector('#bimestreSelect');

    window.addEventListener("DOMContentLoaded", () => {
        const params = new URLSearchParams(window.location.search);
        const valorBim = params.get("bimestre");
        if (valorBim) {
            document.getElementById("bimestreSelect").value = valorBim;
        }
    });

    select.addEventListener("change", function() {
        const valor = this.value;
        const url = new URL(window.location.href);
        url.searchParams.set("bimestre", valor);
        window.location.href = url;
    });
</script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>