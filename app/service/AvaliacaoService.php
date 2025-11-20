<?php
    
require_once(__DIR__ . "/../model/Avaliacao.php");
require_once(__DIR__ . "/../dao/AvaliacaoDAO.php");

class AvaliacaoService {

    private AvaliacaoDAO $avaliacaoDAO;

    public function __construct()
    {
        $this->avaliacaoDAO = new AvaliacaoDAO();
    }

    /* Método para validar os dados da avaliação que vem do formulário */
   public function validarDados(Avaliacao $avaliacao) {
    $erros = [];

    if(!$avaliacao->getBimestre())
        $erros["bimestre"] = "Selecione um bimestre!";
    elseif ($this->avaliacaoDAO->alunoJaAvaliouDisciplinaNoBimestre($avaliacao->getIdAluno(), 
                                                                 $avaliacao->getIdDisciplina(), 
                                                                 $avaliacao->getBimestre()) ) {
        $erros["bimestre"] = "Este bimestre já foi avaliado para esta disciplina!";
    }

    if(!$avaliacao->getNotaClareza())
        $erros["notaClareza"] = "Preencha a nota de clareza!";

    if(!$avaliacao->getNotaDidatica())
        $erros["notaDidatica"] = "Preencha a nota de didática!";

    if(!$avaliacao->getNotaInteracao())
        $erros["notaInteracao"] = "Preencha a nota de interação!";

    if(!$avaliacao->getNotaMotivacao())
        $erros["notaMotivacao"] = "Preencha a nota de motivação!";

    if(!$avaliacao->getNotaDominioConteudo())
        $erros["notaDominioConteudo"] = "Preencha a nota de domínio de conteúdo!";

    if(!$avaliacao->getNotaOrganizacao())
        $erros["notaOrganizacao"] = "Preencha a nota de organização!";

    if(!$avaliacao->getNotaRecursos())
        $erros["notaRecursos"] = "Preencha a nota de recursos!";

    return $erros;
}


}
