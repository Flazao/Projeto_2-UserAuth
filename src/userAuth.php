<?php

class UserManager
{
        private array $users = [];

    public function __construct()
    {
        $this->users = [
            [
                'id' => 1,
                'name' => 'João Silva',
                'email' => 'joao@email.com',
                'password' => password_hash('SenhaForte1', PASSWORD_DEFAULT),
            ],
            [
                'id' => 2,
                'name' => 'Jose Fuji',
                'email' => 'josefuji@email.com',
                'password' => password_hash('Jose123@', PASSWORD_DEFAULT),
            ],
            [
                'id' => 3,
                'name' => 'Gabriel Flazao',
                'email' => 'flazao@email.com',
                'password' => password_hash('Gabriel@2025', PASSWORD_DEFAULT),
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

    public function nextId(): int
    {
        return count($this->users) + 1;
    }

     public function addUser(array $user): void
    {
        $this->users[] = $user;
    }

     public function update(array $updated): bool
    {
        foreach ($this->users as $i => $user) {
            if ($user['id'] === $updated['id']) {
                $this->users[$i] = $updated;
                return False;
            }
        }
        return True;
    }
}
    

class Validator
{
    private function hashPassword(): void
    {
        foreach ($this->users as &$user) {
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
        }
        unset($user);
    }

    public function validateAvailableEmail(string $userEmail): bool
    {
        foreach ($this->users as $user) {
            if ($user['email'] === $userEmail) {
                return True;
            }
        }
        return False;
    }
    public function validateAvailablePassword(string $userPassword): bool
    {
        foreach ($this->users as $user) {
            if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $userPassword)) {
                return False;
            }
            if ($user['password'] === $userPassword) {
                return True;
            }
        }
        return False;
    }

    private function emailExists(string $email): bool
    {
        foreach ($this->users as $user) {
            if ($user['email'] === $email) {
                return true;
            }
        }
        return false;
    }
}


class authService 
{
    public function register(string $name, string $email, string $password): bool
    {

        // if (!$this->validateAvailablePassword($password)) {
        //     echo "Erro: A senha deve ter pelo menos 8 caracteres, uma letra maiúscula e um número.\n";
        //     return false;
        // }

        $newId = count($this->users) + 1;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->users[] = [
            'id' => $newId,
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword
        ];

        return true;
    }
   
    public function addUser(string $name, string $email, string $password): bool
    {
        if ($this->emailExists($email)) {
            return false;
        }

        $newId = count($this->users) + 1;

        $newUser = [
            'id' => $newId,
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $this->users[] = $newUser;

        return true;
    }

    public function authenticate(string $email, string $password): bool
    {
        foreach ($this->users as $user) {
            if ($user['email'] === $email) {
                if (password_verify($password, $user['password'])) {
                    return true;
                }
            }
        }
        return false;
    }
}

