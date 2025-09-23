## Gabriel Flazão - 1990590
## Jose Fuji - 1994006

# Passo a passo para executar o projeto em PHP com XAMPP
1. Instalação
• Baixe o XAMPP no site oficial: https://www.apachefriends.org

• Instale normalmente (próximo, próximo...).

2. Abrindo o painel de controle
• Execute o XAMPP Control Panel (atalho criado após a instalação).

• Clique em Start no Apache

3. Organizando os arquivos PHP
• Dentro da pasta de instalação, existe o diretório htdocs.

• Exemplo: C:\xampp\htdocs\

• Coloque o projeto dentro dessa pasta.

• Por exemplo: C:\xampp\htdocs\projeto

4. Acessando no navegador
• Para abrir o projeto, acesse no navegador:

• localhost/Projeto_2-UserAuth/src/index.php

# Classes e funções
## UserManager

* __construct: inicializa $users com uma lista fixa contendo id, name, email e password (hash gerado por password_hash) para começar com um usuário padrão em memória.

* findUserByEmail(string $email): ?array — percorre a lista e retorna o usuário cujo email corresponde ao informado; retorna null se não encontrar.

* findUserById(int $id): ?array — busca um usuário pelo id e retorna o registro em array; retorna null se não existir.

* addUser(string $name, string $email, string $password): bool — impede cadastro duplicado por e‑mail, gera id sequencial, aplica password_hash e adiciona o novo usuário ao array, retornando true em sucesso ou false em caso de duplicidade.

* updatePassword(int $id, string $newPassword): bool — encontra o usuário por id e substitui a senha por um novo hash com password_hash, retornando true em sucesso ou false se o usuário não existir.

## Validator

* validateEmail(string $email): bool — valida o formato do e‑mail com filter_var e FILTER_VALIDATE_EMAIL, retornando true quando o e‑mail está bem formado e false caso contrário.

* validatePassword(string $password): bool — aplica regex que exige no mínimo 8 caracteres, ao menos 1 letra maiúscula e 1 dígito, retornando true quando a senha atende às regras.

## AuthService

* __construct(UserManager $userManager) — recebe uma instância de UserManager por injeção de dependência, permitindo que a classe orquestre cadastro, login e reset usando a mesma fonte de dados em memória.

* register(string $name, string $email, string $password): bool — valida e‑mail e força da senha com Validator, bloqueia e‑mail duplicado via UserManager e, em seguida, delega o cadastro para addUser, que aplica password_hash antes de salvar.

* login(string $email, string $password): bool — busca o usuário por e‑mail e compara a senha informada com password_verify sobre o hash armazenado, sinalizando sucesso ou falha conforme o resultado.

* resetPassword(int $id, string $newPassword): bool — revalida a força da nova senha e delega a troca para updatePassword, que reescreve o hash com password_hash para manter a segurança.

