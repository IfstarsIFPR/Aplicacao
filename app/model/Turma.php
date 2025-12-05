<?php
#Nome do arquivo: Turma.php
#Objetivo: classe Model para Turma
require_once(__DIR__ . "/Curso.php");

class Turma
{

    private ?int $id;
    private ?Curso $curso;
    private ?int $codigoTurma;
    private ?int $anoTurma;
    private string $turno;


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
     * Get the value of codigoTurma
     */
    public function getCodigoTurma(): ?int
    {
        return $this->codigoTurma;
    }

    /**
     * Set the value of codigoTurma
     */
    public function setCodigoTurma(?int $codigoTurma): self
    {
        $this->codigoTurma = $codigoTurma;

        return $this;
    }

    /**
     * Get the value of anoTurma
     */
    public function getAnoTurma(): ?int
    {
        return $this->anoTurma;
    }

    /**
     * Set the value of anoTurma
     */
    public function setAnoTurma(?int $anoTurma): self
    {
        $this->anoTurma = $anoTurma;

        return $this;
    }

    /**
     * Get the value of turno
     */
    public function getTurno(): string
    {
        return $this->turno;
    }

    /**
     * Set the value of turno
     */
    public function setTurno(string $turno): self
    {
        $this->turno = $turno;

        return $this;
    }
}
