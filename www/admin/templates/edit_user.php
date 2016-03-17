<?php defined('TU') or die('Access denied'); ?>
<div class="content">
	
<h2>Редактирование пользователя</h2>
<?php
if(isset($_SESSION['edit_user']['res'])){
    echo $_SESSION['edit_user']['res'];
    unset($_SESSION['edit_user']['res']);
}
?>
<form action="" method="post">
	
<table class="add_edit_page" cellspacing="0" cellpadding="0">
    <tr>
        <td class="add-edit-txt">Имя пользователя:</td>
        <td><input class="head-text" type="text" name="name" value="<?=htmlspecialchars($get_user['name'])?>" /></td>
    </tr>
    <tr>
        <td class="add-edit-txt">Логин пользователя:</td>
        <td>
<?php if($_SESSION['auth']['user_id'] != $user_id): // если редактируется не свой профиль ?>
        <input class="head-text" type="text" name="login" value="<?=htmlspecialchars($get_user['login'])?>" />
<?php else: // если редактируется свой профиль ?>
        <input class="head-text" type="text" name="login" value="<?=htmlspecialchars($get_user['login'])?>" disabled="" /> <span class="small">Собственный логин изменить нельзя</span>
<?php endif; ?>
        </td>
    </tr>
    <tr>
        <td class="add-edit-txt">Новый пароль:</td>
        <td><input class="head-text" type="text" name="password" /></td>
    </tr>
    <tr>
        <td class="add-edit-txt">Email пользователя:</td>
        <td><input class="head-text" type="text" name="email" value="<?=htmlspecialchars($get_user['email'])?>" /></td>
    </tr>
    <tr>
        <td class="add-edit-txt">Телефон пользователя:</td>
        <td><input class="head-text" type="text" name="phone" value="<?=htmlspecialchars($get_user['phone'])?>" /></td>
    </tr>
    <tr>
        <td class="add-edit-txt">Адрес пользователя:</td>
        <td><input class="head-text" type="text" name="address" value="<?=htmlspecialchars($get_user['address'])?>" /></td>
    </tr>
<?php if($_SESSION['auth']['user_id'] != $user_id): // если редактируется не свой профиль ?>   
    <tr>
        <td class="add-edit-txt">Роль пользователя:</td>
        <td>
            <?php if($roles): ?>
            <select name="id_role">
                <?php foreach($roles as $item): ?>
                    <option <?php if($item['id_role'] == $get_user['id_role']) echo "selected" ?> value="<?=$item['id_role']?>"><?=$item['name_role']?></option>
                <?php endforeach; ?>
            </select>
            <?php endif; ?>
        </td>
    </tr>
<?php endif; ?>
</table>
	
	<input type="image" src="<?=ADMIN_TEMPLATE?>images/save_btn.jpg" /> 

</form>

	</div> <!-- .content -->
	</div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>