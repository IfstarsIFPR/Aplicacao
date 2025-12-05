<?php
#Nome do arquivo: AvaliacaoBimestre.php
#Objetivo: classe Enum para os bimestres do model de Avaliação

class AvaliacaoBimestre
{

    public static string $SEPARADOR = "|";

    const PRIMEIRO = "1º Bimestre";
    const SEGUNDO = "2º Bimestre";
    const TERCEIRO = "3º Bimestre";
    const QUARTO = "4º Bimestre";

    public static function getAllAsArray()
    {
        return [
            AvaliacaoBimestre::PRIMEIRO,
            AvaliacaoBimestre::SEGUNDO,
            AvaliacaoBimestre::TERCEIRO,
            AvaliacaoBimestre::QUARTO
        ];
    }
}
