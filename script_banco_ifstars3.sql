/* Disciplina */
ALTER TABLE disciplina DROP CONSTRAINT fk_disciplina_turma;
ALTER TABLE disciplina DROP COLUMN idTurma;

/* turmadisciplina */
ALTER TABLE turmadisciplina ADD COLUMN idProfessor INT NOT NULL;
ALTER TABLE turmadisciplina ADD CONSTRAINT fk_discTurma_usuario FOREIGN KEY (idProfessor) REFERENCES usuario (idUsuario);

/* turmaalunos */
ALTER TABLE turmaalunos DROP CONSTRAINT fk_turmasAlunos_turmas1;
ALTER TABLE turmaalunos DROP COLUMN idTurma;

ALTER TABLE turmaalunos ADD COLUMN idTurmaDisciplina INT NOT NULL;
ALTER TABLE turmaalunos ADD CONSTRAINT fk_turmaAlunos_turmaDisciplina FOREIGN KEY (idTurmaDisciplina) 
    REFERENCES turmadisciplina (idTurmaDisciplina);

ALTER TABLE turmaalunos DROP CONSTRAINT fk_turmaAlunos_turmaDisciplina;

ALTER TABLE turmaalunos ADD COLUMN idTurma INT NOT NULL;
ALTER TABLE turmaalunos ADD CONSTRAINT fk_turmaAlunos_turma FOREIGN KEY (idTurma) 
    REFERENCES turma (idTurma) ON DELETE CASCADE;

/* Avaliacao */
ALTER TABLE avaliacao ADD COLUMN idTurma INT;
ALTER TABLE avaliacao ADD CONSTRAINT fk_avaliacao_turma FOREIGN KEY (idTurma) 
REFERENCES turma (idTurma);
