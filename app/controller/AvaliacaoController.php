<?php
#Classe controller para Avaliação
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/AvaliacaoDAO.php");
require_once(__DIR__ . "/../model/Avaliacao.php");
require_once(__DIR__ . "/../service/AvaliacaoService.php");

class AvaliacaoController extends Controller
{
    private AvaliacaoDAO $avaliacaoDao;
     private AvaliacaoService $avaliacaoService;

    public function __construct()
    {
        $this->avaliacaoDao = new AvaliacaoDAO();
        $this->avaliacaoService = new AvaliacaoService();

        // executa ação conforme parâmetro na URL (ex: action=list, action=save)
        $this->handleAction();  
    }

    // Lista todas as avaliações
    protected function list(string $msgErro = "", string $msgSucesso = "")
    {
        $dados["lista"] = $this->avaliacaoDao->list();

        $this->loadView("usuario/avaliacao.php", $dados, $msgErro, $msgSucesso);
    }

    // Exibe o formulário de criação
    protected function create()
    {
        $dados['idAvaliacao'] = 0;
        $this->loadView("usuario/avaliacao.php", $dados);
    }

    // Salva os dados do formulário (insere)
    protected function save()
    {

        // Capturar dados do formulário
        $id = $_POST['idAvaliacao'];
        $idTurmaAlunos = trim($_POST['idTurmaAlunos']) !== "" ? trim($_POST['idTurmaAlunos']) : NULL;
        $bimestre = trim($_POST['bimestre']) != "" ? trim($_POST['bimestre']) : NULL;
        $notaClareza = trim($_POST['notaClareza']) != "" ? trim($_POST['notaClareza']) : NULL;
        $notaDidatica = trim($_POST['notaDidatica']) != "" ? trim($_POST['notaDidatica']) : NULL;
        $notaInteracao = trim($_POST['notaInteracao']) != "" ? trim($_POST['notaInteracao']) : NULL;
        $notaMotivacao = trim($_POST['notaMotivacao']) != "" ? trim($_POST['notaMotivacao']) : NULL;
        $notaDominioConteudo = trim($_POST['notaDominioConteudo']) != "" ? trim($_POST['notaDominioConteudo']) : NULL;
        $notaOrganizacao = trim($_POST['notaOrganizacao']) != "" ? trim($_POST['notaOrganizacao']) : NULL;
        $notaRecursos = trim($_POST['notaRecursos']) != "" ? trim($_POST['notaRecursos']) : NULL;
        $comentario = trim($_POST['comentario']) != "" ? trim($_POST['comentario']) : NULL;

        // Criar objeto Avaliacao e preencher
        $avaliacao = new Avaliacao();
        $avaliacao->setIdAvaliacao($id);
        $avaliacao->setIdTurmaAlunos($idTurmaAlunos);
        $avaliacao->setBimestre($bimestre);
        $avaliacao->setNotaClareza($notaClareza);
        $avaliacao->setNotaDidatica($notaDidatica);
        $avaliacao->setNotaInteracao($notaInteracao);
        $avaliacao->setNotaMotivacao($notaMotivacao);
        $avaliacao->setNotaDominioConteudo($notaDominioConteudo);
        $avaliacao->setNotaOrganizacao($notaOrganizacao);
        $avaliacao->setNotaRecursos($notaRecursos);
        $avaliacao->setComentario($comentario);
        

        //Validar os dados (camada service)
        $erros = $this->avaliacaoService->validarDados($avaliacao);

        if (!$erros) {

            //Inserir na Base de Dados
            try {
                if ($avaliacao->getIdAvaliacao() == 0){

                    //print_r($avaliacao);
                    //exit;

                    $this->avaliacaoDao->insert($avaliacao);
                } else {
                    $this->avaliacaoDao->update($avaliacao);
                
                }

                header("location: " . BASEURL . "/controller/AvaliacaoController.php?action=list");
                exit;

            } catch (PDOException $e) {
                //Iserir erro no array
                array_push($erros, "Erro ao gravar no banco de dados!" . $e->getMessage());
                array_push($erros, $e->getMessage());
            }
        }

        //Mostrar os erros
        $dados['idAvaliacao'] = $avaliacao->getIdAvaliacao();
        $dados["avaliacao"] = $avaliacao;

        $msgErro = implode("<br>", $erros);

        $this->loadView("usuario/avaliacao.php", $dados, $msgErro);
    }
}

#Criar objeto para executar o construtor e acionar handleAction()
new AvaliacaoController();
