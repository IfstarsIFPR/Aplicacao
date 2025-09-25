<?php 
#Nome do arquivo: Disciplina.php
#Objetivo: classe Model para Disciplina

class Disciplina {

    private ?int $id;
    private ?string $nomeDisciplina;

    //TODO: implementar o relacionamento ManyToMany com Turma
    private array $turmas; // array de objetos Turma

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
     * Get the value of nomeDisciplina
     */
    public function getNomeDisciplina(): ?string
    {
        return $this->nomeDisciplina;
    }

    /**
     * Set the value of nomeDisciplina
     */
    public function setNomeDisciplina(?string $nomeDisciplina): self
    {
        $this->nomeDisciplina = $nomeDisciplina;

        return $this;
    }
}