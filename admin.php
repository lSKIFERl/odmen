<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style>

</style>
</head>
</html>
<?php

/**
 * Задача 6. Реализовать вход администратора с использованием
 * HTTP-авторизации для просмотра и удаления результатов.
 **/

// Пример HTTP-аутентификации.
// PHP хранит логин и пароль в суперглобальном массиве $_SERVER.
// Подробнее см. стр. 26 и 99 в учебном пособии Веб-программирование и веб-сервисы.
$user = 'u17361';
$pass = '1020693';

$db = new PDO('mysql:host=localhost;dbname=u17361', $user, $pass,
array(PDO::ATTR_PERSISTENT => true));
foreach($db->query("SELECT login,password FROM odmen") as $row){
  $logadm = $row['login'];
  $passadm = $row['password'];
}

if (empty($_SERVER['PHP_AUTH_USER']) ||
    empty($_SERVER['PHP_AUTH_PW']) ||
    md5($_SERVER['PHP_AUTH_USER']) != md5($logadm) ||
md5(md5($_SERVER['PHP_AUTH_PW'])) != md5($passadm)) {
  header('HTTP/1.1 401 Unanthorized');
  header('WWW-Authenticate: Basic realm="My site"');
  print('<h1>401 Требуется авторизация</h1>');
  exit();
}

print('Вы успешно авторизовались и видите защищенные паролем данные.');

$connect = mysqli_connect('localhost', $user, $pass, 'u17361');
$dbinfo = mysqli_query($connect, 'SELECT * FROM cappapride');
print("<div class='row'><div class='col-1'>Id</div>
<div class='col-1'>Name</div>
<div class='col-1'>Login</div>
<div class='col-1'>Password</div>
<div class='col-1'>Email</div>
<div class='col-1'>Birth Date</div>
<div class='col-1'>Sex</div>
<div class='col-1'>Limbs</div>
<div class='col-1'>Abilities</div>
<div class='col-2'>Biography</div>
<div class='col-1'>Consent</div></div>");
while($row = mysql_fetch_row($dbinfo)){
  $id=$row['id'];
  $name=$row['name'];
  $login=$row['login'];
  $password=$row['password'];
  $email=$row['email'];
  $birth=$row['birth'];
  $sex=$row['sex'];
  $limbs=$row['limbs'];
  $sverh=$row['sverh'];
  $bio=$row['bio'];
  $consent=$row['consent'];
  print("<div class='row'><div class='col-1'>$id</div>
  <div class='col-1'>$name</div>
  <div class='col-1'>$login</div>
  <div class='col-1'>$password</div>
  <div class='col-1'>$email</div>
  <div class='col-1'>$birth</div>
  <div class='col-1'>$sex</div>
  <div class='col-1'>$limbs</div>
  <div class='col-1'>$sverh</div>
  <div class='col-2'>$bio</div>
  <div class='col-1'>$consent</div></div>");

print("<form action='' method='POST' style='background-color:#A9A9A9;display: inline-block;'>
<p style='font-size:150%;'>Добро пожаловать,{$_SERVER['PHP_AUTH_USER']}.</p>
<select name='dead' size='1'>
<option value=''>...</option>");
foreach($db->query("SELECT login FROM cappapride ") as $row){
  $user=$row['login'];
  print("<option value='$text'>$text</option>");
}
print("</select>
<input type='submit' value='Удолить'>
</form>");
if(!empty($_POST['dead'])){
  $die=$_POST['dead'];
  try {
    $stmt = $db->prepare("DELETE FROM cappapride WHERE login='$die'");
    $stmt->execute();
}catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
      }
      $die='';
      header('Location:admin.php');
  }
}
// *********
// Здесь нужно прочитать отправленные ранее пользователями данные и вывести в таблицу.
// Реализовать просмотр и удаление всех данных.
// *********
?>