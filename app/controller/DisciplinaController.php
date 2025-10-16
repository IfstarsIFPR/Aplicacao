<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Disciplina.php");
require_once(__DIR__ . "/../dao/DisciplinaDAO.php");
require_once(__DIR__ . "/../dao/TurmaDAO.php");

require_once(__DIR__ . "/../service/DisciplinaService.php");

class DisciplinaController extends Controller
{

    private TurmaDAO $turmaDAO;
    private DisciplinaDAO $disciplinaDao;
    private DisciplinaService $disciplinaService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct()
    {

        if (! $this->usuarioEstaLogado())
            return;

        //Verificar se o usuário é ADMIN
        if (! $this->usuarioLogadoIsAdmin()) {
            echo "Acesso Negado!";
            return;
        }

        $this->disciplinaDao = new DisciplinaDAO();
        $this->disciplinaService = new DisciplinaService();
        $this->turmaDAO = new TurmaDAO();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "")
    {

        $dados["lista"] = $this->disciplinaDao->list();

        // Ordena as turmas pelo nome do curso
        // usort($dados["lista"], function ($a, $b) {
        //     return strcmp($a->getCurso()->getNome(), $b->getCurso()->getNome());
        // });

        $this->loadView("pages/disciplina/disciplina-list.php", $dados,  $msgErro, $msgSucesso);
    }

    protected function create()
    {


        $dados["idDisciplina"] = 0; // garante que não dará erro na view
        $dados["disciplina"] = null;
        
        $dados["turmas"]  = $this->turmaDAO->list();

        // Ordena as turmas pelo nome do curso
        usort($dados["turmas"], function($a, $b) {
            return strcmp($a->getCurso()->getNome(), $b->getCurso()->getNome());
        });

        $this->loadView("pages/disciplina/disciplina-form.php", $dados);
    }

    protected function edit()
    {
        //Busca a turma na base pelo ID    
        $disciplina = $this->findDisciplinaById();
        if ($disciplina) {
            $dados['idDisciplina'] = $disciplina->getId();
            $dados["disciplina"] = $disciplina;

            $dados["turmas"]  = $this->turmaDAO->list();

            // Ordena as turmas pelo nome do curso
            usort($dados["turmas"], function($a, $b) {
                return strcmp($a->getCurso()->getNome(), $b->getCurso()->getNome());
            });

            $this->loadView("pages/disciplina/disciplina-form.php", $dados);
        } else
            $this->list("Disciplina não encontrada!");
    }

    protected function save()
    {
        // Capturar os dados do formulário
        $id = $_POST['idDisciplina'] ?? 0;
        $nomeDisciplina = trim($_POST['nomeDisciplina']) != "" ? trim($_POST['nomeDisciplina']) : NULL;

        $turmasIds = $_POST['turmas'] ?? [];

        // Criar objeto Disciplina
        $disciplina = new Disciplina();
        $disciplina->setId($id);
        $disciplina->setNomeDisciplina($nomeDisciplina);

        // Validar os dados (camada service)
        $erros = $this->disciplinaService->validarDados($disciplina);
        if (!$erros) {
            try {
                if ($disciplina->getId() == 0) {
                    // Insert e recuperar o ID
                    $this->disciplinaDao->insert($disciplina, $turmasIds);
                } else {
                    $this->disciplinaDao->update($disciplina);
                }

                // Redireciona de volta para lista da turma
                header("location: " . BASEURL . "/controller/DisciplinaController.php?action=list");
                exit;
            } catch (PDOException $e) {
                $erros[] = "Erro ao gravar no banco de dados!";
                $erros[] = $e->getMessage();
            }
        }

        // Mostrar os erros
        $dados['idDisciplina'] = $disciplina->getId();
        $dados["disciplina"] = $disciplina;

        $msgErro = implode("<br>", $erros);

        $this->loadView("pages/disciplina/disciplina-form.php", $dados, $msgErro);
    }


    protected function delete()
    {
        $disciplina = $this->findDisciplinaById();
        $idTurma = $_GET['idTurma'] ?? null;

        if ($disciplina) {
            $this->disciplinaDao->deleteById($disciplina->getId());

            header("location: " . BASEURL . "/controller/DisciplinaController.php?action=list&idTurma={$idTurma}");
            exit;
        } else {
            $this->list("Disciplina não encontrada!");
        }
    }
    

    private function findDisciplinaById()
    {
        $id = 0;
        if (isset($_GET["id"]))
            $id = $_GET["id"];

        //Busca o usuário na base pelo ID    
        return $this->disciplinaDao->findById($id);
    }
}


#Criar objeto da classe para assim executar o construtor
new DisciplinaController();
