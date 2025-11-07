<?php

class Avaliacao {

    private ?int $idAvaliacao;
    private ?int $idTurmaAlunos;
    private ?string $bimestre;
    private ?int $notaClareza;
    private ?int $notaDidatica;
    private ?int $notaInteracao;
    private ?int $notaMotivacao;
    private ?int $notaDominioConteudo;
    private ?int $notaOrganizacao;
    private ?int $notaRecursos;
    private ?string $comentario;


    /**
     * Get the value of idAvaliacao
     */
    public function getIdAvaliacao(): ?int
    {
        return $this->idAvaliacao;
    }

    /**
     * Set the value of idAvaliacao
     */
    public function setIdAvaliacao(?int $idAvaliacao): self
    {
        $this->idAvaliacao = $idAvaliacao;

        return $this;
    }

    /**
     * Get the value of idTurmaAlunos
     */
    public function getIdTurmaAlunos(): ?int
    {
        return $this->idTurmaAlunos;
    }

    /**
     * Set the value of idTurmaAlunos
     */
    public function setIdTurmaAlunos(?int $idTurmaAlunos): self
    {
        $this->idTurmaAlunos = $idTurmaAlunos;

        return $this;
    }

    /**
     * Get the value of bimestre
     */
    public function getBimestre(): ?string
    {
        return $this->bimestre;
    }

    /**
     * Set the value of bimestre
     */
    public function setBimestre(?string $bimestre): self
    {
        $this->bimestre = $bimestre;

        return $this;
    }

    /**
     * Get the value of notaClareza
     */
    public function getNotaClareza(): ?int
    {
        return $this->notaClareza;
    }

    /**
     * Set the value of notaClareza
     */
    public function setNotaClareza(?int $notaClareza): self
    {
        $this->notaClareza = $notaClareza;

        return $this;
    }

    /**
     * Get the value of notaDidatica
     */
    public function getNotaDidatica(): ?int
    {
        return $this->notaDidatica;
    }

    /**
     * Set the value of notaDidatica
     */
    public function setNotaDidatica(?int $notaDidatica): self
    {
        $this->notaDidatica = $notaDidatica;

        return $this;
    }

    /**
     * Get the value of notaInteracao
     */
    public function getNotaInteracao(): ?int
    {
        return $this->notaInteracao;
    }

    /**
     * Set the value of notaInteracao
     */
    public function setNotaInteracao(?int $notaInteracao): self
    {
        $this->notaInteracao = $notaInteracao;

        return $this;
    }

    /**
     * Get the value of notaMotivacao
     */
    public function getNotaMotivacao(): ?int
    {
        return $this->notaMotivacao;
    }

    /**
     * Set the value of notaMotivacao
     */
    public function setNotaMotivacao(?int $notaMotivacao): self
    {
        $this->notaMotivacao = $notaMotivacao;

        return $this;
    }

    /**
     * Get the value of notaDominioConteudo
     */
    public function getNotaDominioConteudo(): ?int
    {
        return $this->notaDominioConteudo;
    }

    /**
     * Set the value of notaDominioConteudo
     */
    public function setNotaDominioConteudo(?int $notaDominioConteudo): self
    {
        $this->notaDominioConteudo = $notaDominioConteudo;

        return $this;
    }

    /**
     * Get the value of notaOrganizacao
     */
    public function getNotaOrganizacao(): ?int
    {
        return $this->notaOrganizacao;
    }

    /**
     * Set the value of notaOrganizacao
     */
    public function setNotaOrganizacao(?int $notaOrganizacao): self
    {
        $this->notaOrganizacao = $notaOrganizacao;

        return $this;
    }

    /**
     * Get the value of notaRecursos
     */
    public function getNotaRecursos(): ?int
    {
        return $this->notaRecursos;
    }

    /**
     * Set the value of notaRecursos
     */
    public function setNotaRecursos(?int $notaRecursos): self
    {
        $this->notaRecursos = $notaRecursos;

        return $this;
    }

    /**
     * Get the value of comentario
     */
    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    /**
     * Set the value of comentario
     */
    public function setComentario(?string $comentario): self
    {
        $this->comentario = $comentario;

        return $this;
    }
}