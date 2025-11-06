<?php
    
require_once(__DIR__ . "/../model/Avaliacao.php");

class AvaliacaoService {

    /* Método para validar os dados da avaliação que vem do formulário */
    public function validarDados(Avaliacao $avaliacao) {
        $erros = array();

        //Validar campos vazios
        if(! $avaliacao->getBimestre())
            array_push($erros, "Selecione um [Bimestre]!");

        if(! $avaliacao->getNotaClareza())
            array_push($erros, "Preencha a nota de clareza!");

        if(! $avaliacao->getNotaDidatica())
            array_push($erros, "Preencha a nota de Didática!");

        if(! $avaliacao->getNotaInteracao())
            array_push($erros, "Preencha a nota de Interação!");

        if(! $avaliacao->getNotaMotivacao())
            array_push($erros, "Preencha a nota de Motivação!");

        if(! $avaliacao->getNotaDominioConteudo())
            array_push($erros, "Preencha a nota de domínio de conteúdo!");

        if(! $avaliacao->getNotaOrganizacao())
            array_push($erros, "Preencha a nota de Organização!");

        if(! $avaliacao->getNotaRecursos())
            array_push($erros, "Preencha a nota de Recursos!");


        return $erros;
    }


}
