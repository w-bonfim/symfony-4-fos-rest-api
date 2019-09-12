Informações técnica

- PHP 7.0
- Mysql 5.7
- Framework Symfony 4.3

Instruções de Instalação

Siga a sequência: 

1- Execute o comando abaixo na raiz do projeto 

composer install

2- Preencha as informações do banco de dados no arquivo ".env"

3- Para criar e manipular o banco de dados execute os comandos abaixo

php bin/console doctrine:database:create

php bin/console doctrine:schema:create

php bin/console doctrine:fixtures:load

4 - Rodar o projeto 

php bin/console server:run 

Exemplo de como ficou as rotas da API
http://127.0.0.1:8000/api/user

 
