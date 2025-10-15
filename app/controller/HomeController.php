<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/TurmaDAO.php");

class HomeController extends Controller
{

    private UsuarioDAO $usuarioDAO;
    private TurmaDAO $turmaDAO;

    public function __construct()
    {
        //Verificar se o usuário está logado
        if (! $this->usuarioEstaLogado())
            return;

        $this->usuarioDAO = new UsuarioDAO();
        $this->turmaDAO = new TurmaDAO();

        //Tratar a ação solicitada no parâmetro "action"
        $this->handleAction();
    }

    protected function home()
    {


        $usuario = $this->usuarioDAO->findById($this->getIdUsuarioLogado());


        if ($usuario->getTipoUsuario() == 'aluno') {
            header("location: " . HOME_PAGE_ALUNO);
            return;
        } else if ($usuario->getTipoUsuario() == 'professor') {
            header("location: " . HOME_PAGE_PROFESSOR);
            return;
        } else if ($usuario->getTipoUsuario() == 'admin') {
            $this->homeAdmin();
        }
    }


    protected function homeAluno()
    {
        //Carrega a quantidade de usuários cadastrados
        //Alteração

        if(isset($_GET["mensagem"])){
            $dados["mensagem"] = $_GET["mensagem"];
        }
            
        $curso = $this->usuarioDAO->findById($this->getIdUsuarioLogado())->getCurso();

        $dados["turmas"] = $this->turmaDAO->listByCurso($curso->getId());
        $dados["qtdUsuarios"] = $this->usuarioDAO->quantidadeUsuarios();

        //Carrega a view específica para o aluno
        $this->loadView("home/homeAluno.php", $dados);
    }

    protected function homeProfessor()
    {
        //Carrega a quantidade de usuários cadastrados
        $dados["qtdUsuarios"] = $this->usuarioDAO->quantidadeUsuarios();

        //Carrega a view específica para o aluno
        $this->loadView("home/homeProfessor.php", $dados);
    }

    public function homeAdmin()
    {
        //Carrega a quantidade de usuários cadastrados
        $dados["qtdUsuarios"] = $this->usuarioDAO->quantidadeUsuarios();

        //Carrega a view específica para o admin
        $this->loadView("home/home.php", $dados);
    }
}

//Criar o objeto do controller
new HomeController();
