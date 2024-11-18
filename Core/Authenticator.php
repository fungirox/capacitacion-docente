<?php

namespace Core;

use Core\Repositories\UsuarioRepository;
use Core\Roles\Roles;

class Authenticator {

    public function attempt($username, $password) {
        $user = App::resolve(UsuarioRepository::class)->getByUsername($username);

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
        Session::put("user", [
            "id" => $user["id"],
            "username" => $user["username"],
            "rol" => $user["rol"]
        ]);
        session_regenerate_id(true);
    }

    public function logout() {
        Session::destroy();
    }
}
