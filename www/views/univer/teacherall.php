<?php defined('TU') or die('Access denied'); ?>
<?php 
	include_once "inc/leftbar.php" 
?>
<div class="rightbar">
  <div class="block-depart">
    <h1>кафедра <?=$dep_info['dep_name']?></h1>
    <p><?=$dep_info['dep_page']?></p>

	<table cellspacing="1" cellpadding="1" border="0"> 
	    <tbody>  
	           <tr class="title_table">     
	                   <td><strong>ПІБ</strong></td>  
	                   <td><strong>Посада</strong></td>
	                   <td><strong>Науковий ступінь</strong></td>
	                   <!--<td><strong>е-мейл</strong></td>-->
	            </tr> 
	            <? foreach($teacherall_info as $item): ?>        
	            <tr>           
	                   <td><a id="" href="?view=works&staff=<?=$item['staff_id']?>"><?=$item['fio']?></a></td>             
	                   <td><?=$item['posada_name']?></td>
	                   <td><?=$item['degree_name']?></td>             
	                   <!--<td><?=$item['email']?></td>-->        
	             </tr>         
				<? endforeach; ?>
     </tbody> 
	</table> 
  </div>
</div>