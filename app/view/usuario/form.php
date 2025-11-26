<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">
<h3 class="text-center mt-5">
    <?php if ($dados['idUsuario'] == 0) echo "Inserir";
    else echo "Alterar"; ?>
    Professor
</h3>

<div class="row">
    <div class="container">
        <div class="form-container d-flex justify-content-center">
            <div class="form" style="border-radius: 20px">

                <form id="frmUsuario" method="POST"
                    action="<?= BASEURL ?>/controller/UsuarioController.php?action=save">

                    <!-- NOME -->
                    <div class="mb-3">
                        <label class="form-label" for="txtNome">Nome:</label>
                        <input class="form-control" type="text" id="txtNome" name="nomeUsuario"
                            maxlength="70" placeholder="Informe o nome"
                            value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNome() : ''); ?>" />

                        <?php if (!empty($dados['erros']['nomeUsuario'])): ?>
                            <div class="text-danger small mt-1">
                                <?= $dados['erros']['nomeUsuario']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label class="form-label" for="txtLogin">E-mail:</label>
                        <input class="form-control" type="email" id="txtLogin" name="email"
                            maxlength="70" placeholder="Informe o login"
                            value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getEmail() : ''); ?>" />

                        <?php if (!empty($dados['erros']['email'])): ?>
                            <div class="text-danger small mt-1">
                                <?= $dados['erros']['email']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- SENHA -->
                    <div class="mb-3">
                        <label class="form-label" for="txtSenha">Senha:</label>
                        <input class="form-control" type="password" id="txtPassword" name="senha"
                            maxlength="15" placeholder="Informe a senha"
                            value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getSenha() : ''); ?>" />

                        <?php if (!empty($dados['erros']['senha'])): ?>
                            <div class="text-danger small mt-1">
                                <?= $dados['erros']['senha']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- CONFIRMAR SENHA -->
                    <div class="mb-3">
                        <label class="form-label" for="txtConfSenha">Confirmação da senha:</label>
                        <input class="form-control" type="password" id="txtConfSenha" name="conf_senha"
                            maxlength="15" placeholder="Informe a confirmação da senha"
                            value="<?php echo isset($dados['confSenha']) ? $dados['confSenha'] : ''; ?>" />

                        <?php if (!empty($dados['erros']['conf_senha'])): ?>
                            <div class="text-danger small mt-1">
                                <?= $dados['erros']['conf_senha']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- SIAPE -->
                    <div class="mb-3">
                        <label class="form-label" for="txtSiape">Siape:</label>
                        <input class="form-control" type="text" id="txtSiape" name="siape"
                            maxlength="15" placeholder="Informe o número do siape"
                            value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getSiape() : ''); ?>" />

                        <?php if (!empty($dados['erros']['siape'])): ?>
                            <div class="text-danger small mt-1">
                                <?= $dados['erros']['siape']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <input type="hidden" id="hddId" name="idUsuario"
                        value="<?= $dados['idUsuario']; ?>" />

                    <div class="mt-12">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>

                </form>
            </div>
        </div>

        <div class="col-6">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
