<?php
#Nome do arquivo: UsuarioPapel.php
#Objetivo: classe Enum para os papeis de permissões do model de Usuario

class TurmaTurno {

    public static string $SEPARADOR = "|";

    const MATUTINO = "matutino";
    const VESPERTINO = "vespertino";
    const NOTURNO = "noturno";
    const INTEGRAL = "integral";

    public static function getAllAsArray() {
        return [TurmaTurno::MATUTINO, TurmaTurno::VESPERTINO, TurmaTurno::NOTURNO, TurmaTurno::INTEGRAL];

    }

}