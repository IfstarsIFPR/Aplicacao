ALTER TABLE usuario ADD COLUMN foto_perfil VARCHAR(255);
ALTER TABLE turmadisciplina ADD CONSTRAINT fk_turmadisciplina_turma FOREIGN KEY (idTurma) REFERENCES turma(idTurma);
ALTER TABLE turmadisciplina ADD CONSTRAINT fk_turmadisciplina_disciplina FOREIGN KEY (idDisciplina) REFERENCES disciplina(idDisciplina);

ALTER TABLE turma
DROP FOREIGN KEY fk_turmas_disciplinas;
ALTER TABLE turma
DROP COLUMN idDisciplina;


ALTER TABLE turma ADD COLUMN idCurso INT NOT NULL;
ALTER TABLE turma ADD CONSTRAINT fk_turma_curso FOREIGN KEY (idCurso) REFERENCES curso(idCurso);

ALTER TABLE disciplina
DROP FOREIGN KEY fk_disciplinas_cursos1;

ALTER TABLE disciplina
DROP COLUMN idCurso;
