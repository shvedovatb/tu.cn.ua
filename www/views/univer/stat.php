<?php defined('TU') or die('Access denied'); ?>
<div>
<div>
<form method="get">  
  <ul class="statistics-menu">
    <!-- Пункт меню 1 -->
    <li>
      <select name="departments">
        <option value="">Вибір кафедри</option>
        <?php foreach ($dep_list as $item): ?>
          <?if ($_SESION['stat']['department']==$item['dep_id']): ?>
            <option selected value="<?=$item['dep_id']?>"><?=$item['dep_name']?></option>
          <?else: ?>
            <option value="<?=$item['dep_id']?>"><?=$item['dep_name']?></option>
          <?php endif; ?>          
        <?php endforeach; ?> 

      </select>
    </li> 
    <!-- Пункт меню скрытый для передачи параметра view-->
    <li>
      <input type="hidden" name="view" value="stat"/>
    </li>              
    <!-- Пункт меню 2 -->      
    <li>
     <!--<?php if ($_SESION['stat']['department']): ?>
      <select name="staff">     
        <option value="">Вибір викладача</option>
        <?php foreach ($teacherall_info as $item): ?>
          <?if ($_SESION['stat']['staff_id']==$item['staff_id']): ?>
            <option selected value="<?=$item['staff_id']?>"><?=$item['fio']?></option>
          <?else: ?>
            <option value="<?=$item['staff_id']?>"><?=$item['fio']?></option>
          <?php endif; ?>          
        <?php endforeach; ?> 
      <?php endif; ?>
      </select>-->

        <input type="text" id="keyword" placeholder="Enter keyword">
        <select name="staff" id="content" size="5"></select>
      
    </li>

    <li>
      <input type="submit" value="Показать" /> 
    </li>        
  </ul>
  <!-- Конец списка -->
 
    <?php if (!$_SESION['stat']['staff_id']): ?>
      <?php if (!$_SESION['stat']['department']): ?>
        <h1 class="statistics">загальна кількість робіт по всіх кафедрах чернігівського національного технологічного університету з 1972 року</h1>
      <?php else: ?>
        <?php foreach ($dep_list as $item): ?>
          <?if ($_SESION['stat']['department']==$item['dep_id']): ?>
            <h1 class="statistics">кафедра&nbsp;<?=$item['dep_name']?></h1>      
          <?php endif; ?>          
        <?php endforeach; ?>
      <?php endif; ?> 
    <?php else: ?>
      <?php foreach ($teacherall_info as $item): ?>
        <?if ($_SESION['stat']['staff_id']==$item['staff_id']): ?>
          <h1 class="statistics"><?=$item['fio']?></h1>
        <?php endif; ?>
     <?php endforeach; ?>       
    <?php endif; ?>

  <table class="table_stat">
    <tbody class="table-statistics">
      <tr class="table-statistics-title"><!-- TITLE-->
        <td rowspan="2"><strong>вид роботи</strong></td>
        <td class="part">за період з</td>
      </tr>
      <tr>    
        <td class="forma-data">
        <!--Вывод select  с годами-->
          <select name="year_search">
            <?php foreach ($stat_date as $year): ?>
              <?if ($_SESION['stat']['years']==$year['publ_year']): ?>
                <option selected value="<?=$year['publ_year']?>"><?=$year['publ_year']?></option>
              <?else: ?>
                <option value="<?=$year['publ_year']?>"><?=$year['publ_year']?></option>
              <?php endif; ?>              
            <?php endforeach; ?> 
          </select>
              
        <!--Вывод select  с годами--> 
        </td>
      </tr>
      <tr ><!--НАЗВА РОБОТИ -->
      <?php foreach ($stat_count as $key => $item): ?><!--перебираем массив работ-->
        <td colspan="3" class="title-work"><strong><?=$item[0]?></strong></td><!--и выводим вид работы -->         
      </tr>
      <!--ПЕРЕЧЕНЬ РАБОТ -->
        <?php if(count($item)>1):?><!--если индекс вида работ больше 1-->
          <?php foreach($item['name_detal'] as $key=>$work): ?><!--перебираем перебранный массив по имени работы-->
            <tr>
              <td><?=$work[0]?></td><!--и выводим название работы-->
              <?php if(count($work)>1):?>
                <?php foreach($work['kol'] as $key=>$kol): ?>
                  <td><?=$kol?></td> <!--пустой столбец для вывода цифры - кол-ва работ-->
                <?php endforeach; ?> 
              <?php endif; ?>  
            </tr>
          <?php endforeach; ?>   
        <?php endif; ?>  
      <?php endforeach; ?>
    </tbody>
  </table>
</form>
<?php unset($_SESSION['stat']); ?>   
</div>
</div>