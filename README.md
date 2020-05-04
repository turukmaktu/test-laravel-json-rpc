
## Инструкция

Разработка велась с помощью Laravel на Homested
в репозитории 2 сайта и файл Homested.yml

- клонировать репозитроий
- Homested.yaml скопировать в место где он развернут, и настроить мапинг к сайтам
- выполнить команды из директории с Homested

1. Vagrant up
2. Vagrant ssh
3. cd ~/site
4. composer install
5. php artisan make:widget Form
6. cd ~/data
7. composer install
8. php artisan migrate
9. php artisan db:seed --class=FormSeader

##Описание

Для разработки использовались до библиотеки 
- arrilot/laravel-widgets для виджетов на site.test
- sajya/server для JSON-RPC на data.test



 data/app/Http/Procedures/FormsProcedure.php - обработчик json-rpc
 регестрируется в data/routes/api.php
 
 виджет {{ Widget::run('Form',['page_uid' => 'uid_one']) }} вставляется во view
 файлы 
 - site/resources/views/widgets/form.blade.php
 - site/app/Widgets/Form.php