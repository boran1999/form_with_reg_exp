<?php
  include "formclass.php";
  $base = new formclass;
  $base->data_insert();
  $base->save();
 ?>
<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <h2 align ="left"><font color="blue">Форма регистрации</font></h2>
  <title>Test_Form</title>
 </head>
 <body bgcolor="lightblue">
  <form action="<?= $_SERVER['REQUEST_URI'];?>" method="POST">
   <p><input placeholder="*имя" name="name" value="<?= isset($_POST['name']) ? $_POST['name']:''?>">
 </p>
   <p><input placeholder="*фамилия" name="sname" value="<?= isset($_POST['sname']) ? $_POST['sname']:''?>"> 
 </p>
   <p><input placeholder="*электронная почта" name="email" value="<?= isset($_POST['email']) ? $_POST['email']:''?>" required>
 </p>
   <p><input placeholder="*номер телефона" name="phone" value="<?= isset($_POST['phone']) ? $_POST['phone']:''?>">
 </p>
  <p><font color="blue">Выберите тематику конференции</font></p>
  <p>
    <select name="top" >
      <optgroup label="Topic">
        <option value="biz" name="biz">Бизнес</option>
        <option value="tech" name="tech">Технологии</option>
        <option value="adv" name="adv">Реклама и Маркетинг</option>
        </optgroup>
    </select>
  </p>
  <p><font color="blue">Выберите способ оплаты</font></p> 
  <p>
    <select name="paym">
      <optgroup label="Pay">
        <option value="wbm" name="wbm">Web-money</option>
        <option value="yam" name="yam">Яндекс деньги</option>
        <option value="pp" name="pp">PayPal</option>
        <option value="cred" name="cred">кредитная карта</option>
        </optgroup>
    </select>
  </p>
  <input type="checkbox" name="jel" value="yes"><font color="blue">Хотите получать рассылку о конференции?</font><br>
   <p><input type="submit" value="Отправить данные"></p>
  </form>
  <form action="admin.php">
   <button>admin</button>
  </form>
<div>
</div>
</body>
</html>
