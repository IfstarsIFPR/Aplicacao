<?php

//MOSTRA TODOS OS ERROS PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

#Classe controller padrão
require_once(__DIR__ . "/../util/config.php");
require_once(__DIR__ . "/../model/enum/UsuarioTipo.php");

class Controller {

    //Método que efetua a chamada do ação conforme parâmetro GET recebido pela requisição
    protected function handleAction() {
        //Captura a ação do parâmetro GET
        $action = NULL;
        if(isset($_GET['action']))
            $action = $_GET['action'];
        
        //Chama a ação
        $this->callAction($action);
    }

    protected function callAction($methodName) {
        //Verifica se o método da action recebido por parâmetro existe na classe. Se sim, chama-o
        if($methodName && method_exists($this, $methodName))
            $this->$methodName();
        
        else {
            echo "Ação não encontrada no controller.<br>";
            echo "Verifique com o administrador do sistema.";
        }

    }

    protected function loadView(string $path, array $dados, string $msgErro = "", string $msgSucesso = "") {
        
        $caminho = __DIR__ . "/../view/" . $path;
        if(file_exists($caminho)) {

            //Inclui e exibe a view a partir do controller
            require $caminho;

        } else {
            echo "Erro ao carrega a view solicitada<br>";
            echo "Caminho: " . $caminho;
        }
    }

    protected function usuarioEstaLogado() {
        session_start();

        if(! isset($_SESSION[SESSAO_USUARIO_ID])) {
            header("location: " . LOGIN_PAGE);
            return false;
        }

        return true;
    }

    protected function getIdUsuarioLogado() {
        if(session_status() != PHP_SESSION_ACTIVE)
            session_start();
        
        if(isset($_SESSION[SESSAO_USUARIO_ID]))
            return $_SESSION[SESSAO_USUARIO_ID];

        return 0;
    }

    protected function usuarioLogadoIsAdmin() {

        if(session_status() != PHP_SESSION_ACTIVE)
            session_start();

        if(isset($_SESSION[SESSAO_USUARIO_ID])) {

            if($_SESSION[SESSAO_USUARIO_TIPO] == UsuarioTipo::ADMIN)
                return true;
        }

        return false;
    }

     protected function usuarioLogadoIsProfessor() {

        if(session_status() != PHP_SESSION_ACTIVE)
            session_start();

        if(isset($_SESSION[SESSAO_USUARIO_ID])) {

            if($_SESSION[SESSAO_USUARIO_TIPO] == UsuarioTipo::PROFESSOR)
                return true;
        }

        return false;
    }


}