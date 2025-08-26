<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

require_once(__DIR__ . "/../../model/enum/UsuarioTipo.php");

$nome = "(Sessão expirada)";
$isAdmin = false;
$isAluno = false;
$isProfessor = false;

if (isset($_SESSION[SESSAO_USUARIO_NOME])) {
    $nome = $_SESSION[SESSAO_USUARIO_NOME];
}

if (isset($_SESSION[SESSAO_USUARIO_TIPO])) {
    $isAdmin = $_SESSION[SESSAO_USUARIO_TIPO] == UsuarioTipo::ADMIN;
    $isAluno = $_SESSION[SESSAO_USUARIO_TIPO] == UsuarioTipo::ALUNO;
    $isProfessor = $_SESSION[SESSAO_USUARIO_TIPO] == UsuarioTipo::PROFESSOR;
}
?>
<nav class="navbar navbar-expand-md bg-light px-3 mb-3">
    <button class="navbar-toggler" type="button"
        data-bs-toggle="collapse" data-bs-target="#navSite">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navSite">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?= HOME_PAGE ?>">Home</a>
            </li>

            <?php if ($isAdmin): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                        data-bs-toggle="dropdown">
                        Cadastros
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item"
                            href="<?= BASEURL . '/controller/UsuarioController.php?action=list' ?>">Usuários</a>
                        <a class="dropdown-item"
                            href="<?= BASEURL . '/controller/UsuarioController.php?action=create' ?>">Outro cadastro</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                        data-bs-toggle="dropdown">
                        Gerenciar Cursos
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item"
                            href="<?= BASEURL . '/controller/CursoController.php?action=list' ?>">Cursos</a>
                        <a class="dropdown-item"
                            href="<?= BASEURL . '/controller/CursoController.php?action=create' ?>">Adicionar curso</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                        data-bs-toggle="dropdown">
                        Gerenciar Disciplinas
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item"
                            href="<?= BASEURL . '/controller/DisciplinaController.php?action=list' ?>">Disciplinas</a>
                        <a class="dropdown-item"
                            href="<?= BASEURL . '/controller/DisciplinaController.php?action=create' ?>">Adicionar disciplina</a>
                    </div>
                </li>
            <?php endif; ?>

            <?php if ($isAluno): ?>
                <li class="nav-item">
                    <a class="nav-link" href="" > Minhas Turmas </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="" >Minhas Avaliações</a>
                </li>
            <?php endif; ?>

            
            <?php if ($isProfessor): ?>
                <li class="nav-item">
                    <a class="nav-link" href="" > Minhas Disciplinas </a>
                </li>
            <?php endif; ?>

        </ul>

        <ul class="navbar-nav ms-auto mr-3">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarUsuario"
                    data-bs-toggle="dropdown">
                    <?= $nome ?>
                </a>

                <div class="dropdown-menu">
                    <a class="dropdown-item"
                        href="<?= BASEURL . '/controller/PerfilController.php?action=view' ?>">Perfil</a>
                    <a class="dropdown-item" href="<?= LOGOUT_PAGE ?>">Sair</a>
                </div>
            </li>
        </ul>
    </div>
</nav>