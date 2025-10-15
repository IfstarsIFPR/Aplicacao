<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Turma.php");
require_once(__DIR__ . "/../dao/TurmaDAO.php");
require_once(__DIR__ . "/../dao/DisciplinaDAO.php");
require_once(__DIR__ . "/../dao/TurmaAlunoDAO.php");


class TurmaDisciplinaController extends Controller
{

    private TurmaDAO $turmaDao;
    private DisciplinaDAO $disciplinaDao;
    private TurmaAlunoDAO $turmaAlunoDao;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct()
    {

        if (! $this->usuarioEstaLogado())
            return;

        //Verificar se o usuário é ADMIN
        // if(! $this->usuarioLogadoIsAdmin()) {
        //     echo "Acesso Negado!";
        //     return;
        // }

        $this->turmaDao = new TurmaDAO();
        $this->disciplinaDao = new DisciplinaDAO();
        $this->turmaAlunoDao = new TurmaAlunoDAO();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "")
    {

<<<<<<< Updated upstream
        $turma = $this->disciplinaDao->findDisciplinasByTurmaId(1); // Temporário, depois pegar o ID da URL
        if(! $turma) {
            echo "ID da turma inválida!";
            exit;
        }

        $dados['turma'] = $turma;

        $this->loadView("pages/turmaDisciplina/turma-disciplina-list.php", $dados,  $msgErro, $msgSucesso);
    }

    public function acessarTurma(){
=======
        $turma = $this->findTurmaById();
        if (! $turma) {
            echo "ID da turma inválido!";
            exit;
        }

        // dados para a view
        $dados['turma'] = $turma;
        $dados["lista"] = $this->disciplinaDao->findDisciplinasByTurmaId($turma->getId());

        $this->loadView("pages/turmaDisciplina/turma-disciplina-list.php", $dados, $msgErro, $msgSucesso);
    }

    public function acessarTurma()
    {
>>>>>>> Stashed changes

        $codigoTurma = $_POST['codigoTurma'];
        $idTurma = $_POST['idTurma'];


        $turma = $this->turmaDao->findById($idTurma);

        if (!$turma) {

            header("Location: " . BASEURL . "/controller/HomeController.php?action=homeAluno&mensagem=ID da turma inválida!");

        } else if ($turma->getCodigoTurma() != $codigoTurma) {

            header("Location: " . BASEURL . "/controller/HomeController.php?action=homeAluno&mensagem=Código de acesso inválido!");
        } 


<<<<<<< Updated upstream
        } else if($turma->getCodigoTurma() != $codigoTurma) {
            print ("Código de acesso inválido!");
            exit;
        } 
        
            
=======
>>>>>>> Stashed changes
        // se inscrever na turma

        // 1° criar o metodo de insert no DAO Turma alunos para a relacao de alunos e turmas
        // 2° Aqui mesmo, Chamar o dao e realizar o insert
        // 3° Redirecionar para a página de listagem de disciplinas da turma  

        $this->turmaAlunoDao->insert($this->getIdUsuarioLogado(), $idTurma);

        header("Location: " . BASEURL . "/controller/TurmaDisciplinaController.php?action=list&idTurma=" . $idTurma);
        
    }
<<<<<<< Updated upstream

=======
    private function findTurmaById()
    {
        if (!isset($_GET["idTurma"])) {
            return null;
        }

        $idTurma = (int) $_GET["idTurma"];
        return $this->turmaDao->findById($idTurma);
    }
>>>>>>> Stashed changes
}


#Criar objeto da classe para assim executar o construtor
new TurmaDisciplinaController();
