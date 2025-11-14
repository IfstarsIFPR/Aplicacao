<?php

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/TurmaDisciplina.php");


class TurmaDisciplinaDAO
{

    private PDO $conn;
    private CursoDAO $cursoDAO;

    public function __construct()
    {
        $this->conn = Connection::getConn();
        $this->cursoDAO = new CursoDAO();
    }

    // Vincula disciplina a turma
    public function insert($idTurma, $idDisciplina)
    {
        $sql = "INSERT INTO turmaDisciplina (idTurma, idDisciplina) VALUES (:idTurma, :idDisciplina)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idTurma", $idTurma);
        $stmt->bindParam(":idDisciplina", $idDisciplina);
        return $stmt->execute();
    }

    // Busca disciplinas de uma turma
    public function listByTurma($idTurma)
    {
        $sql = "SELECT d.* 
                FROM disciplina d 
                INNER JOIN turmaDisciplina td ON d.idDisciplina = td.idDisciplina
                WHERE td.idTurma = :idTurma";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idTurma", $idTurma);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, Disciplina::class);
    }


    // Busca disciplinas de uma turma
    public function listByDisciplina($idDiscipina)
    {
        $sql = "SELECT td.idTurmaDisciplina,
                t.idTurma, t.anoTurma, t.codigoTurma, t.turno, t.idCurso,
                td.idDisciplina, 
                u.idUsuario, u.nomeUsuario, u.siape 
                FROM turmaDisciplina td 
                INNER JOIN turma t ON (t.idTurma = td.idTurma)
                INNER JOIN usuario u ON (u.idUsuario = td.idProfessor) 
                WHERE td.idDisciplina = :idDiscipina";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idDiscipina", $idDiscipina);
        $stmt->execute();
        return $this->mapTurmaDisciplina($stmt->fetchAll());
    }

    public function findTurmaDisciplinaById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "SELECT td.idTurmaDisciplina,
                t.idTurma, t.anoTurma, t.codigoTurma, t.turno, t.idCurso,
                td.idDisciplina, 
                u.idUsuario, u.nomeUsuario, u.siape
                FROM turmaDisciplina td
                INNER JOIN turma t ON t.idTurma = td.idTurma
                INNER JOIN usuario u ON u.idUsuario = td.idProfessor
                WHERE td.idTurmaDisciplina = :id";
        $stm = $conn->prepare($sql);
        
        $stm->bindParam(":id", $id);

        $stm->execute();

        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $turmaDisciplinas = $this->mapTurmaDisciplina($result);

        if (count($turmaDisciplinas) == 1)
            return $turmaDisciplinas[0];
        elseif (count($turmaDisciplinas) == 0)
            return null;

        die("TurmaDisciplinaDAO.findById()" .
            " - Erro: mais de uma disciplina encontrada.");
    }


    //Delete todas as associações de uma disciplina
    public function deleteByDisciplina($idDisciplina)
    {
        $sql = "DELETE FROM turmaDisciplina WHERE idDisciplina = :idDisciplina";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idDisciplina", $idDisciplina);
        return $stmt->execute();
    }

    // Remove vínculo
    public function deleteByTurmaDisciplina($idTurma, $idDisciplina)
    {
        $sql = "DELETE FROM turmaDisciplina WHERE idTurma = :idTurma AND idDisciplina = :idDisciplina";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idTurma", $idTurma);
        $stmt->bindParam(":idDisciplina", $idDisciplina);
        return $stmt->execute();
    }

    public function mapTurmaDisciplina($result)
    {
        $turmasDisc = array();
        foreach ($result as $reg) {
            $turmaDisc = new TurmaDisciplina();
            $turmaDisc->setId($reg['idTurmaDisciplina']);

            //Disciplina
            $disc = new Disciplina();
            $disc->setId($reg['idDisciplina']);
            $turmaDisc->setDisciplina($disc);

            //Turma
            $turma = new Turma();
            $turma->setId($reg['idTurma']);
            $turma->setAnoTurma($reg['anoTurma']);
            $turma->setCodigoTurma($reg['codigoTurma']);
            $turma->setTurno($reg['turno']);

            if ($reg["idCurso"] != NULL) {
                $curso = $this->cursoDAO->findById($reg["idCurso"]); // Busca o curso completo
                $turma->setCurso($curso);
            } else {
                $turma->setCurso(NULL);
            }
            $turmaDisc->setTurma($turma);

            //Professor
            $usuario = new Usuario();
            $usuario->setId($reg['idUsuario']);
            $usuario->setNome($reg['nomeUsuario']);
            $usuario->setSiape($reg['siape']);
            $turmaDisc->setProfessor($usuario);

            array_push($turmasDisc, $turmaDisc);
        }

        return $turmasDisc;
    }
}
