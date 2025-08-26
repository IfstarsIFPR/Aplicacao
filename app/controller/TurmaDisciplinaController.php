<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Turma.php");
require_once(__DIR__ . "/../dao/TurmaDAO.php");

class TurmaDisciplinaController extends Controller {

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

        $turma = $this->findTurmaById();
        if(! $turma) {
            echo "ID da turma inválida!";
            exit;
        }

        $dados['turma'] = $turma;

        $this->loadView("pages/turmaDisciplina/turma-disciplina-list.php", $dados,  $msgErro, $msgSucesso);
    }

    

    private function findTurmaById() {
        $id = 0;
        if(isset($_GET["idTurma"]))
            $id = $_GET["idTurma"];

        //Busca o usuário na base pelo ID    
        return $this->turmaDao->findById($id);
    }

}


#Criar objeto da classe para assim executar o construtor
new TurmaDisciplinaController();
