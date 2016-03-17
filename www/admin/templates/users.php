<?php defined('TU') or die('Access denied'); ?>
<div class="content">
	<h2>Список пользователей</h2>
<?php
if(isset($_SESSION['answer'])){
    echo $_SESSION['answer'];
    unset($_SESSION['answer']);
}
?>
<a href="?view=add_user"><img class="add_some" src="<?=ADMIN_TEMPLATE?>images/add_user.jpg" alt="добавить новость" /></a>

<table class="tabl" cellspacing="1">
    <tr>
        <th class="number">№</th>
        <th class="str_name">Имя</th>
        <th class="str_name">Логин</th>
        <th class="str_name">mail</th>
        <th class="str_sort">Роль</th>
        <th class="str_action">Действие</th>
    </tr>

</table>

<a href="?view=add_user"><img class="add_some" src="<?=ADMIN_TEMPLATE?>images/add_user.jpg" alt="добавить новость" /></a>
	</div> <!-- .content -->
	</div> <!-- .content-main -->
</div> <!-- .karkas -->
</body>
</html>