<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/CadastroAluno.css">

<div class="container">

    <h3 class="text-center mt-5">
      <!-- <a href="/controller/LoginController.php?action=login" class="btn-voltar position-relative"><i class="bi bi-arrow-left-circle"></i></a>-->
       <?php if ($dados['idUsuario'] == 0) echo "Cadastro";
       else echo "Alterar"; ?>
       Aluno
    </h3>

    <div class="row my-5 justify-content-center align-items-center"> 

        <div class="col-lg-2 col-md-2 text-center d-flex justify-content-center align-items-center">
        <img src="/Aplicacao/app/view/img/logoStars.png" 
             class="logo-aluno" 
             alt="Logo STARS">
         </div>

           <div class="col-md-4 offset-md-2 aluno-form">
            <form id="frmUsuario" method="POST" enctype="multipart/form-data"
                action="<?= BASEURL ?>/controller/CadastroController.php?action=save">

                <div class="mb-3">
                    <label class="form-label" for="txtNome">Nome:</label>
                    <input class="form-control" type="text" id="txtNome" name="nomeUsuario"
                        maxlength="70" placeholder="Informe o nome"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNome() : ''); ?>" />
                    <?php if (isset($dados['erros']['nomeUsuario'])): ?>
                        <small class="text-danger"><?php echo $dados['erros']['nomeUsuario']; ?></small>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtLogin">E-mail:</label>
                    <input class="form-control" type="email" id="txtLogin" name="email"
                        maxlength="70" placeholder="Informe o email"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getEmail() : ''); ?>" />
                    <?php if (isset($dados['erros']['email'])): ?>
                        <small class="text-danger"><?php echo $dados['erros']['email']; ?></small>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtSenha">Senha:</label>
                    <input class="form-control" type="password" id="txtPassword" name="senha"
                        maxlength="15" placeholder="Informe a senha"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getSenha() : ''); ?>" />
                    <?php if (isset($dados['erros']['senha'])): ?>
                        <small class="text-danger"><?php echo $dados['erros']['senha']; ?></small>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtConfSenha">Confirmação da senha:</label>
                    <input class="form-control" type="password" id="txtConfSenha" name="conf_senha"
                        maxlength="15" placeholder="Informe a confirmação da senha"
                        value="<?php echo isset($dados['confSenha']) ? $dados['confSenha'] : ''; ?>" />
                    <?php if (isset($dados['erros']['conf_senha'])): ?>
                        <small class="text-danger"><?php echo $dados['erros']['conf_senha']; ?></small>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtNumMatricula">Número de Matrícula:</label>
                    <input class="form-control" type="text" id="txtNumMatricula" name="numMatricula"
                        maxlength="20" placeholder="Informe o número de matrícula"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNumMatricula() : ''); ?>" />
                    <?php if (isset($dados['erros']['numMatricula'])): ?>
                        <small class="text-danger"><?php echo $dados['erros']['numMatricula']; ?></small>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtdeclaracaoMatricula">Declaração de Matrícula:</label>
                    <input class="form-control" type="file" id="txtdeclaracaoMatricula" name="declaracaoMatricula"
                        maxlength="20" />
                    <?php if (isset($dados['erros']['declaracaoMatricula'])): ?>
                        <small class="text-danger"><?php echo $dados['erros']['declaracaoMatricula']; ?></small>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="selCurso">Curso:</label>
                    <select class="form-select" name="idCurso" id="selCurso">
                        <option value="">Selecione o curso</option>
                        <?php foreach ($dados["cursos"] as $curso): ?>
                            <option value="<?= $curso->getId() ?>"
                                <?php
                                if (
                                    isset($dados["usuario"]) && $dados['usuario']->getCurso() != null &&
                                    $dados["usuario"]->getCurso()->getId() == $curso->getId()
                                )
                                    echo "selected";
                                ?>>
                                <?= $curso->getNome() ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($dados['erros']['idCurso'])): ?>
                        <small class="text-danger"><?php echo $dados['erros']['idCurso']; ?></small>
                    <?php endif; ?>
                </div>


                <input type="hidden" id="hddId" name="idUsuario"
                    value="<?= $dados['idUsuario']; ?>" />

                <div class="mt-12">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
                <div class="register-link">
                    Já possui cadastro? <a href="LoginController.php?action=login">Clique aqui</a>
                </div>
            </form>
        </div>

    </div>
    <div class="col-3">
        <?php require_once(__DIR__ . "/../include/msg.php"); ?>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>