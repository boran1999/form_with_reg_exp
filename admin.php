<?php
  include "formclass.php";
  $base = new formclass;
 ?>
<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <h2 align ="left"><font color="blue">Удаление данных</font></h2>
  <title>Test_Form</title>
 </head>
 <body bgcolor="lightblue">
	<form action="adm_form.php" method="POST">
		<?php
		$base->data_read();
		?>
	<p><input type="submit" value="Удалить"></p>
	</form>
 </body>
</html>
