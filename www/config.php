<?php

defined('TU') or die('Access denied');/*Вначале
 проверяем прямой доступ к файлу. Функция defined 
 проверяет была ли установлена
 Определяем константу домена.
 Опредeляем пути к контроллеру, модели и видам*/ 

// домен
define('PATH', 'http://tu.cn.ua4/');

// модель
define('MODEL', 'model/model.php');

// контроллер
define('CONTROLLER', 'controller/controller.php');
//файл функции

define('FUNCTIONS', 'functions/functions.php');

// вид
define('VIEW', 'views/');

// папка с активным шаблоном
define('TEMPLATE', VIEW.'univer/');

// сервер БД
define('HOST', 'localhost');

// пользователь
define('USER', 'root');

// пароль
define('PASS', '');

// БД
define('DB', 'staff');

// email администратора
define('ADMIN_EMAIL', 'admin@ishop.com');

// папка шаблонов административной части
define('ADMIN_TEMPLATE', 'templates/');

// название магазина - title
/*define('TITLE', 'Интернет магазин сотовых телефонов');*/

mysql_connect(HOST, USER, PASS) or die('No connect to Server');
mysql_select_db(DB) or die('No connect to DB');
mysql_query("SET NAMES 'UTF8'") or die('Cant set charset');
