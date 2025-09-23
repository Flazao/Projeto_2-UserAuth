<?php

class UserManager
{
    public array $users = [];

    public function __construct()
    {
        $this->users = [
            [
                'id' => 1,
                'name' => 'João Silva',
                'email' => 'joao@email.com',
                'password' => password_hash('SenhaForte1', PASSWORD_DEFAULT),
            ],
        ];
    }

    public function findUserByEmail(string $email): ?array
    {
        foreach ($this->users as $user) {
            if ($user['email'] === $email) {
                return $user;
            }
        }
        return null;
    }

    public function findUserById(int $id): ?array
    {
        foreach ($this->users as $user) {
            if ($user['id'] === $id) {
                return $user;
            }
        }
        return null;
    }

    public function addUser(string $name, string $email, string $password): bool
    {
        if ($this->findUserByEmail($email)) {
            echo "\nErro: E-mail já cadastrado.\n";
            return false;
        }

        $this->users[] = [
            'id' => count($this->users) + 1,
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];
        echo "\nUsuário cadastrado com sucesso!\n";
        return true;
    }

    public function updatePassword(int $id, string $newPassword): bool
    {
        foreach ($this->users as &$user) {
            if ($user['id'] === $id) {
                $user['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
                echo "\nSenha atualizada com sucesso!\n";
                return true;
            }
        }
        echo "\nUsuário não encontrado.\n";
        return false;
    }
}

class Validator
{
    public static function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validatePassword(string $password): bool
    {
        return preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password);
    }
}

class AuthService
{
    private UserManager $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function register(string $name, string $email, string $password): bool
    {
        if (!Validator::validateEmail($email)) {
            echo "\nErro: E-mail inválido.\n";
            return false;
        }

        if (!Validator::validatePassword($password)) {
            echo "\nErro: Senha fraca.\n";
            return false;
        }

        return $this->userManager->addUser($name, $email, $password);
    }

    public function login(string $email, string $password): bool
    {
        $user = $this->userManager->findUserByEmail($email);
        if (!$user) {
            echo "\nFalha no login: usuário não encontrado.\n";
            return false;
        }

        if (password_verify($password, $user['password'])) {
            echo "\nLogin bem-sucedido!\n";
            return true;
        }

        echo "\nFalha no login: senha incorreta.\n";
        return false;
    }

    public function resetPassword(int $id, string $newPassword): bool
    {
        if (!Validator::validatePassword($newPassword)) {
            echo "Erro: Senha fraca.\n";
            return false;
        }

        return $this->userManager->updatePassword($id, $newPassword);
    }
}
    