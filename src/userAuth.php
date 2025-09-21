<?php

class User
{

    public array $users;

    public function __construct()
    {
        $users = [
            [
                'id' => 1,
                'name' => 'João Silva',
                'email' => 'joao@email.com',
                'password' => 'SenhaForte1'
            ],
            [
                'id' => 2,
                'name' => 'Jose Fuji',
                'email' => 'josefuji@email.com',
                'password' => 'Jose123@'
            ],
            [
                'id' => 3,
                'name' => 'Gabriel Flazao',
                'email' => 'flazao@email.com',
                'password' => 'Gabriel@2025'
            ]
        ];
    }


    public function userRegister(): void
    {
        // ...
    }
}

class Validator extends User
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
            if(!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $userPassword)){
                return False;
            }
            if ($user['password'] === $userPassword) {
                return True;
            }
        }
        return False;
    }
}
