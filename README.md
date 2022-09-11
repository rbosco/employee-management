<h1 align="center">
    <p align="center">
      <img alt="logo" src="./readme/logo.jpg" width="400px">
    </p>
    ⚙️ <a href="#" alt=""> mEmployee </a>
</h1>

<h3 align="center">
    ⚙️ Gerencie seus colaboradores de forma fácil integrando com a mEmployee. 👨‍💼
</h3>

<p align="center">
  <img alt="GitHub language count" src="https://img.shields.io/github/languages/count/rbosco/employee-management?color=%2304D361">

  <img alt="Repository size" src="https://img.shields.io/github/repo-size/rbosco/employee-management">
  
  <a href="https://github.com/rbosco/employee-management/commits/master">
    <img alt="GitHub last commit" src="https://img.shields.io/github/last-commit/rbosco/employee-management">
  </a>
    
   <img alt="License" src="https://img.shields.io/badge/license-MIT-brightgreen">
   <a href="https://github.com/rbosco/employee-management/stargazers">
    <img alt="Stargazers" src="https://img.shields.io/github/stars/rbosco/employee-management?style=social">
  </a>
</p>

Tabela de conteúdos
=================

   * [Sobre o projeto](#sobre-o-projeto)
   * [Funcionalidades](#funcionalidades)
   * [Swagger](#swagger)
   * [Como executar o projeto](#como-executar-o-projeto)
     * [Pré-requisitos](#pre-requisitos)
     * [Rodando o servidor](#rodando-o-backend)
     * [Rodando os testes](#rodando-testes)
   * [Tecnologias](#tecnologias)
     * [Server](#tecnologias-server)
     * [Utilitários](#utilitarios)
   * [Autor](#autor)
   * [Licença](#licenca)



## 💻 Sobre o projeto <a name="sobre-o-projeto"></a>

⚙️ O mEmployee fornece API's para gestão de seus colaboradores com opção de histórico referente ao salário.

---

## ⚙️ Funcionalidades <a name="funcionalidades"></a>

- [x] O seu sistema pode se integrar a mEmployee para:
  - [x] Cadastrar colaboradores e seus salários.
  - [x] Atualizar dados de seus colaboradores.
  - [x] Listar um colaborador com seu histórico de salários.
  - [x] Listar todos os colaboradores da sua empresa.

---

## 🎨 Swagger <a name="Swagger"></a>

Acesse o Swagger para ver a documentação das API's da mEmployee.

<a href="https://www.figma.com/file/8szO6rJwdHlSaF95n2vKgW/GoBarber">
  <img alt="Acessar Swagger" src="https://img.shields.io/badge/Acessar%20API%20-Swagger-%2304D361">
</a>

<p align="center" style="display: flex; align-items: flex-start; justify-content: center;">
  <img alt="Screenshot swagger 1" src="./readme/swaager.png" width="400px">
</p>

---

## 🚀 Como executar o projeto <a name="como-executar-o-projeto"></a>

💡 Para visualizar o funcionamento das API's do mEmployee é necessário que o Backend esteja sendo executado para funcionar

### Pré-requisitos <a name="pre-requisitos"></a>

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:
[Git](https://git-scm.com), [Composer](https://nodejs.org/en/), [PHP 8.1](https://www.php.net/downloads.php). 
Além disto é bom ter um editor para trabalhar com o código como [VSCode](https://code.visualstudio.com/).

#### 🎲 Rodando o Backend <a name="rodando-o-backend"></a>

```bash

# Clone este repositório
$ git clone https://github.com/rbosco/employee-management.git

# Acesse a pasta do projeto no terminal/cmd
$ cd employee-management

# Instale as dependências
$ composer install

# Execute a aplicação em modo de desenvolvimento
$ php artisan serve --port=8080

# Faça um reset nas migrations para garantir que o banco esteja vazio
$ php artisan migrate:reset

# Execute as migrations e seeds para criar as tabelas e popular o banco
$ php artisan migrate --seeds

# O servidor inciará na porta:8080 - acesse http://127.0.0.1:8080 

```

<p align="center">
  <a href="https://github.com/rbosco/employee-management/Insomnia_API_mEmployee.json" target="_blank"><img src="https://insomnia.rest/images/run.svg" alt="Run in Insomnia"></a>
</p>

#### 🎲 Rodando os testes <a name="rodando-testes"></a>

```bash

#Execute os testes
$ ./vendor/bin/pest

```

#### 🎲 Acessando o Swagger <a name="acessando-swagger"></a>

O Swagger será executado na rota /api/ui - acesse (http://127.0.0.1:8080/api/ui)

---

## 🛠 Tecnologias <a name="tecnologias"></a>

As seguintes ferramentas foram usadas na construção do projeto:

-   **[EditorConfig](https://editorconfig.org/)**

#### **Server** ([PHP](https://www.php.net/)) <a name="tecnologias-server"></a>

-   **[Laravel](https://laravel.com/)**
-   **[Sqlite](https://www.sqlite.org/index.html)**
-   **[PestPHP](https://pestphp.com/)**
-   **[Swagger](https://laravel.com/)**

> Veja o arquivo  [composer.json](https://github.com/rbosco/employee-management/composer.json)

#### **Utilitários** <a name="utilitarios"></a>

-   Editor:  **[Visual Studio Code](https://code.visualstudio.com/)**
-   Teste de API:  **[Insomnia](https://insomnia.rest/)**

---

## 🦸 Autor <a name="autor"></a>

<a href="https://github.com/rbosco">
 <img src="https://avatars2.githubusercontent.com/u/6660950?s=460&u=ac94c8da0e69db2558f031d01dbca5c60aa19b77&v=4" width="100px" alt="Rômulo Basilio Bosco" />
 <br />
 <sub><b>Rômulo Basilio Bosco</b></sub></a>
 <br />

[![Linkedin Badge](https://img.shields.io/badge/-RomuloBosco-blue?style=flat-square&logo=Linkedin&logoColor=white&link=https://www.linkedin.com/in/romulobbosco/)](https://www.linkedin.com/in/romulobbosco/) 
[![Gmail Badge](https://img.shields.io/badge/-romulo.bbosco@gmail.com-c14438?style=flat-square&logo=Gmail&logoColor=white&link=mailto:romulo.bbosco@gmail.com)](mailto:romulo.bbosco@gmail.com)

---

## 📝 Licença <a name="licenca"></a>

Este projeto esta sob a licença [MIT](./LICENSE).

Feito com ❤️ por Rômulo Basilio Bosco 👋🏽 [Entre em contato!](https://www.linkedin.com/in/romulobbosco/)