<?php
defined('TU') or die('Access denied');

session_start();

// подключение модели
require_once MODEL;
require_once FUNCTIONS;
$cat=category();//массив институтов, факультетов и кафедр для leftbar.php
// получение динамичной части шаблона #content


// регистрация
if($_POST['reg']){
    registration();
    redirect();
}

// авторизация
if($_POST['auth']){
    authorization();
    //if($_SESSION['auth']['user']){
         //если пользователь авторизовался
       // echo "<p>Добро пожаловать, {$_SESSION['auth']['user']}</p>";
       // exit;
    //}else{
         //если авторизация неудачна
      // echo $_SESSION['auth']['error'];
      //  unset($_SESSION['auth']);
      //  exit;
   // }
}

// выход пользователя
if($_GET['do'] == 'logout'){
    logout();
    redirect();
}
// обновление страницы
if($_GET['do'] == 'pageout'){
    pageout();
    redirect();
}

$view = empty($_GET['view']) ? 'main' : $_GET['view'];
// подключение вида
switch ($view) {
	case 'univer':
		$fac_id=abs((int)$_GET['category']);
		$fac_info=fac_info($fac_id);		
		break;		
	case 'stat':		
		$dep_list=get_dep_list();//массив кафедр в select stat.php
		//$work_list=get_list_works_names();
		$stat_date=get_stat_date();	

		if(isset($_GET['year_search'])) $years = clear($_GET['year_search']);
		if(isset($_GET['staff'])) $staff_id = abs((int)$_GET['staff']);
		if(isset($_GET['departments'])) {
			$department = abs((int)$_GET['departments']);
			$teacherall_info=teacherall_info($department);
		}
		$_SESION['stat']['years']=$years;
		$_SESION['stat']['staff_id']=$staff_id;
		$_SESION['stat']['department']=$department;
		
		$stat_count = get_stat_count($staff_id, $years, $department);

		break;
	case 'teacherall':
		$dep_id=abs((int)$_GET['category']);
		$dep_info=dep_info($dep_id);
		$teacherall_info=teacherall_info($dep_id);
		break;	
	case 'works':
		$staff_id=abs((int)$_GET['staff']);
		$staff_info=staff_info($staff_id);
		$works=works($staff_id);
		
		break;
	case 'full_article':
		$publ_id=abs((int)$_GET['publ_id']);
		$full_article=get_full_article($publ_id);

		break;
	case 'full_articleEdit':	    
		$publ_id=abs((int)$_GET['publ_id']);
		$full_article=get_full_article($publ_id);

		if(isset($_POST['edit'])) {
		    save_change_article($publ_id);
		     $path=PATH.'?view=full_article&publ_id='.$publ_id;
		     redirect($path); // здесь переход на страницу full_article после отправки данных
		}
        
		break;
	case 'search':
        
        $arr = array();
        if (!empty($_GET['keywords'])) {
	    	$keywords = mysql_real_escape_string(strip_tags($_GET['keywords']));
	    	$arr=staff_search($keywords);
        }
        header('Content-Type: application/json');
		exit(json_encode($arr));
        break;
	
	default:
		$view = 'main';
}

require_once TEMPLATE.'index.php';

?>