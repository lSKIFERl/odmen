<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style>
  body{
    background-image: url(https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/62880f36-b83d-4aba-8bcb-64d54f81b96a/d36b6hi-356fe675-8477-4c1a-902d-100bdd1bc85c.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzYyODgwZjM2LWI4M2QtNGFiYS04YmNiLTY0ZDU0ZjgxYjk2YVwvZDM2YjZoaS0zNTZmZTY3NS04NDc3LTRjMWEtOTAyZC0xMDBiZGQxYmM4NWMucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.fuFdxlHfqBJnLAT-tNl7ybuNCw4aKCb3w9TpS4TjrEI);
    background-attachment:fixed;
  }
  .a{
    font-family: 'Courier New';
    border: 1px solid black;
    background-color:rgba(255, 69, 0, 0.4);
  }
  .b{
    font-family: 'Courier New';
    border: 1px solid black;
    background-color:rgba(105, 105, 105, 0.5);
    color: white;
  }
  .delete{
    font-family: 'Courier New';
    background-color:rgba(112, 128, 144, 0.55);
    color: white;
  }
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

echo('Удачная авторизация');

print("<form action='' method='POST' class = 'col delete'>
<p>Добро пожаловать, {$_SERVER['PHP_AUTH_USER']}.</p>
<select name='dead' size='1'>
<option value=''>...</option>");
foreach($db->query("SELECT login FROM cappapride ") as $row){
  $user=$row['login'];
  print("<option value='$user'>$user</option>");
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


$connect = mysqli_connect('localhost', $user, $pass, 'u17361');
$dbinfo = mysqli_query($connect, 'SELECT * FROM cappapride');
print("<div class='row'><div class='col-1'>Id</div>
<div class='col-1 a'>Name</div>
<div class='col-1 b'>Login</div>
<div class='col-1 a>Password</div>
<div class='col-1 b'>Email</div>
<div class='col-1 a'>Birth Date</div>
<div class='col-1 b'>Sex</div>
<div class='col-1 a'>Limbs</div>
<div class='col-1 b'>Abilities</div>
<div class='col-2 a'>Biography</div>
<div class='col-1 b'>Consent</div></div>");
while($row = mysqli_fetch_array($dbinfo)){
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
  <div class='col-1 a'>$name</div>
  <div class='col-1 b'>$login</div>
  <div class='col-1 a'>$password</div>
  <div class='col-1 b'>$email</div>
  <div class='col-1 a'>$birth</div>
  <div class='col-1 b'>$sex</div>
  <div class='col-1 a'>$limbs</div>
  <div class='col-1 b'>$sverh</div>
  <div class='col-2 a'>$bio</div>
  <div class='col-1 b'>$consent</div></div>");
}

// *********
// Здесь нужно прочитать отправленные ранее пользователями данные и вывести в таблицу.
// Реализовать просмотр и удаление всех данных.
// *********
?>