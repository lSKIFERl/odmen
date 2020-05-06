<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>FORM</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        #background {
    background-image: url(https://i.pinimg.com/originals/86/66/85/866685bdd4bbc516ec1a13c956d4d7bf.jpg);
    background-attachment:fixed;
    background-color: steelblue;
}

a {
    color: lightsteelblue!important;
    text-decoration: none;
    font: 600;
}

body {
    color: lightskyblue !important;
    font-family: 'Courier New';
}

#Form {
    font-family: 'Courier New';
    border: 1px solid black;
    background: rgba(33, 31, 57, 0.43);
}

caption {
    caption-side: top;
    text-align: center;
    font-size: 14px;
    background-color:dimgrey;
}

#events{
	border-color:white;
	background-color:red;
	text-align:center;
	color:white;
}

.error{
	border: 2px solid red;

}
    </style>	
    </head>
	<body id='background'>
		<div id="Form">
			<div id="events">
				<p>Пожалуйста, заполните форму</p>
			</div>
			<form method="post" action="index.php" name="contract" class="py-3 px-3">
                <?php
                if (!empty($messages['save'])) {
                    print($messages['save']);
                }
                if(!empty($messages['login_and_password'])){
                    print($messages['login_and_password']);
                }
                ?>
				<div id="nam">
                    <?php
                    $ERROR='';
                    $name='';
                    if (!empty($messages['name'])) {
                        print($messages['name']);
                        $ERROR='error';
                    }
                    if(!empty($values['name'])){
                        $name=$values['name'];
                    }
                    ?>
					Имя:<input maxlength="25" size="40" name="name" placeholder="Введите имя" class="<?php print $ERROR?>" value="<?php print $name?>">
				</div>
                </br>
				<div id="address">
                    <?php
                    $ERROR='';
                    $email='';
                    if (!empty($messages['email'])) {
                        print($messages['email']);
                        $ERROR='error';
                    }
                    if(!empty($values['email'])){
                        $email=$values['email'];
                    }
                    ?>
					Email:<input name="email" value="<?php print $email?>" class="<?php print $ERROR?>" placeholder="email@yandex.ruexample@erebor.com">
				</div>
                </br>
				<div id="BIRTHYEAR">
                    <?php
                    $ERROR='';
                    $year='';
                    if (!empty($messages['year'])) {
                        print($messages['year']);
                        $ERROR='error';
                    }
                    if(!empty($values['year'])){
                        $year=$values['year'];
                    }
                    ?>
                    Дата рождения: <input name="year" value="<?php print $year?>" class="<?php print $ERROR?>" placeholder="17.05.2009">
                    
				</div>
                </br>
				<div id="SEX">
                    <?php
                    $ERROR='';
                    $sex='';
                    if (!empty($messages['sex'])) {
                        print($messages['sex']);
                        $ERROR='error';
                    }
                    if(!empty($values['sex'])){
                        $sex=$values['sex'];
                    }
                    ?>
                Пол:    <span class="<?php print $ERROR?>">
                            <input type="radio" value="M" name="sex"<?php if($values['sex']=='M') {print'checked';}?> >Муж
                            <input type="radio" value="F" name="sex"<?php if($values['sex']=='F') {print'checked';}?> >Жен
                            <input type="radio" value="С" name="sex"<?php if($values['sex']=='С') {print'checked';}?> >Я ещё не определилось
                    </span>
                </div>
                </br>
                <div id="LIMBS">
                    <?php
                    $ERROR='';
                    if (!empty($messages['limbs'])) {
                        print($messages['limbs']);
                        $ERROR='error';
                    }
                    ?>
                    Конечности:<?php
                    $select_limbs=array(1=>'',2=>'',2=>'',3=>'',4=>'',5=>'');
                    for($s=1;$s<=5;$s++){
                        if($values['limbs']==$s){
                            $select_limbs[$s]='checked';break;
                        }
                    }
                    ?>
                    <span class="<?php print $ERROR?>">
                        <input type="radio" value="1" name="limbs" <?php print $select_limbs[1]?>>1
                        <input type="radio" value="2" name="limbs" <?php print $select_limbs[2]?>>2
                        <input type="radio" value="3" name="limbs" <?php print $select_limbs[3]?>>3
                        <input type="radio" value="4" name="limbs" <?php print $select_limbs[4]?>>4
                        <input type="radio" value="5" name="limbs" <?php print $select_limbs[5]?>>5 и более
                    </span>
                </div>
                </br>

                <div id="SUPERPOWERS" >
                    <?php
                    $ERROR='';
                    if(!empty($messages['sverh'])){
                        print($messages['sverh']);
                        $ERROR='error';
                    }?>
                    <span >
                        Суперспособности:</br>
                        <?php
                         if(!empty($values['sverh'])){
                             $flag=FALSE;
                             $SVERH_PROVERKA = array("net" =>"", "disk" =>"", "tp" =>"", "invisibility" =>"", "regen" =>"", "food" =>"", "jesus" =>"");
                             $SVERH = unserialize($values['sverh']);
                            if(!empty($SVERH))foreach ($SVERH as $E){
                                if($E=="net"){
                                    $SVERH_PROVERKA["net"]="selected";
                                $flag=TRUE;break;}
                            }
                            if(!empty($SVERH))
                                    if(!$flag){
                                        foreach ($SVERH as $T){
                                            $SVERH_PROVERKA["$T"]="selected";
                                        }
                                    }
                         }
                        ?>
                        <select id="sposobnost" name="sverh[]" multiple="multiple" size="3" class="<?php print $ERROR?>">
                            <option value="net" <?php if(!empty($values['sverh'])) print $SVERH_PROVERKA["net"]?>>None</option>
                            <option disabled="" title="Будет доступно после познания вселенной" value="disk"<?php if(!empty($values['sverh'])) print $SVERH_PROVERKA["disk"]?> >Сдать дисмат с 1 раза на 5</option>
                            <option value="tp"<?php if(!empty($values['sverh'])) print $SVERH_PROVERKA["tp"]?> >Телепортация</option>
                            <option value="invisibility"<?php if(!empty($values['sverh'])) print $SVERH_PROVERKA["invisibility"]?> >Невидимость</option>
                            <option value="regen"<?php if(!empty($values['sverh'])) print $SVERH_PROVERKA["regen"]?> >Ускоренная регенерация</option>
                            <option value="food"<?php if(!empty($values['sverh'])) print $SVERH_PROVERKA["food"]?> >Вкусно готовить</option>
                            <option disabled="" title="Будет доступно после распятия" value="jesus">Ходить по воде</option>
                        </select>
                    </span>
                </div>
                </br>
                    <div id="biography">
                        <?php
                        $ERROR='';
                        $BIO='';
                        if (!empty($messages['biography'])) {
                            print($messages['biography']);
                            $ERROR='error';
                        }
                        if(!empty($values['biography'])){
                            $BIO=$values['biography'];
                        }
                        ?>
                        <p class="<?php print $ERROR?>" >
                            Ваша биография: </br>
                            <textarea cols="45" name="biography" placeholder="Величайшая история подвигов человека (или не очень человека), случайно забрёдшего в наше захолустье"><?php if($values['biography']){print $values['biography'];} ?></textarea>
                        </p>
                    </div>
                </br>
                    <div id="Consent"  >
                    <?php
                    $ERROR='';
                    $consent='';
                    if (!empty($messages['consent'])) {
                        print($messages['consent']);
                        $ERROR='error';
                    }
                    if(!empty($values['consent'])){
                        $consent='checked';
                    }
                    ?>
                    <span class="<?php print $ERROR?>" >Ставя свою подпись, вы принимаете условия компании ООО "Одинокая Гора" и согласны отправиться в путешествие к горе Эребор, а также не имеете никаких притязаний на трон Короля под Горой.
        Через время после отправки, с Вами свяжется высокий седобородый старец.
        <input type="checkbox" name="consent"  value="yes" <?php print $consent?>>
                    </span>
                </div>
                </br>
				<input type="submit" value="Отправить">
			</form>
            <?php   
                    if(!empty($_SESSION['login'])){
                        print('<form method="POST" action="login.php"><input type="submit" name="exit" value="Выход"></form>');
                    }
                ?>
		</div>	
	</body>
</html>