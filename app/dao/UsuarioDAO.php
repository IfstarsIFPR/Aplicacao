<?php
#Nome do arquivo: UsuarioDAO.php
#Objetivo: classe DAO para o model de Usuario

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Usuario.php");
include_once(__DIR__ . "/../model/enum/UsuarioTipo.php");

class UsuarioDAO {

    //Método para listar os usuaários a partir da base de dados
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuario u ORDER BY u.nomeUsuario";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapUsuarios($result);
    }

    //Método para listar os usuários pendentes a partir da base de dados
    public function listPendentes() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuario u WHERE u.tipoUsuario = 'aluno' AND u.status = 'pendente' ORDER BY u.nomeUsuario";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapUsuarios($result);
    }

    public function listByTipo(string $tipoUsuario) {
    $conn = Connection::getConn();

    $sql = "SELECT * FROM usuario WHERE tipoUsuario = ? ORDER BY nomeUsuario";
    $stm = $conn->prepare($sql);
    $stm->execute([$tipoUsuario]);
    $result = $stm->fetchAll();

    return $this->mapUsuarios($result);
}




    //Método para atualizar o status do aluno a partir da base de dados
    public function atualizarStatus(int $idUsuario, string $status)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE usuario SET status = :status WHERE idUsuario = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue("status", $status);
        $stm->bindValue("id", $idUsuario);
        $stm->execute();
    }

    public function listProfessores() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuario u WHERE u.tipoUsuario = ? ORDER BY u.nomeUsuario";
        $stm = $conn->prepare($sql);    
        $stm->execute([UsuarioTipo::PROFESSOR]);
        $result = $stm->fetchAll();
        
        return $this->mapUsuarios($result);
    }


    //Método para buscar um usuário por seu ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuario u" .
               " WHERE u.idUsuario = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findById()" . 
            " - Erro: mais de um usuário encontrado.");
    }


    //Método para buscar um usuário por seu login e senha
    public function findByEmailSenha(string $email, string $senha) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuario u" .
               " WHERE BINARY u.email = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$email]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1) {
            //Tratamento para senha criptografada
            if(password_verify($senha, $usuarios[0]->getSenha()))
                return $usuarios[0];
            else
                return null;
        } elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByLoginSenha()" . 
            " - Erro: mais de um usuário encontrado.");
    }

    //Método para inserir um Usuario
    public function insert(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO usuario (nomeUsuario, email, senha, tipoUsuario, siape, foto_perfil)" .
               " VALUES (:nomeUsuario, :email, :senha, :tipoUsuario, :siape, :foto_perfil)";
        
        $senhaCripto = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);

        $stm = $conn->prepare($sql);
        $stm->bindValue("nomeUsuario", $usuario->getNome());
        $stm->bindValue("email", $usuario->getEmail());
        $stm->bindValue("senha", $senhaCripto);
        $stm->bindValue("tipoUsuario", $usuario->getTipoUsuario());
        $stm->bindValue("siape", $usuario->getSiape());


        //TODO: Caso houver tempo, vamos implementar o sistema de fotos de perfil
        $stm->bindValue("foto_perfil", "arquivo_6894a1046123e.jpg");
        //$stm->bindValue("foto_perfil", $usuario->getFotoPerfil());
        $stm->execute();
    }


 public function insertAluno(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO usuario (nomeUsuario, email, senha, tipoUsuario, idcurso, numMatricula, declaracaoMatricula )" .
               " VALUES (:nomeUsuario, :email, :senha, :tipoUsuario, :idCurso, :numMatricula, :declaracaoMatricula)";
        
        $senhaCripto = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);

        $stm = $conn->prepare($sql);
        $stm->bindValue("nomeUsuario", $usuario->getNome());
        $stm->bindValue("email", $usuario->getEmail());
        $stm->bindValue("senha", $senhaCripto);
        $stm->bindValue("tipoUsuario", $usuario->getTipoUsuario());
        $stm->bindValue("idCurso", ($usuario->getCurso() ? $usuario->getCurso()->getId() : NULL));
        $stm->bindValue("numMatricula", $usuario->getNumMatricula());
        $stm->bindValue("declaracaoMatricula", $usuario->getdeclaracaoMatricula()); 
        $stm->execute();
    }


    //Método para atualizar um Usuario
    public function update(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "UPDATE usuario SET email = :email," . 
              " nomeUsuario = :nomeUsuario," . " senha = :senha," .  " tipoUsuario = :tipoUsuario," . " foto_perfil = :foto_perfil," .
              " idCurso = :idCurso" .
               " WHERE idUsuario = :id";
        
        $stm = $conn->prepare($sql);;
        $stm->bindValue("email", $usuario->getEmail());
        $stm->bindValue("nomeUsuario", $usuario->getNome());
        $stm->bindValue("senha", password_hash($usuario->getSenha(), PASSWORD_DEFAULT));
        $stm->bindValue("foto_perfil", $usuario->getFotoPerfil());
        $stm->bindValue("tipoUsuario", $usuario->getTipoUsuario());
        $stm->bindValue("idCurso", ($usuario->getCurso() ? $usuario->getCurso()->getId() : NULL));
        $stm->bindValue("id", $usuario->getId());
        $stm->execute();
    }

    //Método para excluir um Usuario pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM usuario WHERE idUsuario = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    public function updateFotoPerfil(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "UPDATE usuario SET foto_perfil = ? WHERE idUsuario = ?";

        $stm = $conn->prepare($sql);
        $stm->execute(array($usuario->getFotoPerfil(), $usuario->getId()));
        
    }

    //Método para retornar a quantidade de usuários salvos na base
    public function quantidadeUsuarios() {
        $conn = Connection::getConn();

        $sql = "SELECT COUNT(*) AS qtd_usuario FROM usuario";

        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]["qtd_usuario"];
    }

    public function findProfessores() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuario u WHERE u.tipoUsuario = ? ORDER BY u.nomeUsuario";
        $stm = $conn->prepare($sql);    
        $stm->execute([UsuarioTipo::PROFESSOR]);
        $result = $stm->fetchAll();
        
        return $this->mapUsuarios($result);
    }

    //Método para converter um registro da base de dados em um objeto Usuario
    public function mapUsuarios($result) {
        $usuarios = array();
        foreach ($result as $reg) {
            $usuario = new Usuario();
            $usuario->setId($reg['idUsuario']);
            $usuario->setNome($reg['nomeUsuario']);
            $usuario->setEmail($reg['email']);
            $usuario->setSenha($reg['senha']);
            $usuario->setTipoUsuario($reg['tipoUsuario']);
            $usuario->setSiape($reg['siape']);
            $usuario->setFotoPerfil($reg['foto_perfil']);
            $usuario->setDeclaracaoMatricula($reg['declaracaoMatricula']);
            $usuario->setStatus($reg['status']);
            
            if($reg["idCurso"] != NULL) {
                $curso = new Curso();
                $curso->setId($reg["idCurso"]);
                $usuario->setCurso($curso);
            } else
                $usuario->setCurso(NULL);
            
            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }

}