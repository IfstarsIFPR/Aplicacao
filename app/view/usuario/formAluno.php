<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<h3 class="text-center">
    <?php if($dados['idUsuario'] == 0) echo "Cadastro"; else echo "Alterar"; ?> 
    Aluno
</h3>

<div class="container">
    
    <div class="row" style="margin-top: 10px;">
        
        <div class="col-6">
            <form id="frmUsuario" method="POST" 
                action="<?= BASEURL ?>/controller/CadastroController.php?action=save" >
                <div class="mb-3">
                    <label class="form-label" for="txtNome">Nome:</label>
                    <input class="form-control" type="text" id="txtNome" name="nomeUsuario" 
                        maxlength="70" placeholder="Informe o nome"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNome() : ''); ?>" />
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="txtLogin">E-mail:</label>
                    <input class="form-control" type="email" id="txtLogin" name="email" 
                        maxlength="70" placeholder="Informe o email"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getEmail() : ''); ?>"/>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtSenha">Senha:</label>
                    <input class="form-control" type="password" id="txtPassword" name="senha" 
                        maxlength="15" placeholder="Informe a senha"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getSenha() : ''); ?>"/>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtConfSenha">Confirmação da senha:</label>
                    <input class="form-control" type="password" id="txtConfSenha" name="conf_senha" 
                        maxlength="15" placeholder="Informe a confirmação da senha"
                        value="<?php echo isset($dados['confSenha']) ? $dados['confSenha'] : '';?>"/>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtNumMatricula">Matrícula:</label>
                    <input class="form-control" type="text" id="txtNumMatricula" name="numMatricula" 
                        maxlength="20" placeholder="Informe o número de matrícula"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNumMatricula() : ''); ?>"/>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="selTipoUsuario">Tipo usuário:</label>
                    <select class="form-select" name="tipoUsuario" id="selTipoUsuario">
                        <option value="">Selecione o tipo de usuário</option>
                        <?php foreach($dados["tiposUsuario"] as $tipoUsuario): ?>
                            <option value="<?= $tipoUsuario ?>" 
                                <?php 
                                    if(isset($dados["usuario"]) && $dados["usuario"]->getTipoUsuario() == $tipoUsuario) 
                                        echo "selected";
                                ?>    
                            >
                                <?= $tipoUsuario ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="selCurso">Curso:</label>
                    <select class="form-select" name="idCurso" id="selCurso">
                        <option value="">Selecione o curso</option>
                        <?php foreach($dados["cursos"] as $curso): ?>
                            <option value="<?= $curso->getId() ?>" 
                                <?php 
                                    if(isset($dados["usuario"]) && $dados['usuario']->getCurso() != null && 
                                        $dados["usuario"]->getCurso()->getId() == $curso->getId()) 
                                        echo "selected";

                                ?>    
                            >
                                <?= $curso->getNome() ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <input type="hidden" id="hddId" name="idUsuario" 
                    value="<?= $dados['idUsuario']; ?>" />

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Gravar</button>
                </div>
            </form>            
        </div>

        <div class="col-6">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 30px;">
        <div class="col-12">
        <a class="btn btn-secondary" 
                href="<?= BASEURL ?>/controller/LoginController.php?action=login">Voltar</a>
        </div>
    </div>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>