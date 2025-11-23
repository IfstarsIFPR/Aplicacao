<?php 
#Nome do arquivo: Disciplina.php
#Objetivo: classe Model para Disciplina

class Disciplina {

    private ?int $id;
    private ?string $nomeDisciplina;

    //Atributo para armazenar o nome do professor na listagem de turmas do aluno
    private ?string $nomeProfessor;

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

    /**
     * Get the value of nomeProfessor
     */
    public function getNomeProfessor(): ?string
    {
        return $this->nomeProfessor;
    }

    /**
     * Set the value of nomeProfessor
     */
    public function setNomeProfessor(?string $nomeProfessor): self
    {
        $this->nomeProfessor = $nomeProfessor;

        return $this;
    }
}