<?php defined('TU') or die('Access denied'); ?>
<?php 
  if(isset($_SESSION['edit_page']['res'])){                        
    echo '<script> alert ("'.$_SESSION['edit_page']['res'].'");</script>';
    unset($_SESSION['edit_page']['res']);
  }          
?>
<div class="full-article">
 
<?php if(!$_SESSION['auth']['user']): ?>
<h1 class="title-full"> Для редагування данних потрібно авторизуватись</h1>
<?php else:?>
  <h1 class="title-full"> <?=$full_article['publ_name']?></h1>
<?php endif?>
<table style="white-space: normal">
  <tr>
    <td class="title_table">Детальний тип роботи</td>
    <td class="text_table"><?=$full_article['name_detal_work']?></td>
  </tr>
  <tr>
    <td class="title_table">Повна назва роботи</td>
    <?php if($full_article['publ_name']<>''): ?>
      <td class="text_table"><?=$full_article['publ_name']?></td>
    <?php else: ?>
      <td class="text_table"><?=$full_article['stepen']?></td>
    <?php endif; ?>
  </tr>
  <tr>
    <td class="title_table">Рік</td>
    <td class="text_table"><?=$full_article['publ_year']?></td>
  </tr>
  <?php if($full_article['id_type_work']<>3 and $full_article['id_detal_work']<>14): ?>
  <tr>
     <td class="title_table">Автори</td>
    <td class="text_table"><?=$full_article['authors']?></td>
  </tr>
  <tr>
     <td class="title_table">Анотація</td>
    <td class="text_table"></td>
  </tr>
  <tr>
   <td class="title_table">Посилання на повний текст роботи</td>
    <td class="text_table"><a href=""></a></td>
  </tr>  
  <?php endif; ?>
  <?php if($full_article['id_detal_work']==1 or $full_article['id_detal_work']==2): ?>
    <tr>
      <td class="title_table">DOI</td>
      <td class="text_table"><a href="http://dx.doi.org/<?=htmlspecialchars($full_article['DOI'])?>"><?=htmlspecialchars($full_article['DOI'])?></a></td>
    </tr>
    <tr>
      <td class="title_table">Scopus</td>
      <?php if($full_article['scopus']==1): ?>
        <td class="text_table">Так</td>
      <?php else: ?>
        <td class="text_table">Дані відсутні</td>
      <?php endif; ?>
    </tr>
    <tr>
      <td class="title_table">web of science</td>
      <?php if($full_article['web_of_sc']==1): ?>
        <td class="text_table">Так</td>
      <?php else: ?>
        <td class="text_table">Дані відсутні</td>
      <?php endif; ?>
    </tr> 
    <tr>
      <td class="title_table">Фахова</td>
      <?php if($full_article['prof']==1): ?>
        <td class="text_table">Так</td>
      <?php else: ?>
        <td class="text_table">Дані відсутні</td>
      <?php endif; ?>
    </tr>
  <?php endif; ?> 
  <?php if($full_article['stepen'] and $full_article['publ_name']<>''): ?>
  <tr>
    <td class="title_table">Здобутий ступінь</td>
    <td class="text_table"><?=$full_article['stepen']?></td>
  </tr>
  <?php endif; ?>
  <?php if($full_article['type_conf']): ?>
  <tr>
    <td class="title_table">Тип конференції</td>
    <td class="text_table"><?=$full_article['type_conf']?></td>
  </tr>
  <?php endif; ?>
  <?php if($full_article['type_patent']): ?>
  <tr>
    <td class="title_table">Тип патенту</td>
    <td class="text_table"><?=$full_article['type_patent']?></td>
  </tr>
  <?php endif; ?>
  <?php if($full_article['type_zajavka']): ?>
   <tr>
    <td class="title_table">Тип заявки</td>
    <td class="text_table"><?=$full_article['type_zajavka']?></td>
  </tr>
  <?php endif; ?>
  <?php if($full_article['type_posibnik']): ?>
  <tr>
    <td class="title_table">Тип</td>
    <td class="text_table"><?=$full_article['type_posibnik']?></td>
  </tr>
  <tr>
    <td class="title_table">ISBN</td>
    <td class="text_table"><?=$full_article['isbn']?></td>
  </tr>
  <?php endif; ?>
</table>

<?php foreach ($full_article['staff_id'] as $value): ?>
  <?php if($_SESSION['auth']['user'] and $_SESSION['auth']['staff_id'] == $value):?>       
      <a href="?view=full_articleEdit&publ_id=<?=$full_article['publ_id']?>"><input  class="btn btn-primary" value="Редагувати" /></a>   
  <?php endif; ?>
<?php endforeach; ?>

</div>