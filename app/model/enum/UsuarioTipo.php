<?php
#Nome do arquivo: UsuarioPapel.php
#Objetivo: classe Enum para os papeis de permissões do model de Usuario

class UsuarioTipo
{

    public static string $SEPARADOR = "|";

    const ALUNO = "aluno";
    const ADMIN = "admin";
    const PROFESSOR = "professor";

    public static function getAllAsArray()
    {
        return [UsuarioTipo::ALUNO, UsuarioTipo::PROFESSOR, UsuarioTipo::ADMIN];
    }
}
