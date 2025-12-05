<?php
#Nome do arquivo: UsuarioPapel.php
#Objetivo: classe Enum para os papeis de permissões do model de Usuario

class CursoNivel
{

    public static string $SEPARADOR = "|";

    const TECNICO = "tecnico";
    const TECNOLOGO = "tecnologo";
    const BACHARELADO = "bacharelado";
    const LICENCIATURA = "licenciatura";

    public static function getAllAsArray()
    {
        return [CursoNivel::TECNICO, CursoNivel::TECNOLOGO, CursoNivel::BACHARELADO, CursoNivel::LICENCIATURA];
    }
}
