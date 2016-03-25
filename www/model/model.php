<?
//создание списка для меню категорий
function category(){
	$query="SELECT inst_id, inst_name, faculty.fac_id, fac_name, dep_id, dep_name
	 FROM institute, faculty, department 
	 where inst_id=ins_id and faculty.fac_id=department.fac_id";
	$res=mysql_query($query) or die(mysql_error());
	$cat=array();
	while ($row=mysql_fetch_assoc($res)) {
		if (!$cat[$row['inst_id']]) {
			$cat[$row['inst_id']][] = $row['inst_name'];
		}
		if (!$cat[$row['inst_id']]['fac'][$row['fac_id']]){
			$cat[$row['inst_id']]['fac'][$row['fac_id']][] = $row['fac_name'];
		}
		$cat[$row['inst_id']]['fac'][$row['fac_id']]['dep'][$row['dep_id']] = $row['dep_name'];
	}
	return $cat;
}
//инфо-страница факультета
function fac_info($id){
	$query="SELECT * FROM faculty where fac_id=$id";
	$res=mysql_query($query) or die(mysql_error());
	$fac_info=array();
	$fac_info=mysql_fetch_assoc($res);
	return $fac_info;
}
// инфо-страница кафедры
function dep_info($id){
	$query="SELECT * FROM department where dep_id=$id";
	$res=mysql_query($query) or die(mysql_error());
	$dep_info=array();
	$dep_info=mysql_fetch_assoc($res);
	return $dep_info;
}
//все преподаватели кафедры
function teacherall_info($id){
	$query="SELECT staff_id, 
					CONCAT_WS(' ', f_name, s_name, l_name) as fio, 
					ac_staff.posada_id,
					posada_name, 
					degree_name, 
					email
		FROM ac_staff, posada, degree 
		WHERE posada.posada_id=ac_staff.posada_id 
		and staff_deg_id=degree_id
		and staff_id in (SELECT staff_id FROM ac_staff_dep WHERE dep_id=$id)
		order by ac_staff.posada_id desc";
	$res=mysql_query($query) or die(mysql_error());
	$teacherall_info=array();
	while ($row=mysql_fetch_assoc($res)){
		$teacherall_info[]=$row;
	}
	return $teacherall_info;
}

//список кафедр для селекта в статистике
function get_dep_list(){
	$query="SELECT dep_id, dep_name  FROM department";
	$res=mysql_query($query) or die(mysql_error());
	$dep_list=array();
	while($row=mysql_fetch_assoc($res)){
		$dep_list[]=$row;
	}
	return $dep_list;
}
//поиск преподавателя по первым буквам
function staff_search($keywords){
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
	return $arr;
}

//Информация о преподавателе для заголовка на странице всех его работ
function staff_info($staff_id){
	$query="SELECT CONCAT_WS(' ', f_name, s_name, l_name) as fio, inst_name, fac_name, dep_name
	 FROM ac_staff, institute, faculty, department 
	 where staff_id=$staff_id 
	 	and dep_id=(SELECT dep_id FROM ac_staff_dep WHERE staff_id=$staff_id) 
	 	and inst_id=ins_id 
	 	and faculty.fac_id=department.fac_id";
	$res=mysql_query($query) or die(mysql_error());
	$staff_info=array();
	$staff_info=mysql_fetch_assoc($res);
	return $staff_info;
}

//Список всех работ преподавателя
function works($staff_id){
	$query="SELECT publ_id, publ_name, publ_year, stepen, stat_tmp.id_detal_work, 
		concat(name_detal_work, ' (',
			(select count(publ_id) 
			from publications 
			where publ_id in (SELECT publ_id FROM ac_publications WHERE staff_id=$staff_id)
	  		and publications.id_detal_work=stat_tmp.id_detal_work), ')') 
		as name_detal_work, 
		type_work.id_type_work, name_type_work
	 FROM publications, type_work, stat_tmp
	 WHERE publ_id in (SELECT publ_id FROM ac_publications WHERE staff_id=$staff_id)
	  and publications.id_detal_work=stat_tmp.id_detal_work
	  and stat_tmp.id_type_work=type_work.id_type_work order by type_work.id_type_work";
	$res=mysql_query($query) or die(mysql_error());
	$works=array();
	while ($row=mysql_fetch_assoc($res)) {
		if (!$works[$row['id_type_work']]) {
			$works[$row['id_type_work']][] = $row['name_type_work'];
		}
		if (!$works[$row['id_type_work']]['detal'][$row['id_detal_work']]){
			$works[$row['id_type_work']]['detal'][$row['id_detal_work']][] = $row['name_detal_work'];
		}
		$works[$row['id_type_work']]['detal'][$row['id_detal_work']]['publ'][$row['publ_id']][] = $row['publ_name'];
		if ($row['stepen']<>'' and $row['publ_name']==''){
			$works[$row['id_type_work']]['detal'][$row['id_detal_work']]['publ'][$row['publ_id']][0] = $row['stepen'];
		}
		$works[$row['id_type_work']]['detal'][$row['id_detal_work']]['publ'][$row['publ_id']][] = $row['publ_year'];
	}
	return $works;	
}

/*===Вывод select  с годами stat.php===*/
function get_stat_date(){
	$query="SELECT publ_year 
			FROM publications
			GROUP BY publ_year DESC HAVING count(*)>1";
	$res=mysql_query($query) or die(mysql_error());
	$stat_date=array();
	while($row=mysql_fetch_assoc($res)){
		$stat_date[]=$row;
	}
	return $stat_date;
}
/*===Вывод select  с годами stat.php===*/

/*===Вывод  stat.php*/
function get_stat_count($staff_id, $years, $department){
	if ($staff_id==0 and $department==0){
	$query="SELECT stat_tmp.id_detal_work,stat_tmp.id_type_work, name_detal_work,name_type_work,
			COUNT( publications.id_detal_work ) AS kol_vo
			FROM stat_tmp,publications,type_work 
                        WHERE publications.id_detal_work=stat_tmp.id_detal_work 
                        and stat_tmp.id_type_work=type_work.id_type_work 
                        and publications.publ_year>='$years' 
			GROUP BY publications.id_detal_work
                        order by stat_tmp.id_type_work";
    }
    else if ($staff_id<>0 and $department<>0){
	$query="SELECT stat_tmp.id_detal_work, 
					stat_tmp.id_type_work, 
			        name_detal_work,
			        name_type_work,
			        count(Q.id_detal_work) as kol_vo
			from (stat_tmp inner join type_work on stat_tmp.id_type_work=type_work.id_type_work)
			left join (select publications.id_detal_work
				FROM publications, ac_publications 
				WHERE ac_publications.publ_id=publications.publ_id 
			   		and ac_publications.staff_id=$staff_id 
					and publications.publ_year>='$years') as Q
			on stat_tmp.id_detal_work=Q.id_detal_work
			GROUP BY stat_tmp.id_detal_work
			order by stat_tmp.id_type_work";
    }
    else if ($department<>0 and $staff_id==0){
	$query="SELECT stat_tmp.id_detal_work, 
					stat_tmp.id_type_work, 
			        name_detal_work,
			        name_type_work,
			        count(Q.id_detal_work) as kol_vo
			from (stat_tmp inner join type_work on stat_tmp.id_type_work=type_work.id_type_work)
			left join (select publications.id_detal_work
				FROM publications, ac_publications, ac_staff_dep 
				WHERE ac_publications.publ_id=publications.publ_id 
			   		and ac_publications.staff_id=ac_staff_dep.staff_id 
					and publications.publ_year>='$years'
			   		and ac_staff_dep.dep_id=$department
				group by publications.publ_id) as Q 
			on stat_tmp.id_detal_work=Q.id_detal_work
			GROUP BY stat_tmp.id_detal_work
			order by stat_tmp.id_type_work";
	}
    
    $res=mysql_query($query) or die(mysql_error());
	$stat_count=array();

    while($row=mysql_fetch_assoc($res)){
		if (!$stat_count[$row['id_type_work']]) {
			$stat_count[$row['id_type_work']][] = $row['name_type_work'];
		}
		if (!$stat_count[$row['id_type_work']]['name_detal'][$row['id_detal_work']]){
			$stat_count[$row['id_type_work']]['name_detal'][$row['id_detal_work']][] = $row['name_detal_work'];
		}
		$stat_count[$row['id_type_work']]['name_detal'][$row['id_detal_work']]['kol'][$row['name_detal_work']] = $row['kol_vo'];
	}	
	return $stat_count;
}
function get_full_article($publ_id){
	$query="SELECT * FROM publications 
			inner join detal_work on publications.id_detal_work=detal_work.id_detal_work
			inner join work on detal_work.id_work=work.id_work
			WHERE publ_id=$publ_id";
	$res=mysql_query($query) or die(mysql_error());
	$full_article=array();
    $full_article=mysql_fetch_assoc($res);
    $query="SELECT  CONCAT(f_name, ' ', left(s_name, 1), '. ', left(l_name, 1), '.  ') as fio 
    		FROM ac_staff,  ac_publications
    		WHERE ac_staff.staff_id=ac_publications.staff_id
    		and ac_publications.publ_id=$publ_id";
    $res=mysql_query($query) or die(mysql_error());
    while($row=mysql_fetch_assoc($res)){
    	$full_article['authors'].=$row['fio'];    	
    }  
     $query="SELECT ac_publications.staff_id 
    		FROM ac_staff,  ac_publications
    		WHERE ac_staff.staff_id=ac_publications.staff_id
    		and ac_publications.publ_id=$publ_id";
    $res=mysql_query($query) or die(mysql_error());
    while($row=mysql_fetch_assoc($res)){
    	$full_article['staff_id'][]=$row['staff_id'];    	
    }  	
    return $full_article;
}
function teach_id($publ_id){
 $query="SELECT * FROM ac_publication where publ_id=$publ_id";
	$res=mysql_query($query) or die(mysql_error());
	$teach_id=array();
	$teach_id=mysql_fetch_assoc($res);
	return $teach_id;
    }	

/* ===Регистрация=== */
function registration(){
    $error = ''; // флаг проверки пустых полей
    
    $login = trim($_POST['login']);
    $pass = trim($_POST['pass']);
    $f_name = trim($_POST['f_name']);
    $s_name = trim($_POST['s_name']);
    $l_name = trim($_POST['l_name']);
   
    
    if(empty($login)) $error .= '<li>Не указан логин</li>';
    if(empty($pass)) $error .= '<li>Не указан пароль</li>';
    if(empty($f_name)) $error .= '<li>Не указано прізвище</li>';
    if(empty($s_name)) $error .= '<li>Не указан імя</li>';
    if(empty($l_name)) $error .= '<li>Не указан по батькові</li>';
    
    if(empty($error)){
        // если все поля заполнены
        // проверяем нет ли такого юзера в БД
        $query = "SELECT staff_id FROM ac_staff WHERE login = '" .clear($login). "' LIMIT 1";
        $res = mysql_query($query) or die(mysql_error());
        $row = mysql_num_rows($res); // 1 - такой юзер есть, 0 - нет
        if($row){
            // если такой логин уже есть
            $_SESSION['reg']['res'] = "Користувач з таким логіном вже зареєстрований на сайте. Введіть інший логін.";
            $_SESSION['reg']['f_name'] = $f_name;
            $_SESSION['reg']['s_name'] = $s_name;
            $_SESSION['reg']['l_name'] = $l_name;
        }
        else{
            // если все ок - регистрируем
            $login = clear($login);
            $f_name = clear($f_name);
            $s_name = clear($s_name);
            $l_name = clear($l_name);
            $pass = md5($pass);
            $query = "INSERT INTO ac_staff (f_name, s_name, l_name, login, password)
                        VALUES ('$f_name', '$s_name', '$l_name', '$login', '$pass')";
            $res = mysql_query($query) or die(mysql_error());
            if(mysql_affected_rows() > 0){
                // если запись добавлена
                $_SESSION['reg']['res'] = "Реєстрація пройшла вдало.";
                $_SESSION['auth']['user'] = $_POST['f_name'];
                $_SESSION['auth']['staff_id'] = mysql_insert_id();
                $_SESSION['auth']['s_name'] = $s_name;
                $_SESSION['auth']['l_name'] = $l_name;
            }
            
            else{
                $_SESSION['reg']['res'] = "Помилка!";
                $_SESSION['reg']['login'] = $login;
                $_SESSION['reg']['f_name'] = $f_name;
                $_SESSION['reg']['s_name'] = $s_name;
                $_SESSION['reg']['l_name'] = $l_name;
            }
        }
    }
    else{
        // если не заполнены обязательные поля
        $_SESSION['reg']['res'] = "Не заповнені обов'язкові поля: <ul> $error </ul>";
        $_SESSION['reg']['login'] = $login;
        $_SESSION['reg']['f_name'] = $f_name;
        $_SESSION['reg']['s_name'] = $s_name;
        $_SESSION['reg']['l_name'] = $l_name;
    }
}
/* ===Регистрация=== */
/* ===Авторизация=== */
function authorization(){
    $login = mysql_real_escape_string(trim($_POST['login']));
    $pass = trim($_POST['pass']);
    
    if(empty($login) OR empty($pass)){
        // если пусты поля логин/пароль
        $_SESSION['auth']['error'] = "<div class='error'> Поля логин/пароль должны быть заполнены!</div>";
    }
    else{
        // если получены данные из полей логин/пароль
        $pass = md5($pass);
        
        $query = "SELECT staff_id, CONCAT(f_name,' ', s_name, ' ', l_name) as fio FROM ac_staff WHERE login = '$login' AND password = '$pass' LIMIT 1";
        $res = mysql_query($query) or die(mysql_error());
        if(mysql_num_rows($res) == 1){
            // если авторизация успешна
            $row = mysql_fetch_row($res); 
            $_SESSION['auth']['staff_id'] = $row[0];          
            $_SESSION['auth']['user'] = $row[1];
         
        }
        else{
            // если неверен логин/пароль
            $_SESSION['auth']['error'] = "Логин/пароль введены неверно!";
        }
    }
}
/* ===Авторизация=== */
/* ===Редактирование  и Сохранение изменений в статье===*/
function save_change_article($publ_id){

			$publ_name = trim($_POST['publ_name']);
			$publ_year = trim($_POST['publ_year']);
			$scopus = abs((int)$_POST['scopus']);
			$web_of_sc = abs((int)$_POST['web_of_sc']);
			$prof = trim($_POST['prof']);
			$doi = trim($_POST['doi']);
			$type_conf = trim($_POST['type_conf']);
			$type_patent = trim($_POST['type_patent']);
			$type_zajavka = trim($_POST['type_zajavka']);
			$stepen = trim($_POST['stepen']);
			$type_posibnik = trim($_POST['type_posibnik']);
		    $isbn = trim($_POST['isbn']);
    
      if($publ_year<0){        
        $_SESSION['edit_page']['res'] = "Введіть правильний  рік ";
        return false;
    }
    if($publ_year<1901){        
        $_SESSION['edit_page']['res'] = "Введіть рік в діапазоні з 1901 року";
        return false;
    }
    if($publ_year>2155){        
        $_SESSION['edit_page']['res'] = "Введіть рік в діапазоні до 2155 року";
        return false;
    }
    	    $publ_name = clear($publ_name);
	    	$publ_year = clear($publ_year);
	    	$scopus = clear($scopus);
	    	$web_of_sc = clear($web_of_sc);
	    	$prof = clear($prof);
	    	$doi = clear($doi);
	    	$type_conf = clear($type_conf);
	    	$type_patent = clear($type_patent);
	    	$type_zajavka = clear($type_zajavka);
	    	$stepen = clear($stepen);
	    	$type_posibnik = clear($type_posibnik);
	    	$isbn = clear($isbn);

	    	
        
        $query = "UPDATE publications SET
                 publ_name = '$publ_name',
                 publ_year = '$publ_year',
                 scopus = '$scopus',
                 web_of_sc = '$web_of_sc',
                 prof = '$prof',
                 DOI = '$doi',
                 type_conf = '$type_conf',
                 type_patent = '$type_patent',
				 type_zajavka = '$type_zajavka',
				 stepen = '$stepen',
                 type_posibnik = '$type_posibnik',
		         isbn ='$isbn'  	
                 WHERE publ_id = $publ_id";
        $res = mysql_query($query) or die(mysql_error());
        
        if(mysql_affected_rows() > 0){
            $_SESSION['edit_page']['res'] = "Дані занесено до БД";
            return true;
        }
        else{
            $_SESSION['edit_page']['res'] = "Помилка або Ви нічого не змінювали!";
            return false;
        }
    }

/* ===Редактирование  и Сохранение изменений в статье===*/
