<?php
#Nome do arquivo: login/login.php
#Objetivo: interface para logar no sistema
require_once(__DIR__ . "/../include/header.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/login.css">

<div class="login-container">

    <div class="login-info">
        <img src="/Aplicacao/app/view/img/logoStars.png" alt="Logo STARS" />
        <p style="margin-top: 10px; font-size: 25px;">
            Sistema de feedbacks de alunos sobre professores do IFPR - Campus Foz do Iguaçu.
        </p>

        <div class="illustration">
            <img style="max-width: 1200px;" src="/Aplicacao/app/view/img/mulherestrela1.png" alt="Ilustração">
        </div>

    </div>

    <div class="login-form">
        <h2>Login</h2>
        <form id="frmLogin" action="./LoginController.php?action=logon" method="POST">

            <div class="mb-3">
                <label for="txtLogin" class="form-label">E-mail:</label>
                <input type="text" name="email" id="txtLogin" class="form-control"
                    maxlength="50" placeholder="Informe o e-mail"
                    value="<?php echo isset($dados['email']) ? $dados['email'] : '' ?>" />
                <?php if (isset($dados['erros']['email'])): ?>
                    <small class="text-danger"><?php echo $dados['erros']['email']; ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="txtSenha" class="form-label">Senha:</label>
                <input type="password" name="senha" id="txtSenha" class="form-control"
                    maxlength="50" placeholder="Informe a senha"
                    value="<?php echo isset($dados['senha']) ? $dados['senha'] : '' ?>" />
                <?php if (isset($dados['erros']['senha'])): ?>
                    <small class="text-danger"><?php echo $dados['erros']['senha']; ?></small>
                <?php endif; ?>
                <?php if (isset($dados['erros']['status'])): ?>
                    <small class="text-danger"><?php echo $dados['erros']['status']; ?></small>
                <?php endif; ?>
            </div>


            <button type="submit" class="btn btn-login">Entrar</button>
            <div class="mt-3">
                <?php include_once(__DIR__ . "/../include/msg.php") ?>
            </div>

            <div class="register-link">
                Não possui cadastro? <a href="CadastroController.php?action=create">Clique aqui</a>
            </div>
        </form>
    </div>
</div>
<?php
require_once(__DIR__ . "/../include/footer.php");
?>