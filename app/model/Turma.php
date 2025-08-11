<?php 
#Nome do arquivo: Turma.php
#Objetivo: classe Model para Turma

class Turma {

    private ?int $id;

    private int $idDisciplina;
    private int $idUsuario;
    private string $codigoTurma;
    private int $anoTurma;
    private string $turno;

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getIdDisciplina(): int {
        return $this->idDisciplina;
    }

    public function setIdDisciplina(int $idDisciplina): void {
        $this->idDisciplina = $idDisciplina;
    }

    public function getIdUsuario(): int {
        return $this->idUsuario;
    }

    public function setIdUsuario(int $idUsuario): void {
        $this->idUsuario = $idUsuario;
    }

    public function getCodigoTurma(): string {
        return $this->codigoTurma;
    }

    public function setCodigoTurma(string $codigoTurma): void {
        $this->codigoTurma = $codigoTurma;
    }

    public function getAnoTurma(): int {
        return $this->anoTurma;
    }

    public function setAnoTurma(int $anoTurma): void {
        $this->anoTurma = $anoTurma;
    }

    public function getTurno(): string {
        return $this->turno;
    }

    public function setTurno(string $turno): void {
        $this->turno = $turno;
    }
  
}