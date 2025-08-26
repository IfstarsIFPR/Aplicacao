<?php
    
require_once(__DIR__ . "/../model/Disciplina.php");

class DisciplinaService {

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Disciplina $disciplina) {
        $erros = array();

        //Validar campos vazios
        if(! $disciplina->getNomeDisciplina())
            array_push($erros, "O campo [Nome] é obrigatório.");


        return $erros;
    }


}