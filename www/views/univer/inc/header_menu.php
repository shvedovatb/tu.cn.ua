<?php defined('TU') or die('Access denied'); ?>
<ul class="header-menu-main">
<li>
      <ul class="header-menu">
       <!-- Пункт меню 1 -->
   <li><a href="?view=main"><span>Головна</span></a></li> 
        <!-- Пункт меню 2 -->
        <li><a href="?view=univer"><span>університет</span></a></li>                
         <!-- Пункт меню 3 -->      
        <li><a href="?view=stat"><span>статистика</span></a></li>
        <!-- Пункт меню 4 -->
        <li><a href="#" class="btn-modal" data-toggle="modal" data-target="#myModal"><span>наші викладачі</span></a>
</li> <!--При нажатии на эту ссылку появляется модальное окно с поиском препода --> 
     </ul> 
  </li>
  <li>   
     <ul class="header-menuTwo">
       <!--<li><a href="#" class="btn-modal" data-toggle="modal" data-target="#myModalreg">реєстрація</a>
       </li>-->
       <?php if(!$_SESSION['auth']['user']): ?>
       <li><a href="#" class="btn-modal" data-toggle="modal" data-target="#myModalauth">авторизація</a>
       </li>
       <?php
        if(isset($_SESSION['auth']['error'])){                        
           echo '<script> alert ("'.$_SESSION['auth']['error'].'");</script>';
           unset($_SESSION['auth']);
        }
     ?>
    <?php else: ?>
    <li class="auhtOut"><p>Доброго дня,</p>
             <span><?=htmlspecialchars($_SESSION['auth']['user'])?></span></li>
    <li><a href="?do=logout">Выход</a></li>
    <?php endif; ?>
    </ul>
  </li>
</ul>      

