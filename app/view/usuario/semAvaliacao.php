<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/semAvaliacao1.css">

<div class="container container-nulo mt-5">

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
    <div class="sem-avaliacao-box">

        <img src="<?= BASEURL ?>/view/img/pessoas_lupa.png" class="sem-avaliacao-img" alt="Sem Avaliações">

        <h2>Ainda não foram feitas avaliações!</h2>

    </div>
    <div class="text-center mt-4">
        <a href="<?= BASEURL ?>/controller/TurmaDisciplinaController.php?action=minhasDisciplinasProfessor"
            class="btn-voltar">
            Voltar
        </a>
    </div>

</div>

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