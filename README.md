# Opencart plugin
## Требования
* PHP
* [Composer](https://getcomposer.org/)
* [Docker](https://www.docker.com/)

## Начало работы
* (Опционально)
    + Создать токен на [github.com](https://github.com/settings/tokens/new?scopes=repo&description=Composer) для Composer 
    + Ввести в командной строке полученный токен `composer config -g github-oauth.github.com <токен>`
* Переименовать файл `.env.example` в `.env`
* Если необходимо, то изменить переменные в файле `.env`
* `> composer install`
* `> docker-compose -f docker-compose.yml up -d`
* `> composer run-script start`