<?php
require_once(__DIR__ . '/../connection/Connection.php');
require_once(__DIR__ . '/../model/Avaliacao.php');

class AvaliacaoDAO {

    public function insert(Avaliacao $avaliacao)  {

        $conn = Connection::getConn();


        try {
        $sql = "INSERT INTO avaliacao 
                (idTurmaAlunos, bimestre, notaClareza, notaDidatica, notaInteracao, notaMotivacao, 
                 notaDominioConteudo, notaOrganizacao, notaRecursos, comentario)
                VALUES (:idTurmaAlunos, :bimestre, :notaClareza, :notaDidatica, :notaInteracao, :notaMotivacao, 
                :notaDominioConteudo, :notaOrganizacao, :notaRecursos, :comentario)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("idTurmaAlunos", $avaliacao->getIdTurmaAlunos());
        $stm->bindValue("bimestre", $avaliacao->getBimestre(), PDO::PARAM_STR);
        $stm->bindValue("notaClareza", $avaliacao->getNotaClareza());
        $stm->bindValue("notaDidatica", $avaliacao->getNotaDidatica());
        $stm->bindValue("notaInteracao", $avaliacao->getNotaInteracao());
        $stm->bindValue("notaMotivacao", $avaliacao->getNotaMotivacao()); 
        $stm->bindValue("notaDominioConteudo", $avaliacao->getNotaDominioConteudo());
        $stm->bindValue("notaOrganizacao", $avaliacao->getNotaOrganizacao()); 
        $stm->bindValue("notaRecursos", $avaliacao->getNotaRecursos());
        $stm->bindValue("comentario", $avaliacao->getComentario(), PDO::PARAM_STR);  
        $stm->execute();
        } catch(Exception $e){
            print $e->getMessage();
        }

        }

    public function list(): array {
        $conn = Connection::getConn();
        $stmt = $conn->prepare("SELECT * FROM avaliacao ORDER BY idAvaliacao DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteById(int $id): void {
        $conn = Connection::getConn();
        $stmt = $conn->prepare("DELETE FROM avaliacao WHERE idAvaliacao = ?");
        $stmt->execute([$id]);
    }
}
