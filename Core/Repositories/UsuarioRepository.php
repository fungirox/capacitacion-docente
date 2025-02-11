<?php

namespace Core\Repositories;

use Core\Roles\Roles;

class UsuarioRepository extends RepositoryTemplate {

    private $admin = Roles::ADMIN;
    private $docente = Roles::DOCENTE;
    private $instructor = Roles::INSTRUCTOR;
    private $docenteAndInstructor = Roles::DOCENTE_AND_INSTRUCTOR;
    private $guest = Roles::GUEST;

    public function getById($id) {
        return $this->query(
            "SELECT
                *,
                CASE
                    WHEN admin.ADMINID IS NOT NULL THEN '$this->admin'
                    WHEN docente.DOCENTEID IS NOT NULL AND instructor.INSTRUCTORID IS NOT NULL THEN '$this->docenteAndInstructor'
                    WHEN docente.DOCENTEID IS NOT NULL THEN '$this->docente'
                    WHEN instructor.INSTRUCTORID IS NOT NULL THEN '$this->instructor'
                    ELSE '$this->guest'
                END AS rol
            FROM
                [tblUsuario] usuario
                LEFT JOIN tblAdmin admin on usuario.USERID = admin.USERID
                LEFT JOIN tblDocente docente on usuario.USERID = docente.USERID
                LEFT JOIN tblInstructor instructor on usuario.USERID = instructor.USERID
            WHERE
                usuario.USERID = ? AND USER_Activo = 1",
            [$id]
        )->getOrFail();
    }

    public function getByUsername($username) {
        return $this->query(
            "SELECT
                usuario.USERID,
                usuario.USER_NombreUsuario,
                usuario.USER_Password,
                CASE
                    WHEN admin.ADMINID IS NOT NULL THEN '$this->admin'
                    WHEN docente.DOCENTEID IS NOT NULL AND instructor.INSTRUCTORID IS NOT NULL THEN '$this->docenteAndInstructor'
                    WHEN docente.DOCENTEID IS NOT NULL THEN '$this->docente'
                    WHEN instructor.INSTRUCTORID IS NOT NULL THEN '$this->instructor'
                    ELSE '$this->guest'
                END AS rol
            FROM
                [tblUsuario] usuario
                LEFT JOIN tblAdmin admin on usuario.USERID = admin.USERID
                LEFT JOIN tblDocente docente on usuario.USERID = docente.USERID
                LEFT JOIN tblInstructor instructor on usuario.USERID = instructor.USERID
            WHERE
                USER_NombreUsuario = ? AND
                USER_Activo = 1",
            [$username]
        )->get();
    }

    public function getInstructorFullName($cursoId) {
        return $this->query(
            "SELECT u.USERID, u.USER_Nombre + ' ' + u.USER_Apellido as nombre
            FROM tblCurso c
            JOIN tblCursoInstructor ci ON c.CURSOID = ci.CURSOID
            JOIN tblInstructor i ON ci.INSTRUCTORID = i.INSTRUCTORID
            JOIN tblUsuario u ON i.USERID = u.USERID
            WHERE c.CURSOID = ?",
            [$cursoId]
        )->get();
    }

    public function userAlreadyExists($username) {
        return $this->query(
            "SELECT COUNT(*) as total FROM tblUsuario WHERE USER_NombreUsuario = ?",
            [$username]
        )->get()['total'] > 0;
    }

    public function userAlreadyExistsForUpdate($id, $username) {
        return $this->query(
            "SELECT COUNT(*) as total FROM tblUsuario WHERE USERID != ? AND USER_NombreUsuario = ?",
            [$id, $username]
        )->get()['total'] > 0;
    }

    public function archive($id, $state) {
        return $this->query(
            "UPDATE tblUsuario SET USER_Activo = ? WHERE USERID = ?",
            [$state, $id]
        );
    }
}
