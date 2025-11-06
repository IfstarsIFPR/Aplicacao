<?php

include_once(__DIR__ . "/../connection/Connection.php");

class TurmaDisciplinaDAO {

    private PDO $conn;

    public function __construct() {
        $this->conn = Connection::getConn();
    }

    // Vincula disciplina a turma
    public function insert($idTurma, $idDisciplina) {
        $sql = "INSERT INTO turmaDisciplina (idTurma, idDisciplina) VALUES (:idTurma, :idDisciplina)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idTurma", $idTurma);
        $stmt->bindParam(":idDisciplina", $idDisciplina);
        return $stmt->execute();
    }

    // Busca disciplinas de uma turma
    public function listByTurma($idTurma) {
        $sql = "SELECT d.* 
                FROM disciplina d 
                INNER JOIN turmaDisciplina td ON d.idDisciplina = td.idDisciplina
                WHERE td.idTurma = :idTurma";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idTurma", $idTurma);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, Disciplina::class);
    }

    //Delete todas as associações de uma disciplina
    public function deleteByDisciplina($idDisciplina) {
        $sql = "DELETE FROM turmaDisciplina WHERE idDisciplina = :idDisciplina";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idDisciplina", $idDisciplina);
        return $stmt->execute();
    }

    // Remove vínculo
    public function deleteByTurmaDisciplina($idTurma, $idDisciplina) {
        $sql = "DELETE FROM turmaDisciplina WHERE idTurma = :idTurma AND idDisciplina = :idDisciplina";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idTurma", $idTurma);
        $stmt->bindParam(":idDisciplina", $idDisciplina);
        return $stmt->execute();
    }
}
