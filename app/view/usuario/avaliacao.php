<?php
require_once(__DIR__ . "/../../model/enum/AvaliacaoBimestre.php");

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/avaliacao.css">

<div class="container avaliacao-container">


  <h2 class="text-center mt-5 text-white">
   <!--<a href="/controller/TurmaDisciplinaController.php?action=list&idTurma=2" class="btn-voltar position-relative"><i class="bi bi-arrow-left-circle"></i></a> -->
    📊 Avaliação do(a) Professor(a):
  </h2>

  <h4 class="text-center text-white nome-professor mb-5"><?=  $dados['professor']->getNome() ?></h4>

  <form method="POST" action="<?= BASEURL ?>/controller/AvaliacaoController.php?action=save">

    <input type="hidden" name="idAvaliacao" value="0">

    <div class="row">
      <div class="col-md-4 estrelas-container">

        <!-- Clareza -->
        <span class="info-icon" data-info="Capacidade do professor de transmitir o conteúdo de forma compreensível.">i</span>
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
        <span class="info-icon" data-info="Nível de conhecimento e segurança demonstrado pelo professor ao abordar os temas da disciplina.">i</span>
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
        <span class="info-icon" data-info="Forma como o professor organiza e apresenta o conteúdo, facilitando o processo de aprendizagem.">i</span>
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
        <span class="info-icon" data-info="Comunicação entre professor e alunos, promovendo participação e esclarecimento de dúvidas.">i</span>
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
        <span class="info-icon" data-info="Emprego adequado de materiais e ferramentas que auxiliam na compreensão do conteúdo.">i</span>
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
        <span class="info-icon" data-info="Capacidade do professor de estimular o interesse e o engajamento dos alunos durante as aulas.">i</span>
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
        <span class="info-icon" data-info="Planejamento das aulas e estruturação clara do conteúdo, atividades e avaliações.">i</span>
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

      <div class="forms col-md-6 offset-md-2 lado-direito">

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

        <label for="comentario" class="form-label mt-3">Comentário</label>
        <textarea name="comentario" id="comentario" class="form-control" rows="3" placeholder="Escreva um comentário...">
<?= $dados["avaliacao"] ? $dados["avaliacao"]->getComentario() : "" ?></textarea>
        <?= $dados["avaliacao"] ? $dados["avaliacao"]->getComentario() : "" ?>
        </textarea>

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

<script>
  function mostrarDescricao(id) {
    const div = document.getElementById(id);
    div.style.display = (div.style.display === "none") ? "block" : "none";
  }
</script>

<?php
require_once(__DIR__ .  "/../include/footer.php");
?>