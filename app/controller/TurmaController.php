<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/CursoDAO.php");
require_once(__DIR__ . "/../model/Curso.php");
require_once(__DIR__ . "/../service/CursoService.php");
require_once(__DIR__ . "/../model/enum/CursoNivel.php");

class CursoController extends Controller {

    private CursoDAO $cursoDao;
    private CursoService $cursoService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct() {
       /* if(! $this->usuarioEstaLogado())
            return;

        //Verificar se o usuário é ADMIN
        if(! $this->usuarioLogadoIsAdmin()) {
            echo "Acesso Negado!";
            return;
        }*/

        $this->cursoDao = new CursoDAO();
        $this->cursoService = new CursoService();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "") {
        $dados["lista"] = $this->cursoDao->list();

        $this->loadView("curso/list.php", $dados,  $msgErro, $msgSucesso);
    }

    protected function create() {
        $dados['idCurso'] = 0;
        $dados['nivel'] = CursoNivel::getAllAsArray();

        $this->loadView("curso/form.php", $dados);
    }

    protected function edit() {
        //Busca o usuário na base pelo ID    
        $curso = $this->findUsuarioById();
        if($curso) {
            $dados['idCurso'] = $curso->getId();
            $dados["curso"] = $curso;

            $dados['nivel'] = CursoNivel::getAllAsArray();
            $dados['cursos'] = $this->cursoDao->list();

            $this->loadView("curso/form.php", $dados);
        } else
            $this->list("Curso não encontrado!");
    }

    protected function save() {
        //Capturar os dados do formulário
        $id = $_POST['idCurso'];
        $nome = trim($_POST['nomeCurso']) != "" ? trim($_POST['nomeCurso']) : NULL;
        $nivel= $_POST['nivel'];

        //Criar o objeto Usuario
        $curso = new Curso();
        $curso->setId($id);
        $curso->setNome($nome);
        $curso->setNivel($nivel);
        
        
        //Validar os dados (camada service)
        $erros = $this->cursoService->validarDados($curso);
        if(! $erros) {
            //Inserir no Base de Dados
            try {
                if($curso->getId() == 0)
                    $this->cursoDao->insert($curso);
                else
                    $this->cursoDao->update($curso);
                
                header("location: " . BASEURL . "/controller/CursoController.php?action=list");
                exit;
            } catch(PDOException $e) {
                //Iserir erro no array
                array_push($erros, "Erro ao gravar no banco de dados!");
                array_push($erros, $e->getMessage());
            }
        } 

        //Mostrar os erros
        $dados['idCurso'] = $curso->getId();
        $dados["curso"] = $curso;

        $dados['nivel'] = CursoNivel::getAllAsArray();

        $msgErro = implode("<br>", $erros);

        $this->loadView("curso/form.php", $dados, $msgErro);
    }

    protected function delete() {
        //Busca o usuário na base pelo ID    
        $usuario = $this->findUsuarioById();
        
        if($usuario) {
            //Excluir
            $this->cursoDao->deleteById($usuario->getId());

            header("location: " . BASEURL . "/controller/CursoController.php?action=list");
            exit;
        } else {
            $this->list("Usuário não encontrado!");
        }
    }

    protected function listJson() {
        //Retornar uma lista de usuários em forma JSON
        $cursos = $this->cursoDao->list();
        $json = json_encode($cursos);
        
        echo $json;

        //[{},{},{}]
    }

    private function findUsuarioById() {
        $id = 0;
        if(isset($_GET["id"]))
            $id = $_GET["id"];

        //Busca o usuário na base pelo ID    
        return $this->cursoDao->findById($id);
    }

    

}


#Criar objeto da classe para assim executar o construtor
new CursoController();
