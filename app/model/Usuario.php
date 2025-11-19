<?php 
#Nome do arquivo: Usuario.php
#Objetivo: classe Model para Usuario

require_once(__DIR__ . "/enum/UsuarioTipo.php");
require_once(__DIR__ . "/Curso.php");
require_once(__DIR__ . "/enum/UsuarioStatus.php");

class Usuario {

    private ?int $id;
    private ?Curso $curso;
    private ?string $nome;      
    private ?string $email;
    private ?string $senha;
    private ?string $tipoUsuario;
    private ?int $siape;
    private ?string $declaracaoMatricula = "";
    private ?int $numMatricula;
    private ?string $status = "pendente";

  
    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of curso
     */
    public function getCurso(): ?Curso
    {
        return $this->curso;
    }

    /**
     * Set the value of curso
     */
    public function setCurso(?Curso $curso): self
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of senha
     */
    public function getSenha(): ?string
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     */
    public function setSenha(?string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of tipoUsuario
     */
    public function getTipoUsuario(): ?string
    {
        return $this->tipoUsuario;
    }

    /**
     * Set the value of tipoUsuario
     */
    public function setTipoUsuario(?string $tipoUsuario): self
    {
        $this->tipoUsuario = $tipoUsuario;

        return $this;
    }

    /**
     * Get the value of siape
     */
    public function getSiape(): ?int
    {
        return $this->siape;
    }

    /**
     * Set the value of siape
     */
    public function setSiape(?int $siape): self
    {
        $this->siape = $siape;

        return $this;
    }

    /**
     * Get the value of declaracaoMatricula
     */
    public function getDeclaracaoMatricula(): ?string
    {
        return $this->declaracaoMatricula;
    }

    /**
     * Set the value of declaracaoMatricula
     */
    public function setDeclaracaoMatricula(?string $declaracaoMatricula): self
    {
        $this->declaracaoMatricula = $declaracaoMatricula;

        return $this;
    }

    /**
     * Get the value of numMatricula
     */
    public function getNumMatricula(): ?int
    {
        return $this->numMatricula;
    }

    /**
     * Set the value of numMatricula
     */
    public function setNumMatricula(?int $numMatricula): self
    {
        $this->numMatricula = $numMatricula;

        return $this;
    }

    /**
     * Get the value of fotoPerfil
     */


    /**
     * Get the value of status
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }
}