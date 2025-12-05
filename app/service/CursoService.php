<?php

require_once(__DIR__ . "/../model/Curso.php");

class CursoService
{

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Curso $curso)
    {
        $erros = array();

        //Validar campos vazios
        if (! $curso->getNome())
            $erros['nomeCurso'] = "O campo nome é obrigatório.";

        if (! $curso->getNivel())
            $erros['nivel'] = "O campo nível é obrigatório.";


        return $erros;
    }
}
