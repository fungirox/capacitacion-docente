<?php

namespace Core;

use Core\Roles\Roles;

class Authenticator {

    private $admin = Roles::ADMIN;
    private $docente = Roles::DOCENTE;
    private $instructor = Roles::INSTRUCTOR;
    private $docenteAndInstructor = Roles::DOCENTE_AND_INSTRUCTOR;
    private $guest = Roles::GUEST;

    public function attempt($username, $password) {
        $user = App::resolve(Database::class)->query(
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
            WHERE USER_NombreUsuario = ?
            ",
            [$username]
        )->get();

        if ($user) {
            if (password_verify($password, $user["USER_Password"])) {
                $this->login([
                    "id" => $user["USERID"],
                    "username" => $username,
                    "rol" => $user["rol"]
                ]);
                return true;
            }
        }

        return false;
    }

    public function login($user) {
        $_SESSION["user"] = [
            "id" => $user["id"],
            "username" => $user["username"],
            "rol" => $user["rol"]
        ];
        session_regenerate_id(true);
    }

    public function logout() {
        Session::destroy();
    }
}
