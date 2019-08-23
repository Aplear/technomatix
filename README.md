—сылка на git https://github.com/Aplear/technomatix

»нструкци€ запууска
-------------------
в директории проекта выполн€ем https://github.com/Aplear/technomatix.git

в консоли выполн€ем команду: composer install 

следом: php yii init

ѕоднимаем среду на vagrant в контексте документации Yii2
-------------------
в директории /technomatix/vagrant/config/vagrant-local.yml  - указать свой токен GitHub - <github_token>

далее выполн€ем: vagrant up 

если на linux прописать 

выполнить команду: sudo nano /etc/hosts

вводим пароль

в низу файла указать: 192.168.83.137  backend.technomatix.loc

дл€ сохранени€ нажимаем комбинацию: Ctrl + x

тестовый сервис будет доступен по ссылке http://backend.technomatix.loc

«аходим в vagrant (в консоли) и выполн€ем команды
-------------------

$vagrant ssh

$cd /app

$php yii migrate

$php rbac/init
