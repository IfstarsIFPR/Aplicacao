<?php

include_once(__DIR__ . "/../connection/Connection.php");

class TurmaAlunoDAO {

    private PDO $conn;

    public function __construct() {
        $this->conn = Connection::getConn();
    }

    // Vincula disciplina a turma
    public function insert($idUsuario, $idTurmaDisciplina) {
        $sql = "INSERT INTO turmaalunos (idUsuario, idTurma) VALUES (:idUsuario, :idTurma)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idUsuario", $idUsuario);
        $stmt->bindParam(":idTurma", $idTurmaDisciplina);
        return $stmt->execute();

    }

    public function obterTurmaPorUsuario($idUsuario) {
        $sql = "SELECT idTurma FROM turmaalunos WHERE idUsuario = :idUsuario LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idUsuario", $idUsuario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } 

    public function mapTurmas($result) {
        $turmas = array();
        foreach ($result as $reg) {
            $turma = new Turma();
            $turma->setId($reg['idTurma']);
            $turma->setAnoTurma($reg['anoTurma']);
            $turma->setCodigoTurma($reg['codigoTurma']);
            $turma->setTurno($reg['turno']);
    
            if($reg["idCurso"] != NULL) {
                $cursoDAO = new CursoDAO();
                $curso = $cursoDAO->findById($reg["idCurso"]); // Busca o curso completo
                $turma->setCurso($curso);
            } else {
                $turma->setCurso(NULL);
}
            array_push($turmas, $turma);
        }

        return $turmas; 
    }
    

}