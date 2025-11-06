<?php

require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/enum/UsuarioTipo.php");


class UsuarioService
{

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Usuario $usuario, ?string $confSenha)
    {
        $erros = [];

        // Campos obrigatórios
        if (!$usuario->getNome())
            $erros['nomeUsuario'] = "O campo Nome é obrigatório.";

        if (!$usuario->getEmail())
            $erros['email'] = "O campo E-mail é obrigatório.";

        if (!$usuario->getSenha())
            $erros['senha'] = "O campo Senha é obrigatório.";

        if (!$confSenha)
            $erros['conf_senha'] = "O campo Confirmação da senha é obrigatório.";

        if ($usuario->getSenha() && $confSenha && $usuario->getSenha() != $confSenha)
            $erros['conf_senha'] = "O campo Confirmação de senha deve ser igual ao da senha.";

        if (!$usuario->getTipousuario()) {
            $erros['tipousuario'] = "O campo Tipo usuário é obrigatório.";
            return $erros;
        }

        if ($usuario->getTipousuario() == UsuarioTipo::ALUNO) {

            if (!$usuario->getDeclaracaoMatricula())
                $erros['declaracaoMatricula'] = "O campo Declaração de Matrícula é obrigatório.";

            if (!$usuario->getNumMatricula())
                $erros['numMatricula'] = "O campo Número de Matrícula é obrigatório.";

            if (!$usuario->getCurso())
                $erros['idCurso'] = "O campo Curso é obrigatório.";
        }

        if ($usuario->getTipousuario() == UsuarioTipo::PROFESSOR) {
            if (!$usuario->getSiape())
                $erros['siape'] = "O campo SIAPE é obrigatório.";
        }

        return $erros;
    }




    /* Método para validar se o usuário selecionou uma foto de perfil */
    public function validarFotoPerfil(array $foto)
    {
        $erros = array();

        if ($foto['size'] <= 0)
            array_push($erros, "Informe a foto para o perfil!");

        return $erros;
    }
}
