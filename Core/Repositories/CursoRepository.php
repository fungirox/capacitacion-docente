<?php

namespace Core\Repositories;

class CursoRepository extends RepositoryTemplate {

    public function getAll() {
        return $this->query(
            "SELECT
                curso.CURSOID,
                curso.CURSO_Nombre,
                curso.CURSO_Tipo + ' ' + curso.CURSO_Modalidad as tipo,
                curso.CURSO_Activo,
                STRING_AGG(area.AREA_Siglas, ',') AS areas,
                usuario.USER_Nombre + ' ' + usuario.USER_Apellido AS instructor_nombre
            FROM
                tblCurso AS curso
            LEFT JOIN
                tblCursoInstructor AS cursoInstructor ON curso.CURSOID = cursoInstructor.CURSOID
            LEFT JOIN
                tblInstructor AS instructor ON instructor.INSTRUCTORID = cursoInstructor.INSTRUCTORID
            LEFT JOIN
                tblUsuario AS usuario ON usuario.USERID = instructor.USERID
            LEFT JOIN
                tblCursoArea AS cursoArea ON cursoArea.CURSOID = curso.CURSOID
            LEFT JOIN
                tblArea AS area ON area.AREAID = cursoArea.AREAID
            GROUP BY
                curso.CURSOID,
                curso.CURSO_Nombre,
                curso.CURSO_Tipo,
                curso.CURSO_Modalidad,
                curso.CURSO_Total_Horas,
                curso.CURSO_Activo,
                usuario.USER_Nombre,
                usuario.USER_Apellido"
        )->getAll();
    }
}
