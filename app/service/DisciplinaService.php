<?php

require_once(__DIR__ . "/../model/Disciplina.php");

class DisciplinaService
{

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Disciplina $disciplina, array $turmasIds = []) {
    $erros = [];

    // Nome obrigatório
    if (!$disciplina->getNomeDisciplina())
        $erros['nomeDisciplina'] = "O campo nome é obrigatório.";

    // Turma obrigatória
    if (empty($turmasIds))
        $erros['turmas'] = "Selecione ao menos uma Turma.";

    return $erros;
}

}
