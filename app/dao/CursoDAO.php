<?php
#Nome do arquivo: CursoDAO.php
#Objetivo: classe DAO para o model de Curso

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Curso.php");

class CursoDAO {

    //Método para listar os usuaários a partir da base de dados
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM curso c ORDER BY c.nomeCurso";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapCursos($result);
    }

    //Método para buscar um usuário por seu ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM curso c" .
               " WHERE u.idCurso = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $cursos = $this->mapCursos($result);

        if(count($cursos) == 1)
            return $cursos[0];
        elseif(count($cursos) == 0)
            return null;

        die("CursoDAO.findById()" . 
            " - Erro: mais de um curso encontrado.");
    }
     //Método para inserir um Usuario
    public function insert(Curso $curso) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO curso (nomeCurso, nivel)" .
               " VALUES (:nomeCurso, :nivel)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("nomeCurso", $curso->getNome());
        $stm->bindValue("nivel", $curso->getNivel());
        $stm->execute();
    }

    //Método para atualizar um Usuario
    public function update(Curso $curso) {
        $conn = Connection::getConn();

        $sql = "UPDATE curso SET nomeCurso = :nomeCurso," . 
              " nivel = :nivel," .
               " WHERE idCurso = :id";
        
        $stm = $conn->prepare($sql);;
        $stm->bindValue("nomeCurso", $curso->getNome());
        $stm->bindValue("nivel", $curso->getNivel());
        $stm->bindValue("id", $curso->getId());
        $stm->execute();
    }
    //Método para excluir um Usuario pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM curso WHERE idCurso = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }


    //Método para converter um registro da base de dados em um objeto Curso
    private function mapCursos($result) {
        $cursos = array();
        foreach ($result as $reg) {
            $curso = new Curso();
            $curso->setId($reg['idCurso']);
            $curso->setNome($reg['nomeCurso']);
            $curso->setNivel($reg['nivel']);
            
            array_push($cursos, $curso);
        }

        return $cursos;
    }

}