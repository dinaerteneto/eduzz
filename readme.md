## Teste para o Eduzz
  Você é o programador escolhido para criar um sistema básico, que insere, edita, exclui e lista toda a base de dados de candidatos da empresa Eduzz. Simples, mas que deve seguir alguns pré-requisitos.
  
  - PRÉ-REQUISITOS TÉCNICOS: 
    - Deve ser utilizado o framework Lumen (>=5.4) para criação das APIs. 
    - No front deve ser utilizado: Html, Css e Javascript (utilize a biblioteca e layout de sua preferência). 
    - Utilize o banco de dados MySQL para criar sua aplicação.

## Tecnológias utilizada no desenvolvimento
    - Servidor
      - vagrant
      - homestead

    - Backend
      - PHP
      - Lumen
        - Migrations
        - Seeds
      - Mysql

    - Frontend
      - VueJs
        - VueResource
        - VueEvents
      - Jquery
      - Bootstrap

    - Ide
      - VsCode
      - Sublime

## Instalação
  - Após clonar o projeto, rode os comandos abaixo
    - composer install
    - php artisan migrate (para criar as tabelas)
    - php artisan db:seed (para popular as tabelas)
    - cd frontend
    - npm install
    - npm run build
    - criar 3 hosts
      - eduzz.api -> apontando para ./public 
      - eduzz.doc -> apontando para ./public/apidoc
      - eduzz.dash -> apontando para ./frontend
    - acesse no navegador eduzz.dash
