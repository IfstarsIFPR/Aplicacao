<?php
    
require_once(__DIR__ . "/../model/Curso.php");

class CursoService {

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Curso $curso) {
        $erros = array();

        //Validar campos vazios
        if(! $curso->getNome())
            array_push($erros, "O campo [Nome] é obrigatório.");
        
        if(! $curso->getNivel()) 
            array_push($erros, "O campo [Nivel] é obrigatório");

        return $erros;
    }


}
