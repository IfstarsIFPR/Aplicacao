<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="container mt-5 text-white">
    <h3 class="text-center mb-4">Média das Avaliações da Disciplina</h3>


    <div class="text-center">

        <div class="row">
            <div class="col-md-3 my-5">
                <select class="form-select" name="" id="bimestreSelect">

                    <option value="1º Bimestre">1º Bimestre</option>
                    <option value="2º Bimestre">2º Bimestre</option>
                    <option value="3º Bimestre">3º Bimestre</option>
                    <option value="4º Bimestre">4º Bimestre</option>


                </select>
            </div>
        </div>

    </div>

    <canvas id="graficoAvaliacoes" style="max-height: 400px;"></canvas>


    <!-- COMENTARIOS -->
      <div class="row">
    <section class="comentarios mt-5">

        <?php foreach ($dados["comentarios"] as $comentario): ?>

        <div class="card mb-3">
            
            <div class="card-body">
                <p class="card-text"><strong>Anônimo:</strong> <?= $comentario['comentario'] ?></p> 
               
            <!-- Formulário para responder -->
            <form method="post" action="<?= BASEURL ?>/controller/AvaliacaoController.php?action=responder" class="mt-2">
                <input type="hidden" name="idAvaliacao" value="<?= $comentario['idAvaliacao'] ?>">
                 <textarea name="resposta" class="form-control mb-2" placeholder="Responder comentário" required><?= $comentario['respostaProfessor'] ?></textarea>
                    <button type="submit" class="btn btn-primary btn-sm">Responder</button> 
                     <a href="#" class="card-link">denunciar</a>

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
        const valorBim = params.get("bimestre"); // pega o valor da URL

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