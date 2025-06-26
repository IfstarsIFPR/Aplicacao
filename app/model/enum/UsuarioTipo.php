<?php
#Nome do arquivo: UsuarioPapel.php
#Objetivo: classe Enum para os papeis de permissões do model de Usuario

class TipoUsuario {

    public static string $SEPARADOR = "|";

    const aluno = "aluno";
    const admin = "admin";
    const professor = "professor";

    public static function getAllAsArray() {
        return [TipoUsuario::aluno, TipoUsuario::admin, TipoUsuario::professor];
    }

}

