<?php
require_once(__DIR__ . '/../connection/Connection.php');
require_once(__DIR__ . '/../model/Avaliacao.php');

class AvaliacaoDAO
{

    public function insert(Avaliacao $avaliacao)
    {
        $conn = Connection::getConn();

        try {
            $sql = "INSERT INTO avaliacao (
                    idAluno, 
                    idProfessor,
                    idDisciplina,
                    bimestre, 
                    notaClareza, 
                    notaDidatica, 
                    notaInteracao, 
                    notaMotivacao, 
                    notaDominioConteudo, 
                    notaOrganizacao, 
                    notaRecursos, 
                    comentario
                ) VALUES (
                    :idAluno,
                    :idProfessor,
                    :idDisciplina,
                    :bimestre, 
                    :notaClareza, 
                    :notaDidatica, 
                    :notaInteracao, 
                    :notaMotivacao, 
                    :notaDominioConteudo, 
                    :notaOrganizacao, 
                    :notaRecursos, 
                    :comentario
                )";

            $stm = $conn->prepare($sql);

            // Bind dos parâmetros
            $stm->bindValue(":idAluno", $avaliacao->getIdAluno(), PDO::PARAM_INT);
            $stm->bindValue(":idProfessor", $avaliacao->getProfessor()->getId(), PDO::PARAM_INT);
            $stm->bindValue(":idDisciplina", $avaliacao->getIdDisciplina(), PDO::PARAM_INT);
            $stm->bindValue(":bimestre", $avaliacao->getBimestre(), PDO::PARAM_STR);
            $stm->bindValue(":notaClareza", $avaliacao->getNotaClareza());
            $stm->bindValue(":notaDidatica", $avaliacao->getNotaDidatica());
            $stm->bindValue(":notaInteracao", $avaliacao->getNotaInteracao());
            $stm->bindValue(":notaMotivacao", $avaliacao->getNotaMotivacao());
            $stm->bindValue(":notaDominioConteudo", $avaliacao->getNotaDominioConteudo());
            $stm->bindValue(":notaOrganizacao", $avaliacao->getNotaOrganizacao());
            $stm->bindValue(":notaRecursos", $avaliacao->getNotaRecursos());
            $stm->bindValue(":comentario", $avaliacao->getComentario(), PDO::PARAM_STR);

            $stm->execute();

            // Opcional: retornar o ID inserido (caso precise)
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            // Mais seguro e legível do que "print"
            throw new Exception("Erro ao salvar a avaliação no banco de dados: " . $e->getMessage());
        }
    }

    public function list(): array
    {
        $conn = Connection::getConn();
        $stmt = $conn->prepare("SELECT * FROM avaliacao ORDER BY idAvaliacao DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listByAlunoId(int $idAluno): array
    {
        $conn = Connection::getConn();
        $stmt = $conn->prepare("SELECT * FROM avaliacao WHERE idAluno = ? ORDER BY idAvaliacao DESC");
        $stmt->execute([$idAluno]);

        //TODO : Ajustar para retornar objetos Avaliacao - Padrao MAP usado nas outras DAOS

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteById(int $id): void
    {
        $conn = Connection::getConn();
        $stmt = $conn->prepare("DELETE FROM avaliacao WHERE idAvaliacao = ?");
        $stmt->execute([$id]);
    }


    //TODO: Implementar método de atualização
    public function update()
    {
        return null;
    }
}
