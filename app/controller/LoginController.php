<?php
#Classe controller para a Logar do sistema
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../service/LoginService.php");
require_once(__DIR__ . "/../model/Usuario.php");

class LoginController extends Controller
{

    private LoginService $loginService;
    private UsuarioDAO $usuarioDao;

    public function __construct()
    {
        $this->loginService = new LoginService();
        $this->usuarioDao = new UsuarioDAO();

        $this->handleAction();
    }

    protected function login()
    {
        $this->loadView("login/login.php", []);
    }

    /* Método para logar um usuário a partir dos dados informados no formulário */
    protected function logon()
    {
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;

        //Validar os campos
        $erros = $this->loginService->validarCampos($email, $senha);
        if (empty($erros)) {
            //Valida o login a partir do banco de dados
            $usuario = $this->usuarioDao->findByEmailSenha($email, $senha);
            if ($usuario) {

                    //bloqueio se o aluno estiver com cadastro pendente
                    if (
                        $usuario->getTipoUsuario() === UsuarioTipo::ALUNO
                        && $usuario->getStatus() === UsuarioStatus::PENDENTE
                    ) {
                        $erros['status'] = "Seu cadastro ainda está pendente! Aguarde a validação da declaração de matrícula.";

                        $dados["email"] = $email;
                        $dados["senha"] = $senha;
                        $dados["erros"] = $erros;

                        // Retorna para o login
                        $this->loadView("login/login.php", $dados);
                        return; // para a função
                    }
                //Se encontrou o usuário, salva a sessão e redireciona para a HOME do sistema
                $this->loginService->salvarUsuarioSessao($usuario);

                if ($usuario->getTipoUsuario() === UsuarioTipo::ALUNO) {
                    header("Location: " . HOME_PAGE_ALUNO);
                } elseif ($usuario->getTipoUsuario() === UsuarioTipo::PROFESSOR) {
                    header("Location: " . HOME_PAGE_PROFESSOR);
                } elseif ($usuario->getTipoUsuario() === UsuarioTipo::ADMIN) {
                    header("Location: " . HOME_PAGE);
                } else {
                    echo "Tipo de usuário inválido!";
                }
                exit;


                // header("location: " . HOME_PAGE);
                // exit;
            } else {
                $erros['senha'] = "Login ou senha informados são inválidos!";
            }
        }

        //Se há erros, volta para o formulário            
        $dados["email"] = $email;
        $dados["senha"] = $senha;
        $dados["erros"] = $erros;

        $this->loadView("login/login.php", $dados);
    }

    /* Método para logar um usuário a partir dos dados informados no formulário */
    protected function logout()
    {
        $this->loginService->removerUsuarioSessao();

        $this->loadView("login/login.php", [], "", "Usuário deslogado com suscesso!");
    }
}


#Criar objeto da classe para assim executar o construtor
new LoginController();
