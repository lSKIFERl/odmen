<?php

/**
 * Файл login.php для не авторизованного пользователя выводит форму логина.
 * При отправке формы проверяет логин/пароль и создает сессию,
 * записывает в нее логин и id пользователя.
 * После авторизации пользователь перенаправляется на главную страницу
 * для изменения ранее введенных данных.
 **/

// Отправляем браузеру правильную кодировку,
// файл login.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');
session_start();
$_SESSION['csrf_token'] = substr( str_shuffle( 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM' ), 0, 10 );
/*function generate_form_token() {
  return $_SESSION['csrf_token'] = substr( str_shuffle( 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM' ), 0, 10 );
  }*/
// Начинаем сессию.
if (!empty($_POST['exit'])) {
  session_destroy();
  session_write_close();
  header('Location:./');
}
// В суперглобальном массиве $_SESSION хранятся переменные сессии.
// Будем сохранять туда логин после успешной авторизации.


// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  ?>
<head>
  <title>Autorization</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<div class="Form">
  <form action="" method="post">
    Логин:<input name="login"/>
    Пароль:<input name="pass" type="password"/>
    <input name="csrf_token" type="hidden" value="<?php print $_SESSION['csrf_token']?>" />
    <input type="submit" value="Войти" />
  </form>
</div>
<?php
}
// Иначе, если запрос был методом POST, т.е. нужно сделать авторизацию с записью логина в сессию.
else if( isset( $_SESSION['csrf_token'] ) && $_SESSION['csrf_token'] == $_POST['csrf_token'] ){
        $flag=FALSE;
        $MESSAGE='';
        $user = 'u17361';
        $pass = '1020693';
        $log=$_POST['login'];
        $db = new PDO('mysql:host=localhost;dbname=u17361', $user, $pass,
        array(PDO::ATTR_PERSISTENT => true));
        if(!empty($_POST['login']) && !empty($_POST['pass'])){
          foreach($db->query("SELECT login FROM odmen") as $row){  
          if($_POST['login']==$row['login'])
            {
              $_SERVER['PHP_AUTH_USER'] = $_POST['login'];
              $_SERVER['PHP_AUTH_PW'] = $_POST['pass'];
              header('Location: admin.php');
            }
          }
            foreach($db->query("SELECT login FROM cappapride") as $row) {
              if($_POST['login']==$row['login']){
                $flag=TRUE;
                break;
              }
            }
            if($flag){
              $_SESSION['login']=$_POST['login'];
              $_SESSION['user_id']=rand(1,255);
              header('Location:./');
            }else{
              print("<div><img src='https://www.meme-arsenal.com/memes/1cf32f2e0a98eaf59f98f39f28c1de81.jpg' width='500' height='353'></div>");
            }
        }else{
          print("Заполните поля для логина и пароля.");
        }
    }else{
      echo($_POST['csrf_token']);
      echo($_SESSION['csrf_token']);
    }       
?>
