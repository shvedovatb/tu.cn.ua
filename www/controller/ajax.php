<?php
define('USER', 'root');
define('PASS', '');
define('HOST', 'localhost');
define('DB', 'staff');

mysql_connect(HOST, USER, PASS) or die('No connect to Server');
mysql_select_db(DB) or die('No connect to DB');
mysql_query("SET NAMES 'UTF8'") or die('Cant set charset');

$arr = array();

if (!empty($_GET['keywords'])) {
	$keywords = mysql_real_escape_string(strip_tags($_GET['keywords']));
	$sql = "SELECT ac_staff.staff_id, f_name, s_name, l_name, dep_name 
	FROM ac_staff, ac_staff_dep, department 
	WHERE f_name like('".$keywords."%')
	and ac_staff.staff_id=ac_staff_dep.staff_id
	and ac_staff_dep.dep_id=department.dep_id";
	$result = mysql_query($sql) or die(mysql_error());
	if (mysql_num_rows($result) > 0) {
		while ($row = mysql_fetch_assoc($result)) {
			$arr[] = $row;
		}
	}
}
echo json_encode($arr);