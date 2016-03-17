<?php

defined('TU') or die('Access denied');

/* ===Распечатка массива=== */
function print_arr($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}
/* ===Распечатка массива=== */

/* ===Фильтрация входящих данных=== */
function clear($var){
    $var = mysql_real_escape_string(strip_tags($var));
    return $var;
}
/* ===Фильтрация входящих данных=== */

/* ===Редирект=== */
function redirect($http = false){
    if($http) $redirect = $http;
        else    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    header("Location: $redirect");
    exit;
}
/* ===Редирект=== */

/* ===Выход пользователя=== */
function logout(){
    unset($_SESSION['auth']);
}
/* ===Обновление данных === */
function pageout(){
    //unset($_SESSION['edit_page']['res']);
    unset($_SESSION['answer']);
}

/* ===Обновление данных === */