<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/CursoDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/enum/UsuarioTipo.php");

class UsuarioController extends Controller {

    private UsuarioDAO $usuarioDao;
    private CursoDAO $cursoDao;
    private UsuarioService $usuarioService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct() {
        
        if(! $this->usuarioEstaLogado())
            return;

        //Verificar se o usuário é ADMIN
        if(! $this->usuarioLogadoIsAdmin()) {
            echo "Acesso Negado!";
            return;
        }

        $this->usuarioDao = new UsuarioDAO();
        $this->usuarioService = new UsuarioService();
        $this->cursoDao = new CursoDAO();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "") {
        $dados["lista"] = $this->usuarioDao->list();

        $this->loadView("usuario/list.php", $dados,  $msgErro, $msgSucesso);
    }


    protected function listPendentes(string $msgErro = "", string $msgSucesso = "") {
        
        $dados["lista"] = $this->usuarioDao->listPendentes();

        $this->loadView("usuario/list-pendentes.php", $dados,  $msgErro, $msgSucesso);
    }

    protected function editPendentes(){
        
    }

    protected function create() {
        $dados['idUsuario'] = 0;
        $dados['tiposUsuario'] = UsuarioTipo::getAllAsArray();
        $dados['cursos'] = $this->cursoDao->list();

        $this->loadView("usuario/form.php", $dados);
    }

    protected function edit() {
        //Busca o usuário na base pelo ID    
        $usuario = $this->findUsuarioById();
        if($usuario) {
            $dados['idUsuario'] = $usuario->getId();
            $usuario->setSenha("");
            $dados["usuario"] = $usuario;

            $dados['tiposUsuario'] = UsuarioTipo::getAllAsArray();
            $dados['cursos'] = $this->cursoDao->list();

            $this->loadView("usuario/form.php", $dados);
        } else
            $this->list("Usuário não encontrado!");
    }

    protected function save() {
        //Capturar os dados do formulário
        $id = $_POST['idUsuario'];
        $nome = trim($_POST['nomeUsuario']) != "" ? trim($_POST['nomeUsuario']) : NULL;
        $email = trim($_POST['email']) != "" ? trim($_POST['email']) : NULL;
        $senha = trim($_POST['senha']) != "" ? trim($_POST['senha']) : NULL;
        $confSenha = trim($_POST['conf_senha']) != "" ? trim($_POST['conf_senha']) : NULL;
        $tipousuario = UsuarioTipo::PROFESSOR;
        $siape = trim($_POST['siape']) != "" ? trim($_POST['siape']) : NULL;
        
        //Criar o objeto Usuario
        $usuario = new Usuario();
        $usuario->setId($id);
        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $usuario->setTipousuario($tipousuario);
        $usuario->setSiape($siape);
        
        
        //Validar os dados (camada service)
        $erros = $this->usuarioService->validarDados($usuario, $confSenha);
        if(! $erros) {
            //Inserir no Base de Dados
            try {
                if($usuario->getId() == 0)
                    $this->usuarioDao->insert($usuario);
                else
                    $this->usuarioDao->update($usuario);
                
                header("location: " . BASEURL . "/controller/UsuarioController.php?action=list");
                exit;
            } catch(PDOException $e) {
                //Iserir erro no array
                array_push($erros, "Erro ao gravar no banco de dados!");
                array_push($erros, $e->getMessage());
            }
        } 

        //Mostrar os erros
        $dados['idUsuario'] = $usuario->getId();
        $dados["usuario"] = $usuario;
        $dados['confSenha'] = $confSenha;

        $dados['tiposUsuario'] = UsuarioTipo::getAllAsArray();

        $msgErro = implode("<br>", $erros);

        $this->loadView("usuario/form.php", $dados, $msgErro);
    }

    protected function delete() {
        //Busca o usuário na base pelo ID    
        $usuario = $this->findUsuarioById();
        
        if($usuario) {
            //Excluir
            $this->usuarioDao->deleteById($usuario->getId());

            header("location: " . BASEURL . "/controller/UsuarioController.php?action=list");
            exit;
        } else {
            $this->list("Usuário não encontrado!");
        }
    }

    protected function listJson() {
        //Retornar uma lista de usuários em forma JSON
        $usuarios = $this->usuarioDao->list();
        $json = json_encode($usuarios);
        
        echo $json;

        //[{},{},{}]
    }

    private function findUsuarioById() {
        $id = 0;
        if(isset($_GET["id"]))
            $id = $_GET["id"];

        //Busca o usuário na base pelo ID    
        return $this->usuarioDao->findById($id);
    }

    

}


#Criar objeto da classe para assim executar o construtor
new UsuarioController();
