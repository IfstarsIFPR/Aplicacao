<?php
    
require_once(__DIR__ . "/../model/Turma.php");

class TurmaService {

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Turma $turma) {
        $erros = array();

        //Validar campos vazios
        if(! $turma->getAnoTurma())
            array_push($erros, "O campo [Ano da turma] é obrigatório.");
        
        if(! $turma->getCodigoTurma()) 
            array_push($erros, "O campo [Código] é obrigatório");

        if(! $turma->getTurno()) 
            array_push($erros, "O campo [Turno] é obrigatório");

        if(! $turma->getCurso()) 
            array_push($erros, "O campo [Curso] é obrigatório");

        return $erros;
    }


}
