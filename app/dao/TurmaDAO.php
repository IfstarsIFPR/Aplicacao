<?php
#Nome do arquivo: CursoDAO.php
#Objetivo: classe DAO para o model de Turma

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Turma.php");
include_once(__DIR__ . "/../dao/CursoDAO.php");



class TurmaDAO {

    //Método para listar os usuaários a partir da base de dados
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM turma t ORDER BY t.anoTurma";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapTurmas($result);
        
    }

    public function listByCurso(int $idCurso) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM turma t WHERE t.idCurso = :idCurso ORDER BY t.anoTurma";
        $stm = $conn->prepare($sql); 
        $stm->bindValue("idCurso", $idCurso);   
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapTurmas($result);
        
    }

    //Método para buscar um usuário por seu ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM turma t" .
               " WHERE t.idTurma = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapTurmas($result);

        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("TurmaDAO.findById()" . 
            " - Erro: mais de uma turma encontrada.");
    }

    //Método para inserir um Usuario
    public function insert(Turma $turma) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO turma (anoTurma, codigoTurma, turno, idCurso)" .
               " VALUES (:anoTurma, :codigoTurma, :turno, :idCurso)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("anoTurma", $turma->getAnoTurma());
        $stm->bindValue("codigoTurma", $turma->getCodigoTurma());
        $stm->bindValue("turno", $turma->getTurno());
        $stm->bindValue("idCurso", ($turma->getCurso() ? $turma->getCurso()->getId() : NULL));
        $stm->execute();
    }

     //Método para atualizar um Usuario
    public function update(Turma $turma) {
        $conn = Connection::getConn();

        $sql = "UPDATE turma SET anoTurma = :anoTurma," . 
              " codigoTurma = :codigoTurma," .  " turno = :turno," . " idCurso = :idCurso" .
               " WHERE idTurma = :id";
        
        $stm = $conn->prepare($sql);;
        $stm->bindValue("anoTurma", $turma->getAnoTurma());
        $stm->bindValue("codigoTurma", $turma->getCodigoTurma());
        $stm->bindValue("turno", $turma->getTurno());
        $stm->bindValue("idCurso", ($turma->getCurso() ? $turma->getCurso()->getId() : NULL));
        $stm->bindValue("id", $turma->getId());
        $stm->execute();
    }

      //Método para excluir uma Turma pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM turma WHERE idTurma = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
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