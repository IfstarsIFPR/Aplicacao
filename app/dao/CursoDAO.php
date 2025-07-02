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