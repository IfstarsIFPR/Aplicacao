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

        //print '<pre> ';
        //print_r($dados["lista"]);
        //print '</pre> ';

        ///controller/TurmaDisciplinaController.php?action=list&idTurma=1

        $this->loadView("usuario/listaAvaliacao.php", $dados, $msgErro, $msgSucesso);

        //TODO: provisoriamente redireciona para a lista de disciplinas da turma 1 - O ideal é redirecionar para a página das minhas avaliações
        //header("location: " . BASEURL . "/controller/TurmaDisciplinaController.php?action=list&idTurma=1?msgSucesso=$msgSucesso");
        //exit;
    }

    protected function disciplinasAvaliadas(string $msgErro = "")
    {
        $idAluno = $this->getIdUsuarioLogado();
        $dados["lista"] = $this->avaliacaoDao->listDisciplinasAvaliadas($idAluno);

        // carrega a view que mostra os cards das disciplinas
        $this->loadView("usuario/disciplinasAvaliadas.php", $dados, $msgErro);
    }


    protected function listarAvaliacoesPorDisciplina(string $msgErro = "", string $msgSucesso = "")
    {
        if (!isset($_GET['idDisciplina'])) {
            $this->list("Disciplina não informada.");
            return;
        }

        $idDisciplina = $_GET['idDisciplina'];
        $idAluno = $this->getIdUsuarioLogado();

        // Buscar somente as avaliações da disciplina selecionada
        $dados["lista"] = $this->avaliacaoDao->listByDisciplinaId($idAluno, $idDisciplina);

        $this->loadView("usuario/listAvaliacao.php", $dados, $msgErro, $msgSucesso);
    }



    protected function listByDisciplina(string $msgErro = "", string $msgSucesso = "")
    {
        if (!isset($_GET['idDisciplina'])) {
            $this->list("Disciplina não informada.");
            return;
        }

        $idDisciplina = $_GET['idDisciplina'];
        $idAluno = $this->getIdUsuarioLogado();

        // Chama o DAO para pegar avaliações do aluno nessa disciplina
        $dados["lista"] = $this->avaliacaoDao->listByDisciplinaId($idAluno, $idDisciplina);

        $dados["idDisciplina"] = $idDisciplina;

        // Carrega a view correta
        $this->loadView("usuario/listAvaliacao.php", $dados, $msgErro, $msgSucesso);
    }




    // Exibe o formulário de criação
    protected function create()
    {
        $dados['idAvaliacao'] = 0;
        $dados['avaliacao'] = null;
        $dados['idDisciplina'] = $_GET['id_disicplina'];

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
        $notaClareza = isset($_POST['notaClareza']) ? $_POST['notaClareza'] : NULL;
        $notaDidatica = isset($_POST['notaDidatica']) ? $_POST['notaDidatica'] : NULL;
        $notaInteracao = isset($_POST['notaInteracao']) ? $_POST['notaInteracao'] : NULL;
        $notaMotivacao = isset($_POST['notaMotivacao']) ? $_POST['notaMotivacao'] : NULL;
        $notaDominioConteudo = isset($_POST['notaDominioConteudo']) ? $_POST['notaDominioConteudo'] : NULL;
        $notaOrganizacao = isset($_POST['notaOrganizacao']) ? $_POST['notaOrganizacao'] : NULL;
        $notaRecursos = isset($_POST['notaRecursos']) ? $_POST['notaRecursos'] : NULL;
        $comentario = trim($_POST['comentario']) != "" ? $_POST['comentario'] : NULL;

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
                if ($avaliacao->getIdAvaliacao() == 0) {

                    $this->avaliacaoDao->insert($avaliacao);
                } else {
                    $this->avaliacaoDao->update($avaliacao);
                }

                $this->list("", "Avaliação salva com sucesso!");
                return;
                // Importante para evitar que o código continue e exiba o formulário novamente

            } catch (PDOException $e) {
                //Iserir erro no array
                array_push($erros, "Erro ao gravar no banco de dados!" . $e->getMessage());
                array_push($erros, $e->getMessage());
            }
        }

        //Mostrar os erros
        $dados['idAvaliacao'] = $avaliacao->getIdAvaliacao();
        $dados['idDisciplina'] = $idDisciplina;
        $dados["avaliacao"] = $avaliacao;

        $dados["erros"] = $erros;

    $this->loadView("usuario/avaliacao.php", $dados);
    return;

    }
}

#Criar objeto para executar o construtor e acionar handleAction()
new AvaliacaoController();
