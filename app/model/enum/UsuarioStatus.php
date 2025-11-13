<?php
#Nome do arquivo: UsuarioStatus.php
#Objetivo: classe Enum para os status do model de Usuario

class UsuarioStatus {

    public static string $SEPARADOR = "|";

    const ATIVO = "ativo";
    const PENDENTE = "pendente";

    public static function getAllAsArray() {
        return [UsuarioStatus::ATIVO, UsuarioStatus::PENDENTE];
    }

}

