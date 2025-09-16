<?php

class User {
    
    public array $usuarios;

    public function __construct()
    {
        $usuarios = [
        ['id' => 1, 'nome' => 'João Silva', 'email' => 'joao@email.com',
        'senha' => 'SenhaForte1'],
        ['id' => 2, 'nome' => 'Jose Fuji', 'email' => 'josefuji@email.com',
        'senha' => 'Jose123@'],
        ['id' => 3, 'nome' => 'Gabriel Flazao', 'email' => 'flazao@email.com',
        'senha' => 'Gabriel@2025']];
    }

}