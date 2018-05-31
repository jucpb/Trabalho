# Trabalho #

Inserir descrição

O projeto foi escrito com base no framework  [Codeignaiter 3.1.8](https://github.com/bcit-ci/CodeIgniter)

## Dependendências ##

 - [Firebase/JWt](https://github.com/firebase/php-jwt)
 - [Codeignaiter Rest Server](https://github.com/chriskacerguis/codeigniter-restserver)

## Instalação ##

Para instalar o portal basta descompactar o projeto no servidor.

### Instalação das dependências  - produção ###

A instalação em produção instala apenas os pacotes necessários para rodar o projeto e otimiza o carregamento das classes.

```bash
cd 'project_folder'
composer install --no-dev --optimize-autoloader
```

### Instalação das dependências  - Desenvolvimento ###

A instalação em desenvolvimento instala também as bibliotecas de documentação e testes.

```bash
cd 'project_folder'
composer install
```