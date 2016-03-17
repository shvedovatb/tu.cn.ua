<?php

define('TU', TRUE);
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/config.php';

if($_SESSION['auth']['admin']){
    header("Location: ../");
    exit;
}

if($_POST){
    $login = trim(mysql_real_escape_string($_POST['user']));
    $pass = trim($_POST['pass']);
    $query = "SELECT staff_id, login, password FROM ac_staff WHERE login = '$login' AND id_role = 2 ";
    $res = mysql_query($query);
    $row = mysql_fetch_assoc($res);
    if($row['password'] == md5($pass)){
        $_SESSION['auth']['admin'] = htmlspecialchars($row['login']);
        $_SESSION['auth']['user_id'] = $row['staff_id'];
        header("Location: ../");
        exit;
    }else{
        $_SESSION['res'] = '<div class="error">Логин или пароль не совпадает!</div>';
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../<?=ADMIN_TEMPLATE?>style.css" />
<title>Вход в админку</title>
</head>

<body>
<div class="karkas">
	<div class="head">
		<a href="#"><img style="width:200px; height:150px;" src="../<?=ADMIN_TEMPLATE?>images/Logo_vector.svg" /></a>
		<p>Вход в админку</p>
	</div>
	<div class="enter">
<?php 
if(isset($_SESSION['res'])){
    echo $_SESSION['res'];
    unset($_SESSION['res']);
}
?>
        <form method="post" action="">
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>Username:</td>
                <td><input type="text" name="user" /></td>
              </tr>
              <tr>
                <td>Password:</td>
                <td><input type="password" name="pass" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="image" src="../<?=ADMIN_TEMPLATE?>images/enter_btn.jpg" name="submit" /></td>
              </tr>
            </table>      
        </form>
    </div>
</div>
</body>
</html>
