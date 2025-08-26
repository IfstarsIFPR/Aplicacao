<?php

require_once(__DIR__ . "/Turma.php");
require_once(__DIR__ . "/Disciplina.php");
require_once(__DIR__ . "/Usuario.php");

class TurmaDisciplina {

    private ?int $id;
    private ?Turma $turma;
    private ?Disciplina $disciplina;
    private ?Usuario $professor;


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
     * Get the value of turma
     */
    public function getTurma(): ?Turma
    {
        return $this->turma;
    }

    /**
     * Set the value of turma
     */
    public function setTurma(?Turma $turma): self
    {
        $this->turma = $turma;

        return $this;
    }

    /**
     * Get the value of disciplina
     */
    public function getDisciplina(): ?Disciplina
    {
        return $this->disciplina;
    }

    /**
     * Set the value of disciplina
     */
    public function setDisciplina(?Disciplina $disciplina): self
    {
        $this->disciplina = $disciplina;

        return $this;
    }

    /**
     * Get the value of professor
     */
    public function getProfessor(): ?Usuario
    {
        return $this->professor;
    }

    /**
     * Set the value of professor
     */
    public function setProfessor(?Usuario $professor): self
    {
        $this->professor = $professor;

        return $this;
    }
}