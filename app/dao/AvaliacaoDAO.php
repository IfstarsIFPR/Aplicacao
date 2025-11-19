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
                    idTurma,
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
                    :idTurma,
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
            $stm->bindValue(":idTurma", $avaliacao->getTurma()->getId(), PDO::PARAM_INT);
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

    public function listDisciplinasAvaliadas(int $idAluno): array
    {
        $conn = Connection::getConn();
        $sql = "SELECT DISTINCT d.idDisciplina, d.nomeDisciplina
        FROM avaliacao a
        INNER JOIN disciplina d ON d.idDisciplina = a.idDisciplina
        WHERE a.idAluno = ?
        ORDER BY d.nomeDisciplina";
        $stm = $conn->prepare($sql);
        $stm->execute([$idAluno]);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function alunoJaAvaliouDisciplinaNoBimestre(int $idAluno, int $idDisciplina, string $bimestre): bool
    {
        $conn = Connection::getConn();
        $sql = "SELECT a.idAvaliacao
                FROM avaliacao a
                WHERE a.idAluno = ? AND a.idDisciplina = ? AND a.bimestre = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$idAluno, $idDisciplina, $bimestre]);
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        if(empty($result))
            return false;
        else
            return true;
    }



    public function listComentariosByDisciplinaProfessor($idProfessor, $idTurma, $idDisciplina, $bimestre): array
    {
        $conn = Connection::getConn();
        $stmt = $conn->prepare("SELECT * FROM avaliacao WHERE idProfessor = :idProfessor AND idTurma = :idTurma 
        AND idDisciplina = :idDisciplina AND bimestre = :bimestre");

        $stmt->bindValue(':idProfessor', $idProfessor);
        $stmt->bindValue(':idDisciplina', $idDisciplina);
        $stmt->bindValue(':idTurma', $idTurma);
        $stmt->bindValue(':bimestre', $bimestre);


        $stmt->execute();

        //TODO : Ajustar para retornar objetos Avaliacao - Padrao MAP usado nas outras DAOS

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function responderComentario(int $idAvaliacao, string $resposta): bool
    {
        $conn = Connection::getConn();
        $sql = "UPDATE avaliacao SET respostaProfessor = :resposta WHERE idAvaliacao = :idAvaliacao";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':resposta', $resposta, PDO::PARAM_STR);
        $stmt->bindValue(':idAvaliacao', $idAvaliacao, PDO::PARAM_INT);

        return $stmt->execute();
    }



    public function listByDisciplinaProfessor($idProfessor, $idTurma, $idDisciplina, $bimestre)
    {
        $conn = Connection::getConn();

        $sql = "SELECT
                AVG(notaClareza) AS mediaClareza,
                AVG(notaDidatica) AS mediaDidatica,
                AVG(notaInteracao) AS mediaInteracao,
                AVG(notaMotivacao) AS mediaMotivacao,
                AVG(notaDominioConteudo) AS mediaDominioConteudo,
                AVG(notaOrganizacao) AS mediaOrganizacao,
                AVG(notaRecursos) AS mediaRecursos
            FROM avaliacao
            WHERE idProfessor = :idProfessor AND idDisciplina = :idDisciplina AND idTurma = :idTurma AND bimestre = :bimestre";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':idProfessor', $idProfessor);
        $stmt->bindValue(':idDisciplina', $idDisciplina);
        $stmt->bindValue(':idTurma', $idTurma);
        $stmt->bindValue(':bimestre', $bimestre);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function listByDisciplinaId($idAluno, $idDisciplina)
    {
        $conn = Connection::getConn();
        $sql = "SELECT * FROM avaliacao 
            WHERE idAluno = :idAluno 
              AND idDisciplina = :idDisciplina
            ORDER BY bimestre ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":idAluno", $idAluno);
        $stmt->bindValue(":idDisciplina", $idDisciplina);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function listByDisciplinaAndAluno($idDisciplina, $idAluno)
    {
        $conn = Connection::getConn();
        $sql = "SELECT * FROM avaliacao 
            WHERE idDisciplina = ? AND idAluno = ?
            ORDER BY bimestre ASC";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$idDisciplina, $idAluno]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }





    //TODO: Implementar método de atualização
    public function update()
    {
        return null;
    }
}
