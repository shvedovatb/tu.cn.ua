<?php defined('TU') or die('Access denied'); ?>
<div class="full-article">
<?php if(!$_SESSION['auth']['user']): ?>
  <h1 class="title-full"> Для редагування данних потрібно авторизуватись</h1>
<?php else:?>
  <?php foreach ($full_article['staff_id'] as $value) {
    if($_SESSION['auth']['staff_id'] == $value) $dostup=1;}
  ?>
<?php endif; ?> 
<?php 
  if(isset($_SESSION['edit_page']['res'])){                        
    echo '<script> alert ("'.$_SESSION['edit_page']['res'].'");</script>';
    unset($_SESSION['edit_page']['res']);
  }          
?>
<?php if ($dostup==1): ?> 
  <h1 class="title-full"> <?=$full_article['publ_name']?></h1>

  <form method="post" >
    <table style="white-space: normal">
      <tr>
        <td class="title_table">Детальний тип роботи</td>
        <td class="text_table"><input type="texteria" name="name_detal_work" class="form-control" readonly="readonly" value="<?=$full_article['name_detal_work']?>"></td>
      </tr>
      <tr>
        <?php if($full_article['publ_name']<>''): ?>
          <td class="title_table">Повна назва роботи</td>
          <td class="text_table"><input type="texteria" name="publ_name" class="form-control" value='<?=$full_article["publ_name"]?>'></td>
        <?php else: ?>
          <td class="title_table">Присуджений степінь</td>
          <td class="text_table"><input type="texteria" name="stepen" class="form-control" value="<?=$full_article['stepen']?>"></td>
        <?php endif; ?>
      </tr>
      <tr>
        <td class="title_table">Рік</td>
        <td class="text_table"><input type="texteria" name="publ_year" class="form-control" value="<?=$full_article['publ_year']?>"></td>
      </tr>
      <?php if($full_article['id_type_work']<>3 and $full_article['id_detal_work']<>14): ?>
      <tr>
        <td class="title_table">Автори</td>
        <td class="text_table"><input type="texteria" name="authors" class="form-control" readonly="readonly" value="<?=$full_article['authors']?>"></td>
      </tr>
      <tr>
         <td class="title_table">Анотація</td>
        <td class="text_table"><input type="texteria" name="anotaz" class="form-control" value=""></td>
      </tr>
      <tr>
       <td class="title_table">Посилання на повний текст роботи</td>
        <td class="text_table"><input type="texteria" name="full_text_way" class="form-control" value=""></td>
      </tr>  
      <?php endif; ?>
      <?php if($full_article['id_detal_work']==1 or $full_article['id_detal_work']==2): ?>
        <tr>
          <td class="title_table">DOI</td>
          <td class="text_table"><input  class="form-control" name="doi" readonly="readonly" value="<?=$full_article['DOI']?>"></td>
        </tr>
        <tr>
          <td class="title_table">Scopus (1-так, 0-дані відсутні)</td>
          <td class="text_table"><input type="texteria" name="scopus" class="form-control" value="<?=$full_article['scopus']?>"></td>
        </tr>
        <tr>
          <td class="title_table">web of science (1-так, 0-дані відсутні)</td>
          <td class="text_table"><input type="texteria" name="web_of_sc"  class="form-control" value="<?=$full_article['web_of_sc']?>"></td>
        </tr> 
        <tr>
          <td class="title_table">Фахова (1-так, 0-дані відсутні)</td>
          <td class="text_table"><input type="texteria" name="prof"  class="form-control" value="<?=$full_article['prof']?>"></td>
        </tr>
      <?php endif; ?> 
      <?php if($full_article['stepen'] and $full_article['publ_name']<>''): ?>
      <tr>
        <td class="title_table">Здобутий ступінь</td>
        <td class="text_table"><input type="texteria" name="stepen"  class="form-control" value="<?=$full_article['stepen']?>"></td>
      </tr>
      <?php endif; ?>
      <?php if($full_article['type_conf']): ?>
      <tr>
        <td class="title_table">Тип конференції</td>
        <td class="text_table"><input type="texteria" name="type_conf" class="form-control" value="<?=$full_article['type_conf']?>"></td>
      </tr>
      <?php endif; ?>
      <?php if($full_article['type_patent']): ?>
      <tr>
        <td class="title_table">Тип патенту</td>
        <td class="text_table"><input type="texteria" name="type_patent" class="form-control" value="<?=$full_article['type_patent']?>"></td>
      </tr>
      <?php endif; ?>
      <?php if($full_article['type_zajavka']): ?>
       <tr>
        <td class="title_table">Тип заявки</td>
        <td class="text_table"><input type="texteria" name="type_zajavka" class="form-control" value="<?=$full_article['type_zajavka']?>"></td>
      </tr>
      <?php endif; ?>
      <?php if($full_article['type_posibnik']): ?>
      <tr>
        <td class="title_table">Тип</td>
        <td class="text_table"><input type="texteria" name="type_posibnik" class="form-control" value="<?=$full_article['type_posibnik']?>"></td>
      </tr>
      <tr>
        <td class="title_table">ISBN</td>
        <td class="text_table"><input type="texteria" name="isbn" class="form-control" value="<?=$full_article['isbn']?>"></td>
      </tr>
      <?php endif; ?>
    </table>
    <input type="submit" name="edit" id="edit" class="btn btn-primary" value="Відправити" /> 
  </form>
<?php else: ?>
    <h1 class="title-full"> Ви можете редагувати тільки власні роботи </h1>
<?php endif; ?>
</div>