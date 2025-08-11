<?php
#Nome do arquivo: CursoDAO.php
#Objetivo: classe DAO para o model de Turma

include_once(__DIR__ . "/../connection/Connection.php");

class TurmaDAO {

    //Método para listar os usuaários a partir da base de dados
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM turma t";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();

        return $result;
        
    }

}