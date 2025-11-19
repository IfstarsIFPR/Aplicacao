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

      <div class="row">
        <div class="col-md-6">

          <!-- Clareza -->
          <label class="form-label">Clareza na explicação:</label>
          <div class="estrela">
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <input type="radio" name="notaClareza" id="clareza<?= $i ?>" value="<?= $i ?>"
                <?php if ($dados['avaliacao'] && $dados['avaliacao']->getNotaClareza() == $i) echo "checked"; ?>>
              <label for="clareza<?= $i ?>"><i class="bi bi-star-fill"></i></label>
            <?php endfor; ?>
          </div>
          <?php if (isset($dados["erros"]["notaClareza"])): ?>
            <small class="text-danger"><?= $dados["erros"]["notaClareza"] ?></small>
          <?php endif; ?>

          <!-- Domínio -->
          <label class="form-label mt-2">Domínio do conteúdo:</label>
          <div class="estrela">
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <input type="radio" name="notaDominioConteudo" id="dominio<?= $i ?>" value="<?= $i ?>"
                <?php if ($dados['avaliacao'] && $dados['avaliacao']->getNotaDominioConteudo() == $i) echo "checked"; ?>>
              <label for="dominio<?= $i ?>"><i class="bi bi-star-fill"></i></label>
            <?php endfor; ?>
          </div>
          <?php if (isset($dados["erros"]["notaDominioConteudo"])): ?>
            <small class="text-danger"><?= $dados["erros"]["notaDominioConteudo"] ?></small>
          <?php endif; ?>

          <!-- Didática -->
          <label class="form-label mt-2">Didática:</label>
          <div class="estrela">
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <input type="radio" name="notaDidatica" id="didatica<?= $i ?>" value="<?= $i ?>"
                  <?php if ($dados['avaliacao'] && $dados['avaliacao']->getNotaDidatica() == $i) echo "checked"; ?>>
              <label for="didatica<?= $i ?>"><i class="bi bi-star-fill"></i></label>
            <?php endfor; ?>
          </div>
          <?php if (isset($dados["erros"]["notaDidatica"])): ?>
            <small class="text-danger"><?= $dados["erros"]["notaDidatica"] ?></small>
          <?php endif; ?>

          <!-- Interação -->
          <label class="form-label mt-2">Interação:</label>
          <div class="estrela">
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <input type="radio" name="notaInteracao" id="interacao<?= $i ?>" value="<?= $i ?>"
                  <?php if ($dados['avaliacao'] && $dados['avaliacao']->getNotaInteracao() == $i) echo "checked"; ?>>
              <label for="interacao<?= $i ?>"><i class="bi bi-star-fill"></i></label>
            <?php endfor; ?>
          </div>
          <?php if (isset($dados["erros"]["notaInteracao"])): ?>
            <small class="text-danger"><?= $dados["erros"]["notaInteracao"] ?></small>
          <?php endif; ?>

          <!-- Recursos -->
          <label class="form-label mt-2">Uso de recursos:</label>
          <div class="estrela">
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <input type="radio" name="notaRecursos" id="recursos<?= $i ?>" value="<?= $i ?>"
                   <?php if ($dados['avaliacao'] && $dados['avaliacao']->getNotaRecursos() == $i) echo "checked"; ?>>
              <label for="recursos<?= $i ?>"><i class="bi bi-star-fill"></i></label>
            <?php endfor; ?>
          </div>
          <?php if (isset($dados["erros"]["notaRecursos"])): ?>
            <small class="text-danger"><?= $dados["erros"]["notaRecursos"] ?></small>
          <?php endif; ?>

          <!-- Motivação -->
          <label class="form-label mt-2">Motivação:</label>
          <div class="estrela">
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <input type="radio" name="notaMotivacao" id="motivacao<?= $i ?>" value="<?= $i ?>"
                   <?php if ($dados['avaliacao'] && $dados['avaliacao']->getNotaMotivacao() == $i) echo "checked"; ?>>
              <label for="motivacao<?= $i ?>"><i class="bi bi-star-fill"></i></label>
            <?php endfor; ?>
          </div>
          <?php if (isset($dados["erros"]["notaMotivacao"])): ?>
            <small class="text-danger"><?= $dados["erros"]["notaMotivacao"] ?></small>
          <?php endif; ?>

          <!-- Organização -->
          <label class="form-label mt-2">Organização:</label>
          <div class="estrela">
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <input type="radio" name="notaOrganizacao" id="organizacao<?= $i ?>" value="<?= $i ?>"
                   <?php if ($dados['avaliacao'] && $dados['avaliacao']->getNotaOrganizacao() == $i) echo "checked"; ?>>
              <label for="organizacao<?= $i ?>"><i class="bi bi-star-fill"></i></label>
            <?php endfor; ?>
          </div>
          <?php if (isset($dados["erros"]["notaOrganizacao"])): ?>
            <small class="text-danger"><?= $dados["erros"]["notaOrganizacao"] ?></small>
          <?php endif; ?>

        </div>



        <input type="hidden" name="idDisciplina" value="<?= $dados['idDisciplina'] ?>">




        <div class="col-6">


          <!-- Bimestre -->
          <label for="bimestre" class="form-label mt-3">Bimestre:</label>
          <select name="bimestre" id="bimestre" class="form-select">
            <option value="">Selecione</option>
            <option value="1º Bimestre" <?= $dados["avaliacao"] && $dados["avaliacao"]->getBimestre() == AvaliacaoBimestre::PRIMEIRO ? "selected" : "" ?>>1º Bimestre</option>
            <option value="2º Bimestre" <?= $dados["avaliacao"] && $dados["avaliacao"]->getBimestre() == AvaliacaoBimestre::SEGUNDO ? "selected" : "" ?>>2º Bimestre</option>
            <option value="3º Bimestre" <?= $dados["avaliacao"] && $dados["avaliacao"]->getBimestre() == AvaliacaoBimestre::TERCEIRO ? "selected" : "" ?>>3º Bimestre</option>
            <option value="4º Bimestre" <?= $dados["avaliacao"] && $dados["avaliacao"]->getBimestre() == AvaliacaoBimestre::QUARTO ? "selected" : "" ?>>4º Bimestre</option>
          </select>
          <?php if (isset($dados["erros"]["bimestre"])): ?>
            <small class="text-danger"><?= $dados["erros"]["bimestre"] ?></small>
          <?php endif; ?>


          <label for="comentario" class="form-label">Comentário</label>
          <textarea name="comentario" id="comentario" class="form-control" rows="3" placeholder="Escreva um comentário...">
<?= $dados["avaliacao"] ? $dados["avaliacao"]->getComentario() : "" ?></textarea>

          <?php if (isset($dados["erros"]["comentario"])): ?>
            <small class="text-danger"><?= $dados["erros"]["comentario"] ?></small>
          <?php endif; ?>

          <button type="submit" class="btn btn-primary w-100 mt-3">Enviar</button>
        </div>



        

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