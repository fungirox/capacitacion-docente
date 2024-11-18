<?php

namespace Core\Repositories;

use Core\Repositories\RepositoryTemplate;
use Core\Roles\Roles;
use Core\Session;

class UsuarioRepository extends RepositoryTemplate {

    private $admin = Roles::ADMIN;
    private $docente = Roles::DOCENTE;
    private $instructor = Roles::INSTRUCTOR;
    private $docenteAndInstructor = Roles::DOCENTE_AND_INSTRUCTOR;
    private $guest = Roles::GUEST;

    public function getAllExceptCurrent() {
        $userId = Session::getUser('id');

        return $this->query(
            "SELECT
                usuario.USERID,
                USER_NombreUsuario,
                USER_Nombre + ' ' + USER_Apellido as USER_NombreCompleto,
                USER_Email,
                CASE
                    WHEN admin.ADMINID IS NOT NULL THEN 'Administrador'
                    WHEN docente.DOCENTEID IS NOT NULL AND instructor.INSTRUCTORID IS NOT NULL THEN 'Docente/Instructor'
                    WHEN docente.DOCENTEID IS NOT NULL THEN 'Docente'
                    WHEN instructor.INSTRUCTORID IS NOT NULL THEN 'Instructor'
                    ELSE '$this->guest'
                END AS rol,
                CASE
                    WHEN admin.ADMINID IS NOT NULL THEN 'danger'
                    WHEN docente.DOCENTEID IS NOT NULL AND instructor.INSTRUCTORID IS NOT NULL THEN 'warning'
                    WHEN docente.DOCENTEID IS NOT NULL THEN 'success'
                    WHEN instructor.INSTRUCTORID IS NOT NULL THEN 'secondary'
                    ELSE ''
                END AS color
            FROM
                [tblUsuario] usuario
                LEFT JOIN tblAdmin admin on usuario.USERID = admin.USERID
                LEFT JOIN tblDocente docente on usuario.USERID = docente.USERID
                LEFT JOIN tblInstructor instructor on usuario.USERID = instructor.USERID
            WHERE
                usuario.USERID != $userId AND
                USER_Activo = 1

            "
        )->getAll();
    }

    public function getById($id) {
        return $this->query("SELECT * FROM tblUsuario WHERE USERID = ? AND USER_Activo = 1", [$id])->getOrFail();
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
                USER_Activo = 1
            ",
            [$username]
        )->get();
    }

    public function createUsuario($values) {
        return $this->query(
            "INSERT INTO tblUsuario (USER_NombreUsuario, USER_Password, USER_Nombre, USER_Apellido, USER_Email, USER_Genero) VALUES (?, ?, ?, ?, ?, ?)",
            [$values["username"], password_hash($values["contraseña"], PASSWORD_BCRYPT), $values["nombre"], $values["apellido"], $values["email"], $values["genero"]]
        );
    }

    public function createDocente($values) {
        return $this->query(
            "INSERT INTO tblDocente (USERID, DOCENTE_Nomina, DOCENTE_Base, DOCENTE_Horas_Base) VALUES (?, ?, ?, ?)",
            [$values["userId"], $values["username"], $values["baseOrHoras"], $values["horasBase"]]
        );
    }

    public function createInstructor($userId) {
        return $this->query(
            "INSERT INTO tblInstructor (USERID) VALUES (?)",
            [$userId]
        );
    }

    public function createAdministrador($userId) {
        return $this->query(
            "INSERT INTO tblAdmin (USERID) VALUES (?)",
            [$userId]
        );
    }

    public function delete($id) {
        return $this->query("UPDATE tblUsuario SET USER_Activo = 0 WHERE USERID = ?", [$id]);
    }

    // public function update($values) {
    //     return $this->query(
    //         "UPDATE tblArea SET AREA_Nombre = ?, AREA_Siglas = ? WHERE AREAID = ?",
    //         [$values["nombre"], $values["siglas"], $values["id"]]
    //     );
    // }
}
