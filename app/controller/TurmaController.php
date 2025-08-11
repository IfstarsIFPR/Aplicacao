<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");

require_once(__DIR__ . "/../model/Turma.php");
require_once(__DIR__ . "/../dao/TurmaDAO.php");



//TODO: fix -> eventualmente será necessário apagar algumas desses requires, que ser denecessários
require_once(__DIR__ . "/../dao/CursoDAO.php");
require_once(__DIR__ . "/../model/Curso.php");
require_once(__DIR__ . "/../service/CursoService.php");
require_once(__DIR__ . "/../model/enum/CursoNivel.php");

class TurmaController extends Controller {

    private TurmaDAO $turmaDao;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct() {

        if(! $this->usuarioEstaLogado())
            return;

        //Verificar se o usuário é ADMIN
        if(! $this->usuarioLogadoIsAdmin()) {
            echo "Acesso Negado!";
            return;
        }

        $this->turmaDao = new TurmaDAO();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "") {

        $dados["lista"] = $this->turmaDao->list();

        $this->loadView("pages/turma/turma-list.php", $dados,  $msgErro, $msgSucesso);
    }

}


#Criar objeto da classe para assim executar o construtor
new TurmaController();
