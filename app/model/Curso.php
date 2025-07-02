<?php 
#Nome do arquivo: Usuario.php
#Objetivo: classe Model para Usuario

class Curso {

    private ?int $id;
    private ?string $nome;
    private ?string $nivel;

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
     * Get the value of nivel
     */
    public function getNivel(): ?string
    {
        return $this->nivel;
    }

    /**
     * Set the value of nivel
     */
    public function setNivel(?string $nivel): self
    {
        $this->nivel = $nivel;

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
}