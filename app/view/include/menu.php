<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

require_once(__DIR__ . "/../../model/enum/UsuarioTipo.php");
require_once(__DIR__ . "/../../dao/TurmaAlunoDAO.php");


$nome = "(Sessão expirada)";
$isAdmin = false;
$isAluno = false;
$isProfessor = false;
$idUsuario = $_SESSION[SESSAO_USUARIO_ID] ?? 0;

if (isset($_SESSION[SESSAO_USUARIO_NOME])) {
    $nome = $_SESSION[SESSAO_USUARIO_NOME];
}

if (isset($_SESSION[SESSAO_USUARIO_TIPO])) {
    $isAdmin = $_SESSION[SESSAO_USUARIO_TIPO] == UsuarioTipo::ADMIN;
    $isAluno = $_SESSION[SESSAO_USUARIO_TIPO] == UsuarioTipo::ALUNO;
    $isProfessor = $_SESSION[SESSAO_USUARIO_TIPO] == UsuarioTipo::PROFESSOR;
}

/*if ($isAluno) {
    $idUsuario = $_SESSION[SESSAO_USUARIO_ID] ?? 0;

    $turmaDao = new TurmaAlunoDAO();
    $idTurma = $turmaDao->obterTurmaPorUsuario($idUsuario)['idTurma'];
}*/

if ($isAluno) {
    $idUsuario = $_SESSION[SESSAO_USUARIO_ID] ?? 0;

    $turmaDao = new TurmaAlunoDAO();
    $turma = $turmaDao->obterTurmaPorUsuario($idUsuario);

    if ($turma && isset($turma['idTurma'])) {
        $idTurma = $turma['idTurma'];
    } else {
        $idTurma = 0; // caso o aluno ainda não tenha turma ou retorne false
    }
}




?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/menu.css">

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">
    <div class="container-fluid">


        <a class="navbar-brand d-flex align-items-center" href="<?= HOME_PAGE ?>">
            <img src="<?= BASEURL ?>/view/img/logoStars.png" alt="Logo" class="navbar-logo me-2">
        </a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navSite">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if ($isAdmin): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownCadastros" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Cadastros
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownCadastros">
                            <li><a class="dropdown-item"
                                    href="<?= BASEURL . '/controller/UsuarioController.php?action=list' ?>">Usuários</a></li>
                            <li><a class="dropdown-item"
                                    href="<?= BASEURL . '/controller/UsuarioController.php?action=create' ?>">Outro cadastro</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownCursos" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Gerenciar Cursos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownCursos">
                            <li><a class="dropdown-item"
                                    href="<?= BASEURL . '/controller/CursoController.php?action=list' ?>">Cursos</a></li>
                            <li><a class="dropdown-item"
                                    href="<?= BASEURL . '/controller/CursoController.php?action=create' ?>">Adicionar curso</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownDisciplinas" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Gerenciar Disciplinas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownDisciplinas">
                            <li><a class="dropdown-item"
                                    href="<?= BASEURL . '/controller/DisciplinaController.php?action=list' ?>">Disciplinas</a></li>
                            <li><a class="dropdown-item"
                                    href="<?= BASEURL . '/controller/DisciplinaController.php?action=create' ?>">Adicionar disciplina</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if ($isAluno): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL . '/controller/TurmaDisciplinaController.php?action=list&idTurma=' . $idTurma ?>">Minhas Turmas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Minhas Avaliações</a>
                    </li>
                <?php endif; ?>

                <?php if ($isProfessor): ?>
                    <li class="nav-item"><a class="nav-link" href="#">Minhas Disciplinas</a></li>
                <?php endif; ?>

            </ul>
            <ul class="navbar-nav ms-auto mr-3">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarUsuario"
                        data-bs-toggle="dropdown">
                    </a>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarUsuario"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar"><?= strtoupper(substr($nome, 0, 2)) ?></div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUsuario">
                        <li><a class="dropdown-item" href="<?= BASEURL . '/controller/PerfilController.php?action=view' ?>">Perfil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="<?= LOGOUT_PAGE ?>">Sair</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>