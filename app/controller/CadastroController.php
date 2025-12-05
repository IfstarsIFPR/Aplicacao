<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/CursoDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/enum/UsuarioTipo.php");
require_once(__DIR__ . "/../service/ArquivoService.php");
class CadastroController extends Controller
{

    private UsuarioDAO $usuarioDao;
    private CursoDAO $cursoDao;
    private UsuarioService $usuarioService;
    private ArquivoService $arquivoService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct()
    {

        $this->usuarioDao = new UsuarioDAO();
        $this->usuarioService = new UsuarioService();
        $this->cursoDao = new CursoDAO();
        $this->arquivoService = new ArquivoService();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "")
    {
        $dados["lista"] = $this->usuarioDao->list();

        $this->loadView("usuario/list.php", $dados,  $msgErro, $msgSucesso);
    }

    protected function create()
    {
        $dados['idUsuario'] = 0;
        $dados['tiposUsuario'] = UsuarioTipo::ALUNO;
        $dados['cursos'] = $this->cursoDao->list();

        $this->loadView("usuario/formAluno.php", $dados);
    }

    protected function edit()
    {
        //Busca o usuário na base pelo ID    
        $usuario = $this->findUsuarioById();
        if ($usuario) {
            $dados['idUsuario'] = $usuario->getId();
            $usuario->setSenha("");
            $dados["usuario"] = $usuario;
            $dados['tiposUsuario'] = UsuarioTipo::getAllAsArray();
            $dados['cursos'] = $this->cursoDao->list();

            $this->loadView("usuario/formAluno.php", $dados);
        } else
            $this->list("Usuário não encontrado!");
    }

    protected function save()
    {
        //Capturar os dados do formulário
        $id = $_POST['idUsuario'];
        $nome = trim($_POST['nomeUsuario']) != "" ? trim($_POST['nomeUsuario']) : NULL;
        $numMatricula = trim($_POST['numMatricula']) != "" ? trim($_POST['numMatricula']) : NULL;
        $email = trim($_POST['email']) != "" ? trim($_POST['email']) : NULL;
        $senha = trim($_POST['senha']) != "" ? trim($_POST['senha']) : NULL;
        $confSenha = trim($_POST['conf_senha']) != "" ? trim($_POST['conf_senha']) : NULL;
        $tipousuario = UsuarioTipo::ALUNO;
        $idCurso = trim($_POST['idCurso']) != "" ? trim($_POST['idCurso']) : NULL;

        //Criar o objeto Usuario
        $usuario = new Usuario();
        $usuario->setId($id);
        $usuario->setNome($nome);
        $usuario->setNumMatricula($numMatricula);

        $arquivo = $_FILES["declaracaoMatricula"];

        if ($arquivo['name'] != '' && $arquivo['type'] == 'application/pdf') {
            $usuario->setdeclaracaoMatricula($arquivo['name']);
        }

        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $usuario->setTipousuario($tipousuario);

        if ($idCurso) {
            $curso = new Curso();
            $curso->setId($idCurso);
            $usuario->setCurso($curso);
        } else
            $usuario->setCurso(null);

        //Validar os dados (camada service)
        $erros = $this->usuarioService->validarDados($usuario, $confSenha);

        if (! $erros) {

            // Validar arquivo
            if (! $erros) {
                //1- Salvar a foto em um arquivo

                $nomeArquivo = $this->arquivoService->salvarArquivo($arquivo);

                if ($nomeArquivo) {
                    $usuario->setdeclaracaoMatricula($nomeArquivo);


                    // Se for atualização, exclui o arquivo antigo
                } else {
                    array_push($erros, "Não foi possível salvar o arquivo de declaração!");
                }
            } else {
                $erros = array_merge($erros);
            }

            //Inserir na Base de Dados
            try {
                if ($usuario->getId() == 0)
                    $this->usuarioDao->insertAluno($usuario);
                else
                    $this->usuarioDao->update($usuario);

                header("location: " . BASEURL . "/controller/UsuarioController.php?action=list");
                exit;
            } catch (PDOException $e) {
                //Iserir erro no array
                array_push($erros, "Erro ao gravar no banco de dados!" . $e->getMessage());
                array_push($erros, $e->getMessage());
            }
        }

        //Mostrar os erros
        $dados['idUsuario'] = $usuario->getId();
        $dados["usuario"] = $usuario;
        $dados['confSenha'] = $confSenha;

        $dados['tiposUsuario'] = UsuarioTipo::getAllAsArray();
        $dados['cursos'] = $this->cursoDao->list();

        $dados['erros'] = $erros;
        $this->loadView("usuario/formAluno.php", $dados);
    }

    protected function delete()
    {
        //Busca o usuário na base pelo ID    
        $usuario = $this->findUsuarioById();

        if ($usuario) {

            //Excluir
            $this->usuarioDao->deleteById($usuario->getId());

            header("location: " . BASEURL . "/controller/CadastroController.php?action=list");
            exit;
        } else {
            $this->list("Usuário não encontrado!");
        }
    }

    protected function listJson()
    {
        //Retornar uma lista de usuários em forma JSON
        $usuarios = $this->usuarioDao->list();
        $json = json_encode($usuarios);

        echo $json;
    }

    private function findUsuarioById()
    {
        $id = 0;
        if (isset($_GET["id"]))
            $id = $_GET["id"];

        //Busca o usuário na base pelo ID    
        return $this->usuarioDao->findById($id);
    }
}


#Criar objeto da classe para assim executar o construtor
new CadastroController();
