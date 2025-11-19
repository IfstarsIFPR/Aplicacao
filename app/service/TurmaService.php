<?php
    
require_once(__DIR__ . "/../model/Turma.php");

class TurmaService {

    public function validarDados(Turma $turma) {
        $erros = array();

        if(! $turma->getAnoTurma())
            $erros['anoTurma'] = "O campo Ano da turma é obrigatório.";

        if(! $turma->getCodigoTurma()) 
            $erros['codigoTurma'] = "O campo Código é obrigatório.";

        if(! $turma->getTurno()) 
            $erros['turno'] = "O campo Turno é obrigatório.";

        if(! $turma->getCurso()) 
            $erros['idCurso'] = "O campo Curso é obrigatório.";

        return $erros;
    }

}


