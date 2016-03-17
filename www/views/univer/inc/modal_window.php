  <?php defined('TU') or die('Access denied'); ?>
 <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content modal-header modal-body">
       <div class="modal-body">
        <form method="post" action="#" class="form-horizontal"> 
  <div class="form-group">
    <label class="control-label col-xs-3" for="inputSearch"></label>
    <div class="col-xs-9">
      <input type="text" name="login"  class="form-control" id="inputSearch" required="required" placeholder="Введіть прізвище викладача">
    </div>
  </div> 
  <br />
  <div class="form-group">
    <div class="col-xs-offset-3 col-xs-9">
      <input type="submit" name="auth" id="auth" class="btn btn-primary" value="Пошук" />
      <input type="reset" class="btn btn-default" value="Очистити форму">
    </div>
  </div>
</form>
      </div>
      <div class="modal-footer">
        <a class="btn btn-default" data-dismiss="modal">Закрити</a>
      </div>
    </div>
  </div>
</div>

<!--РЕЄСТРАЦІЯ <div id="myModalreg" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content
    <div class="modal-content modal-header modal-body">
       <div class="modal-body">
        <form method="post" action="<?=PATH?>" class="form-horizontal">
  <div class="form-group ">
    <label class="control-label col-xs-3" for="lastName">Прізвище:</label>
    <div class="col-xs-9">
      <input type="text" name="f_name" value="<?=htmlspecialchars($_SESSION['reg']['f_name'])?>" class="form-control" id="lastName" required="required" placeholder="Введіть прізвище">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-xs-3" for="firstName">Им'я:</label>
    <div class="col-xs-9">
      <input type="text" name="s_name" value="<?=htmlspecialchars($_SESSION['reg']['s_name'])?>" class="form-control" id="firstName" required="required" placeholder="Введіть имя">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-xs-3" for="fatherName">По батькові:</label>
    <div class="col-xs-9">
      <input type="text" name="l_name" value="<?=htmlspecialchars($_SESSION['reg']['l_name'])?>" class="form-control" id="fatherName" required="required" placeholder="Введіть по батькові">
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-xs-3" for="inputLogin">Логін:</label>
    <div class="col-xs-9">
      <input type="text" name="login" value="<?=htmlspecialchars($_SESSION['reg']['login'])?>" class="form-control" id="inputLogin" required="required" placeholder="Введіть логін">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-xs-3" for="inputPassword">Пароль:</label>
    <div class="col-xs-9">
      <input type="password" name="pass" class="form-control" id="inputPassword" required="required" placeholder="Введіть пароль">
    </div>
  </div>
  <br />
  <div class="form-group">
    <div class="col-xs-offset-3 col-xs-9">
      <input type="submit"  name="reg" class="btn btn-primary" value="Реєстрація">
      <input type="reset" class="btn btn-default" value="Очистити форму">
    </div>
  </div>
</form>

      <?php    
    if(isset($_SESSION['reg']['res'])){
        echo '<script> alert ("'.$_SESSION['reg']['res'].'");</script>';
        unset($_SESSION['reg']);
    } ?>
      </div>
      <div class="modal-footer">
        <a class="btn btn-default" data-dismiss="modal">Закрити</a>
      </div>
    </div>

  </div>
</div>
РЕЄСТРАЦІЯ -->


<!--АВТОРИЗАЦИЯ -->
<div id="myModalauth" class="modal fade" role="dialog">
  <div class="modal-dialog">
   
    <div class="modal-content modal-header modal-body">
       <div class="modal-body">


                <form method="post" action="#" class="form-horizontal"> 
  <div class="form-group">
    <label class="control-label col-xs-3" for="inputLogin">Логін:</label>
    <div class="col-xs-9">
      <input type="text" name="login"  class="form-control" id="inputLogin" required="required" placeholder="Введіть логін">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-xs-3" for="inputPassword">Пароль:</label>
    <div class="col-xs-9">
      <input type="password" name="pass" class="form-control" id="inputPassword" required="required" placeholder="Введіть пароль">
    </div>
  </div>
  <br />
  <div class="form-group">
    <div class="col-xs-offset-3 col-xs-9">
      <input type="submit" name="auth" id="auth" class="btn btn-primary" value="Увійти" />
      <input type="reset" class="btn btn-default" value="Очистити форму">
    </div>
  </div>
</form>
    
 </div>
      <div class="modal-footer">
        <a class="btn btn-default" data-dismiss="modal">Закрити</a>
      </div>
    </div>

  </div>
</div><!--АВТОРИЗАЦИЯ -->

