<?php defined('TU') or die('Access denied'); ?>
<div class="content">
	
<h2>Добавление пользователя</h2>
<?php
if(isset($_SESSION['add_user']['res'])){
    echo $_SESSION['add_user']['res'];
}
?>
<form action="" method="post">
	
<table class="add_edit_page" cellspacing="0" cellpadding="0">
    <tr>
        <td class="add-edit-txt">*Прізвище користувача:</td>
        <td><input class="head-text" type="text" name="f_name" value="<?=htmlspecialchars($_SESSION['add_user']['name'])?>" /></td>
    </tr>
    <tr>
        <td class="add-edit-txt">*Имя користувача:</td>
        <td><input class="head-text" type="text" name="s_name" value="<?=htmlspecialchars($_SESSION['add_user']['name'])?>" /></td>
    </tr>
    <tr>
        <td class="add-edit-txt">*По-батькові:</td>
        <td><input class="head-text" type="text" name="l_name" value="<?=htmlspecialchars($_SESSION['add_user']['name'])?>" /></td>
    </tr>
    <tr>
        <td class="add-edit-txt">*Логін користувача:</td>
        <td><input class="head-text" type="text" name="login" value="<?=htmlspecialchars($_SESSION['add_user']['login'])?>" /></td>
    </tr>
    <tr>
        <td class="add-edit-txt">*Пароль користувача:</td>
        <td><input class="head-text" type="text" name="password" value="<?=htmlspecialchars($_SESSION['add_user']['password'])?>" /></td>
    </tr>
   
   
</table>
	
	<input type="image" src="<?=ADMIN_TEMPLATE?>images/save_btn.jpg" /> 

</form>
<?php unset($_SESSION['add_user']); ?>

	</div> <!-- .content -->
	</div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>