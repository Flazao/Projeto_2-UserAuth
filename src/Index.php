<?php

require_once "user_auth.php";

$users = new UserManager();
$auth = new AuthService($users);

echo "=== Caso 1 ===\n";
$auth->register("Maria Oliveira", "maria@gmail.com", "Senha123");

echo "=== Caso 2 ===\n";
$auth->register("Pedro", "pedro@gmail.com", "Senha123");

echo "=== Caso 3 ===\n";
$auth->login("joao@email.com", "Errada123");

echo "=== Caso 4 ===\n";
$auth->resetPassword(1, "NovaSenha1");

echo "=== Caso 5 ===\n";
$auth->register("João X", "joao@email.com", "OutraSenha1");
