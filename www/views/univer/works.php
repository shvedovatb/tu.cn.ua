<div>
   <div class="teacher-inform">
	<div id="fio"><b><?=$staff_info['fio']?></b></div><br>
	<div id="universitet"><?=$staff_info['inst_name']?></div><br>
	<div id="facultet">Факультет: <?=$staff_info['fac_name']?></div><br>
	<div id="cafedra">Кафедра: <?=$staff_info['dep_name']?></div><br>
   </div>	
<ul id="tabs" class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#panel1"> Наукова робота</a></li>
	<li><a data-toggle='tab' href="#panel2"> Методична робота</a></li>
	<li><a data-toggle='tab' href="#panel3"> Організаційна робота</a></li>
</ul>
<div class="tab-content">
	<?php for ($i=1; $i <= 3; $i++) : //формирование содержимого панели?>
	  <?php if ($works[$i]): //роботы в наличии?> 
		  <div id="panel<?=$i?>" class="tab-pane fade<?php if ($i==1) echo ' in active'?>">
		    <div class="panel-group" id="accordion">
			  <?php foreach ($works[$i]['detal'] as $key=>$item): //формирование содержимого аккордеона?>
			  <div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$key?>">
			          <?=$item[0]?>
			        </a>
			      </h4>
		    	</div>
			    <div id="collapse<?=$key?>" class="panel-collapse collapse">
			      <div class="panel-body">
			        <table>
			        	<tr class="title-panel-body">
			        		<td><strong>Рік</strong></td>
			        		<td><strong>Повна назва роботи</strong></td>
			        	</tr>
			        	<?php foreach ($item['publ'] as $key => $item): //формирование таблицы статей?>
			        	<tr>
			        		<td><?=$item[1]?></td>
			        		<td><a href="?view=full_article&publ_id=<?=$key?>"><?=$item[0]?></a></td>
			        	</tr>
						<?php endforeach; //формирование таблицы статей?>
			        </table>
			      </div>
			    </div>
			  </div>
			  <?php endforeach; //формирование содержимого аккордеона?>      
			</div>
		  </div>
	  <?php else: //роботы отсутствуют?>
	  	<div id="panel<?=$i?>" class="tab-pane fade<?php if ($i==1) echo ' in active'?>">
	  	  <h4>Дані відсутні</h4>
	  	</div>
	  <?php endif; ?>
	<?php endfor; //формирование содержимого панели?>

</div>
</div>
