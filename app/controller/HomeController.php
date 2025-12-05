<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/TurmaDAO.php");
require_once(__DIR__ . "/../dao/TurmaAlunoDAO.php");

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

        if (isset($_GET["mensagem"])) {
            $dados["mensagem"] = $_GET["mensagem"];
        }
        $turmaAlunoDAO = new TurmaAlunoDAO();
        $turmaUsuario = $turmaAlunoDAO->obterTurmaPorUsuario($this->getIdUsuarioLogado());
        if ($turmaUsuario) {
            //Se existe um resultado pelo menos, significa que o usuario ja selecionou a tumra
            $dados["turmaSelecionada"] = $this->turmaDAO->findById($turmaUsuario["idTurma"]);
            header("location: " . BASEURL . "/controller/TurmaDisciplinaController.php?action=list&idTurma=" . $dados["turmaSelecionada"]->getId());
            return;
        } else {

            //Se existe um resultado pelo menos, significa que o usuario ja selecionou a tumra

            $curso = $this->usuarioDAO->findById($this->getIdUsuarioLogado())->getCurso();

            $dados["turmas"] = $this->turmaDAO->listByCurso($curso->getId());

            //Carrega a view específica para o aluno
            $this->loadView("home/homeAluno.php", $dados);
        }
    }

    protected function homeProfessor()
    {
        header("location: " . BASEURL . "/controller/TurmaDisciplinaController.php?action=minhasDisciplinasProfessor");
    }

    public function homeAdmin()
    {
        //Carrega a quantidade de usuários cadastrados
        header("location: " . BASEURL . "/controller/UsuarioController.php?action=listPendentes");
    }
}

//Criar o objeto do controller
new HomeController();
