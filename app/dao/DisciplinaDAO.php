<?php
#Nome do arquivo: CursoDAO.php
#Objetivo: classe DAO para o model de Turma

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Disciplina.php");
include_once(__DIR__ . "/../dao/TurmaDAO.php");
include_once(__DIR__ . "/../dao/TurmaDisciplinaDAO.php");


class DisciplinaDAO {

    //Método para listar as disciplinas a partir da base de dados
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM disciplina d ORDER BY d.nomeDisciplina";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapDisciplinas($result);
        
    }

    //Método para buscar um usuário por seu ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM disciplina d" .
               " WHERE d.idDisciplina = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $disciplinas = $this->mapDisciplinas($result);

        if(count($disciplinas) == 1)
            return $disciplinas[0];
        elseif(count($disciplinas) == 0)
            return null;

        die("DisciplinaDAO.findById()" . 
            " - Erro: mais de uma disciplina encontrada.");
    }

    public function findDisciplinasByTurmaId($idTurma) {
        $conn = Connection::getConn();

        if (!isset($_GET["idTurma"])) {
            return null;
        }

        $idTurma = $_GET["idTurma"];

        $sql = "SELECT d.* FROM disciplina d " .
               "JOIN turmadisciplina td ON d.idDisciplina = td.idDisciplina " .
               "WHERE td.idTurma = :idTurma " .
               "ORDER BY d.nomeDisciplina";

        $stm = $conn->prepare($sql);
        $stm->bindValue("idTurma", $idTurma);
        $stm->execute();
        $result = $stm->fetchAll();

        $disciplinas = $this->mapDisciplinas($result);

        return $disciplinas;

    }

    public function findTurmasByDisciplinaId($idDisciplina) {
    $conn = Connection::getConn();

    $sql = "SELECT t.* FROM turma t
            JOIN turmadisciplina td ON t.idTurma = td.idTurma
            WHERE td.idDisciplina = :idDisciplina";

    $stm = $conn->prepare($sql);
    $stm->bindValue("idDisciplina", $idDisciplina);
    $stm->execute();
    $result = $stm->fetchAll();

    $turmaDao = new TurmaDAO();
    return $turmaDao->mapTurmas($result);
}

     //Método para inserir um Usuario
    public function insert(Disciplina $disciplina, array $turmasIds) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO disciplina (nomeDisciplina)" .
               " VALUES (:nomeDisciplina)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("nomeDisciplina", $disciplina->getNomeDisciplina());
        $stm->execute();

        $lastId = $conn->lastInsertId();

        // Inserir os relacionamentos ManyToMany na tabela disciplina_turma
        if (!empty($turmasIds)) {   
            
            $sqlRel = "INSERT INTO turmadisciplina (idDisciplina, idTurma, idProfessor) VALUES (:disciplina_id, :turma_id, 4)";
            $stmRel = $conn->prepare($sqlRel);

            foreach ($turmasIds as $turmaId) {
                $stmRel->bindValue("disciplina_id", $lastId);
                $stmRel->bindValue("turma_id", $turmaId);
                $stmRel->execute();
            }
        }

    }

      //Método para atualizar um Usuario
    public function update(Disciplina $disciplina) {
        $conn = Connection::getConn();

        $sql = "UPDATE disciplina SET nomeDisciplina = :nomeDisciplina" .
               " WHERE idDisciplina = :id";
        
        $stm = $conn->prepare($sql);;
        $stm->bindValue("nomeDisciplina", $disciplina->getNomeDisciplina());
        $stm->bindValue("id", $disciplina->getId());
        $stm->execute();
    }

    //Método para excluir uma Turma pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        // Primeiro, excluir os vínculos na tabela turmaDisciplina
        $turmaDisciplinaDAO = new TurmaDisciplinaDAO();
        $turmaDisciplinaDAO->deleteByDisciplina($id);
        // Depois, excluir a disciplina

        $sql = "DELETE FROM disciplina WHERE idDisciplina = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

     private function mapDisciplinas($result) {
        $disciplinas = array();
        foreach ($result as $reg) {
            $disciplina = new Disciplina();
            $disciplina->setId($reg['idDisciplina']);
            $disciplina->setNomeDisciplina($reg['nomeDisciplina']);
    
            array_push($disciplinas, $disciplina);
        }

        return $disciplinas;
    }
    


}