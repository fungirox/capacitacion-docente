<?php

namespace Core\Repositories;

class CursoRepository extends RepositoryTemplate {

    public function getAll() {
        return $this->query(
            "SELECT
                curso.CURSOID,
                curso.CURSO_Nombre,
                curso.CURSO_Tipo,
                curso.CURSO_Modalidad,
                curso.CURSO_Total_Horas,
                curso.CURSO_Activo,
                usuario.USER_Nombre + ' ' + usuario.USER_Apellido as instructor_nombre
            FROM
                tblCurso as curso
            LEFT JOIN
                tblCursoInstructor as cursoInstructor ON curso.CURSOID = cursoInstructor.CURSOID
            LEFT JOIN
                tblInstructor as instructor ON instructor.INSTRUCTORID = cursoInstructor.INSTRUCTORID
            LEFT JOIN
                tblUsuario as usuario ON usuario.USERID = instructor.USERID;"
        )->getAll();
    }
}
