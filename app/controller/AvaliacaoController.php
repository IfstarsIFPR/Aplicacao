<?php
#Classe controller para Avaliação
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/AvaliacaoDAO.php");
require_once(__DIR__ . "/../model/Avaliacao.php");
require_once(__DIR__ . "/../service/AvaliacaoService.php");
require_once(__DIR__ . "/../dao/DisciplinaDAO.php");


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
        $dados["lista"] = $this->avaliacaoDao->listByAlunoId($this->getIdUsuarioLogado());


        print '<pre> ';
        print_r($dados["lista"]);
        print '</pre> ';

        ///controller/TurmaDisciplinaController.php?action=list&idTurma=1

        //$this->loadView("usuario/avaliacao.php", $dados, $msgErro, $msgSucesso);

        //TODO: provisoriamente redireciona para a lista de disciplinas da turma 1 - O ideal é redirecionar para a página das minhas avaliações
        //header("location: " . BASEURL . "/controller/TurmaDisciplinaController.php?action=list&idTurma=1?msgSucesso=$msgSucesso");
        //exit;
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

        $disciplinaDao = new DisciplinaDAO();

        // Capturar dados do formulário
        $id = $_POST['idAvaliacao'];

        $bimestre = trim($_POST['bimestre']) != "" ? trim($_POST['bimestre']) : NULL;

        $idDisciplina = trim($_POST['idDisciplina']) != "" ? trim($_POST['idDisciplina']) : NULL;

        //TODO: AQUI DEVE HAVER UMA VALIDACAO PARA O ID DA DISCILINA.


        $professor = $disciplinaDao->findProfessorByDisciplinaId($idDisciplina);

        $idAluno = $this->getIdUsuarioLogado();
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

        // $avaliacao->setIdTurmaAlunos($idTurmaAlunos);
        $avaliacao->setBimestre($bimestre);

        $avaliacao->setIdAluno($idAluno);
        $avaliacao->setProfessor($professor);
        $avaliacao->setIdDisciplina($idDisciplina);

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

                $this->list("", "Avaliação salva com sucesso!");
                return; // Importante para evitar que o código continue e exiba o formulário novamente

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
