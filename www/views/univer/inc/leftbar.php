<?php defined('TU') or die('Access denied'); ?>

<div class="leftbar">
  <div class="main">
    <!--Меню институтов -->
    <div class="title_depart">
    <ul id="menu">
      <ul class="category">
        <?php foreach ($cat as $key => $item): ?>
          <li class="active has-sub">
            <a href="#"><h3><?=$item[0]?></h3></a>
            <?php if(count($item)>1):?> 
              <ul>
                <?php foreach($item['fac'] as $key=>$fac): ?>
                  <li class="has-sub">
                    <a href="?view=univer&amp;category=<?=$key?>"><?=$fac[0]?> факультет</a>
                    <?php if(count($fac)>1):?>
                      <ul>    
                        <?php foreach($fac['dep'] as $key=>$dep): ?>
                          <li>
                            <a href="?view=teacherall&amp;category=<?=$key?>">кафедра <?=$dep?></a>
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    <?php endif; ?>
                  </li> 
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
      </ul>
    </div>
  </div>
</div>

