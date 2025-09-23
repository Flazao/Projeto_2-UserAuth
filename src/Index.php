<?php

require_once "user_auth.php";

$users = new UserManager();
$auth = new AuthService($users);

$auth->register("Maria Souza", "maria@email.com", "Maria123");

$auth->login("maria@email.com", "Maria123");

$auth->resetPassword(1, "NovaSenha123");