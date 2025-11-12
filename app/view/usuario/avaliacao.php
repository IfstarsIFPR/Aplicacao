<?php
  require_once(__DIR__ . "/../../model/enum/AvaliacaoBimestre.php");

  require_once(__DIR__ . "/../include/header.php");
  require_once(__DIR__ . "/../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/avaliacao.css">

<div class="container mt-5">
  <div class="card shadow p-4">
    <h2 class="text-center mb-4">Avaliação do Professor</h2>

    <form method="POST" action="<?= BASEURL ?>/controller/AvaliacaoController.php?action=save">

      <input type="hidden" name="idAvaliacao" value="0">

      <!-- Exemplo de uma avaliação por estrelas -->
      <div class="row">
        <div class="col-6">
          <label class="form-label">Clareza na explicação:</label>
          <div class="estrela">
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <input type="radio" name="notaClareza" id="clareza<?= $i ?>" value="<?= $i ?>"
                <?php if($dados['avaliacao'] && $dados['avaliacao']->getNotaClareza() && 
                          $dados['avaliacao']->getNotaClareza() == $i)
                          echo "checked"; ?>
              >
              <label for="clareza<?= $i ?>"><i class="bi bi-star-fill"></i></label>
            <?php endfor; ?>
          </div>


          <label class="form-label">Domínio do conteudo:</label>
          <div class="estrela">
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <input type="radio" name="notaDominioConteudo" id="dominio<?= $i ?>" value="<?= $i ?>">
              <label for="dominio<?= $i ?>"><i class="bi bi-star-fill"></i></label>
            <?php endfor; ?>
          </div>



          <label class="form-label">Didática:</label>
          <div class="estrela">
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <input type="radio" name="notaDidatica" id="didatica<?= $i ?>" value="<?= $i ?>">
              <label for="didatica<?= $i ?>"><i class="bi bi-star-fill"></i></label>
            <?php endfor; ?>
          </div>



          <label class="form-label">Interação:</label>
          <div class="estrela">
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <input type="radio" name="notaInteracao" id="interacao<?= $i ?>" value="<?= $i ?>">
              <label for="interacao<?= $i ?>"><i class="bi bi-star-fill"></i></label>
            <?php endfor; ?>
          </div>



          <label class="form-label">Uso de recursos:</label>
          <div class="estrela">
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <input type="radio" name="notaRecursos" id="recursos<?= $i ?>" value="<?= $i ?>">
              <label for="recursos<?= $i ?>"><i class="bi bi-star-fill"></i></label>
            <?php endfor; ?>
          </div>



          <label class="form-label">Motivação:</label>
          <div class="estrela">
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <input type="radio" name="notaMotivacao" id="motivacao<?= $i ?>" value="<?= $i ?>">
              <label for="motivacao<?= $i ?>"><i class="bi bi-star-fill"></i></label>
            <?php endfor; ?>
          </div>



          <label class="form-label">Organização:</label>
          <div class="estrela">
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <input type="radio" name="notaOrganizacao" id="organizacao<?= $i ?>" value="<?= $i ?>">
              <label for="organizacao<?= $i ?>"><i class="bi bi-star-fill"></i></label>
            <?php endfor; ?>
          </div>
        </div>

        <div class="col-6">
          <label for="comentario" class="form-label">Comentário</label>
          <textarea name="comentario" id="comentario" class="form-control" rows="3" placeholder="Escreva um comentário..."><?= $dados["avaliacao"] ? $dados["avaliacao"]->getComentario() : "" ?></textarea>
          <button type="submit" class="btn btn-warning w-100">Enviar Avaliação</button>
        </div>

        <input type="hidden" name="idDisciplina" value="<?= $dados['idDisciplina'] ?>">

        <label for="bimestre" class="form-label mt-3">Bimestre:</label>
        <select name="bimestre" id="bimestre" class="form-select">
          <option value="">Selecione</option>
          <option value="1º Bimestre" 
            <?= $dados["avaliacao"] && $dados["avaliacao"]->getBimestre() == AvaliacaoBimestre::PRIMEIRO ? "selected" : "" ?>>1º Bimestre</option>
          <option value="2º Bimestre">2º Bimestre</option>
          <option value="3º Bimestre">3º Bimestre</option>
          <option value="4º Bimestre">4º Bimestre</option>
        </select>
      </div>

    </form>

    <?php 
      require_once(__DIR__ .  "/../include/msg.php");
    ?>
  </div>
</div>

<?php 
      require_once(__DIR__ .  "/../include/footer.php");
?>