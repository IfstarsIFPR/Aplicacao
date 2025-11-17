<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Turma.php");
require_once(__DIR__ . "/../dao/TurmaDAO.php");
require_once(__DIR__ . "/../dao/DisciplinaDAO.php");
require_once(__DIR__ . "/../dao/TurmaAlunoDAO.php");
require_once(__DIR__ . "/../dao/TurmaDisciplinaDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

class TurmaDisciplinaController extends Controller
{

    private TurmaDAO $turmaDao;
    private DisciplinaDAO $disciplinaDao;
    private TurmaAlunoDAO $turmaAlunoDao;
    private TurmaDisciplinaDAO $turmaDisciplinaDao;

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
        $this->turmaDisciplinaDao = new TurmaDisciplinaDAO();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "")
    {

        $turma = $this->findTurmaById();

        if (!$turma) {
            echo "ID da turma inválido!";
            exit;
        }

        // dados para a view
        $dados['turma'] = $turma;
        $dados["lista"] = $this->disciplinaDao->findDisciplinasByTurmaId($turma->getId());

        $this->loadView("pages/turmaDisciplina/turma-disciplina-list.php", $dados, $msgErro, $msgSucesso);
    }

    protected function listTurmas(string $msgErro = "", string $msgSucesso = "")
    {

        $disciplina = $this->findDisciplinaById();

        if (!$disciplina) {
            echo "ID da disciplina inválido!";
            exit;
        }

        // dados para a view
        $dados['disciplina'] = $disciplina;
        $dados["turmas"] = $this->turmaDisciplinaDao->listByDisciplina($disciplina->getId());

        $this->loadView("pages/turmaDisciplina/turma-disciplina-admin.php", $dados, $msgErro, $msgSucesso);
    }

    protected function minhasDisciplinasProfessor()
{
    $idProfessor = $this->getIdUsuarioLogado();
    $disciplinas = $this->turmaDisciplinaDao->listByProfessor($idProfessor);
    $dados["disciplinas"] = $disciplinas;
    $this->loadView("pages/turmaDisciplina/minhas-disciplinas-professor.php", $dados);
}




    protected function edit() {

        $usuarioDao = new UsuarioDAO();
        //Busca a turma na base pelo ID    
        $turmaDisciplina = $this->findTurmaDisciplinaById();
        if($turmaDisciplina) {
            $dados['idTurmaDisciplina'] = $turmaDisciplina->getId(); 
            $dados["turmaDisciplina"] = $turmaDisciplina;
            $dados['professores'] = $usuarioDao->findProfessores();

            $this->loadView("pages/turmaDisciplina/turma-disciplina-edit.php", $dados);
            
        } else
            $this->list("Turma não encontrada!");
    }
    protected function save()
    {

        $idTurmaDisciplina = $_POST['idTurmaDisciplina'];
        $idProfessor = $_POST['idProfessor'];

        // Busca registro completo
        $turmaDisciplina = $this->turmaDisciplinaDao->findTurmaDisciplinaById($idTurmaDisciplina);
        $idDisciplina = $turmaDisciplina->getDisciplina()->getId();

        // Atualiza apenas o professor
        $professor = new Usuario();
        $professor->setId($idProfessor);
        $turmaDisciplina->setProfessor($professor);

        try {
            // Apenas update (nunca insert)
            $this->turmaDisciplinaDao->update($turmaDisciplina);

            header("location: " . BASEURL . "/controller/TurmaDisciplinaController.php?action=listTurmas&idDisciplina={$idDisciplina}");
            exit;
        } catch (PDOException $e) {
            $msgErro = "Erro ao atualizar: " . $e->getMessage();
            $dados['msgErro'] = $msgErro;
            $this->loadView("pages/turmaDisciplina/turma-disciplina-edit.php", $dados, $msgErro);
        }
    }

    public function acessarTurma(){
        $codigoTurma = $_POST['codigoTurma'];
        $idTurma = $_POST['idTurma'];


        $turma = $this->turmaDao->findById($idTurma);

        if (! $turma) {
            print("ID da turma inválida!");
            exit;
        } else if ($turma->getCodigoTurma() != $codigoTurma) {
            print("Código de acesso inválido!");
            exit;
        } else {
            // Redirecionar para a página de listagem de disciplinas da turma
            header("Location: " . BASEURL . "/controller/TurmaDisciplinaController.php?action=list&idTurma=" . $idTurma);
        }


        // se inscrever na turma

        // 1° criar o metodo de insert no DAO Turma alunos para a relacao de alunos e turmas
        // 2° Aqui mesmo, Chamar o dao e realizar o insert
        // 3° Redirecionar para a página de listagem de disciplinas da turma  

        $this->turmaAlunoDao->insert($this->getIdUsuarioLogado(), $idTurma);

        header("Location: " . BASEURL . "/controller/TurmaDisciplinaController.php?action=list&idTurma=" . $idTurma);
    }
    private function findTurmaById()
    {
        if (!isset($_GET["idTurma"])) {
            return null;
        }

        $idTurma = (int) $_GET["idTurma"];
        return $this->turmaDao->findById($idTurma);
    }

     private function findDisciplinaById()
    {
        if (!isset($_GET["idDisciplina"])) {
            return null;
        }

        $idDisciplina = (int) $_GET["idDisciplina"];
        return $this->disciplinaDao->findById($idDisciplina);
    }

    private function findTurmaDisciplinaById()
    {
        if (!isset($_GET["idTurmaDisciplina"])) {
            return null;
        }

        $idTurmaDisciplina = (int) $_GET["idTurmaDisciplina"];
        return $this->turmaDisciplinaDao->findTurmaDisciplinaById($idTurmaDisciplina);
    }
}


#Criar objeto da classe para assim executar o construtor
new TurmaDisciplinaController();
