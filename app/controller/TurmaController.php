<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Turma.php");
require_once(__DIR__ . "/../dao/TurmaDAO.php");
require_once(__DIR__ . "/../dao/CursoDAO.php");
require_once(__DIR__ . "/../model/enum/TurmaTurno.php");
require_once(__DIR__ . "/../service/TurmaService.php");

class TurmaController extends Controller {

    private TurmaDAO $turmaDao;
    private CursoDAO $cursoDao;
    private TurmaService $turmaService;

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
        $this->turmaService = new TurmaService();
        $this->cursoDao = new CursoDAO();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "") {

        $curso = $this->findCursoById();
        if(! $curso) {
            echo "ID do curso inválido!";
            exit;
        }

        $dados['curso'] = $curso;
        $dados["lista"] = $this->turmaDao->listByCurso($curso->getId());

        $this->loadView("pages/turma/turma-list.php", $dados,  $msgErro, $msgSucesso);
    }

    protected function create() {
        $dados['idTurma'] = 0;
        $dados['turno'] = TurmaTurno::getAllAsArray();
        $dados['cursos'] = $this->cursoDao->list();

        $this->loadView("pages/turma/turma-form.php", $dados);
    }

     protected function edit() {
        //Busca a turma na base pelo ID    
        $turma = $this->findTurmaById();
        if($turma) {
            $dados['idTurma'] = $turma->getId();
            $dados["turma"] = $turma;

            $dados['turno'] = TurmaTurno::getAllAsArray();
            $dados['cursos'] = $this->cursoDao->list();

            $this->loadView("pages/turma/turma-form.php", $dados);
        } else
            $this->list("Turma não encontrada!");
    }
    protected function save() {
        //Capturar os dados do formulário
        $id = $_POST['idTurma'];
        $anoTurma = trim($_POST['anoTurma']) != "" ? trim($_POST['anoTurma']) : NULL;
        $codigoTurma = trim($_POST['codigoTurma']) != "" ? trim($_POST['codigoTurma']) : NULL;
        $turno = $_POST['turno'];
        $idCurso = trim($_POST['idCurso']) != "" ? trim($_POST['idCurso']) : NULL;
        
        //Criar o objeto Usuario
        $turma = new Turma();
        $turma->setId($id);
        $turma->setAnoTurma($anoTurma);
        $turma->setCodigoTurma($codigoTurma);
        $turma->setTurno($turno);
        
        if($idCurso) {
            
            $curso = new Curso();
            $curso->setId($idCurso);
            $turma->setCurso($curso);
        
        } else {
            $turma->setCurso(null);
        }
        //Validar os dados (camada service)
        $erros = $this->turmaService->validarDados($turma);
        if(! $erros) {
            //Inserir no Base de Dados
            try {
                if($turma->getId() == 0)
                    $this->turmaDao->insert($turma);
                else
                    $this->turmaDao->update($turma);
                
                header("location: " . BASEURL . "/controller/TurmaController.php?action=list&idCurso={$idCurso}");
                exit;
            } catch(PDOException $e) {
                //Iserir erro no array
                array_push($erros, "Erro ao gravar no banco de dados!");
                array_push($erros, $e->getMessage());
            }
        } 

        //Mostrar os erros
        $dados['idTurma'] = $turma->getId();
        $dados["turma"] = $turma;

        $dados['turno'] = TurmaTurno::getAllAsArray();
        $dados['cursos'] = $this->cursoDao->list();

        $msgErro = implode("<br>", $erros);

        $this->loadView("pages/turma/turma-form.php", $dados, $msgErro);
    }

    protected function delete() {
        //Busca o usuário na base pelo ID    
        $turma = $this->findTurmaById();
        
        if($turma) {
            //Excluir
            $this->turmaDao->deleteById($turma->getId());

            header("location: " . BASEURL . "/controller/TurmaController.php?action=list&idCurso=" . $turma->getCurso()->getId());
            exit;
        } else {
            $this->list("Turma não encontrada!");
        }
    }

    protected function listJson() {
        //Retornar uma lista de usuários em forma JSON
        $turmas = $this->turmaDao->list();
        $json = json_encode($turmas);
        
        echo $json;

        //[{},{},{}]
    }

    private function findTurmaById() {
        $id = 0;
        if(isset($_GET["id"]))
            $id = $_GET["id"];

        //Busca o usuário na base pelo ID    
        return $this->turmaDao->findById($id);
    }

    private function findCursoById() {
        $id = 0;
        if(isset($_GET["idCurso"]))
            $id = $_GET["idCurso"];

        //Busca o usuário na base pelo ID    
        return $this->cursoDao->findById($id);
    }



}


#Criar objeto da classe para assim executar o construtor
new TurmaController();
